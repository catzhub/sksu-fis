<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

ob_start();

require 'include/dbconnect.php';

header('Content-Type: application/json');

ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);

session_start();


/* ============================
   READ INPUT
============================ */

$data = json_decode(
  file_get_contents("php://input"),
  true
);

if (!isset($data['credential'])) {

  echo json_encode([
    "status"=>"error",
    "message"=>"Missing credential"
  ]);

  exit;

}


/* ============================
   VERIFY GOOGLE
============================ */

$credential =
$data['credential'];

$verify_url =
"https://oauth2.googleapis.com/tokeninfo?id_token=" .
$credential;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $verify_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

if ($response === FALSE) {

  echo json_encode([
    "status"=>"error",
    "message"=>"Token verification failed"
  ]);

  exit;

}

$payload =
json_decode($response, true);

if (!$payload) {

  echo json_encode([
    "status"=>"error",
    "message"=>"Invalid Google token"
  ]);

  exit;

}


/* ============================
   VALIDATE CLIENT ID
============================ */

$client_id =
"1067806573057-rmecopun8e761up24tb2ukui86h4600b.apps.googleusercontent.com";

if ($payload['aud'] !== $client_id) {

  echo json_encode([
    "status"=>"error",
    "message"=>"Invalid client ID"
  ]);

  exit;

}


/* ============================
   EXTRACT GOOGLE DATA
============================ */

$email     = $payload['email'];
$name      = $payload['name'];
$picture   = $payload['picture'];
$google_id = $payload['sub'];


/* ============================
   GET USER FROM DATABASE
============================ */

$stmt = $conn->prepare("

SELECT 
    e.*,
    c.campname,
    u.access_module,
    u.usertype

FROM employees_2 e

INNER JOIN campuses c 
    ON e.campid = c.campid

LEFT JOIN users u
    ON e.empid = u.empid
    AND u.access_module = 'inspire'

WHERE e.emp_email = ?

");

$stmt->bind_param(
  "s",
  $email
);

if (!$stmt->execute()) {

  echo json_encode([
    "status"=>"error",
    "message"=>"Database Error"
  ]);

  exit;

}

$result =
$stmt->get_result();

if ($result->num_rows !== 1) {

  echo json_encode([
    "status"=>"error",
    "message"=>"Unauthorized email"
  ]);

  exit;

}

$user =
$result->fetch_assoc();


/* ============================
   STORE SESSION (KEEP FORMAT)
============================ */

$_SESSION['auth'] = [

    'logged_in' => true,

    'login_time' => time(),

    'access_module' =>
        $user['access_module'] ?? null,

    'usertype' =>
        $user['usertype'] ?? 'Faculty',

    'google' => [

        'sub' => $payload['sub'] ?? null,
        'email' => $payload['email'] ?? null,
        'name' => $payload['name'] ?? null,
        'given_name' => $payload['given_name'] ?? null,
        'family_name' => $payload['family_name'] ?? null,
        'picture' => $payload['picture'] ?? null,
        'email_verified' => $payload['email_verified'] ?? null,
        'issuer' => $payload['iss'] ?? null,
        'audience' => $payload['aud'] ?? null,
        'expires' => $payload['exp'] ?? null

    ],

    'db' => $user

];


/* OPTIONAL SHORTCUTS */

$_SESSION['user_id'] =
$user['empid'];

$_SESSION['user_name'] =
$user['emp_fname'] .
' ' .
$user['emp_lname'];

$_SESSION['designation'] =
$user['emp_designation'];

$_SESSION['campus'] =
$user['campname'];


/* SECURITY */

session_regenerate_id(true);


/* ============================
   DECIDE REDIRECT
============================ */

if ($user['access_module'] === 'inspire') {

    $redirect =
    "admin/employees.php";

}
else {

    $redirect =
    "employee-profile.php";

}


/* ============================
   RETURN RESPONSE
============================ */

ob_clean();

echo json_encode([

  "status"=>"success",

  "redirect"=>$redirect

]);

exit;
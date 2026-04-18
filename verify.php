<?php
session_start();
// include 'include/dbconnect.php';
// include 'config.php';

// if (!isset($_POST['credential'])) {
//     die('Invalid request');
// }

// $token = $_POST['credential'];

// /* VERIFY TOKEN WITH GOOGLE */
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL,
//     "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token);

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $response = curl_exec($ch);

// if (curl_errno($ch)) {
//     die('Token verification failed');
// }

// curl_close($ch);

// /* Decode Google response */
// $payload = json_decode($response, true);

// if (!isset($payload['email'])) {
//     die('Invalid Google token');
// }

// /* Restrict institutional domain */
// if (!str_ends_with($payload['email'], '@sksu.edu.ph')) {
//     die('Unauthorized domain');
// }

// /* Validate audience */
// if ($payload['aud'] != '1067806573057-rmecopun8e761up24tb2ukui86h4600b.apps.googleusercontent.com') {
//     die('Invalid client ID');
// }

// $email = $payload['email'];

// /* DATABASE QUERY */
// $stmt = $conn->prepare("
// 	SELECT 
// 	    e.*,
// 	    c.campname,
// 	    u.access_module,
// 	    u.usertype
// 	FROM employees_2 e
// 	INNER JOIN campuses c 
// 	    ON e.campid = c.campid

// 	LEFT JOIN users u
// 	    ON e.empid = u.empid
// 	    AND u.access_module = 'inspire'

// 	WHERE e.emp_email = ?
// ");

// $stmt->bind_param("s", $email);
// $stmt->execute();

// $result = $stmt->get_result();

// if ($result->num_rows == 1) {

//     session_regenerate_id(true);

//     $user = $result->fetch_assoc();

//     /*
//     ===============================
//     STORE COMPLETE SESSION
//     ===============================
//     */

//     $_SESSION['auth'] = [

//         'logged_in' => true,

//         'login_time' => time(),

// 	    'access_module' =>
// 	        $user['access_module'] ?? null,

// 	    'usertype' =>
// 	        $user['usertype'] ?? 'Faculty',

//         'google' => [

//             'sub' => $payload['sub'] ?? null,
//             'email' => $payload['email'] ?? null,
//             'name' => $payload['name'] ?? null,
//             'given_name' => $payload['given_name'] ?? null,
//             'family_name' => $payload['family_name'] ?? null,
//             'picture' => $payload['picture'] ?? null,
//             'email_verified' => $payload['email_verified'] ?? null,
//             'issuer' => $payload['iss'] ?? null,
//             'audience' => $payload['aud'] ?? null,
//             'expires' => $payload['exp'] ?? null

//         ],

//         'db' => $user

//     ];

//     /*
//     OPTIONAL SHORTCUT VARIABLES
//     */

//     $_SESSION['user_id'] =
//         $user['empid'];

//     $_SESSION['user_name'] =
//         $user['emp_fname'] .
//         ' ' .
//         $user['emp_lname'];

//     $_SESSION['designation'] =
//         $user['emp_designation'];

//     $_SESSION['campus'] =
//         $user['campname'];
    
// 	/* ===============================
// 	   ROLE-BASED REDIRECT
// 	=============================== */

// 	if (!empty($user['access_module'])) {

// 	    if ($user['access_module'] === 'inspire') {

// 	        /* Admin user */

// 	        header('location:' . BASE_URL . 'admin/employees.php');
// 	        exit;

// 	    }

// 	}

// 	/* Regular Faculty */

// 	header('location:' . BASE_URL . 'employee-profile.php');
// 	exit;

// }
// else {

//     header('location:' . BASE_URL . 'index.php?status=nf');
//     exit;

// }

header('location:employee-profile.php');
?>
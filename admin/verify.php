<?php  

session_start();
include '../include/dbconnect.php';
    // header('location:users-profile.php');

// The JWT token you want to decode
$jwt_token = $_POST['credential'];

// Step 1: Split the JWT into its components (header, payload, signature)
$parts = explode('.', $jwt_token);

if (count($parts) != 3) {
    die('Invalid JWT');
}

// Step 2: Base64Url decode the payload
$payload = $parts[1];

// Add padding to the payload for proper Base64 decoding
$payload = str_pad($payload, strlen($payload) + (4 - strlen($payload) % 4) % 4, '=');

// Decode from Base64Url
$decoded_payload = base64_decode(strtr($payload, '-_', '+/')); // Convert from Base64Url to Base64

// Step 3: Convert the payload (which is a JSON object) into a PHP array
$payload_data = json_decode($decoded_payload, true);

// Step 4: Print the decoded payload data
// echo '<pre>';
// print_r($payload_data);
// echo '<br>';
// echo $payload_data['email'];

$email = $payload_data['email'];
$query = "
	SELECT * FROM employees_2 
	INNER JOIN campuses USING (campid)
	WHERE emp_email = '$email'
";
$select = mysqli_query($conn, $query);
// print_r($select);
if (mysqli_num_rows($select)==1) {
    
	$_SESSION['user_data'] = $payload_data;
	$_SESSION['user_data_2'] = mysqli_fetch_assoc($select);
	// $_SESSION['user_data']['loggedin']=>1;
// 	print_r(mysqli_fetch_assoc($select));
// 	header('location:https://sksu-orms.net/myprofile/users-profile.php');
    header('location:employees.php');

}else{

	header('location:index.php');
}

?>
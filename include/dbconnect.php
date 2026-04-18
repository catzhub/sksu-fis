<?php
$servername = "localhost";
// $username = "tnrmssks25";  // Your database username
// $password = "Mn3m0n1cs_18";      // Your database password

$username = "root";  // Your database username
$password = "";      // Your database password

$database = "tnrmssks25_sksucampman";  // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully!";
?>

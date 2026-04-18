<?php

session_start();
include 'include/dbconnect.php';

if (!isset($_SESSION['auth']['db']['empid'])) {

    die("Unauthorized");

}

$empid =
$_SESSION['auth']['db']['empid'];

if (!isset($_GET['id'])) {

    die("Invalid request");

}

$file_id =
intval($_GET['id']);

$stmt =
$conn->prepare("
SELECT *
FROM employee_files
WHERE file_id = ?
AND empid = ?
AND is_deleted = 0
");

$stmt->bind_param(
    "ii",
    $file_id,
    $empid
);

$stmt->execute();

$result =
$stmt->get_result();

if ($result->num_rows !== 1) {

    die("File not found");

}

$row =
$result->fetch_assoc();

$filepath =
"files/forms/" .
$row['file_name'];

if (!file_exists($filepath)) {

    die("File missing");

}

header('Content-Type: ' .
$row['file_type']);

header('Content-Disposition: attachment; filename="' .
$row['file_original_name'] .
'"');

header('Content-Length: ' .
filesize($filepath));

readfile($filepath);

exit;
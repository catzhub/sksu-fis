<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_SESSION['auth']['logged_in'])) {

    header('location:index.php');
    exit;

}

if (empty($_SESSION['csrf'])) {

    $_SESSION['csrf'] =
    bin2hex(random_bytes(32));

}
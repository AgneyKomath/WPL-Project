<?php
session_start();

if(!isset($_SESSION['admin_user'])) {
    header("Location: index.php");
    exit();
}

$connection = pg_connect("host=localhost dbname=TRANSPORT user=postgres password=kjsce");

if (!$connection) {
    echo "An error occurred while connecting to the database.<br>";
    exit();
}
?>

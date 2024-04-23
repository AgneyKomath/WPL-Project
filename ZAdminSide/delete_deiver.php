<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $driver_id = $_GET['id'];

    $sql = "DELETE FROM employee WHERE employee_id = $driver_id";
    if (pg_query($connection, $sql)) {
        echo "Driver deleted successfully!";
    } else {
        echo "Error deleting driver: " . pg_last_error($connection);
    }

    header("Location: manage_driver.php");
    exit();
} else {
    echo "Driver ID not provided";
    exit();
}
?>


<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $material_id = $_GET['id'];

    $sql = "DELETE FROM raw_materials WHERE material_id = $material_id";
    if (pg_query($connection, $sql)) {
        echo "Raw material deleted successfully!";
    } else {
        echo "Error deleting raw material: " . pg_last_error($connection);
    }

    header("Location: manage_raw_material.php");
    exit();
} else {
    echo "Material ID not provided";
    exit();
}
?>

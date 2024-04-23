<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST['quantity'];
    $unit_of_measure = $_POST['unit_of_measure'];
    $description = $_POST['description'];
    $supplier_id = $_POST['supplier_id'];
    $material_name = $_POST['material_name'];

    $sql = "INSERT INTO raw_materials (quantity_in_stock, unit_of_measure, material_description, supplier_id, material_name) 
            VALUES ('$quantity', '$unit_of_measure', '$description', '$supplier_id', '$material_name')";

    if (pg_query($connection, $sql)) {
        echo "New raw material added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . pg_last_error($connection);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Raw Material</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Add Raw Material</h1>
    </header>

    <aside>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="manage_raw_material.php">Manage Raw Materials</a></li>
        </ul>
    </aside>

    <main>
        <h2>Add New Raw Material</h2>
        <form method="post">
            <label for="material_name">Name:</label>
            <input type="text" id="material_name" name="material_name" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <label for="unit_of_measure">Unit of Measure:</label>
            <input type="text" id="unit_of_measure" name="unit_of_measure" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            <label for="supplier_id">Supplier ID:</label>
            <input type="number" id="supplier_id" name="supplier_id" required>
            <button type="submit">Add Raw Material</button>
        </form>
    </main>

</body>
</html>

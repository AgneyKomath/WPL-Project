<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $material_id = $_POST['material_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $unit_of_measure = $_POST['unit_of_measure'];
    $supplier_id = $_POST['supplier_id'];

    $sql = "UPDATE raw_materials SET 
            material_name = '$name', 
            material_description = '$description', 
            quantity_in_stock = '$quantity', 
            unit_of_measure = '$unit_of_measure', 
            supplier_id = '$supplier_id' 
            WHERE material_id = $material_id";

    if (pg_query($connection, $sql)) {
        echo "Raw material updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . pg_last_error($connection);
    }
}

if (isset($_GET['id'])) {
    $material_id = $_GET['id'];
    $sql = "SELECT * FROM raw_materials WHERE material_id = $material_id";
    $result = pg_query($connection, $sql);

    if ($result && pg_num_rows($result) == 1) {
        $row = pg_fetch_assoc($result);
    } else {
        echo "Raw material not found";
        exit();
    }
} else {
    echo "Raw material ID not provided";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Raw Material</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Edit Raw Material</h1>
    </header>

    <aside>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="manage_raw_material.php">Manage Raw Materials</a></li>
        </ul>
    </aside>

    <main>
        <h2>Edit Raw Material</h2>
        <form method="post">
            <input type="hidden" name="material_id" value="<?php echo $row['MATERIAL_ID']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['MATERIAL_NAME']; ?>" required>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $row['MATERIAL_DESCRIPTION']; ?>" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $row['QUANTITY_IN_STOCK']; ?>" required>
            <label for="unit_of_measure">Unit of Measure:</label>
            <input type="text" id="unit_of_measure" name="unit_of_measure" value="<?php echo $row['UNIT_OF_MEASURE']; ?>" required>
            <label for="supplier_id">Supplier ID:</label>
            <input type="number" id="supplier_id" name="supplier_id" value="<?php echo $row['SUPPLIER_ID']; ?>" required>
            <button type="submit">Update Raw Material</button>
        </form>
    </main>

</body>
</html>

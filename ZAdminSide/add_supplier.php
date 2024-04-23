<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'];
    $supplier_contact = $_POST['supplier_contact'];
    $supplier_location = $_POST['supplier_location'];
    
    $sql = "INSERT INTO supplier (supplier_name, supplier_contact, supplier_location) VALUES ('$supplier_name', '$supplier_contact', '$supplier_location')";
    if (pg_query($connection, $sql)) {
        echo "Supplier added successfully!";
        header("Location:manage_suppliers.php");
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
    <title>Add Supplier</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <div class="container">
        <h2>Add Supplier</h2>
        <form method="post">
            <input type="text" name="supplier_name" placeholder="Supplier Name" required><br>
            <input type="text" name="supplier_contact" placeholder="Supplier Contact" required><br>
            <input type="text" name="supplier_location" placeholder="Supplier Location" required><br>
            <button type="submit">Add Supplier</button>
        </form>
        <a href="admin_panel.php" class="back-btn">Back to Admin Panel</a>
    </div>

</body>
</html>

<?php
include 'db_connection.php';

if (!isset($_GET['id'])) {
    header("Location: manage_suppliers.php");
    exit();
}

$supplier_id = $_GET['id'];

$sql = "SELECT * FROM supplier WHERE supplier_id = $supplier_id";
$result = pg_query($connection, $sql);

if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result); 
} else {
    header("Location: manage_suppliers.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'];
    $supplier_contact = $_POST['supplier_contact'];
    $supplier_location = $_POST['supplier_location'];
    
    $sql = "UPDATE supplier SET supplier_name='$supplier_name', supplier_contact='$supplier_contact', supplier_location='$supplier_location' WHERE supplier_id=$supplier_id";
    if (pg_query($connection, $sql)) {
        echo "Supplier updated successfully!";
        header("Location: manage_suppliers.php");
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
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <div class="container">
        <h2>Edit Supplier</h2>
        <form method="post">
            <input type="text" name="supplier_name" placeholder="Supplier Name" value="<?php echo isset($row['SUPPLIER_NAME']) ? $row['SUPPLIER_NAME'] : ''; ?>" required><br>
            <input type="text" name="supplier_contact" placeholder="Supplier Contact" value="<?php echo isset($row['SUPPLIER_CONTACT']) ? $row['SUPPLIER_CONTACT'] : ''; ?>" required><br>
            <input type="text" name="supplier_location" placeholder="Supplier Location" value="<?php echo isset($row['SUPPLIER_LOCATION']) ? $row['SUPPLIER_LOCATION'] : ''; ?>" required><br>
            <button type="submit">Update Supplier</button>
        </form>
        <a href="manage_suppliers.php" class="back-btn">Back to Manage Suppliers</a>
    </div>

</body>
</html>

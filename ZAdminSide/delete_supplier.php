<?php
include 'db_connection.php';

if (!isset($_GET['id'])) {
    header("Location: manage_suppliers.php");
    exit();
}

$supplier_id = $_GET['id'];

$sql = "SELECT * FROM supplier WHERE supplier_id = $supplier_id";
$result = pg_query($connection, $sql);

if (pg_num_rows($result) == 1) {
    $row = pg_fetch_assoc($result);
} else {
    header("Location: manage_suppliers.php");
    exit();
}

if (isset($_POST['confirm'])) {
    if ($_POST['confirm'] === 'yes') {
        $sql_delete = "DELETE FROM supplier WHERE supplier_id = $supplier_id";
        if (pg_query($connection, $sql_delete)) {
            echo "Supplier deleted successfully!";
        } else {
            echo "Error deleting supplier: " . pg_last_error($connection);
        }
    }
    header("Location: manage_suppliers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Supplier</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <div class="container">
        <h2>Delete Supplier</h2>
        <p>Are you sure you want to delete this supplier?</p>
        <form method="post">
            <button type="submit" name="confirm" value="yes">Yes, Delete</button>
            <button type="button" class="back-btn" onclick="location.href='manage_suppliers.php';">No, Cancel</button>
        </form>
    </div>

</body>
</html>

<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $driver_id = $_POST['driver_id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    $sql = "UPDATE employee SET employee_name = '$name', employee_contact = '$contact' WHERE employee_id = $driver_id";

    if (pg_query($connection, $sql)) {
        echo "Driver updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . pg_last_error($connection);
    }
}

if (isset($_GET['id'])) {
    $driver_id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE employee_id = $driver_id";
    $result = pg_query($connection, $sql);

    if (pg_num_rows($result) == 1) {
        $row = pg_fetch_assoc($result);
    } else {
        echo "Driver not found";
        exit();
    }
} else {
    echo "Driver ID not provided";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Driver</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Edit Driver</h1>
    </header>

    <aside>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="manage_driver.php">Manage Drivers</a></li>
        </ul>
    </aside>

    <main>
        <h2>Edit Driver</h2>
        <form method="post">
            <input type="hidden" name="driver_id" value="<?php echo $row['employee_id']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['employee_name']; ?>" required>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row['employee_contact']; ?>" required>
            <button type="submit">Update Driver</button>
        </form>
    </main>

</body>
</html>

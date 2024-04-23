<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    // Escape special characters to prevent SQL injection
    $name = pg_escape_string($connection, $name);
    $contact = pg_escape_string($connection, $contact);

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO EMPLOYEE (EMPLOYEE_NAME, EMPLOYEE_CONTACT, EMPLOYEE_POSITION) VALUES ($1, $2, 'driver')";

    // Prepare and execute the SQL statement using parameters
    $result = pg_query_params($connection, $sql, array($name, $contact));

    // Check if the query was executed successfully
    if ($result) {
        echo "New driver added successfully!";
    } else {
        echo "Error: " . pg_last_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Driver</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Add Driver</h1>
    </header>

    <aside>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="manage_driver.php">Manage Drivers</a></li>
        </ul>
    </aside>

    <main>
        <h2>Add New Driver</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
            <button type="submit">Add Driver</button>
        </form>
    </main>

</body>
</html>

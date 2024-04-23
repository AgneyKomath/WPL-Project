<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Drivers</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Manage Drivers</h1>
    </header>

    <aside>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="add_driver.php">Add Driver</a></li>
        </ul>
    </aside>

    <main>
        <h2>Drivers List</h2>
        <table>
            <thead>
                <tr>
                    <th>Driver ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Edit</th> 
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM EMPLOYEE WHERE EMPLOYEE_POSITION = 'driver'";
                $result = pg_query($connection, $sql);

                if ($result && pg_num_rows($result) > 0) {
                    while ($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['employee_id'] . "</td>";
                        echo "<td>" . $row['employee_name'] . "</td>";
                        echo "<td>" . $row['employee_contact'] . "</td>";
                        echo "<td><a href='edit_driver.php?id=" . $row['employee_id'] . "' class='edit-btn'>Edit</a></td>"; 
                        echo "<td><a href='delete_driver.php?id=" . $row['employee_id'] . "' class='delete-btn'>Delete</a></td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No drivers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>
</html>

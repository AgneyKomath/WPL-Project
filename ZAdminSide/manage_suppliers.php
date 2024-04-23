<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Suppliers</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Manage Suppliers</h1>
    </header>

    <aside>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="add_supplier.php">Add Supplier</a></li>
        </ul>
    </aside>

    <main>
        <h2>Suppliers List</h2>
        <table>
            <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Supplier Name</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Edit</th> 
                    <th>Delete</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM supplier";
                $result = pg_query($connection, $sql);

                if ($result && pg_num_rows($result) > 0) {
                    while($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['supplier_id'] . "</td>";
                        echo "<td>" . $row['supplier_name'] . "</td>";
                        echo "<td>" . $row['supplier_contact'] . "</td>";
                        echo "<td>" . $row['supplier_location'] . "</td>";
                        echo "<td><a href='edit_supplier.php?id=" . $row['supplier_id'] . "' class='edit-btn'>Edit</a></td>"; 
                        echo "<td><a href='delete_supplier.php?id=" . $row['supplier_id'] . "' class='delete-btn'>Delete</a></td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No suppliers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>
</html>

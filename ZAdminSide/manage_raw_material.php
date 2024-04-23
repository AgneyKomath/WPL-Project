<?php
include 'db_connection.php';

$sql = "SELECT * FROM raw_materials";
$result = pg_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Raw Materials</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Manage Raw Materials</h1>
    </header>

    <aside>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="add_raw_material.php">Add Raw Materials</a></li>
        </ul>
    </aside>

    <main>
        <h2>Raw Materials List</h2>
        <table>
            <thead>
                <tr>
                    <th>Material ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit of Measure</th>
                    <th>Supplier ID</th>
                    <th>Edit</th> 
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && pg_num_rows($result) > 0) {
                    while($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['material_id'] . "</td>";
                        echo "<td>" . $row['material_name'] . "</td>";
                        echo "<td>" . $row['material_description'] . "</td>";
                        echo "<td>" . $row['quantity_in_stock'] . "</td>";
                        echo "<td>" . $row['unit_of_measure'] . "</td>";
                        echo "<td>" . $row['supplier_id'] . "</td>";
                        echo "<td><a href='edit_raw_material.php?id=" . $row['material_id'] . "' class='edit-btn'>Edit</a></td>"; 
                        echo "<td><a href='delete_raw_material.php?id=" . $row['material_id'] . "' class='delete-btn'>Delete</a></td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No raw materials found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>
</html>

<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();
    
    // Redirect to the login page or any other page after logout
    header("Location: index.php");
    exit();
}

$connection = pg_connect("host=localhost dbname=TRANSPORT user=postgres password=kjsce");

if (!$connection) {
    echo "An error occurred while connecting to the database.<br>";
    exit();
}

// Query to select all rows from the table (replace 'your_table_name' with your actual table name)
$query = "SELECT * FROM raw_materials";
$result = pg_query($connection, $query);

if (!$result) {
    echo "An error occurred while executing the query.<br>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raw Materials Page</title>
    <link rel="stylesheet" href="assets/styles/rawstyle.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f18c4a11f7.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <h1>
            <a href="home.php">
                Supply Chain Management
            </a>
        </h1>
        <h2>
        <?php 
        if(isset($_SESSION['user_id'])) {
            echo "Welcome, ".$_SESSION['user_id'];
        }
        ?>
        </h2>
    </header>
    <nav class="navbar">
        <ul>
            <li><a href="home.php"><i class="fa-solid fa-truck"></i></a></li>
            <li><a href="order.php">Order List</a></li>
            <li><a href="rawmats.php">Raw Materials</a></li>
            <li><a href="">asdfasdfas</a></li>
        </ul>
        <div class="logout">
            <a href="?logout">Logout<i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
        
        
    </nav>

    <main>
        <div class="tableList">
            <h3>Raw Materials</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Material Name</th>
                    <th>Material Description</th>
                    <th>Quantity in Stock</th>
                    <th>Unit Of Measure</th>
                    <th>Supplier ID</th>
                </tr>
                <?php 
                while ($row = pg_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['material_id'] . "</td>";
                    echo "<td>" . $row['material_name'] . "</td>";
                    echo "<td>" . $row['material_description'] . "</td>";
                    echo "<td>" . $row['quantity_in_stock'] . "</td>";
                    echo "<td>" . $row['unit_of_measure'] . "</td>";
                    echo "<td>" . $row['supplier_id'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="editraw">
            <button class="editButton">Edit Values</button>
            <button class="editButton">Edit Values</button>
            <button class="editButton">Edit Values</button>
            <button class="editButton">Edit Values</button>
            <button class="editButton">Edit Values</button>
        </div>
    </main>


</body>

</html>
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

// Establish database connection
$connection = pg_connect("host=localhost dbname=TRANSPORT user=postgres password=kjsce");

if (!$connection) {
    echo "An error occurred while connecting to the database.<br>";
    exit();
}

// Query to select all rows from the products table
$query = "SELECT * FROM product";
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
    <title>Products Page</title>
    <link rel="stylesheet" href="assets/styles/productstyle.css?v=<?php echo time(); ?>">
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
            // if(isset($_SESSION['user_id'])) {
            //     echo "Welcome, ".$_SESSION['user_id'];
            // }
            ?>
        </h2>
    </header>
    <nav class="navbar">
        <ul>
            <li><a href="home.php"><i class="fa-solid fa-truck"></i></a></li>

            <li><a href="products.php">Products</a></li>
        </ul>
        <div class="logout">
            <a href="?logout">Logout<i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </nav>

    <main>

        <table border="1">
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Selling Price</th>
            </tr>
            <?php
            // Check if the result is valid and contains rows
            if ($result && pg_num_rows($result) > 0) {
                // Loop through each row in the result set
                while ($row = pg_fetch_assoc($result)) {

                

                    echo "<tr>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['product_name']. "</td>";
                    echo "<td>" . $row['product_description']. "</td>";
                    echo "<td>" . $row['selling_price']. "</td>";
                    // Add more cells for additional columns if needed
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No orders found.</td></tr>";
            }
            ?>
        </table>
        
    </main>
</body>

</html>
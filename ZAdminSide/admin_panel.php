<?php
session_start();

// Check if user is already logged in
if(!isset($_SESSION['admin_user'])) {
    header("Location: index.php");
    exit();
}

$connection = pg_connect("host=localhost dbname=TRANSPORT user=postgres password=kjsce");

if (!$connection) {
    echo "An error occurred while connecting to the database.<br>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['new_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    $sql_update = "UPDATE orders SET order_status = '$new_status' WHERE order_id = '$order_id'";

    $result = pg_query($connection, $sql_update);

    if (!$result) {
    echo "An error occurred while executing the query.<br>";
    }
    else{
        header("Location: admin_panel.php");
    }
    exit();
}

$query = "SELECT * FROM orders ";
$result_orders = pg_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>

    <header>
        <h1>Admin Panel</h1>
    </header>

    <aside>
        <ul>
            <li><a href="manage_driver.php">Manage Drivers</a></li>
            <!-- <li><a href="new_client.php">Create Client Account</a></li>  -->
            <li><a href="manage_suppliers.php">Manage Suppliers</a></li>
            <li><a href="manage_raw_material.php">Manage Raw Material</a></li>
        </ul>

        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </aside>

    <main>
        <p>Welcome, <?php echo $_SESSION['admin_user']; ?>!</p>

        <h2>Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (pg_num_rows($result_orders) > 0) {
                    while ($row = pg_fetch_assoc($result_orders)) {
                        if($row['order_status']=='t'){
                            $status1='Fulfilled';
                        }else{
                            $status1='In Progress';
                        }
                        echo "<tr>";
                        echo "<td>" . $row['order_id'] . "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td>" . $status1 . "</td>";
                        echo "<td>";
                        if ($row['order_status']=='t') {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                            echo "<input type='hidden' name='new_status' value='f'>";
                            echo "<button type='submit'>Set to In Progress</button>";
                            echo "</form>";
                        } else {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                            echo "<input type='hidden' name='new_status' value='t'>";
                            echo "<button type='submit'>Set to Fulfilled</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>
</html>

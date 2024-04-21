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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Chain Management Website</title>
    <link rel="stylesheet" href="assets/styles/homestyle.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f18c4a11f7.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <h1>
            <a href=index.html>
                Supply Chain Management
            </a>
        </h1>
    </header>
    <nav class="navbar">
        <ul>
            <li><a href="index.html"><i class="fa-solid fa-truck"></i></a></li>
            <li><a href="order.html">Order List</a></li>
            <li><a href="warehouse.html">Warehouse Details</a></li>
            <li><a href="clients.html">Client List</a></li>
            <li><a href="employees.html">Employee Directory</a></li>
        </ul>
        <div class="logout">
            <a href="?logout">Logout<i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
        
        
    </nav>
    <main>
        <article class="cont">

            <blockquote class="quote">"Transport is not a privilege, it's a right!"</blockquote>

        </article>
    </main>
</body>

</html>
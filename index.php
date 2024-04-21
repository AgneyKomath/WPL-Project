<?php
// Start session
session_start();

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="assets/styles/indexstyle.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f18c4a11f7.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Welcome to Our Website</h1>
    
        <div class ="buttons">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </div>

    <!-- <main>
        <article class="cont">

            <blockquote class="quote">"Transport is not a privilege, it's a right!"</blockquote>

        </article>
    </main> -->

</body>
</html>
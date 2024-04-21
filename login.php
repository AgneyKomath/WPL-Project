<?php
session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$connection = pg_connect("host=localhost dbname=TRANSPORT user=postgres password=kjsce");

if (!$connection) {
    echo "An error occurred.<br>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the provided credentials exist in the database
    $query = "SELECT * FROM client WHERE client_username = '$username' AND client_password = '$password'";
    $result = pg_query($connection, $query);

    if ($result && pg_num_rows($result) == 1) {
        // Login successful
        // Start a session and set a variable to indicate the user is logged in
        $_SESSION['user_id'] = $username;
        
        // Redirect user to home page
        header("Location: home.php");
        exit();
    } else {
        // Login failed
        $error = "Invalid username or password. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/loginstyles.css?v=<?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <title>Login Form</title>
</head>

<body>
    <div class="container">
        <div class="loginBox">
            <header class="heading">
                <h2>LOGIN</h2>
            </header>
            <main class="cred">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <div class="password-block">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <button type="button" class="showPasswordBtn" id="showPasswordBtn">Show</button>
                    </div>
                    <button type="submit" class="submitBtn">LOGIN</button>
                </form>
                <?php if (isset($error)) { echo "<p >$error</p>"; } ?>
                <p class="dont-have-account">Don't have an account? <a href="register.php">Register here</a>.</p>
            </main>
        </div>
    </div>

    <script src="assets/scripts/script.js"></script>

</body>

</html>
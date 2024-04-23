<?php
session_start();

if(isset($_SESSION['admin_user'])) {
    header("Location: admin_panel.php");
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
    $query = "SELECT * FROM admin WHERE admin_user = '$username' AND admin_password = '$password'";
    $result = pg_query($connection, $query);

    if ($result && pg_num_rows($result) == 1) {
        // Login successful
        // Start a session and set a variable to indicate the user is logged in
        $row = pg_fetch_assoc($result);
        $_SESSION['admin_user'] = $username;
        
        // Redirect user to home page
        header("Location: admin_panel.php");
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
                <form  method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <div class="password-block">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <button type="button" class="showPasswordBtn" id="showPasswordBtn">Show</button>
                    </div>
                    <button type="submit" class="submitBtn">LOGIN</button>
                </form>
                <?php if (isset($error)) { echo "<p >$error</p>"; } ?>
            </main>
        </div>
    </div>

    <script src="assets/scripts/script.js"></script>

</body>

</html>

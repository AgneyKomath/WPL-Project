<?php
session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

// Establish database connection
$connection = pg_connect("host=localhost dbname=TRANSPORT user=postgres password=kjsce");

if (!$connection) {
    echo "An error occurred.<br>";
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['Name'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Note: You should hash the password for security reasons before storing it in the database
    
    // Insert data into the database
    $query = "INSERT INTO client (client_name, client_contact, client_username, client_password) VALUES ('$name', '$contact', '$username', '$password')";
    $result = pg_query($connection, $query);

    if ($result) {
        // Set session timeout to 1 hour (3600 seconds)
        $_SESSION['timeout'] = time() + 3600;
        header("Location: home.php");
        $query1 = "SELECT * FROM client WHERE client_username = '$username' AND client_password = '$password'";
        $result1 = pg_query($connection, $query);

        if ($result && pg_num_rows($result) == 1) {
            // Login successful
            // Start a session and set a variable to indicate the user is logged in
            $row = pg_fetch_assoc($result);
            $_SESSION['user_id'] = $row['client_id'];
            
            // Redirect user to home page
            header("Location: home.php");
            exit();
        } else {
            // Login failed
            $error = "Invalid username or password. Please try again.";
    }
    } else {
        // Registration failed
        $error = "Registration failed. Please try again.";
    }
    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/registerstyle.css?v=<?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <title>Register Form</title>
</head>
<body>
    <body>
    <div class="container">
        <div class="loginBox">
            <header class="heading">
                <h2>Register</h2>
            </header>
            <main class="cred">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="text" name="Name" placeholder="Enter your name" required>
                    <input type="text" name="contact" placeholder="Enter your Contact Number" required>
                    <input type="text" name="username" placeholder="Username" required>
                    <div class="password-block">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <button type="button" class="showPasswordBtn" id="showPasswordBtn">Show</button>
                    </div>
                    <button type="submit" class="submitBtn">Register</button>
                </form>
                <?php if (isset($error)) { echo "<p >$error</p>"; } ?>
                <p class="dont-have-account">Already have an account? <a href="login.php">Login here</a>.</p>
            </main>
        </div>
    </div>

    <script src="assets/scripts/script.js"></script>

</body>
</body>
</html>
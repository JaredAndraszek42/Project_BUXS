<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">

    <title>Create Account</title>
</head>
<body>

    <header>
        <a href="http://192.168.56.103" target="_blank">
            <img src="../images/LuminoLogo.png" alt="Lumino Logo">
        </a>
    </header>

    <div class="login-container">
        <div class="login-card">
            <h1>Login Error!</h1>
            <br>
            <p class="register-text">

<?php
session_start();
require 'config.php';  // Database configuration file

if ($_SERVER["REQUEST_METHOD"] == "GET" or (isset($_SESSION['username']) and isset($_SESSION['password']))) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
       $username = $_GET['username'];
       $password = $_GET['password'];
    } else {
       $username = $_SESSION['username'];
       $password = $_SESSION['password'];
    }

    // Query the database to verify the username and password
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if the user exists and verify the password
    if ($user && (md5($password) == $user['password'] or $password == $user['password'])) {  // Using MD5 here for simplicity
        // Successful login, create session variables
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $user['password'];
        $_SESSION['plan'] = $user['plan'];
        $_SESSION['servers'] = $user['servers'];
        $_SESSION['databases'] = $user['datab_count'];
        $_SESSION['storageUsed'] = $user['storageUsedGB'];
        $_SESSION['storageMax'] = $user['storageMaxGB'];

	if ($user['isAdmin'] == 0) {
           header("Location: ../src/dashboard.php");
           exit();
	} else {
           $_SESSION['isAdmin'] = $user['isAdmin'];
	   header("Location: ../src/admin/dashboard.php");
	   exit();
	}
    } else {
        // Invalid credentials
        echo "<span style='color:red;'>Invalid username or password.</span><br>";
    }
} else {
   header("Location: ../index.php");
}
?>

		<br>
		<form action="../index.php">
		     <button type="submit" class="login-btn">Return to Login</button>
		</form>
            </p>
        </div>
    </div>
</body>
</html>

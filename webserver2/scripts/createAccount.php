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
            <h1>Account Error!</h1>
            <br>
            <p class="register-text">

<?php
session_start();
require 'config.php';  // Database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqlSearch = "SELECT EXISTS(SELECT 1 FROM users WHERE username= ?) AS user_exists;";
    $stmt = $conn->prepare($sqlSearch);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['user_exists']) {
	echo "<span style='color:red'>Name Already Used</span>";
    } else {
        // Query the database to verify the username and password
        $sql = "INSERT INTO users (username, password, plan, created_at) VALUES ('".$username."', md5('".$password."'), 'Free', '".date('Y-m-d')."');";

        if ($conn->query($sql) === TRUE) {

	     $newSql = "SELECT userID FROM users WHERE username= ?;";
	     $stmt = $conn->prepare($newSql);
	     $stmt->bind_param("s", $username);
    	     $stmt->execute();
    	     $result = $stmt->get_result();
    	     $row = $result->fetch_assoc();

	    $_SESSION['userID'] = $row['userID'];
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['plan'] = 'Free';
            $_SESSION['servers'] = 0;
            $_SESSION['databases'] = 0;
            $_SESSION['storageUsed'] = 0;
            $_SESSION['storageMax'] = 1;

            header("Location: ../index.php");
            exit();
        } else {
            echo "Error";
        }
    }
}
?>
                <br>
                <form action="../src/createAccount.php">
                     <button type="submit" class="login-btn">Return to Login</button>
                </form>
            </p>
        </div>
    </div>
</body>
</html>

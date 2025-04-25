<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Lumino</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/acknowledgement.css">
</head>
<body>

<?php
session_start();
require 'config.php';  // Database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['isAdmin'])) {
       $isAdmin = 1;
    } else {
       $isAdmin = 0;
    }

    $plan = $_POST['plan'];
    $created = str_replace('/', '-', $_POST['created_at']);
    $datab = $_POST['datab_count'];
    $servers = $_POST['servers'];
    $storageMax = $_POST['storageMaxGB'];
    $storageUsed = $_POST['storageUsedGB'];


    // Query the database to verify the username and password
    $sql = "INSERT INTO users (username, password, isAdmin, plan, created_at, datab_count, servers, storageMaxGB, storageUsedGB) VALUES ('".$username."', md5('".$password."'),".$isAdmin.", '" .$plan."', '".$created."', ".$datab.", ".$servers.", ".$storageMax.", ".$storageUsed.");";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='ack-container'>
                <h1><i class='material-icons'>check_circle</i> Account Created</h1>
                <p>The account for <strong>".htmlspecialchars($username)."</strong> has been successfully created.</p>
                <p>You will be redirected shortly...</p>
                <a href='/src/admin/createAccount.php' class='ack-btn'>Create Another Account</a>
              </div>";

        // Auto Redirect After 3 Seconds
        echo "<script>
                setTimeout(function() {
                    window.location.href = '/src/admin/createAccount.php';
                }, 3000);
              </script>";
    } else {
        echo "<div class='ack-container error'>
                <h1><i class='material-icons'>error</i> Error</h1>
                <p>There was an issue creating the account.</p>
                <a href='/src/admin/createAccount.php' class='ack-btn'>Try Again</a>
              </div>";
    }
}
?>
</body>
</html>

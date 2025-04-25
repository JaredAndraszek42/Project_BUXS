<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['username'])) {
    header("Location: /index.php");
    exit();
}

if (!isset($_SESSION['isAdmin'])) {
    header("Location: ../dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Lumino</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/admin-dashboard.css">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">
</head>
<body>
    <header>
        <img src="/images/LuminoLogo.png" alt="Lumino Logo">
        <a href="/scripts/logout.php" class="logout-btn">Logout</a>
    </header>

    <div class="admin-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>This is your admin dashboard. Choose an option below:</p>

        <div class="dashboard-grid">
            <a href="createAccount.php" class="dashboard-btn">
                <i class="material-icons">person_add</i>
                Create Account
            </a>

            <a href="viewTickets.php" class="dashboard-btn">
                <i class="material-icons">assignment</i>
                View Tickets
            </a>

            <a href="viewOperations.php" class="dashboard-btn">
                <i class="material-icons">build</i>
                View Operations
            </a>
        </div>
    </div>
</body>
</html>

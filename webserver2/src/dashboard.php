<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION['isAdmin'])) {
    header("Location: ./admin/dashboard.php");
    exit();
}

$storageUsed = $_SESSION['storageUsed'];
$storageMax = $_SESSION['storageMax'];
$storagePercentage = ($storageUsed / $storageMax) * 100;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lumino</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">
</head>
<body>

    <!-- HEADER -->
    <header>
        <img src="../images/LuminoLogo.png" alt="Lumino Logo" id="LuminoLogo">
        <a href="../scripts/logout.php" class="logout-btn">Logout</a>
    </header>

    <!-- DASHBOARD -->
    <div class="dashboard-container">
        <div class="dashboard-card">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>You are on the <strong><?php echo $_SESSION['plan']; ?></strong> plan.</p>
        </div>

        <!-- STORAGE PROGRESS BAR -->
        <div class="storage-progress">
            <div class="progress-circle">
                <svg viewBox="0 0 100 100">
                    <circle class="bg" cx="50" cy="50" r="45"></circle>
                    <circle class="progress" cx="50" cy="50" r="45" 
                        style="stroke-dasharray: 282.6; stroke-dashoffset: <?php echo 282.6 - (282.6 * $storagePercentage / 100); ?>;">
                    </circle>
                    <text x="50" y="55" text-anchor="middle"><?php echo round($storagePercentage); ?>%</text>
                </svg>
            </div>
            <p><?php echo $storageUsed; ?> GB / <?php echo $storageMax; ?> GB</p>
        </div>

        <!-- STATS GRID -->
        <div class="stats-grid">
            <div class="stat-box">
                <i class="material-icons">dns</i>
                <p><strong>Servers Running</strong></p>
                <p><?php echo $_SESSION['servers']; ?></p>
            </div>

            <div class="stat-box">
                <i class="material-icons">developer_board</i>
                <p><strong>Databases</strong></p>
                <p><?php echo $_SESSION['databases']; ?></p>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="action-buttons">
            <a href="viewYourTickets.php" class="dashboard-btn">View/Create A Ticket</a>
            <a href="updateAccount.php" class="dashboard-btn">Update Account</a>
        </div>
    </div>
</body>

<script>
document.getElementById('LuminoLogo').addEventListener('click', function() {
	alert('Hint: The admin look at these tickets constantly. You will need to use an exploit that when the admin view your ticket, it will give you something.');
});
</script>

</html>

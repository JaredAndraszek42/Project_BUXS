<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- External CSS -->
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/admin-createAccount.css">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">

    <title>Update Account</title>
</head>
<body>
<div class="account-container">
     <h1><i class="material-icons">manage_accounts</i> Update Your Account</h1>
     <form method="GET" action="/scripts/updateAccount.php">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value=<?php echo $_SESSION['username'];?> required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="plan">Select a Plan</label>
                <select name="plan" id="plan" value=<?php echo $_SESSION['plan'];?>>
                    <option value="Free">Free</option>
                    <option value="Trial">Trial</option>
                    <option value="WebHosting">Webserver Only</option>
                    <option value="StorageOnly">Storage Only</option>
                </select>
            </div>

            <div class="grid-container">
                <div class="input-group">
                    <label for="datab_count">Number of Databases</label>
                    <input type="number" id="datab_count" name="datab_count" min="0" step="1" value=<?php echo $_SESSION['databases'];?>>
                </div>

                <div class="input-group">
                    <label for="servers">Number of Servers</label>
                    <input type="number" id="servers" name="servers" min="0" step="1" value=<?php echo $_SESSION['servers'];?>>
                </div>
            </div>

            <div class="grid-container">
                <div class="input-group">
                    <label for="storageMaxGB">Storage Available (GB)</label>
                    <input type="number" id="storageMaxGB" name="storageMaxGB" min="0" step="1" value=<?php echo $_SESSION['storageMax'];?>>
                </div>

                <div class="input-group">
                    <label for="storageUsedGB">Storage Used (GB)</label>
                    <input type="number" id="storageUsedGB" name="storageUsedGB" min="0" step="0.01" value=<?php echo $_SESSION['storageUsed'];?>>
                </div>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" name="update" value="Update" class="submit-btn">
                    <i class="material-icons">check</i> Update
                </button>

                <a href="/src/admin/dashboard.php" class="dashboard-btn">
                    <i class="material-icons">arrow_back</i> Return to Dashboard
                </a>
            </div>
        </form>
</div>
</body>
</html>

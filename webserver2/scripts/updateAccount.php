<?php
    session_start();
    if (!isset($_SESSION['username'])) {
	header("Location: ../index.php");
	exit();
    }

    if (!isset($_GET["username"]) || !isset($_GET["password"])) {
	header("Location: /src/updateAccount.php");
	exit();
    } else {
	$username = $_GET["username"];
	$password = $_GET["password"];
	$plan = $_GET["plan"];
	$databases = $_GET["datab_count"];
	$servers = $_GET["servers"];
	$storageMax = $_GET["storageMaxGB"];
	$storageUsed = $_GET["storageUsedGB"];
    }

    include('../scripts/config.php');

    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
</head>
<body>
    <?php
	if (isset($username) && isset($password) && isset($plan) && isset($databases) && isset($servers) && isset($storageMax) && isset($storageUsed)) {
            $sql = "UPDATE users SET username = '".$username."', password = md5('".$password."'), plan = '".$plan."', datab_count = ".$databases.", servers = ".$servers.", storageMaxGB = ".$storageMax.", storageUsedGB = ".$storageUsed." WHERE userID = ".$_SESSION['userID'].";";

	    if ($conn->query($sql) === TRUE) {
		$_SESSION['username'] = $username;
        	$_SESSION['password'] = $password;
        	$_SESSION['plan'] = $plan;
        	$_SESSION['servers'] = $servers;
        	$_SESSION['databases'] = $databases;
        	$_SESSION['storageUsed'] = $storageUsed;
        	$_SESSION['storageMax'] = $storageMax;
		header("Location: ../src/dashboard.php");
		exit();
	    } else {
		echo "ERROR\n";
	        printf("Could not update account: %s\n", mysqli_error($conn));
      	    }
        }
    ?>
    <a href="/src/dashboard.php"><button>Back to Dashboard</button></a>
</body>
</html>

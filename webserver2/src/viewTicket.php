<?php
session_start();
    if (!isset($_SESSION['username'])) {
	header("Location: ../index.php");
	exit();
    }

    if (!isset($_GET["subject"]) || !isset($_GET["description"])) {
	header("Location: ./comments.php");
	exit();
    } else {
	$subject = $_GET["subject"];
	$description = $_GET["description"];
    }

    include('../scripts/config.php');

    if ($conn->connect_error) {
        die("connection failed: " . conn->connect_error);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/tickets.css">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">

    <title>Ticket Confirmation - Lumino</title>
</head>
<body>
    <div class="ticket-container">
	<div class="ticket-card">
		<?php
		    if (isset($subject) && isset($description)) {
			$sql = "INSERT INTO tickets (userID, plan, subject, description, status) VALUES (?, ?, ?, ?, 'Open');";

			$userID = $_SESSION['userID'];
			$plan = $_SESSION['plan'];

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("isss", $userID, $plan, $_GET['subject'], $_GET['description']);

			if ($stmt->execute()) {
			    echo "<h1>The following ticket has been submitted!</h1><br><br>";
			    echo "<h2>Subject: ".$subject."</h2><br><br>Description: ".$description."<br><br>";
			} else {
			    echo "ERROR\n";
			    printf("Could not create ticket: %s\n", mysqli_error($conn));
			}
		    }
		?>
	</div>
        <div class="action-buttons">
            <a href="dashboard.php" class="submit-btn">Back to Dashboard</a>
            <a href="tickets.php" class="submit-btn">Create another Ticket</a>
        </div>
    </div>
</body>
</html>

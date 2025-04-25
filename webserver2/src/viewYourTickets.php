<?php
session_start();

include('../scripts/config.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

if ($conn->connect_error) {
    die("connection failed: " . conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/admin-tickets.css">

    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">

    <title>View Tickets - Lumino Admin</title>

    <!-- Automatically reload page every 1 minute (60000 milliseconds) -->
    <script>
        setInterval(function() {
            window.location.reload();
        }, 60000); // 1 minute interval
    </script>
</head>
<body>

    <div class="admin-container">
        <h1>Viewing Tickets</h1>
        <p>This is your Ticket dashboard</p>
        <a href="dashboard.php" class="dashboard-btn">Return to Dashboard</a>
	<a href="tickets.php" class="dashboard-btn">Open A New Ticket</a>

        <div class="ticket-table">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Plan</th>
                        <th>Ticket ID</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT users.username, users.plan, tickets.ticketID, tickets.subject, tickets.description, tickets.status, tickets.created_at FROM tickets JOIN users ON tickets.userID = users.userID WHERE users.username='" . $_SESSION['username'] . "' ORDER BY status ASC, created_at DESC;";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            while ($newArr = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $newArr['username'] . "</td>";
                                echo "<td>" . $newArr['plan'] . "</td>";
                                echo "<td>" . $newArr['ticketID'] . "</td>";
                                echo "<td>" . $newArr['subject'] . "</td>";
                                echo "<td>" . $newArr['description'] . "</td>";
                                echo "<td class='status " . strtolower($newArr['status']) . "'>" . $newArr['status'] . "</td>";
                                echo "<td>" . $newArr['created_at'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='error-text'>Error connecting to database</td></tr>";
                        }

                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

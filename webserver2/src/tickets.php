<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/tickets.css">

    <title>Submit a Comment</title>
</head>
<body>
    <div class="ticket-container">
        <a href="viewYourTickets.php" class="back-btn">
            <i class="material-icons">arrow_back</i> Back to Ticket Dashboard
        </a>

        <div class="ticket-card">
            <h1>Create a Ticket</h1>

            <form method="GET" action="viewTicket.php">
                <div class="input-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" placeholder="Enter the ticket subject..." required>
                </div>

                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="5" placeholder="Describe your issue..." required></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit Ticket</button>
            </form>
        </div>
    </div>
</body>
</html>

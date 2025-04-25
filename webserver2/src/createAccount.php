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
        <a href="#" id="lumino-logo">
            <img src="/images/LuminoLogo.png" alt="Lumino Logo">
        </a>
    </header>

    <div class="login-container">
        <div class="login-card">
            <h1>Create a FREE Account</h1>
	    <br>
            <form method="POST" action="../scripts/createAccount.php">
                <div class="input-group">
                    <i class="material-icons">person</i>
                    <input type="text" id="username" name="username" placeholder="Username"
                        value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <i class="material-icons">lock</i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="login-btn">Create Account</button>
            </form>

            <p class="register-text">
                Already have an account?
                <a href="../index.php">Login</a>
            </p>
        </div>
    </div>
</body>
<script>
    // Function to track logo clicks
    function trackLogoClicks() {
        let clickCount = localStorage.getItem("logoClickCount") ? parseInt(localStorage.getItem("logoClickCount")) : 0;

        clickCount++;

        localStorage.setItem("logoClickCount", clickCount);

        console.log("Lumino Logo Clicked: " + clickCount + " times");

        if (clickCount === 10) {
            alert("Bruh");
            localStorage.setItem("logoClickCount", 0); // Reset count
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        let logo = document.getElementById("lumino-logo");
        if (logo) {
            logo.addEventListener("click", trackLogoClicks);
        }
    });
</script>
</html>

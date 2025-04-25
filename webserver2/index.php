<?php
    // Start session
    session_start();

    if (isset($_SESSION['username'])) {
      header("Location: ./src/dashboard.php");
    }


    // If the form is submitted, set session variables
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        header("Location: ./src/dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lumino</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">
</head>
<body>

    <header>
        <a href="#">
            <img id="lumino-logo" src="./images/LuminoLogo.png" alt="Lumino Logo">
        </a>
    </header>


    <div class="login-container">
        <div class="login-card">
            <h1>Welcome Back</h1>
            <p>Log in to access your dashboard</p>

            <form method="GET" action="./scripts/login.php">
                <div class="input-group">
                    <i class="material-icons">person</i>
                    <input type="text" id="username" name="username" placeholder="Username"
                        value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <i class="material-icons">lock</i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <p class="register-text">
                Don't have an account?
                <a href="./src/createAccount.php">Sign Up</a>
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
            alert("Try creating a new account -Flint ....");
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


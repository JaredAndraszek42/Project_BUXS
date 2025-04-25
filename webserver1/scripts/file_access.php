<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="/images/LuminoLogo.png">
        <link rel="icon" type="image/png" href="./images/LuminoLogo.png">
        <link rel="stylesheet" href="/styles/main.css">
        <link rel="stylesheet" href="/styles/nav.css">
        <link rel="stylesheet" href="/styles/hero.css">
        <link rel="stylesheet" href="/styles/features.css">
        <link rel="stylesheet" href="/styles/stats.css">
        <link rel="stylesheet" href="/styles/footer.css">
        <link rel="stylesheet" href="/styles/access.css">
        <link rel="stylesheet" href="/styles/testimonials.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <title>View Article</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/index.html" class="logo">
                <img src="/images/LuminoLogo.png" alt="Lumino Logo">
                LUMINO</a>
            <ul class="nav-links">
                <li><a href="/src/features.html">Features</a></li>
                <li><a href="/src/documents.html">Docs</a></li>
                <li><a href="/src/about.html">About</a></li>
                <li><a href="/src/pricing.html">Pricing</a></li>
                <li><a href="/src/contact.html">Contact Us</a></li>
            </ul>
            <a href="/src/login.php" class="cta-button">Log in</a>
        </div>
    </nav>
<div>
    <!-- Here we will acceess a file from the files folder -->
    <?php
    if (isset($_GET['filename'])) {
        $filename = $_GET['filename'];

        // Security measures to allow only alphanumeric characters and dots //
        if (preg_match('/^[a-zA-Z0-9.]+$/', $filename)) {

            // ./files/filename.txt //
            $filepath = "../files/" . $filename;

            if ($filename == "Flint.txt") {
                if (isset($_GET['User'])) {
                    $title = "ERROR";
	            $date_location = "N/A";
        	    $author = "N/A";
		    $articleBody = "You are not authorized to view";
                } else {
                    $content = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                    $title = trim($content[0]); // First line: Title
                    $date_location = trim($content[1]); // Second line: Date & Location
                    $author = trim(str_replace("By:", "", $content[2])); // Third line: Author

                    // Extract the article body (everything after line 3)
                    $article_body = array_slice($content, 3);
                    $articleBody = implode("\n\n\n", $article_body);
                }
            } else if (file_exists($filepath)) {
		$content = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

		$title = trim($content[0]); // First line: Title
		$date_location = trim($content[1]); // Second line: Date & Location
		$author = trim(str_replace("By:", "", $content[2])); // Third line: Author

		// Extract the article body (everything after line 3)
		$article_body = array_slice($content, 3);
		$articleBody = implode("\n\n\n", $article_body);
            } else {
                $title = "ERROR";
                $date_location = "N/A";
                $author = "N/A";
                $articleBody = "The file does not exist";
            }
        } else {
	    $title = "ERROR";
            $date_location = "N/A";
            $author = "N/A";
            $articleBody = "Invalid filename";
        }
    }
    ?>

    <section class="article">
        <div class="container">
            <h1 id="titleHeader"><?php echo htmlspecialchars($title); ?></h1>
            <p class="meta" id="dateLocation"><strong><?php echo htmlspecialchars($date_location); ?></strong></p>
            <p class="meta" id="author">By: <strong><?php echo htmlspecialchars($author); ?></strong></p>
            <article class="article">
                <?php echo nl2br(htmlspecialchars($articleBody)); ?>
            </article>
        </div>
    </section>
</div>
</body>
<footer class="footer">
    <div class="container footer-container">

        <!-- Horizontal Sitemap -->
        <nav class="footer-sitemap">
            <ul>
                <li><a href="/src/index.html">Home</a></li>
                <li><a href="/src/features.html">Features</a></li>
                <li><a href="/src/documents.html">Docs</a></li>
                <li><a href="/src/about.html">About</a></li>
                <li><a href="/src/pricing.html">Pricing</a></li>
                <li><a href="/src/contact.html">Contact</a></li>
                <li><a href="/src/login.html">Login</a></li>
            </ul>
        </nav>

        <!-- Centered Logo and Copyright -->
        <div class="footer-bottom">
            <div class="footer-logo">
                <img src="../images/LuminoLogo.png" alt="Lumino Logo" onclick="scrollToTop()">
            </div>
            <p class="footer-copyright">&copy; 2025 Lumino Cloud. All rights reserved.</p>
        </div>

    </div>
</footer>
<script src="script.js"></script>
</html>

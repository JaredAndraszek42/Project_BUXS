<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /index.php");
    exit();
}

if (!isset($_SESSION['isAdmin'])) {
    header("Location: ../dashboard.php");
    exit();
}

require '../../scripts/config.php';

$sql_operations = "SELECT * FROM internal_operations ORDER BY priority_level DESC, id ASC";
$result_operations = $conn->query($sql_operations);

$file_contents = "";
$file_name = "";

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    if ($search == 'Flint') {
	echo "<script> alert('press the ~` key');</script>";
    }

    // VULNERABLE TO SQL INJECTION
    $sql_files = "SELECT file_path FROM incident_reports WHERE description LIKE '%$search%' ORDER BY id LIMIT 1";
    $executed_sql = $sql_files;

    $result_files = $conn->query($sql_files);

    if ($result_files->num_rows > 0) {
        $row = $result_files->fetch_assoc();
        $file_name = basename($row['file_path']); // Extract filename

        // Load the file contents if it exists
        $file_path = __DIR__ . $row['file_path'];

        if (file_exists($file_path)) {
            $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);

            // Handle different file types
            if (in_array($file_ext, ['txt', 'log', 'csv'])) {
                $file_contents = nl2br(htmlspecialchars(file_get_contents($file_path)));
            } elseif ($file_ext == "pdf") {
                $file_contents = "<embed src='" . $row['file_path'] . "' width='100%' height='500px' />";
            } else {
                $file_contents = "<p>File format not supported for inline viewing. <a href='" . $row['file_path'] . "' download>Download Instead</a></p>";
            }
        } else {
            $file_contents = "<p><strong>Error:</strong> File not found.</p>";
        }
    } else {
        $file_contents = "<p>No matching files found.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/images/LuminoLogo.png">
    <title>Admin Operations & File Viewer</title>

    <!-- Google Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- External CSS -->
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/admin-operations.css">
</head>
<body>
    <header>
        <h1>Admin Operations</h1>
        <a href="dashboard.php" class="dashboard-btn"><i class="material-icons">arrow_back</i> Back to Dashboard</a>
    </header>

    <!-- INTERNAL OPERATIONS TABLE -->
    <div class="operations-container">
        <h2>Internal Operations</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operation Name</th>
                    <th>Details</th>
                    <th>Priority</th>
                    <th>Assigned To</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_operations->num_rows > 0) {
                    while ($row = $result_operations->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["operation_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["details"]) . "</td>";
                        echo "<td class='priority-" . strtolower($row["priority_level"]) . "'>" . $row["priority_level"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["assigned_to"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-data'>No operations found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- INCIDENT FILE SEARCH -->
    <div class="file-search-container">
        <h2>Incident File Viewer</h2>
        <p>Search for an incident file:</p>

        <form method="POST">
            <input type="text" name="search" placeholder="Enter keyword...">
            <button type="submit"><i class="material-icons">search</i> Search</button>
        </form>

<?php if (!empty($executed_sql)): ?>
        <div id="sql-debug" style="display: none; margin-top: 50px; background: #1e1e1e; color: #ff4f4f; padding: 15px; border-radius: 5px; font-family: monospace;">
             <strong>SQL Executed:</strong><br>
             <?php echo htmlspecialchars($executed_sql); ?>
        </div>

        <div class="file-results">
            <h3>Results:</h3>
            <?php if (!empty($file_name)): ?>
                <p><strong>File Found:</strong> <?php echo htmlspecialchars($file_name); ?></p>
            <?php endif; ?>
            <div><?php echo $file_contents; ?></div>
        </div>
    </div>
        <script>
            // Secret toggle (press ~ key to show)
            document.addEventListener("keydown", function(e) {
               if (e.key === "`") {
                  const debugBox = document.getElementById("sql-debug");
                  debugBox.style.display = debugBox.style.display === "none" ? "block" : "none";
              }
          });
     </script>
<?php endif; ?>


</body>
</html>

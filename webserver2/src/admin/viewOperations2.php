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

// 🟢 Fetch Internal Operations (Safe Query)
$sql_operations = "SELECT * FROM internal_operations ORDER BY priority_level DESC, id DESC";
$result_operations = $conn->query($sql_operations);

// 🟡 Vulnerable File Search Query (SQL Injection Entry Point)
$file_contents = "";
$file_name = "";

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    // ❌ VULNERABLE TO SQL INJECTION
    $sql_files = "SELECT file_path FROM incident_reports WHERE description LIKE '%$search%' LIMIT 1";
    $result_files = $conn->query($sql_files);

    if ($result_files->num_rows > 0) {
        $row = $result_files->fetch_assoc();
        $file_name = basename($row['file_path']); // Extract filename

        // Load the file contents if it exists
        $file_path = __DIR__ . $row['file_path'];  // Adjust based on your actual file storage

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
    <title>Admin Operations & File Viewer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Admin Dashboard</h2>

<!-- 🟢 INTERNAL OPERATIONS TABLE -->
<h3>Internal Operations</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Operation Name</th>
        <th>Details</th>
        <th>Priority Level</th>
        <th>Assigned To</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result_operations->num_rows > 0) {
        while ($row = $result_operations->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . htmlspecialchars($row["operation_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["details"]) . "</td>";
            echo "<td>" . $row["priority_level"] . "</td>";
            echo "<td>" . htmlspecialchars($row["assigned_to"]) . "</td>";
            echo "<td>
                    <a href='editOperation.php?id=" . $row["id"] . "'>Edit</a> | 
                    <a href='deleteOperation.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a> | 
                    <a href='markComplete.php?id=" . $row["id"] . "'>Mark as Completed</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No operations found</td></tr>";
    }
    ?>
</table>

<!-- 🟡 FILE SEARCH (SQL INJECTION VULNERABILITY) -->
<h3>Incident File Viewer</h3>
<p>Search for an incident file:</p>

<form method="POST">
    <input type="text" name="search" placeholder="Enter keyword...">
    <button type="submit">Search</button>
</form>

<h3>Results:</h3>
<?php if (!empty($file_name)): ?>
    <p><strong>File Found:</strong> <?php echo htmlspecialchars($file_name); ?></p>
<?php endif; ?>
<div><?php echo $file_contents; ?></div>

<a href="adminDashboard.php">Back to Dashboard</a>

</body>
</html>

<?php $conn->close(); ?>

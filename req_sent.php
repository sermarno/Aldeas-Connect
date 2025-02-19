<?php
ini_set('display_errors', 1); // Enable error reporting
error_reporting(E_ALL); // Show all errors

include "includes/db.php";

// getting form input from new_proj.php form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ensures data is safe to use in SQL queries
    $title = $conn->real_escape_string($_POST['title']);
    $proj_description = $conn->real_escape_string($_POST['proj_description']);
    $proj_start = $conn->real_escape_string($_POST['proj_start']);
    $proj_end = $conn->real_escape_string($_POST['proj_end']);
    $community_id = $conn->real_escape_string($_POST['community_id']);

    // inserting data into projects table
    $sql = "INSERT INTO project_requests (title, proj_description, proj_start, proj_end, community_id) VALUES (?, ?, ?, ?, ?)";
    
    // preparing and running the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $proj_description, $proj_start, $proj_end, $community_id);
    if ($stmt->execute()) {
        // retrieving the inserted project
        $new_project_id = $conn->insert_id;
        $query = "SELECT * FROM project_requests WHERE request_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $new_project_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $project_request = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "Error: " . $stmt->error;
    }
// if the project_id is set, grab to edit
} else if (isset($_GET['project_id'])) {
    $project_id = $conn->real_escape_string($_GET['project_id']);
    $sql = "SELECT * FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project_request = $result->fetch_assoc();
    } else {
        echo "Project not found.";
        exit();
    }

} else {
    echo "No project provided.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Summary</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
</head>
<body>
    <!-- Nav Bar -->
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?>

    <header>
        <h1>Request Summary</h1>
    </header>
    <div class="form">
        <h2><?php echo htmlspecialchars($project_request['title']); ?></h2>
        <p><strong>Description:</strong> <?php echo htmlspecialchars(($project_request['proj_description'])); ?></p>
        <p><strong>Start Date:</strong> <?php echo $project_request['proj_start']; ?></p>
        <p><strong>End Date:</strong> <?php echo $project_request['proj_end']; ?></p>
        <div class="cancel">
            <a href="index.php">Back to home page</a>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="js/nav.js"></script>
</body>
</html>

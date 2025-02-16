<?php
session_start();
include "includes/db.php";

if (isset($_GET['project_id'])) {
    $project_id = $conn->real_escape_string($_GET['project_id']);
    $sql = "SELECT * FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        echo "Project not found.";
        exit();
    }

    $stmt->close();
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
    <title>Project Details</title>
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
        <h1>Project Changes</h1>
    </header>
    <div class="form">
        <h2><?php echo htmlspecialchars($project['title']); ?></h2>
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($project['proj_description'])); ?></p>
        <p><strong>Start Date:</strong> <?php echo $project['proj_start']; ?></p>
        <p><strong>End Date:</strong> <?php echo $project['proj_end']; ?></p>
        <div class="cancel">
            <a href="index.php">Back to home page</a>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="js/nav.js"></script>
</body>
</html>

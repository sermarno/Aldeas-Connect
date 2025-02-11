<?php
session_start();
include "includes/db.php";
// collecting form data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['project_id'])) {
    $project_id = $conn->real_escape_string($_POST['project_id']);
    $sql = "SELECT * FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Sent</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
    <!-- Nav Bar -->
    <div class="nav">
        <a href="index.php">
            <img src="img/logo.jpg" alt="home">
        </a>
        <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>Edit Project</h1>
    </header>
    <div class="form">
        <form action="update_project.php" method="POST">
            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
            <label for="title">Project Title:</label>
            <input type="text" name="title" id="title" required value="<?php echo htmlspecialchars($project['title']); ?>">

            <label for="proj_description">Description:</label>
            <textarea name="proj_description" id="proj_description" required><?php echo htmlspecialchars($project['proj_description']); ?></textarea>

            <label for="proj_start">Start Date:</label>
            <input type="date" name="proj_start" id="proj_start" required value="<?php echo $project['proj_start']; ?>">

            <label for="proj_end">End Date:</label>
            <input type="date" name="proj_end" id="proj_end" required value="<?php echo $project['proj_end']; ?>">

            <input type="submit" value="Update Project">
        </form>
    </div>
    <div class="cancel">
            <a href="index.php">Back to home page</a>
    </div>
    <?php include 'includes/footer.php' ?>
    <?php $conn->close();?>
</body>
</html>
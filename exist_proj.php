<?php
    session_start();
    include "includes/db.php";
    $comm_sql = "SELECT * FROM communities";
    $comm_result = $conn->query($comm_sql);
    $community = "";
    $projects = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['community_id'])) {
        $selected_community = $_POST['community_id'];
    
        // Fetch projects related to the selected community
        $proj_sql = "SELECT project_id, title FROM projects WHERE community_id = ?";
        $stmt = $conn->prepare($proj_sql);
        $stmt->bind_param("i", $selected_community);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
        $stmt->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Remove Project Request</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- linking javascript for drop downs
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
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
        <h1>Existing Project Request Form</h1>
    </header>
    <div class="form">
        <form action="exist_proj.php" method="POST">
            <label for="community">Community:</label>
            <select name="community_id" id="community" required onchange="this.form.submit()">
                <option value="">Select a community</option>
                <?php 
                while ($row = $comm_result->fetch_assoc()) {
                    $selected = ($row['community_id'] == $selected_community) ? "selected": "";
                    echo "<option value='" . $row['community_id'] . "' $selected>" . htmlspecialchars($row['comm_name']) . "</option>";
                }
                ?>
            </select>
        </form>
        <?php if ($selected_community && count($projects) > 0): ?>
            <form action="req_sent.php" method="POST">
                <input type="hidden" name="community_id" value="<?php echo $selected_community; ?>">
                
                <label for="project">Project:</label>
                <select name="project_id" id="project" required>
                    <option value="">Select the project you want to edit</option>
                    <?php 
                    foreach ($projects as $proj) {
                        echo "<option value='" . $proj['project_id'] . "'>" . htmlspecialchars($proj['title']) . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Submit">
            </form>
        <?php elseif ($selected_community): ?>
            <p>No projects found for this community.</p>
        <?php endif; ?>
    </div>
    <?php include 'includes/footer.php' ?>
    <?php $conn->close(); ?>
</body>
</html>
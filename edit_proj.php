<?php
session_start();
include "includes/db.php";

// Variables for community and project
$selected_community = "";
$projects = [];
$project = null;

// Handle community selection and fetch projects
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

// If project is selected, fetch project details for editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];
    $sql = "SELECT * FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_project'])) {
    $project_id = $_POST['project_id'];
    $title = $conn->real_escape_string($_POST['title']);
    $proj_description = $conn->real_escape_string($_POST['proj_description']);
    $proj_start = $conn->real_escape_string($_POST['proj_start']);
    $proj_end = $conn->real_escape_string($_POST['proj_end']);

    $sql = "UPDATE projects SET title = ?, proj_description = ?, proj_start = ?, proj_end = ? WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $proj_description, $proj_start, $proj_end, $project_id);

    if ($stmt->execute()) {
        header('Location: req_sent.php?project_id=' . $project_id);
        exit();
    } else {
        echo "Could not update project: " . $conn->error;
    }

    $stmt->close(); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project Request</title>
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
        <h1></h1>
    </header>
    <div class="form">
        <div class="goback">
            <a class="back" href="index.php"> ← Go Back</a>
        </div>
        <div class="form_container">
            <form action="edit_proj.php" method="POST">
                <h1>Edit Project Request Form</h1>
                <p class="italic">
                    This form is for Smart Village residents who wish to update a project seen
                    on this website. Your request will be reviewed and you will be provided with 
                    a message regarding it's approval or denial. <br><br> 
                </p>

                <div class="details_container">
                    <p class="underline">COMMUNITY</p>
                    <p class="italic">Please select which community the project is associated with.</p>
                    <label for="community">Community:</label><br>
                    <select name="community_id" id="community" required onchange="this.form.submit()">
                        <option value="">Select a community</option>
                        <?php 
                        // Fetch communities
                        $comm_sql = "SELECT * FROM communities";
                        $comm_result = $conn->query($comm_sql);
                        while ($row = $comm_result->fetch_assoc()) {
                            $selected = ($row['community_id'] == $selected_community) ? "selected": "";
                            echo "<option value='" . $row['community_id'] . "' $selected>" . htmlspecialchars($row['comm_name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </form> <br>
            <?php if ($selected_community): ?>
            <!-- If a community is selected, display projects for editing -->
                <div class="details_container">
                    <p class="underline">PROJECT</p>
                    <p class="italic">Please select the project you'd like to make changes to.</p>
                    <?php if ($selected_community && count($projects) > 0): ?>
                        <form action="edit_proj.php" method="POST">
                            <input type="hidden" name="community_id" value="<?php echo $selected_community; ?>">
                            
                            <label for="project">Project:</label>
                            <select name="project_id" id="project" required onchange="this.form.submit()">
                                <option value="">Select the project you want to edit</option>
                                <?php 
                                foreach ($projects as $proj) {
                                    $selected_project = ($proj['project_id'] == $project['project_id']) ? "selected" : "";
                                    echo "<option value='" . $proj['project_id'] . "' $selected_project>" . htmlspecialchars($proj['title']) . "</option>";
                                }
                                ?>
                            </select>
                        </form>
                    <?php elseif ($selected_community): ?>
                        <p>No projects found for this community. <br>Looking to add a new project? <a href="new_proj.php">New Project Request</a></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?><br>

            <?php if ($project): ?>
                <!-- If a project is selected, display the edit form with pre-populated details -->
                <div class="project_details">
                    <?php if ($project): ?>
                        <form action="edit_proj.php" method="POST">
                            <h2>Edit Project Details</h2>
                            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
                            <input type="hidden" name="update_project" value="1">
                            
                            <div class="details_container">
                                <p class="underline">PROJECT TITLE AND DESCRIPTION</p>
                                <p class="italic">Give your project a name and tell us what it's about.</p>
                                Project Title: <br><input type="text" name="title" id="title" required value="<?php echo htmlspecialchars($project['title']); ?>"><br><br>
                                Project Description: <br><input type="text" name="proj_description" id="proj_description" class="large_input" required value="<?php echo htmlspecialchars($project['proj_description']); ?>"><br>
                            </div>

                            <div class="details_container">
                                <p class="underline">PROJECTED TIMELINE</p>
                                <p class="italic">Please note that this is an estimation and can be changed.</p>
                                <div class="select_date">
                                    <div class="date_input">
                                        <label for="proj_start">Start Date:</label> 
                                        <input type="date" id="proj_start" name="proj_start" required value="<?php echo $project['proj_start']; ?>"><br>
                                    </div>
                                    <div class="date_input">
                                        <label for="proj_end">End Date:</label> 
                                        <input type="date" name="proj_end" id="proj_end" required value="<?php echo $project['proj_end']; ?>"><br>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Update Project">
                        </form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="js/nav.js"></script>
    <?php $conn->close(); ?>
</body>
</html>

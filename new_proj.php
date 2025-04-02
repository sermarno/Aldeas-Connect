<?php
    include 'includes/db.php';
    $comm_sql = "SELECT * FROM communities";
    $comm_result = $conn->query($comm_sql);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $conn->real_escape_string($_POST['title']);
        $proj_description = $conn->real_escape_string($_POST['proj_description']);
        $proj_start = $conn->real_escape_string($_POST['proj_start']);
        $proj_end = $conn->real_escape_string($_POST['proj_end']);
        $community_id = $conn->real_escape_string($_POST['community_id']);
        
        // Handle image upload
        $proj_image = null;
        if (isset($_FILES['proj_image']) && $_FILES['proj_image']['error'] == 0) {
            echo "File uploaded: " . $_FILES['proj_image']['name'];
            $proj_image = $_FILES['proj_image']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($proj_image);
            if (move_uploaded_file($_FILES['proj_image']['tmp_name'], $target_file)) {
                echo "Image uploaded successfully.";
            } else {
                echo "image upload failed.";
            }
        }
    
        // Insert project into database
        $sql = "INSERT INTO projects (title, proj_description, proj_start, proj_end, community_id, proj_image) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $title, $proj_description, $proj_start, $proj_end, $community_id, $proj_image);
    
        if ($stmt->execute()) {
            header("Location: investor.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Project Request</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <!-- linking javascript for drop downs -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <a class="back" href="investor.php"> ← Go Back</a>
        </div>
        <div class="form_container">
            <form action="new_proj.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="project_id">
                <div class="project_details">
                    <h2>Project Details</h2>
                    <div class="details_container">
                        <p class="underline">PROJECT TITLE AND DESCRIPTION</p>
                        <p class="italic">Give the project a name and a short description explaining it's purpose.</p>
                        Project Title: <br><input type="text" name="title"><br><br>
                        Project Description: <br><input type="text" name="proj_description" class="large_input">
                    </div>
                    <div class="details_container">
                        <p class="underline">PROJECTED TIMELINE</p>
                        <p class="italic"> Please note that this is an estimation and can be changed.</p>
                        <div class="select_date">
                            <div class="date_input">
                                <label for="proj_start">Start Date:</label> 
                                <input type="date" id="proj_start" name="proj_start">
                            </div>
                            <div class="date_input">
                                <label for="proj_end">End Date:</label> 
                                <input type="date" id="proj_end" name="proj_end">
                            </div>
                        </div>
                    </div>
                    <div class="details_container">
                        <p class="underline">COMMUNITY</p>
                        <p class="italic">Which community is working on this project? <br></p>
                        <select name="community_id" id="community" required>
                            <option value="">Select a community</option>
                            <?php 
                            if ($comm_result->num_rows > 0) {
                                while ($row = $comm_result->fetch_assoc()) {
                                    echo "<option value='" . $row['community_id'] . "'>" . htmlspecialchars($row['comm_name']) . "</option>";
                                }
                            }
                            ?>
                        </select> <br><br>
                    </div>
                    <div class="details_container">
                        <p class="underline">PROJECT IMAGE</p>
                        <p class="italic">Upload an image representing the project (optional).</p>
                        <label for="proj_image">Select Image:</label><br>
                        <input type="file" id="proj_image" name="proj_image" accept="image/*"><br><br>
                    </div>
                    <input type="submit" value="Add Project">
                </div>
            </form>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
    <script src="js/nav.js"></script>
    <?php $conn->close(); ?>
</body>
</html>
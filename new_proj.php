<?php
    include 'includes/db.php';
    $comm_sql = "SELECT * FROM communities";
    $comm_result = $conn->query($comm_sql);
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
            <a class="back" href="request.php"> ← Go Back</a>
        </div>
        <div class="form_container">
            <form action="req_sent.php" method="POST">
                <h1>New Project Request Form</h1>
                <p class="italic">
                    This form is for Smart Village residents who wish to see
                    their project on this website and do not see it already in the <a href="investor.php">project's list.</a>
                    Your request will be reviewed and you will be provided with a message regarding
                    it's approval or denial. <br><br> 
                </p>
                <input type="hidden" name="request_id">
                <div class="project_details">
                    <h2>Project Details</h2>
                    <div class="details_container">
                        <p class="underline">PROJECT TITLE AND DESCRIPTION</p>
                        <p class="italic">Give your project a name and tell us what it's about.</p>
                        Project Title: <br><input type="text" name="title"><br><br>
                        Project Description: <br><input type="text" name="proj_description" class="large_input">
                    </div>
                    <div class="details_container">
                        <p class="underline">PROJECTED TIMELINE</p>
                        <p class="italic">Please note that this is an estimation and can be changed.</p>
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
                        <p class="italic">What community are you a part of? <br></p>
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
                    <input type="submit" value="Send Request">
                </div>
            </form>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
    <script src="js/nav.js"></script>
    <?php $conn->close(); ?>
</body>
</html>
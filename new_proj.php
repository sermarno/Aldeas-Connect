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
        <h1>New Project Request Form</h1>
    </header>
    <div class="form">
        <form action="req_sent.php" method="POST">
            <input type="hidden" name="request_id">
            Project Title: <input type="text" name="title"><br>
            Project Description: <input type="text" name="proj_description"><br>
            Project Start Date: <input type="date" name="proj_start"><br>
            Project End Date: <input type="date" name="proj_end"><br>
            What community are you a part of?
            <select name="community_id" id="community" required>
                <option value="">Select a community</option>
                <?php 
                if ($comm_result->num_rows > 0) {
                    while ($row = $comm_result->fetch_assoc()) {
                        echo "<option value='" . $row['community_id'] . "'>" . htmlspecialchars($row['comm_name']) . "</option>";
                    }
                }
                ?>
            </select> <br>
            <input type="submit" value="Send Request">
        </form>
    </div>
    <?php include 'includes/footer.php' ?>
    <script src="js/nav.js"></script>
    <?php $conn->close(); ?>
</body>
</html>
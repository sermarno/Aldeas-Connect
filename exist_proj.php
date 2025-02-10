<?php
    session_start();
    include "includes/db.php";
    $comm_sql = "SELECT * FROM communities";
    $comm_result = $conn->query($comm_sql);
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
    <!-- linking javascript for drop downs -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <form action="req_sent.php" method="POST">
            Community:
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
            <input type="submit">
        </form>
    </div>
    <?php include 'includes/footer.php' ?>
    <?php $conn->close(); ?>
</body>
</html>
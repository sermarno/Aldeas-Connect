<?php
    session_start();

    $hostname = 'db.luddy.indiana.edu';
    $username = 'i494f24_team61';
    $password = 'zuzim9344peery';
    $database = 'i494f24_team61';
    $conn = new mysqli($hostname, $username, $password, $database);
    if ($conn->connect_error) {
      die("Connection failed.". $conn->connect_error);}

    $comm_sql = "SELECT * FROM communities";
    $comm_result = $conn->query($comm_sql);
    $conn->close();
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
    <!-- linking javascript for drop downs -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Nav Bar -->
    <div class="nav">
            <h3><a href="index.php">Home</a></h3>
            <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>New Project Request Form</h1>
    </header>
    <div class="form">
        <form action="req_sent.php" method="POST">
            <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
            Project Title: <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>"><br>
            Project Description: <input type="text" name="proj_description" value="<?php echo htmlspecialchars($row['req_description']); ?>"><br>
            Project Start Date: <input type="date" name="proj_start" value="<?php echo $row['proj_start']; ?>"><br>
            Project End Date: <input type="date" name="proj_end" value="<?php echo $row['proj_end']; ?>"><br>
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
            <input type="submit">
        </form>
    </div>
    <?php include 'includes/footer.php' ?>
</body>
</html>
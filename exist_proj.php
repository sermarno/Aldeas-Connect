<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Remove Project Request</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
    <!-- Nav Bar -->
    <div class="nav">
            <h3><a href="index.php">Home</a></h3>
            <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>Existing Project Request Form</h1>
    </header>
    <div class="form">
        <form action="req_sent.php" method="POST">
            <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
            Project Title: <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>"><br>
            Project Description: <input type="text" name="proj_description" value="<?php echo htmlspecialchars($row['req_description']); ?>"><br>
            Project Start Date: <input type="date" name="proj_start" value="<?php echo $row['proj_start']; ?>"><br>
            Project End Date: <input type="date" name="proj_end" value="<?php echo $row['proj_end']; ?>"><br>
            Request Status: <br>
            Status Message: <br>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Form</title>
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
        <h1>Project Request</h1>
    </header>
    <div class="proj_container">
        <div class="new">
            <p>Do you want to see your community's projects online?</p>
            <a href="new_proj.php">New Project</a>
        </div>
        <hr>
        <div class="existing">
            <p>Already see your project?</p>
            <a href="edit_proj.php">Update or Remove Project</a>
        </div>
        <div class="cancel">
            <a href="index.php">Cancel</a>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>

</body>
</html>
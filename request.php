<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Form</title>
    <!-- Linking CSS Stylesheet -->
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
    <script src="js/nav.js"></script>

</body>
</html>
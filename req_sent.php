<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Sent</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
    <?php
    session_start();

    $hostname = 'db.luddy.indiana.edu';
    $username = 'i494f24_team61';
    $password = 'zuzim9344peery';
    $database = 'i494f24_team61';
    $conn = new mysqli($hostname, $username, $password, $database);
    if ($conn->connect_error) {
      die("Connection failed.". $conn->connect_error);}
    // collecting form data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $conn->real_escape_string($_POST['title']);
        $proj_description = $conn->real_escape_string($_POST['proj_description']);
        $proj_start = $conn->real_escape_string($_POST['proj_start']);
        $proj_end = $conn->real_escape_string($_POST['proj_end']);
        $community_id = $conn->real_escape_string($_POST['community_id']);
        $sql = "INSERT INTO projects (title, proj_description, proj_start, proj_end, community_id)
        VALUES ('$title', '$proj_description', '$proj_start', '$proj_end', '$community_id')";
        if ($conn->query($sql) === TRUE) {
            $result = "New project request '$title' has been successfully sent for review!";
        } else {
            $result = "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
    <div class="nav">
                <h3><a href="index.php">Home</a></h3>
                <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>New Project Request Form</h1>
    </header>
    <?php if (isset($result)) { ?>
        <p><?php echo $result; ?> </p>
    <?php } ?>
    <div class="cancel">
            <a href="index.php">Back to home page</a>
    </div>
</body>
</html>
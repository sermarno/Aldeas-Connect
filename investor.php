<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Page</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>

<?php
    include "includes/db.php";
    // Database Query
    $query = "SELECT * FROM required_help";
    $result_set = mysqli_query($conn, $query);
    if ($result_set){
        echo "<h2>Required Help</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Community</th><th>Required Resources</th></tr>";

        while ($row = mysqli_fetch_assoc($result_set)) {
            echo "<tr>";
            echo "<td>" . $row['community'] . "</td>";
            echo "<td>" . $row['req_resources'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No dish records found.<br>";
    }
    // Close the Connection
    mysqli_close($conn);
?>

<body>
    <!-- Nav Bar -->
    <div class="nav">
        <a href="index.php">
            <img src="img/logo.jpg" alt="home">
        </a>
        <?php include 'includes/nav.php' ?>
    </div>
<header>
    <h1>Investor Page</h1>
</header>

<h2>Projects</h2>

<!--Table to show ongoing projects, projects in progress, etc.-->


<h2>Where You Can Help</h2>
<!--Table to show project title, where the project needs assistance.-->
<?php include 'includes/footer.php' ?>


</body>
</html>
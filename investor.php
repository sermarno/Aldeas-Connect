<?php
    include "includes/db.php";
    // Database Query
    $query = "SELECT * FROM required_help";
    $result_set = mysqli_query($conn, $query);
    if ($result_set){
        echo "<h2>Required Help</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Community</th><th>Required Resources</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
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
    mysqli_close($conn)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Page</title>
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
    <h1>Investor Page</h1>
</header>

<h2>Projects</h2>

<!--Table to show ongoing projects, projects in progress, etc.-->

<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Project Timeline</th>
        <th>Project Percentage</th>
    </tr>
</table>
<h2>Where You Can Help</h2>
<!--Table to show project title, where the project needs assistance.-->
<table>
    <tr>
        <th>Community</th>
        <th>Required Resources</th>
    </tr>
    <tr>
        <td>Yokdzonot-Hu, Yaxkabá</td>
        <td>More carving tools.</td>
    </tr>
    <tr>
        <td>Tikum, Tekax</td>
        <td>More containers.</td>
    </tr>
    <tr>
        <td>Hunukú, Temozón</td>
        <td>More computers for online resources.</td>
    </tr>
    <tr>
        <td>Cazumá, Cazumá</td>
        <td>More wifi routers for intenet.</td>
    </tr>
</table>

<?php include 'includes/footer.php' ?>
<script src="js/nav.js"></script>

</body>
</html>
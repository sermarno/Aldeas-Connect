<?php
    session_start();
    include "includes/db.php";
    $sql = "SELECT * FROM projects";
    $result = $conn->query($sql);
    $projects = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    } // Moved this to the top before queries
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    /> 
</head>

<body>
    <!-- Nav Bar -->
    <?php include 'includes/nav.php'; 
        include 'includes/side_nav.php';?>
    <!-- Header -->
    <header>
        <h1>See How You Can Help</h1>
    </header>

    <!-- Community Projects Section -->
    <div class="all_projects">
        <h3>Community Projects</h3>
        <div class="proj-grid2">
            <?php
                if (count($projects) > 0) {
                    foreach ($projects as $project) {
                        echo "<div class='proj-card'>";
                        echo "<div class='card-body'>"; // Adding card body
                        echo "<h3>" . htmlspecialchars($project['title']) . "</h3>";
                        echo "<p>" . htmlspecialchars($project['proj_description']) . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
        <p class="italic">Want to see your community's projects here?</p>
        <a class="button" href="request.php">Submit a Request</a>
    </div>

    <!-- Requred Help Section -->
    <div class="projects-container">
        <?php
            // Database Query
            $query = "SELECT * FROM required_help";
            $result_set = mysqli_query($conn, $query);
            if ($result_set) {
                echo "<h3>Required Help</h3>";
                echo "<table>";
                echo "<tr><th>Community</th><th>Required Resources</th></tr>";

                while ($row = mysqli_fetch_assoc($result_set)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['community']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['req_resources']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No records found.<br>";
            }

            // Close database connection
            mysqli_close($conn);
        ?>
    </div>

    <!--- Footer --->
    <?php
    include 'includes/footer.php';
    ?>
    <script src="js/nav.js"></script>
</body>
</html>

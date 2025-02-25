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
    <title>Investor Page</title>
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
        <?php include 'includes/nav.php'; 
         include 'includes/side_nav.php';?>
    </div>
    <!-- Header -->
    <header>
        <h1>Investor Page</h1>
    </header>

    <!-- Community Projects Section -->
    <div class="projects-container">
        <h3>Community Projects</h3>
        <div class="proj-grid">
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
    </div>

    <!-- Requred Help Section -->
    <div class="requests-container">
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
</body>
</html>

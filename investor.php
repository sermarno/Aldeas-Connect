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
        <p>Support projects that create lasting impact in local communities.</p>
    </header>

    <!-- Community Projects Section -->
    <div class="all_projects">
        <h3>Community Projects</h3>
        <div class="proj-grid2">
            <?php
                if (count($projects) > 0) {
                    foreach ($projects as $project) {
                        // Project Card
                        // Ensure these variables exist before use
                        $raised = $project['raised_amount'] ?? 0;
                        $goal = $project['goal_amount'] ?? 1; // Avoid division by zero
                        $progress = ($goal > 0) ? round(($raised / $goal) * 100) : 0;
                        echo "<div class='proj-card'>";
                        echo "<div class='card-body'>"; // Adding card body
                        echo "<h3>" . htmlspecialchars($project['title']) . "</h3>";
                        echo "<p>" . htmlspecialchars($project['proj_description']) . "</p>";
                        // Progress Bar
                        echo "<div class='progress-container'>";
                        echo "<div class='progress-bar' style='width: {$progress}%;'></div>";
                        echo "<p class='progress-text'>Raised: \${$raised} / Goal: \${$goal} ({$progress}%)</p>";
                        echo "<a href='investor.php?project_id=" . $project['id'] . "' class='donate-btn'>Donate</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?> 
            <a class='button' href='new_proj.php'><img src="img/plus.png"></a>      
        </div>
    </div>


    <div class="collaboration">
        <h3>How Companies Can Help</h3>
        <p>Businesses can support these projects in various ways:</p>
        <ul>
            <li><strong>Financial Contributions:</strong> Donate directly to community projects.</li>
            <li><strong>Resources & Expertise:</strong> Provide materials, mentorship, or technical support.</li>
            <li><strong>Partnerships:</strong> Build long-term collaborations for sustainable impact.</li>
        </ul>
        <a class="button" href="partner.php">Partner with Us</a>
    </div>

    <!-- Requred Help Section -->
    <div class="projects-container">
        <?php
            // Database Querygit 
            $query = "SELECT * FROM required_help";
            $result_set = mysqli_query($conn, $query);
            if ($result_set) {
                echo "<h3>Communities That Need Support</h3>";
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

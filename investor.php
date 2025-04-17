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
    <title>Community Projects</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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
        <h1>Community Projects</h1>
        <p>See How You Can Help: Support projects that create lasting impact in local communities.</p>
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
                        echo "<img src='" . htmlspecialchars($project['proj_image'], ENT_QUOTES, 'UTF-8') . "' />";
                        echo "<button class='edit-btn' 
                        data-id='" . $project['project_id'] . "'
                        data-title='" . htmlspecialchars($project['title'], ENT_QUOTES) . "'
                        data-description='" . htmlspecialchars($project['proj_description'], ENT_QUOTES) . "'
                        data-image='" . htmlspecialchars($project['proj_image'], ENT_QUOTES) . "'
                        ><img src='img/edit.png' alt='edit'></button>";
                        echo "<h3>" . htmlspecialchars($project['title']) . "</h3>";
                        echo "<p>" . htmlspecialchars($project['proj_description']) . "</p>";
                        // Progress Bar
                        echo "<div class='progress-container'>";
                        echo "<div class='progress-bar' style='width: {$progress}%;'></div>";
                        echo "<p class='progress-text'>Raised: \${$raised} / Goal: \${$goal} ({$progress}%)</p>";
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
        <h3>How You Can Help</h3>
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
                echo "<div class='table-responsive'>";
                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo "<tr>
                    <th scope='col'>Community</th>
                    <th scope='col'>Required Resources</th>
                    </tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result_set)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['community']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['req_resources']) . 
                    " <a href='corporate_support.php?community=" . urlencode($row['community']) . "'</td>";
                    //  class='btn btn-sm btn-outline-primary ml-3'>Offer Help</a>
                    echo "</tr>";
                }
                echo "</tbody></table></div>";
            } else {
                echo "No records found.<br>";
            }

            // Close database connection
            mysqli_close($conn);
        ?>
    </div>

    <div id="editModal" class="edit-modal">
        <div class="edit-modal-content">
            <span class="close">&times;</span>
            <form id="editForm" method="POST" action="update_proj.php">
            <input type="hidden" name="project_id" id="editProjectId">
            <label for="editTitle">Title:</label>
            <input type="text" name="title" id="editTitle" required>
            
            <label for="editDescription">Description:</label>
            <textarea name="proj_description" id="editDescription" required></textarea>
            <br>
            <label for="editImage">Image URL:</label>
            <input type="text" name="proj_image" id="editImage">
            
            <button type="submit" class="button">Save Changes</button>
            </form>
        </div>
    </div>

    <!--- Footer --->
    <?php
    include 'includes/footer.php';
    ?>
    <script src="js/nav.js"></script>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
            document.getElementById('editProjectId').value = this.dataset.id;
            document.getElementById('editTitle').value = this.dataset.title;
            document.getElementById('editDescription').value = this.dataset.description;
            document.getElementById('editImage').value = this.dataset.image;

            document.getElementById('editModal').style.display = 'block';
            });
        });

        document.querySelector('.close').addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == document.getElementById('editModal')) {
            document.getElementById('editModal').style.display = 'none';
            }
        });
    </script>

</body>
</html>

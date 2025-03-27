<?php
session_start();
include 'includes/db.php';

// Check if community_id is passed
if (isset($_GET['community_id'])) {
    $community_id = (int) $_GET['community_id'];

    // Query to fetch projects for the selected community
    $sql = "SELECT * FROM projects WHERE community_id = $community_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through the result set and display each project
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($row['title']) . "</strong><br>";
            echo "<em>" . htmlspecialchars($row['proj_description']) . "</em><br>";
            if (!empty($row['proj_image'])) {
                echo "<img src='" . htmlspecialchars($row['proj_image']) . "' alt='" . htmlspecialchars($row['title']) . "' style='width: 100px;'><br>";
            }
            echo "<strong>Start Date: </strong>" . htmlspecialchars($row['proj_start']) . "<br>";
            echo "<strong>End Date: </strong>" . htmlspecialchars($row['proj_end']) . "</li><br>";
        }
        echo "</ul>";
    } else {
        echo "No projects found for this community.";
    }
} else {
    echo "Community ID is missing.";
}

$conn->close();
?>

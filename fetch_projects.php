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
        // Output the projects in a structured format
        echo "<div class='projects-list'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='project-card'>";
            echo "<h3 class='project-title'>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p class='project-description'><em>" . htmlspecialchars($row['proj_description']) . "</em></p>";

            if (!empty($row['proj_image'])) {
                echo "<div class='project-image'>";
                echo "<img src='" . htmlspecialchars($row['proj_image']) . "' alt='" . htmlspecialchars($row['title']) . "'>";
                echo "</div>";
            }

            echo "<p class='project-dates'><strong>Start Date:</strong> " . htmlspecialchars($row['proj_start']) . "<br>";
            echo "<strong>End Date:</strong> " . htmlspecialchars($row['proj_end']) . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p class='no-projects'>No projects found for this community.</p>";
    }
} else {
    echo "<p class='error'>Community ID is missing.</p>";
}

$conn->close();
?>

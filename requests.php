<?php
    session_start();
    include "includes/db.php";
    $sql = "SELECT * FROM project_requests";
    $result = $conn->query($sql);
    $project_requests = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $project_requests[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Requests</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- linking javascript for drop downs -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Nav Bar -->
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?>
    <header>
        <h1></h1>
    </header>
    <div class="projects-container">
        <div class="req-grid">
            <h2>Pending Requests</h2>
            <?php
                if (count($project_requests) > 0 ) {
                    foreach ($project_requests as $project_request) {
                        echo "<div class='proj-card'>";
                        echo "<h3>" . htmlspecialchars($project_request['title']) . "</h3>";
                        echo "<p>" . htmlspecialchars($project_request['proj_description']) . "</p>";
                        echo "<p>Start Date: " . htmlspecialchars($project_request['proj_start']) . "</p>";
                        echo "<p>End Date: " . htmlspecialchars($project_request['proj_end']) . "</p>";
                        echo "<p>Request Status: " . htmlspecialchars($project_request['request_status']) . "</p>";
                        echo "<button class='review-btn' 
                            data-id='" . htmlspecialchars($project_request['request_id']) . "'
                            data-title='" . htmlspecialchars($project_request['title']) . "'
                            data-description='" . htmlspecialchars($project_request['proj_description']) . "'
                            data-start='" . htmlspecialchars($project_request['proj_start']) . "'
                            data-end='" . htmlspecialchars($project_request['proj_end']) . "'
                            data-status='" . htmlspecialchars($project_request['request_status']) . "'>Review Request</button>";

                        // button "see how you can help": a href? or button? 
                        echo "</div>";
                    }
                }
                ?>
         </div>
    </div>

    <div id="review-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Review Project Request</h2>
            <input type="hidden" id="request-id">
            <p id="request-details"></p>
            <p><strong>Decision Message (if denied):</strong></p>
            <textarea name="admin-comments" id="admin-comments" placeholder="Enter decision comment if denied..."></textarea><br>
            <button id="approve-btn">Approve</button>
            <button id="deny-btn">Deny</button>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>
    <script src="js/nav.js"></script>
    <script src="js/modal.js"></script>
    <?php $conn->close(); ?>
</body>
</html>
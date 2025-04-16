<?php 
session_start();
include "includes/db.php";

// Fetch all communities
$sql = "SELECT * FROM communities";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communities</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
    <!-- Nav Bar -->
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?>

    <header>
        <h1>Communities</h1>
    </header>

    <section class="communities-table">
        <table>
            <thead>
                <tr>
                    <th>Community Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>See Projects</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['comm_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['comm_description']); ?></td>
                            <td><?php echo htmlspecialchars($row['comm_location']); ?></td>
                            <td>
                                <button class="button" onclick="showProjects(<?php echo $row['community_id']; ?>)">See Projects</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No communities to display.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <!-- Modal for displaying projects -->
    <div id="projectsModal" class="modal2">
        <div class="modal-content2">
            <span class="close2" onclick="closeModal()">&times;</span>
            <h2>Projects for Community</h2>
            <div id="projectsList"></div> <!-- List of projects will be loaded here -->
        </div>
    </div>

    <?php include 'includes/footer.php' ?>
    <script src="js/nav.js"></script>
    <script src="js/google-login.js"></script>

    <script>
        // Function to show the modal and fetch projects for the community
        function showProjects(community_id) {
            // Open the modal
            document.getElementById("projectsModal").style.display = "block";
            document.getElementById("projectsList").innerHTML = ""; 
            // Fetch projects via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_projects.php?community_id=" + community_id, true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    document.getElementById("projectsList").innerHTML = xhr.responseText;
                } else {
                    document.getElementById("projectsList").innerHTML = "No projects found.";
                }
            };
            xhr.send();
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById("projectsModal").style.display = "none";
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>

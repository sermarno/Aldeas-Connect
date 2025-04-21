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
    <main>
            <header>
                <h1>Communities with Smart Village Resources</h1>
            </header>
            <section class="communities-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="community-card">
                            <div class="image-carousel" data-images='[
                                "<?php echo $row["comm_img1"]; ?>", 
                                "<?php echo $row["comm_img2"]; ?>", 
                                "<?php echo $row["comm_img3"]; ?>"
                                ]'>
                                <img src="<?php echo $row["comm_img1"]; ?>" alt="Community Image" class="carousel-img">
                                <button class="prev-img">⟨</button>
                                <button class="next-img">⟩</button>
                            </div>
                            <h2 class="community-name"><?php echo htmlspecialchars($row['comm_name']); ?></h2>
                            <p class="community-location"><?php echo htmlspecialchars($row['comm_location']); ?></p>
                            <p class="community-description">Known For: <?php echo htmlspecialchars($row['comm_description']); ?></p>
                            <p class="community-connection-date">Connected on: <?php echo htmlspecialchars($row['comm_connection_date']); ?></p>
                            <button class="comm_button" onclick="showProjects(<?php echo $row['community_id']; ?>)">See Projects</button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No communities to display.</p>
                <?php endif; ?>
            </section>


            <!-- Modal for displaying projects -->
            <div id="projectsModal" class="modal2">
                <div class="modal-content2">
                    <span class="close2" onclick="closeModal()">&times;</span>
                    <h2>Projects for Community Development</h2>
                    <div id="projectsList"></div>
                </div>
            </div>

            <script src="js/nav.js"></script>
            <script src="js/google-login.js"></script>

            <script>
                // function to show the modal and fetch projects for the community
                function showProjects(community_id) {
                    document.getElementById("projectsModal").style.display = "block";
                    document.getElementById("projectsList").innerHTML = ""; 
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
                function closeModal() {
                    document.getElementById("projectsModal").style.display = "none";
                }
            </script>
            <!-- image shuffle -->
            <script>
            document.querySelectorAll('.image-carousel').forEach(carousel => {
                const images = JSON.parse(carousel.dataset.images);
                let index = 0;

                const imgTag = carousel.querySelector('.carousel-img');
                const prevBtn = carousel.querySelector('.prev-img');
                const nextBtn = carousel.querySelector('.next-img');

                prevBtn.addEventListener('click', () => {
                    index = (index - 1 + images.length) % images.length;
                    imgTag.src = images[index];
                });

                nextBtn.addEventListener('click', () => {
                    index = (index + 1) % images.length;
                    imgTag.src = images[index];
                });
            });
        </script>
    </main>
    <?php include 'includes/footer.php' ?>

</body>
</html>

<?php $conn->close(); ?>

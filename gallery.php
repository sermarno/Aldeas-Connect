 <?php
    session_start();
    include "includes/db.php";
    $comm_sql = "SELECT comm_name, comm_description FROM communities";
    $comm_result = $conn->query($comm_sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
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
        <h1>Village Gallery</h1>
    </header>
    <div class="gallery">
    <?php
        if ($comm_result->num_rows > 0) {
            while($row = $comm_result->fetch_assoc()) {
                echo '<div class="gallery-item" id="community-' . $row["id"] . '">';
                echo '<h2>' . $row["comm_name"] . '</h2>';
                echo '<img src="' . $row["image"] . '" alt="' . $row["comm_name"] . '">';
                echo '<p>' . $row["comm_description"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
    <div class="lightbox" id="lightbox">
        <img src="" alt="">
    </div>

    <script>
        const galleryItems = document.querySelectorAll('.gallery-item img');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = lightbox.querySelector('img');

        galleryItems.forEach(item => {
            item.addEventListener('click', () => {
                lightboxImg.src = item.src;
                lightbox.style.display = 'flex';
            });
        });

        lightbox.addEventListener('click', () => {
            lightbox.style.display = 'none';
        });
    </script>
    <?php include 'includes/footer.php' ?>
    <script src="js/nav.js"></script>
    <?php $conn->close(); ?>
    
</body>
</html>

 <?php
    session_start();
    

    $hostname = 'db.luddy.indiana.edu';
    $username = 'i494f24_team61';
    $password = 'zuzim9344peery';
    $database = 'i494f24_team61';
    $conn = new mysqli($hostname, $username, $password, $database);
    if ($conn->connect_error) {
      die("Connection failed.". $conn->connect_error);}

    $comm_sql = "SELECT comm_name, comm_description FROM communities";
    $comm_result = $conn->query($comm_sql);
    $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Village Gallery</h1>
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
    
</body>
</html>

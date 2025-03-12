
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
    
<br>
<br>
    <header>
        <h1>Village Gallery</h1>
    </header>   
    
    
    <div class="gallery-section">
        <h2>Agricultural Products</h2>
    <div class="gallery">
        <img src="img/smartvillages2.jpg" >
        <img src="img/smartvillagessauce.jpg" >
        <img src="img/smartvillagessauces.jpg" >
        <!-- Add more images as needed -->
    </div>
        </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="gallery-section">
        <h2>Female Empowerment</h2>
        <div class="gallery">
            <img src="img/female-empowerment2.jpg">
            <img src="img/female-empowerment3.jpg">
            <img src="img/female-empowerment.jpg">
        </div>
    </div>
    <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="gallery-section">
        <h2>Education</h2>
        <div class="gallery">
            <img src="img/education3.jpg">
            <img src="img/education2.jpg">
            <img src="img/education1.jpg">
        </div>
    </div>
    <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="gallery-section">
        <h2>Handmade Art</h2>
        <div class="gallery">
            <img src="img/artwork1.jpg">
            <img src="img/artwork2.jpg">
            <img src="img/artwork3.jpg">
        </div>
    </div>
    <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="gallery-section">
        <h2>Health Education</h2>
        <div class="gallery">
            <img src="img/health1.jpg">
            <img src="img/health2.jpg">
            <img src="img/health3.jpg">
        </div>
    </div>

    <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img class="lightbox-content" id="lightbox-img">
        <a class="prev">&#10094;</a>
        <a class="next">&#10095;</a>
    </div>

    <a class="button" href="investor.php">See Ongoing Projects</a>



    
    
    
    <?php include 'includes/footer.php' ?>
    <script src="js/nav.js"></script>
    <script src="js/gallery.js"></script>
</body>
</html>

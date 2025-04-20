<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <!-- Translate API -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }       
    </script>
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        function translatePage() {
            var translateElement = document.getElementById('google_translate_element');
            translateElement.style.display = 'block';
            var select = translateElement.querySelector('select');
            select.value = 'es';
            select.dispatchEvent(new Event('change'));
        }
    </script>
</head>
<body>
    <!-- Nav Bar -->
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?>

    <header>
        <h1 class="team-heading">Meet the Team</h1>
    </header>
    <div class="team-container">
  
    <div class="team-member">
    <img src="img/rfoncann.jpg" alt="bio photo">
    <div class="member-info">
    <h2>Reece Foncannon</h2>
    <h3>Informatics BS</h3>
    <h3>Human-Centered Computing Minor</h3>
  </div>
    <p>Reece is a senior at Indiana University majoring in Informatics with a minor in Human-Centered Computing.  Reece finds immense satisfaction in designing intuitive and aesthetically pleasing websites for users.  Throughout these past few months learning about the Smart Village project in Mexico, Reece and the team have been inspired to build a helpful website that empowers the people in these villages to maximize their potential.  Reece believes that internet access is a human right in today's society, so working on a project that aims to connect rural communities to the internet has been very fulfilling.</p>
  
  </div>
  <div class="team-member">
    <img src="img/sermarno.jpg" alt="bio photo">
    <div class="member-info">
    <h2>Serra Arnold</h2>
    <h3>Informatics BS</h3>
    <h3>Web Development & Design Minor</h3>
  </div>
    <p>Serra is also a senior at Indiana University, majoring in Informatics and minoring in web development and design. Her journey in Informatics has ignited her passion for leveraging technology to enhance business productivity and daily life. Serra and the team are extremely appreciative of the opportunity to enhance life in rural communities across Mexico.</p>
  </div>
  <!-- Add more team members as needed -->
  <div class="team-member">
    <img src="img/nimasuen.jpg" alt="bio photo">
    <div class="member-info">
    <h2>Nosadeba Imasuen</h2>
    <h3>Informatics BS</h3>
  </div>
    <p>Nosadeba is a senior at Indiana University, majoring in Informatics with a focus in Graphic design. He aims to integrate his informatics studies into the design and implementation aspect of graphic design. After conversing and working with Aldeas Intelligentes, Nosadeba believes that integrating technology is beyond helpful to the residents who live in these rural areas. With the soon-to-be-designed web app, he hopes his efforts will be useful to the community to allow a smoother development throughout the company between the residents and their projects. </p>
  </div>
  <div class="team-member">
    <img src="img/ecristan.jpg" alt="bio photo">
    <div class="member-info">
    <h2>Ella Cristancho</h2>
    <h3>Informatics BS</h3>
    <h3>Business Minor, Pre-Law Track</h3>
  </div>
    <p>Ella is a senior at Indiana University majoring in Informatics with a minor in Business and on the Pre-Law track. Her academic journey highlights her passion for the intersection of technology, business, and social impact. Working with Aldeas Inteligentes on this project has been a dream come true as it converges the things she cares about most. Being able to advance her technical skills through the development of the app while also helping expand the work being done in the smart villages (and beyond) is something the team is so grateful for. 
    </p>
  </div>
</div>
<div class="translate-container">
  <div id="google_translate_element" class="translate-box"></div>
  <img src="img/translate_icon.png" alt="Translate" class="translate-icon">
</div>
<?php include 'includes/footer.php' ?>
<script src="js/nav.js"></script>


    
</body>
</html>
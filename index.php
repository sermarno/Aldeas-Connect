<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>

<div class="content">
        <h1>Welcome to My Website</h1>
        <p></p>
        <button onclick="translatePage()">Translate to Spanish</button>
        <div id="google_translate_element" style="display:none;"></div>
    </div>
    <script>
        function translatePage() {
            var translateElement = document.getElementById('google_translate_element');
            translateElement.style.display = 'block';
            var select = translateElement.querySelector('select');
            select.value = 'es';
            select.dispatchEvent(new Event('change'));
        }
    </script>
    <!-- Nav Bar -->
    <div class="nav">
            <h3><a href="index.php">Home</a></h3>
            <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>Project Overview: <br><span>La Conexión y el Futuro de las Aldeas Inteligentes</span></h1>
    </header>

    <div class="map">
        <p>Map</p>
    </div>
    
    <div class="request">
        <p>Want to see your community's projects here?</p>
        <a href="request.php">Submit a Request</a>
    </div>

    <article id="overview">
        <h3>Overview</h3>
        <p>
            Aldeas Inteligentes is a transformative initiative by the Mexican Federal Government aimed at providing digital access to rural and isolated communities across Mexico. 
            By connecting 83 communities with wireless internet, offering STEM training, and supporting community development projects, Aldeas Inteligentes is enhancing education, commerce, health, and overall welfare.
            Our information system will change how rural communities track progress, showcase their achievements, and connect with supporters.
            From improving education and healthcare to boosting local commerce, we're creating a platform that helps amplify the voices and aspirations of Mexico's underrated regions.
        </p>
    </article>
</body>
</html>
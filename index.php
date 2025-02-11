<?php
//array of village data placeholders still need to pull info to village
$villages = [
    [
        "name" => "Village A",
        "lat" => 19.4326,
        "lng" => -99.1332,
        "info" => "This is Village A. Known for its agricultural projects."
    ],
    [
        "name" => "Village B",
        "lat" => 20.6597,
        "lng" => -103.3496,
        "info" => "This is Village B. Famous for its STEM initiatives."
    ],
    [
        "name" => "Village C",
        "lat" => 21.1619,
        "lng" => -86.8515,
        "info" => "This is Village C. Focused on e-commerce development."
    ],
];
?>

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
    <!-- Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDf99Nyj4amTBbILPYjYt0S01h-kuSWqo"></script> 

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Nav Bar -->
    <div class="nav">
            <h3><a href="index.php">Home</a></h3>
            <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>Project Overview: <br><span>La Conexión y el Futuro de las Aldeas Inteligentes</span></h1>
    </header>
    <button onclick="translatePage()">Translate to Spanish</button>
    <div id="google_translate_element" style="display:none;"></div>
    <script>
        function translatePage() {
            var translateElement = document.getElementById('google_translate_element');
            translateElement.style.display = 'block';
            var select = translateElement.querySelector('select');
            select.value = 'es';
            select.dispatchEvent(new Event('change'));
        }
    </script>

    <div id="map">
        <h1 style="text-align: center;">Aldeas Inteligentes: Village Map</h1>
        <script>
            const villages = <?php echo json_encode($villages); ?>;

            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 6,
                    center: { lat: 23.6345, lng: -102.5528 }, // Center of Mexico might change later depending on what villages
                });

                villages.forEach(village => {
                    const marker = new google.maps.Marker({
                        position: { lat: village.lat, lng: village.lng },
                        map: map,
                        title: village.name,
                    });

                    const infoWindow = new google.maps.InfoWindow({
                        content: `<h3>${village.name}</h3><p>${village.info}</p>`,
                    });

                    marker.addListener("click", () => {
                        infoWindow.open(map, marker);
                    });
                });
            }

            window.onload = initMap;
        </script>
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
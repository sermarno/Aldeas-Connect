
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
<!-- everything is subject to change based on what the other pages look like -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aldeas Inteligentes Map of Mexico</title>
<!-- come back here to add api we decide on (static) -->
    <script src="https://maps.googleapis.com/maps/api/js?key=GET_API_KEY"></script> 
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'includes/nav.php' ?>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <h1 style="text-align: center;">Aldeas Inteligentes: Village Map</h1>
    <div id="map"></div>

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
</body>
</html>

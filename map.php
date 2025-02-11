
<?php
//array of village data placeholders still need to pull info to village
$villages = [
    [
        "name" => "Sacún Cubwitz",
        "lat" => 17.1275,
        "lng" => -91.93989,
        "info" => "Centro de Salud in Chiapas, focused on processing and sharing health sector reports."
    ],
    [
        "name" => "Siberia",
        "lat" => 16.61759,
        "lng" => -92.29259,
        "info" => "Centro de Salud Microregional in Siberia, Chiapas, improving healthcare report sharing."
    ],
    [
        "name" => "Yibeljoj",
        "lat" => 16.95799,
        "lng" => -92.504199,
        "info" => "Centro de Salud Microregional in Yibeljoj, working on better jurisdictional health coordination."
    ],
    [
        "name" => "Nueva Tenochtitlán",
        "lat" => 16.4769,
        "lng" => -94.08289,
        "info" => "Centro de Salud Nueva Tenochtitlán, focusing on digital health records and remote care."
    ],
    [
        "name" => "Gabriel Leyva Velázquez",
        "lat" => 16.4614,
        "lng" => -91.835999,
        "info" => "Centro de Salud in Las Margaritas, enhancing health information sharing."
    ],
    [
        "name" => "San Antonio Las Delicias",
        "lat" => 16.8869,
        "lng" => -91.8763,
        "info" => "Centro de Salud providing support in remote medical reporting."
    ],
    [
        "name" => "Roberto Barrios",
        "lat" => 17.3255,
        "lng" => -91.9257,
        "info" => "Healthcare initiative in Palenque, Chiapas."
    ],
    [
        "name" => "Mariano Matamoros",
        "lat" => 16.48079,
        "lng" => -92.5849,
        "info" => "Centro de Salud supporting health jurisdiction reports."
    ],
    [
        "name" => "Nuevo Limar",
        "lat" => 17.45329,
        "lng" => -92.3957,
        "info" => "Health center working on jurisdiction and hospital coordination."
    ],
    [
        "name" => "Esperanza de los Pobres",
        "lat" => 17.30969,
        "lng" => -93.4825,
        "info" => "Centro de Salud promoting data sharing in Chiapas."
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

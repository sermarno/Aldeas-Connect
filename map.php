
<?php
//array of village data placeholders still need to pull info to village
$villages = [
    ["name" => "Sacún Cubwitz", "lat" => 17.1275, "lng" => -91.93989, "info" => "Centro de Salud in Chiapas, focused on processing and sharing health sector reports."],
    ["name" => "Siberia", "lat" => 16.61759, "lng" => -92.29259, "info" => "Centro de Salud Microregional in Siberia, Chiapas, improving healthcare report sharing."],
    ["name" => "Yibeljoj", "lat" => 16.95799, "lng" => -92.504199, "info" => "Centro de Salud Microregional in Yibeljoj, working on better jurisdictional health coordination."],
    ["name" => "Nueva Tenochtitlán", "lat" => 16.4769, "lng" => -94.08289, "info" => "Centro de Salud Nueva Tenochtitlán, focusing on digital health records and remote care."],
    ["name" => "Gabriel Leyva Velázquez", "lat" => 16.4614, "lng" => -91.835999, "info" => "Centro de Salud in Las Margaritas, enhancing health information sharing."],
    ["name" => "San Antonio Las Delicias", "lat" => 16.8869, "lng" => -91.8763, "info" => "Centro de Salud providing support in remote medical reporting."],
    ["name" => "Roberto Barrios", "lat" => 17.3255, "lng" => -91.9257, "info" => "Healthcare initiative in Palenque, Chiapas."],
    ["name" => "Mariano Matamoros", "lat" => 16.48079, "lng" => -92.5849, "info" => "Centro de Salud supporting health jurisdiction reports."],
    ["name" => "Nuevo Limar", "lat" => 17.45329, "lng" => -92.3957, "info" => "Health center working on jurisdiction and hospital coordination."],
    ["name" => "Esperanza de los Pobres", "lat" => 17.30969, "lng" => -93.4825, "info" => "Centro de Salud promoting data sharing in Chiapas."],
    ["name" => "Miguel Hidalgo y Costilla", "lat" => 17.2679, "lng" => -93.4487, "info" => "Centro de Salud in Tecpatán improving access to health records."],
    ["name" => "Casa Ejidal Francisco León", "lat" => 17.194269, "lng" => -91.32486, "info" => "Community space supporting refugee education and human rights awareness."],
    ["name" => "Comité de Ayuda para Migrantes", "lat" => 17.19427, "lng" => -91.512, "info" => "Shelter for migrants in Palenque offering educational and legal support."],
    ["name" => "Frontera Corozal", "lat" => 16.82233, "lng" => -90.88832, "info" => "Community education hub for refugee training."],
    ["name" => "Telebachillerato Agua Azul", "lat" => 20.858056, "lng" => -87.325556, "info" => "Educational center supporting online learning in Quintana Roo."],
    ["name" => "Secundaria Comunitaria Niños Héroes", "lat" => 21.3083, "lng" => -87.5625, "info" => "School offering remote education access."],
    ["name" => "Lachivixá", "lat" => 16.707031, "lng" => -95.334314, "info" => "Economic & educational hub promoting e-commerce & online training."],
    ["name" => "Ejido Corazón del Valle", "lat" => 16.418889, "lng" => -94.013056, "info" => "Support center for rural economic projects and e-commerce integration."],
    ["name" => "El Trapiche", "lat" => 15.9552222, "lng" => -96.47583333, "info" => "Project for sustainable landscapes and digital education."],
    ["name" => "Centro de Salud El Mandimbo", "lat" => 15.893055, "lng" => -96.208611, "info" => "Economic and health-related project for community growth."],
    ["name" => "Centro Integrador de Desarrollo", "lat" => 21.0299, "lng" => -99.7458, "info" => "Agricultural improvement initiative for local farmers."],
    ["name" => "Centro de Cultura Blas Mazo", "lat" => 26.801679, "lng" => -109.699219, "info" => "Cultural initiative to support traditional crafts."],
    ["name" => "Comisaría Municipal Yokdzonot Hu", "lat" => 20.46023, "lng" => -88.64281, "info" => "Economic and social support for Maya women in agriculture."],
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

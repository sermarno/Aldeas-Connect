<?php
session_start();
include "includes/db.php";
$sql = "SELECT * FROM project_highlights";
$result = $conn->query($sql);
$projects = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

if (isset($_SESSION['google_email'])) {
    $email = $_SESSION['google_email'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // If user does not exist, redirect to register.php
        header("Location: register.php");
        exit();
    }
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aldeas Inteligentes IU</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDf99Nyj4amTBbILPYjYt0S01h-kuSWqo"></script> 
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
    <!-- Logout/login Popup -->
     <script>
        function logoutMessage() {
            alert("You have been successfully logged out!");
        }
     </script>
    <script>
        function loginMessage() {
            alert("You have been successfully logged in!");
        }
     </script>
</head>
<body>
    <!-- logout message -->
    <?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
        <script>
            logoutMessage();
        </script>
    <?php endif; ?>

    <!-- login message -->
     <?php if (isset($_GET['login']) && $_GET['login'] == 'success'): ?>
        <script>
            loginMessage();
        </script>
    <?php endif; ?>

    <!-- Nav Bar -->
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?>
    <header id="home">
        <h1>
            Aldeas Inteligentes IU <br>
            <span>
                The Connection and Future of Smart Villages
            </span>
        </h1>
        <a class="button_home" href="project.php">Learn More About Aldeas Inteligentes IU</a>
    </header>

    <main>
        <div class="intro">
            <p>
                Aldeas Inteligentes is a transformative initiative by the Mexican Federal Government aimed at providing digital access to rural and isolated communities across Mexico. 
                By connecting 83 communities with wireless internet, offering STEM training, and supporting community development projects, Aldeas Inteligentes is enhancing education, commerce, health, and overall welfare.
                Our information system will change how rural communities track progress, showcase their achievements, and connect with supporters.
                From improving education and healthcare to boosting local commerce, we're creating a platform that helps amplify the voices and aspirations of Mexico's underrated regions.
            </p>
        </div>
        <div class="projects-container">
            <h3>Project Highlights</h3>
            <div class="proj-grid">
                <?php
                    if (count($projects) > 0 ) {
                        foreach ($projects as $project) {
                            echo "<div class='proj-card'>";
                            if (!empty($project['proj_image'])) {
                                echo "<img src='" . htmlspecialchars($project['proj_image']) . "' alt='project image' class='proj-image'><br>";
                            }
                            echo "<h3>" . htmlspecialchars($project['title']) . "</h3>";
                            echo "<p>" . htmlspecialchars($project['proj_description']) . "</p>";
                            echo "<a href='investor.php?project_id=" . $project['id'] . "' class='donate-btn'>Donate</a>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
            <a class="button" href="investor.php">See More</a>
        </div>

        <div class="map-container">
            <div class="map-text">
                <h3>83 Communtities with Smart Village Resources</h3>
                <p>Explore the many communities benefiting from Smart Village inititaves.<br></p>
                <p class="italic">Click on a map marker to learn more</p>
            </div>
            <div id="map">
                <script>
                    const villages = <?php echo json_encode($villages); ?>;

                    function initMap() {
                        const map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 5,
                            center: { lat: 20.4229, lng: -88.1653 }, // Center of Yucatan
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
                            //Testing
                            marker.addListener("click", () => {
                                infoWindow.open(map, marker);
                            });
                        })
                    }

                window.onload = initMap;
                </script>
            </div>
        </div>
        <!-- Messenger Tool -->
         <?php if (isset($_SESSION['user_id'])): ?>
            <div id="chat-button" onclick="toggleChatbox()">Messenger ^</div>
            <div class="chat-popup" style="display:none">
                <button class="close_button" type="button" onclick="closeChatbox()">X</button>
                    <h3>Send a Message</h3>
                    <div id="messages-container"></div>
                <form id="message_form" action="send_message.php" method="POST">
                    <label for="recipient_id">Select Recipient:</label>
                    <select id="recipient_id" name="recipient_id" required>
                        <option value="">Users</option>
                        <?php
                        $query = "SELECT user_id, fname, lname, user_role FROM users";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()): ?>
                            <option value="<?php echo $row['user_id']; ?>">
                                <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select><br><br>

                    <label for="message">Message:</label><br>
                    <textarea id="message" name="message" placeholder="Type your message..." required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        <?php endif; ?>
        <script src="js/nav.js"></script>
        <script src="js/messenger.js"></script>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
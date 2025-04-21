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
    ["name" => "Sacún Cubwitz", "lat" => 17.1275, "lng" => -91.93989, "info" => "Centro de Salud in Chiapas, focused on processing and sharing health sector reports.", "stage" => 1],
    ["name" => "Siberia", "lat" => 16.61759, "lng" => -92.29259, "info" => "Centro de Salud Microregional in Siberia, Chiapas, improving healthcare report sharing.", "stage" => 2],
    ["name" => "Yibeljoj", "lat" => 16.95799, "lng" => -92.504199, "info" => "Centro de Salud Microregional in Yibeljoj, working on better jurisdictional health coordination.", "stage" => 3],
    ["name" => "Nueva Tenochtitlán", "lat" => 16.4769, "lng" => -94.08289, "info" => "Centro de Salud Nueva Tenochtitlán, focusing on digital health records and remote care.", "stage" => 4],
    ["name" => "Gabriel Leyva Velázquez", "lat" => 16.4614, "lng" => -91.835999, "info" => "Centro de Salud in Las Margaritas, enhancing health information sharing.", "stage" => 1],
    ["name" => "San Antonio Las Delicias", "lat" => 16.8869, "lng" => -91.8763, "info" => "Centro de Salud providing support in remote medical reporting.", "stage" => 2],
    ["name" => "Roberto Barrios", "lat" => 17.3255, "lng" => -91.9257, "info" => "Healthcare initiative in Palenque, Chiapas.", "stage" => 3],
    ["name" => "Mariano Matamoros", "lat" => 16.48079, "lng" => -92.5849, "info" => "Centro de Salud supporting health jurisdiction reports.", "stage" => 4],
    ["name" => "Nuevo Limar", "lat" => 17.45329, "lng" => -92.3957, "info" => "Health center working on jurisdiction and hospital coordination.", "stage" => 1],
    ["name" => "Esperanza de los Pobres", "lat" => 17.30969, "lng" => -93.4825, "info" => "Centro de Salud promoting data sharing in Chiapas.", "stage" => 2],
    ["name" => "Miguel Hidalgo y Costilla", "lat" => 17.2679, "lng" => -93.4487, "info" => "Centro de Salud in Tecpatán improving access to health records.", "stage" => 3],
    ["name" => "Casa Ejidal Francisco León", "lat" => 17.194269, "lng" => -91.32486, "info" => "Community space supporting refugee education and human rights awareness.", "stage" => 4],
    ["name" => "Comité de Ayuda para Migrantes", "lat" => 17.19427, "lng" => -91.512, "info" => "Shelter for migrants in Palenque offering educational and legal support.", "stage" => 1],
    ["name" => "Frontera Corozal", "lat" => 16.82233, "lng" => -90.88832, "info" => "Community education hub for refugee training.", "stage" => 2],
    ["name" => "Telebachillerato Agua Azul", "lat" => 20.858056, "lng" => -87.325556, "info" => "Educational center supporting online learning in Quintana Roo.", "stage" => 3],
    ["name" => "Secundaria Comunitaria Niños Héroes", "lat" => 21.3083, "lng" => -87.5625, "info" => "School offering remote education access.", "stage" => 4],
    ["name" => "Lachivixá", "lat" => 16.707031, "lng" => -95.334314, "info" => "Economic & educational hub promoting e-commerce & online training.", "stage" => 1],
    ["name" => "Ejido Corazón del Valle", "lat" => 16.418889, "lng" => -94.013056, "info" => "Support center for rural economic projects and e-commerce integration.", "stage" => 2],
    ["name" => "El Trapiche", "lat" => 15.9552222, "lng" => -96.47583333, "info" => "Project for sustainable landscapes and digital education.", "stage" => 3],
    ["name" => "Centro de Salud El Mandimbo", "lat" => 15.893055, "lng" => -96.208611, "info" => "Economic and health-related project for community growth.", "stage" => 4],
    ["name" => "Centro Integrador de Desarrollo", "lat" => 21.0299, "lng" => -99.7458, "info" => "Agricultural improvement initiative for local farmers.", "stage" => 1],
    ["name" => "Centro de Cultura Blas Mazo", "lat" => 26.801679, "lng" => -109.699219, "info" => "Cultural initiative to support traditional crafts.", "stage" => 2],
    ["name" => "Comisaría Municipal Yokdzonot Hu", "lat" => 20.46023, "lng" => -88.64281, "info" => "Economic and social support for Maya women in agriculture.", "stage" => 3],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aldeas Connect</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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
</head>
<body>
    <!-- Nav Bar -->
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?>

    <main>
        <div class="header">
            <div class="header_text">
                <h1>
                    <span>Aldeas Connect</span> <br>
                    The Connection and Future of Smart Villages <br>
                    <a class="button_home" href="project.php">Learn More</a>
                </h1>
            </div>
            <img src="img/home.jpeg" alt="home">
        </div>
        <div class="intro">
            <img class='intro_img' src="img/laptops.jpeg" alt="utlizing_wifi">
            <div class="intro_content">
                <div class="intro_header">
                    <h2>Aldeas <br> Inteligentes <br> <span>Community Development Projects</span></h2>
                    <a class="button" href="investor.php">View Projects</a>
                </div>
                <p>
                Aldeas Inteligentes is a transformative initiative by the Mexican Federal Government aimed at providing digital access to rural and isolated communities across Mexico. 
                By connecting 83 communities with wireless internet, offering STEM training, and supporting community development projects, Aldeas Inteligentes is enhancing education, commerce, health, and overall welfare in these communitites.
                Our information system will change how rural communities track progress, showcase their achievements, and connect with supporters.
                From improving education and healthcare to boosting local commerce, we're creating a platform that helps amplify the voices and aspirations of Mexico's underrated regions. <br>
                </p>
            </div>
        </div>

        <div class="map-container">

            <div class="map-text top-text">
                <h3>83 Communities with Smart Village Resources</h3> 
            <p>Explore the many communities benefiting from Smart Village inititaves.<br></p>
            <p class="italic">Click on a map marker to learn more</p>
            <a class="button" href="communities.php">See Communities</a>
        </div>
            <div id="map"></div>

        <div class="legend-grid-custom">
            <div class="legend-item stage1">
                <img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" alt="Stage 1">
                <p><strong>Stage 1:</strong> Connection – This is the first step, where internet and digital tools are introduced to connect the community in key sectors like health, education, tourism, and the economy.</p>
            </div>
            <div class="legend-item stage2">
                <img src="http://maps.google.com/mapfiles/ms/icons/orange-dot.png" alt="Stage 2">
                <p><strong>Stage 2:</strong> Use – Once connected, the community begins to use technology in practical ways, such as accessing telemedicine, learning digital skills, and participating in e-commerce.</p>
            </div>
            <div class="legend-item stage3">
                <img src="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png" alt="Stage 3">
                <p><strong>Stage 3:</strong> Deployment – Residents start to make the technology their own by creating solutions, services, and innovations that address local needs through connectivity.</p>
            </div>
            <div class="legend-item stage4">
                <img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png" alt="Stage 4">
                <p><strong>Stage 4:</strong> Sustained – As a result, communities experience greater social inclusion, knowledge sharing, and measurable contributions to sustainable development goals (SDGs).</p>
            </div>
        </div>



            <!-- <div class="legend">
                    <p><img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png"> Stage 1: Connection - This is the first step, where internet and digital tools are introduced to connect the community in key sectors like health, education, tourism, and the economy.</p>
                    <p><img src="http://maps.google.com/mapfiles/ms/icons/orange-dot.png"> Stage 2: Use - Once connected, the community begins to use technology in practical ways, such as accessing telemedicine, learning digital skills, and participating in e-commerce.</p>
                    <p><img src="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"> Stage 3: Deployment - People start to make the technology their own by creating solutions, services, and innovations that address local needs through connectivity.</p>
                    <p><img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png"> Stage 4: Sustained - As a result, communities experience greater social inclusion, knowledge sharing, and measurable contributions to sustainable development goals (SDGs).</p>
                </div> -->
            <!-- Legend for the colors ^-->
            
                <script>
                    const villages = <?php echo json_encode($villages); ?>;
                    
                    //colors to markers (assigned them randomly)
                    const stageColors = {
                        1: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                        2: "http://maps.google.com/mapfiles/ms/icons/orange-dot.png",
                        3: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png",
                        4: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
                    };

                    function initMap() {
                        const map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 5,
                            center: { lat: 20.4229, lng: -88.1653 },
                        });

                        villages.forEach(village => {
                            const marker = new google.maps.Marker({
                                position: { lat: village.lat, lng: village.lng },
                                map: map,
                                title: village.name,
                                icon: stageColors[village.stage] || stageColors[1]
                            });

                            const infoWindow = new google.maps.InfoWindow({
                                content: `<h3>${village.name}</h3><p>${village.info}</p><p><strong>Stage ${village.stage}</strong></p>`,
                            });

                            marker.addListener("click", () => {
                                infoWindow.open(map, marker);
                            });
                        });
                    }

                    window.onload = initMap;
                </script>
            </div>
        </div>
        <div class="projects-container">
            <h3>Community Project Highlights</h3>
            <div class="proj-grid" id="projectGrid">
                <?php if (count($projects) > 0): ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="proj-card"
                            data-project-id="<?= htmlspecialchars($project['project_id']) ?>"
                            data-community-id="<?= htmlspecialchars($project['community_id']) ?>">
                            <?php if (!empty($project['proj_image'])): ?>
                                <img src="<?= htmlspecialchars($project['proj_image']) ?>"
                                    alt="project image"
                                    class="proj-image"><br>
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($project['title']) ?></h3>
                            <p><?= htmlspecialchars($project['proj_description']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <a class="button" href="gallery.php">See Project Gallery</a>
            <a class="button" href="investor.php">See All Projects</a>
        </div>
        <!-- Project Card Popups -->
        <div id="projectModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img id="modalImage" src="" alt="Project Image">
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
                <p id="modalCommunity"></p>
                <p id="modalStartDate"></p>
                <a id="communityDetailsLink" class="button" href="communities.php">See Communities</a>
            </div>
        </div>
        <!-- Messenger Tool -->
         <?php if (isset($_SESSION['user_id'])): ?>
            <div id="chat-button" onclick="toggleChatbox()"><img src="img/messenger.png" alt="messages"></div></div>
            <div class="chat-popup" style="display:none">
                <button class="close_button" type="button" onclick="closeChatbox()">X</button>
                
                <div id="messages-container">
                    <button class="new_message" onclick="showMessageForm()">New Message</button>
                    <h3>Messages</h3>
                    <?php
                    // Fetch the messages sent to the current user
                    $user_id = $_SESSION['user_id'];
                    $query = "
                        SELECT messages.message, messages.sent_at, users.fname, users.lname, messages.sender_id, messages.recipient_id
                        FROM messages
                        JOIN users ON users.user_id = messages.sender_id
                        WHERE (messages.sender_id = ? OR messages.recipient_id = ?) 
                        ORDER BY messages.sent_at DESC
                        ";
                    if ($stmt = $conn->prepare($query)) {
                        $stmt->bind_param('ii', $user_id, $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $sender_name = $row['sender_id'] == $user_id ? "You" : $row['fname'] . " " . $row['lname'];
                                $message = htmlspecialchars($row['message']);
                                $sent_at = $row['sent_at'];
                                echo "<div class='message-box'>";
                                echo "<strong>" . $sender_name . "</strong><br> " . $message . "<br>";
                                echo "<small>" . $sent_at . "</small>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No messages found.</p>";
                        }
                    }
                    ?>
                </div>


                <form id="message_form">
                    <button class="show_messages" onclick="showMessages()">Go Back</button>
                    <h3>Send a Message</h3>
                    <label for="recipient_id">Select Recipient:</label>
                    <select id="recipient_id" name="recipient_id" required>
                        <option value="">Select</option>
                        <?php
                        $query = "SELECT user_id, fname, lname, user_role FROM users WHERE user_id != ?";
                        if ($stmt = $conn->prepare($query)) {
                            $stmt->bind_param('i', $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            while ($row = $result->fetch_assoc()): ?>
                                <option value="<?php echo $row['user_id']; ?>">
                                    <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
                                </option>
                            <?php endwhile; ?>
                            <?php $stmt->close(); ?>
                        <?php } ?>
                    </select><br><br>

                    <label for="message">Message:</label><br>
                    <textarea id="message" name="message" placeholder="Type your message..." required></textarea>
                    <button type="submit">Send Message</button>
                    <p id="message_status"></p>
                </form>
            </div>
        <?php endif; ?>
        <script src="js/nav.js"></script>
        <script src="js/messenger.js"></script>
        <script src="js/messenger_form.js"></script>
        <script>
            function showMessageForm() {
                document.getElementById('messages-container').style.display = 'none';
                document.getElementById('message_form').style.display = 'block';
            }

            function showMessages() {
                document.getElementById('messages-container').style.display = 'block';
                document.getElementById('message_form').style.display = 'none';
            }

            function closeChatbox() {
                document.querySelector('.chat-popup').style.display = 'none';
            }
        </script>
        <div class="translate-container">
            <div id="google_translate_element" class="translate-box"></div>
            <img src="img/translate_icon.png" alt="Translate" class="translate-icon">
        </div>
    </main>
    <script src="js/card-modal.js"></script>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php
    session_start();
    include "includes/db.php";
    $sql = "SELECT * FROM projects";
    $result = $conn->query($sql);
    $projects = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    } // Moved this to the top before queries
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner with Us</title>
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
    <?php include 'includes/nav.php'; 
        include 'includes/side_nav.php';?>
    <!-- Header -->
    <header>
        <h1>Connect With Us</h1>
        <p>Join us in making a difference. Fill out the form below and we'll connect with you.</p>
    </header>
    <?php
    mysqli_close($conn);
    ?>

    <div class="form_container">
        <?php if (!empty($successMessage)) : ?>
                <p class="success-message"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <form action="partner.php" method="post">
            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" required>

            <label for="contact_person">Contact Person:</label>
            <input type="text" id="contact_person" name="contact_person" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="support_type">How Would You Like to Support?</label>
            <select id="support_type" name="support_type" required>
                <option value="Financial Contribution">Financial Contribution</option>
                <option value="Providing Resources">Providing Resources</option>
                <option value="Technical Expertise">Technical Expertise</option>
                <option value="Other">Other</option>
            </select>

            <label for="message">Additional Information (Optional):</label>
            <textarea id="message" name="message" rows="4"></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="translate-container">
        <div id="google_translate_element" class="translate-box"></div>
        <img src="img/translate_icon.png" alt="Translate" class="translate-icon">
    </div>
    <?php
    include 'includes/footer.php';
    ?>
    <script src="js/nav.js"></script>
</body>
</html>
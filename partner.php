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
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
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
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $company_name = ($conn, $_POST['company_name']);
        // $contact_person = ($conn, $_POST['contact_person']);
        // $email = ($conn, $_POST['email']);
        // $phone = ($conn, $_POST['phone']);
        // $support_type = ($conn, $_POST['support_type']);
        // $message = ($conn, $_POST['message']);

        // if (mysqli_query($conn, $sql)) {
        //     $successMessage = "Thank you for your support! We will reach out to you soon.";
        // } else {
        //     $successMessage = "Error: " . mysqli_error($conn);
        // }
    // }
    
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


    <?php
    include 'includes/footer.php';
    ?>
    <script src="js/nav.js"></script>
</body>
</html>
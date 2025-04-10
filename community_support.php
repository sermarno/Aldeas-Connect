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
    <title>All Projects</title>
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
        <h1>Community Projects</h1>
        <p>See How You Can Help: Support projects that create lasting impact in local communities.</p>
    </header>

<?php
$community = $_GET['community'] ?? 'Unknown Community';
$resources = $_GET['resources'] ?? 'N/A';
?>

<div class="support-box">
    <h2>Offer Help to <?php echo htmlspecialchars($community); ?></h2>
    <p><strong>Requested Resources:</strong> <?php echo htmlspecialchars($resources); ?></p>

    <form action="submit_support.php" method="POST">
        <input type="hidden" name="community" value="<?php echo htmlspecialchars($community); ?>">
        <input type="hidden" name="resources" value="<?php echo htmlspecialchars($resources); ?>">

        <div class="form-group">
            <label for="company_name">Your Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>

        <div class="form-group">
            <label for="contact_email">Contact Email</label>
            <input type="email" class="form-control" id="contact_email" name="contact_email" required>
        </div>

        <div class="form-group">
            <label for="support_type">How would you like to help?</label>
            <select class="form-control" id="support_type" name="support_type" required>
                <option value="">-- Select an option --</option>
                <option value="financial">Financial Contribution</option>
                <option value="resources">Provide Materials/Resources</option>
                <option value="expertise">Technical Assistance or Mentorship</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="message">Optional Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Details, questions, or a custom offer..."></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit Offer</button>
    </form>
</div>

</body>
</html>
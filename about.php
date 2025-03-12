<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
</head>
<body>
        
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?> 
    
    <div class="about-container">
    <?php
    session_start();

    $hostname = 'db.luddy.indiana.edu';
    $username = 'i494f24_team61';
    $password = 'zuzim9344peery';
    $database = 'i494f24_team61';
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $section = $_POST['section'];
        $content = $_POST['content'];
        $image_path = '';

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            }
        }

        // Update database
        if ($image_path) {
            $sql = "UPDATE about_content SET content=?, image_path=? WHERE section=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $content, $image_path, $section);
        } else {
            $sql = "UPDATE about_content SET content=? WHERE section=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $content, $section);
        }
        $stmt->execute();
        $stmt->close();
    }

    // Fetch content
    $sql = "SELECT section, content, image_path FROM about_content";
    $result = $conn->query($sql);

    $content = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $content[$row['section']] = $row;
        }
    } else {
        echo "No content found.";
    }

    $conn->close();
    ?>

    <!-- Display content -->
    <?php if (isset($content['Our Mission'])): ?>
        <header>
            <h2>Our Mission</h2>
            <p><?php echo $content['Our Mission']['content']; ?></p>
            <img src="<?php echo $content['Our Mission']['image_path']; ?>" alt="Our Mission Image">
        </header>
    <?php else: ?>
        <h2>Our Mission</h2>
        <p>Content not available.</p>
    <?php endif; ?>
        <!-- Display content -->
        <?php if (isset($content['Our Mission'])): ?>
            <div>
                <h2>Our Mission</h2>
                <p><?php echo $content['Our Mission']['content']; ?></p>
                <img src="<?php echo $content['Our Mission']['image_path']; ?>" alt="Our Mission Image">
            </div>
        <?php else: ?>
            <h2>Our Mission</h2>
            <p>Content not available.</p>
        <?php endif; ?>

    <?php if (isset($content['Why?'])): ?>
        <h2>Why?</h2>
        <p><?php echo $content['Why?']['content']; ?></p>
    <?php else: ?>
        <h2>Why?</h2>
        <p>Content not available.</p>
    <?php endif; ?>

    <!-- Edit form -->
    <h2>Edit Content</h2>
    <form action="about.php" method="post" enctype="multipart/form-data">
        <label for="section">Section:</label>
        <select name="section" id="section">
            <option value="Our Mission">Our Mission</option>
            <option value="Why?">Why?</option>
        </select>
        <br>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" rows="5" cols="40"></textarea>
        <br>
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        <br>
        <br>
        <input type="submit" value="Update">
    </form>
</div>
<?php include 'includes/footer.php'; ?>
<script src="js/nav.js"></script>
        <!-- Edit form -->
        <h2>Edit Content</h2>
        <form action="about.php" method="post" enctype="multipart/form-data">
            <label for="section">Section:</label>
            <select name="section" id="section">
                <option value="Our Mission">Our Mission</option>
                <option value="Why?">Why?</option>
            </select>
            <br>
            <br>
            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="5" cols="40"></textarea>
            <br>
            <br>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
            <br>
            <br>
            <input type="submit" value="Update">
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="js/nav.js"></script>
</body>
</html>
<?php
    include 'includes/db.php';
    $comm_sql = "SELECT * FROM communities";
    $comm_result = $conn->query($comm_sql);

    // Testimonials
    $query = "SELECT * FROM testimonials WHERE status = 'approved' ORDER BY created_at DESC";
    $result = $conn->query($query);
    $testimonials = [];
    while ($row = $result->fetch_assoc()) {
        $testimonials[] = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Stories</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <?php include 'includes/side_nav.php'; ?>



    <hr>
    <div class="testimonials">
        <h1>Read Stories From the Villages</h1>
        <?php foreach ($testimonials as $t) { ?>
            <div class="testimonial">
                <h3><?= htmlspecialchars($t['user_id']) ?> (Community: <?= htmlspecialchars($t['community_id']) ?>)</h3>
                <p><?= htmlspecialchars($t['story_text']) ?></p>
                <?php if (!empty($t['video_url'])) { ?>
                    <video width="300" controls>
                        <source src="<?= htmlspecialchars($t['video_url']) ?>" type="video/mp4">
                    </video>
                <?php } ?>
                <p class="category">Category: <?= htmlspecialchars($t['category']) ?></p>
            </div>
        <?php } ?>
    </div>
    <header><h2>Add Your Story</h2></header>

    <div class="form">
        <form action="story_sent.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="request_id">

            <label>Your Story:</label>
            <input type="text" name="story_text" required><br>

            <label>Category:</label>
            <select name="category" required>
                <option value="">Select a Category</option>
                <option value="Education">Education</option>
                <option value="Economic">Economic</option>
                <option value="Health">Health</option>
                <option value="Other">Other</option>
            </select><br>

            <label>Community:</label>
            <select name="community_id" required>
                <option value="">Select a community</option>
                <?php while ($row = $comm_result->fetch_assoc()) { ?>
                    <option value="<?= $row['community_id'] ?>"><?= htmlspecialchars($row['comm_name']) ?></option>
                <?php } ?>
            </select> <br>

            <label>Upload Video (Optional):</label>
            <input type="file" name="video" accept="video/*"><br>

            <input type="submit" value="Share Your Story">
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="js/nav.js"></script>
</body>
</html>

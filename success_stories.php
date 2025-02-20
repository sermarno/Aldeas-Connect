<?php
require 'db.php';

//Approved Testimonials
$query = "SELECT t.testimonial_id, u.full_name, c.comm_name, t.story_text, t.video_url, t.category, t.created_at 
          FROM testimonials t 
          JOIN users u ON t.user_id = u.user_id 
          JOIN communities c ON t.community_id = c.community_id
          WHERE t.status = 'approved'
          ORDER BY t.created_at DESC";

$result = $conn->query($query);
$testimonials = [];
while ($row = $result->fetch_assoc()) {
    $testimonials[] = $row;
}

// Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $community_id = $_POST["community_id"];
    $story_text = $_POST["story_text"];
    $category = $_POST["category"];
    $video_url = "";

    // Video Upload if applicable
    if (!empty($_FILES['video']['name'])) {
        $target_dir = "uploads/videos/";
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
            $video_url = $target_file;
        }
    }

    // Put Testimonial into Database
    $query = "INSERT INTO testimonials (user_id, community_id, story_text, video_url, category, status) 
              VALUES (?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisss", $user_id, $community_id, $story_text, $video_url, $category);

    if ($stmt->execute()) {
        echo "<script>alert('Story submitted! Awaiting admin approval.'); window.location.href='success_stories.php';</script>";
    } else {
        echo "<script>alert('Submission failed. Try again.'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Stories</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="nav">
        <h3><a href="index.php">Home</a></h3>
        <?php include 'includes/nav.php'; ?>
    </div>

    <header>
        <h1>Success Stories</h1>
    </header>

    <!-- Submit a Story -->
    <div class="form">
        <h2>Share Your Story</h2>
        <form action="success_stories.php" method="POST" enctype="multipart/form-data">
            <label>Full Name:</label>
            <input type="text" name="user_name" required><br>

            <label>Community:</label>
            <select name="community_id">
                <option value="1">Community 1</option>
                <option value="2">Community 2</option>
                <option value="3">Community 3</option>
            </select><br>

            <label>Category:</label>
            <select name="category">
                <option value="Education">Education</option>
                <option value="Economic">Economic</option>
                <option value="Health">Health</option>
                <option value="Other">Other</option>
            </select><br>

            <label>Write Your Story:</label>
            <textarea name="story_text" placeholder="Describe your experience..." required></textarea><br>

            <label>Upload Video Testimonial (Optional):</label>
            <input type="file" name="video" accept="video/*"><br>

            <button type="submit">Submit Story</button>
        </form>
    </div>

    <hr>

    <!-- Display Approved Stories -->
    <div class="testimonials">
        <h2>Read Success Stories</h2>
        <?php foreach ($testimonials as $t) { ?>
            <div class="testimonial">
                <h3><?php echo $t['full_name']; ?> (<?php echo $t['comm_name']; ?>)</h3>
                <p><?php echo $t['story_text']; ?></p>
                <?php if ($t['video_url']) { ?>
                    <video width="300" controls>
                        <source src="<?php echo $t['video_url']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php } ?>
                <p class="category">Category: <?php echo $t['category']; ?></p>
            </div>
        <?php } ?>
    </div>
</body>
</html>

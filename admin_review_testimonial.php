<?php
require 'db.php';

$query = "SELECT * FROM testimonials WHERE status = 'pending'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Review Testimonials</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="nav">
        <h3><a href="index.php">Home</a></h3>
        <?php include 'includes/nav.php'; ?>
    </div>

    <header>
        <h1>Pending Testimonials</h1>
    </header>

    <div class="testimonials">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="testimonial">
                <h3><?php echo $row['user_name']; ?></h3>
                <p><?php echo $row['story_text']; ?></p>
                <?php if ($row['video_url']) { ?>
                    <video width="300" controls>
                        <source src="<?php echo $row['video_url']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php } ?>
                <form action="approve_testimonial.php" method="POST">
                    <input type="hidden" name="testimonial_id" value="<?php echo $row['testimonial_id']; ?>">
                    <button type="submit" name="approve">Approve</button>
                    <button type="submit" name="reject">Reject</button>
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>


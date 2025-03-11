<?php
include 'includes/db.php';
$query = "SELECT * FROM testimonials WHERE status = 'pending'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Review</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <header><h1>Pending Testimonials</h1></header>

    <div class="testimonials">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="testimonial">
                <h3><?= htmlspecialchars($row['user_id']) ?></h3>
                <p><?= htmlspecialchars($row['story_text']) ?></p>
                <form action="approve_testimonial.php" method="POST">
                    <input type="hidden" name="testimonial_id" value="<?= $row['testimonial_id'] ?>">
                    <button type="submit" name="approve">Approve</button>
                    <button type="submit" name="reject">Reject</button>
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>

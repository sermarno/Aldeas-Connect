<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $community_id = $_POST["community_id"];
    $story_text = $_POST["story_text"];
    $category = $_POST["category"];
    $video_url = "";

    // Video Upload
    if (!empty($_FILES['video']['name'])) {
        $target_dir = "uploads/videos/";
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
            $video_url = $target_file;
        }
    }

    // Testimonial
    session_start();
    $user_id = $_SESSION['user_id'] ?? 1;
    $stmt = $conn->prepare("INSERT INTO testimonials (user_id, community_id, story_text, video_url, category, status) 
                            VALUES (?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iisss", $user_id, $community_id, $story_text, $video_url, $category);

    if ($stmt->execute()) {
        echo "<script>alert('Story submitted! Awaiting admin approval.'); window.location.href='success_stories.php';</script>";
    } else {
        echo "<script>alert('Submission failed. Try again.'); window.history.back();</script>";
    }
}
?>

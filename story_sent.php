<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the session is only started if not active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("Error: User is not logged in.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $community_id = $_POST["community_id"];
    $story_text = $_POST["story_text"];
    $category = $_POST["category"];
    $video_url = "";

    // Video Upload
    if (!empty($_FILES['video']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        
        // Ensure upload directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
            $video_url = $target_file;
        }
    }
    // Testimonial
    session_start();
    $user_id = $_SESSION['user_id'] ?? 1;
    $stmt = $conn->prepare("INSERT INTO testimonials (user_id, community_id, story_text, video_url, category, status) 
                            VALUES (?, ?, ?, ?, ?, 'pending')");
    // Fix the SQL query to correctly match bind_param()
    $stmt = $conn->prepare("INSERT INTO testimonials (user_id, community_id, story_text, video_url, category, status) 
                            VALUES (?, ?, ?, ?, ?, 'pending')");
    
    $stmt->bind_param("iisss", $user_id, $community_id, $story_text, $video_url, $category);
    // Fix the SQL query to correctly match bind_param()
    session_start();
    $user_id = $_SESSION['user_id'] ?? 1;
    $stmt = $conn->prepare("INSERT INTO testimonials (user_id, user_id, community_id, story_text, video_url, category, status) 
                            VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    
    $stmt->bind_param("iisss", $user_id, $user_id, $community_id, $story_text, $video_url, $category);

    if ($stmt->execute()) {
        echo "<script>alert('Story submitted! Awaiting admin approval.'); window.location.href='success_stories.php';</script>";
    } else {
        echo "<script>alert('Submission failed. Try again.'); window.history.back();</script>";
    }
}
?>

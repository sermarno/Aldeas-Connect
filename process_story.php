<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["testimonial_id"], $_POST["status"])) {
    $testimonial_id = $_POST["testimonial_id"];
    $status = $_POST["status"];
    $admin_comments = isset($_POST["admin_comments"]) ? $conn->real_escape_string($_POST["admin_comments"]) : "";

    $stmt = $conn->prepare("UPDATE testimonials SET status = ?, admin_comments = ? WHERE testimonial_id = ?");
    $stmt->bind_param("ssi", $status, $admin_comments, $testimonial_id);

    if ($stmt->execute()) {
        echo "Testimonial has been $status.";
    } else {
        echo "Error updating testimonial.";
    }
}

$conn->close();
?>

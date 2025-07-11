<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['recipient_id']) || empty($_POST['recipient_id'])) {
        die("Error: Please select a recipient.");
    }

    if (!isset($_POST['message']) || empty($_POST['message'])) {
        die("Error: Message cannot be empty.");
    }

    $sender_id = $_SESSION['user_id'];
    $recipient_id = $_POST['recipient_id'];
    $message = $_POST['message'];

    $query = "INSERT INTO messages (sender_id, recipient_id, message, sent_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $sender_id, $recipient_id, $message);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message.";
    }

    $stmt->close();
    $conn->close();
}
?>

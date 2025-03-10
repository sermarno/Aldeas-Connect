<?php
session_start();
include('includes/db.php'); 

$sender_id = $_SESSION['user_id'];
$recipient_id = $_GET['recipient_id'];

$query = "SELECT m.message_id, m.message, m.sent_at, u.fname, u.lname 
          FROM messages m
          JOIN users u ON m.sender_id = u.user_id
          WHERE (m.sender_id = ? AND m.recipient_id = ?) OR (m.sender_id = ? AND m.recipient_id = ?)
          ORDER BY m.sent_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param('iiii', $sender_id, $recipient_id, $recipient_id, $sender_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo '<div class="message">';
    echo '<strong>' . htmlspecialchars($row['fname']) . ' ' . htmlspecialchars($row['lname']) . ':</strong>';
    echo '<p>' . htmlspecialchars($row['message']) . '</p>';
    echo '<small>' . htmlspecialchars($row['sent_at']) . '</small>';
    echo '</div>';
}

$stmt->close();
$conn->close();
?>

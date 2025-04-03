<?php
session_start();
include('includes/db.php'); 

$sender_id = $_SESSION['user_id'];
$recipient_id = $_GET['recipient_id'];

$query = "SELECT m.message_id, m.message, m.sent_at, u.fname, u.lname 
          FROM messages m
          JOIN users u ON m.sender_id = u.user_id
          WHERE (m.sender_id = ? AND m.recipient_id = ?) OR (m.sender_id = ? AND m.recipient_id = ?)
          ORDER BY m.sent_at ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param('iiii', $sender_id, $recipient_id, $recipient_id, $sender_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $isSender = ($row['sender_id'] == $sender_id);
    $class = $isSender ? "sent-message" : "received-message";
    
    echo '<div class="message ' . $class . '">';
    echo '<strong>' . ($isSender ? "You" : htmlspecialchars($row['fname'] . ' ' . $row['lname'])) . ':</strong>';
    echo '<p>' . htmlspecialchars($row['message']) . '</p>';
    echo '<small>' . htmlspecialchars($row['sent_at']) . '</small>';
    echo '</div>';
}


$stmt->close();
$conn->close();
?>

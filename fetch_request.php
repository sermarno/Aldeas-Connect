<?php
include "includes/db.php";
$request_id = $_POST['request_id'];
$sql = "SELECT * FROM project_requests WHERE request_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $request_id);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
$conn->close();
?>

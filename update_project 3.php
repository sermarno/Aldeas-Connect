<?php
session_start();
include "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['project_id'])) {
    $project_id = $conn->real_escape_string($_POST['project_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $proj_description = $conn->real_escape_string($_POST['proj_description']);
    $proj_start = $conn->real_escape_string($_POST['proj_start']);
    $proj_end = $conn->real_escape_string($_POST['proj_end']);

    $sql = "UPDATE projects SET title = ?, proj_description = ?, proj_start = ?, proj_end = ? WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $proj_description, $proj_start, $proj_end, $project_id);

    if ($stmt->execute()) {
        echo "Project updated successfully! <a href='index.php'>Go back</a>";
    } else {
        echo "Error updating project: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
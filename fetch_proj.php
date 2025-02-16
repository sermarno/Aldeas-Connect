<?php
include "includes/db.php";
if (isset($_POST['community_id'])) {
    $community_id = intval($_POST['community_id']);
    $proj_sql = "SELECT project_id, title FROM projects WHERE community_id = ?";
    $stmt = $conn->prepare($proj_sql);
    $stmt->bind_param("i", $community_id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo '<option value="">Select the project you want to edit</option>';
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['project_id'] . "'>" . htmlspecialchars($row['title']) . "</option>";
    }
    $stmt->close();
}
$conn->close();
?>
<?php
session_start();
include "includes/db.php"; // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $request_id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
    $action = isset($_POST["action"]) ? $_POST["action"] : "";
    $comment = isset($_POST["comment"]) ? trim($_POST["comment"]) : "";

    if ($request_id > 0 && ($action === "approve" || $action === "deny")) {
        if ($action === "approve") {
            // Move project request to Projects table and delete from Requests
            $sql = "INSERT INTO projects (title, proj_description, proj_start, proj_end)
                    SELECT title, proj_description, proj_start, proj_end FROM project_requests WHERE request_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $request_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Delete from requests table after inserting
                $delete_sql = "DELETE FROM project_requests WHERE request_id = ?";
                $delete_stmt = $conn->prepare($delete_sql);
                $delete_stmt->bind_param("i", $request_id);
                $delete_stmt->execute();
                $delete_stmt->close();

                echo "Project approved and moved to Projects";
            } else {
                echo "Error: Could not approve project";
            }
            $stmt->close();
        } elseif ($action === "deny") {
            // Update status and add admin comment
            $sql = "UPDATE project_requests SET request_status = 'Denied', admin_comment = ? WHERE request_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $comment, $request_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Project request denied";
            } else {
                echo "Error: Could not deny project";
            }
            $stmt->close();
        }
    } else {
        echo "Invalid request";
    }
}

$conn->close();
?>

<?php
include "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = intval($_POST['project_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['proj_description']);
    $image = mysqli_real_escape_string($conn, $_POST['proj_image']);

    $sql = "UPDATE projects 
            SET title = '$title', proj_description = '$description', proj_image = '$image'
            WHERE project_id = $project_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: investor.php?updated=1"); // change to your page
        exit();
    } else {
        echo "Error updating project: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

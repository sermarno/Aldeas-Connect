<?php
// Include database connection
include('db.php');

// Get the project ID from the query string
$project_id = $_GET['project_id'];

// Fetch the project data
$query = "SELECT * FROM project_highlights WHERE project_id = $project_id";
$result = mysqli_query($connection, $query);
$project = mysqli_fetch_assoc($result);

// Fetch the associated community data
$community_id = $project['community_id'];
$community_query = "SELECT * FROM communities WHERE community_id = $community_id";
$community_result = mysqli_query($connection, $community_query);
$community = mysqli_fetch_assoc($community_result);

// Prepare the response
$response = [
    'project' => $project,
    'community' => $community
];

// Send the response as JSON
echo json_encode($response);
?>

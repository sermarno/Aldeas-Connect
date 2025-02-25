<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();
require 'includes/db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];

    // Check if email already exists (extra safety)
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "This email is already registered.";
        exit();
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (fname, lname, username, email, user_role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fname, $lname, $username, $email, $user_role);
    $stmt->execute();

    // Start session and redirect to home page
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['user_role'] = $user_role;

    header("Location: index.php");
    exit();
}
?>

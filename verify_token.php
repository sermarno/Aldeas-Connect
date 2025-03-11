<?php
require 'vendor/autoload.php';
require 'includes/db.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

use Google\Client;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];

    $client = new Google_Client(['client_id' => '425696034712-7ns8jm05qgakn29cmkfvmaffv6bpnvp9.apps.googleusercontent.com']);
    $payload = $client->verifyIdToken($token);

    if ($payload) {
        $google_id = $payload['sub']; // Google user ID
        $email = $payload['email']; // Email from Google

        // Check if the user already exists
        $stmt = $conn->prepare("SELECT user_id, username, user_role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // User exists, log them in
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['user_role'];

            echo json_encode(['success' => true, 'redirect' => 'index.php']);
        } else {
            // User does not exist, redirect to registration form
            session_start();
            $_SESSION['google_email'] = $email;

            echo json_encode(['success' => true, 'redirect' => 'register.php']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid token']);
    }
}
?>

<?php
require 'vendor/autoload.php'; // If using Composer for Google's client library

use Google\Client;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];

    $client = new Google_Client(['client_id' => '425696034712-7ns8jm05qgakn29cmkfvmaffv6bpnvp9.apps.googleusercontent.com']);
    $payload = $client->verifyIdToken($token);

    if ($payload) {
        echo json_encode(['success' => true, 'user' => $payload]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid token']);
    }
}
?>

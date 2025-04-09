<?php
session_start();
if (!isset($_SESSION['google_email'])) {
    header("Location: login.php?login=success");
    exit();
}

$email = $_SESSION['google_email'];

require 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Registration</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
</head>
<body id="register">
    <div class="register_form">
        <h1>Complete Registration</h1>
        <p class="italic">You don't have an account yet. Enter your details below to sign up!</p>
        <form action="register_process.php" method="POST">
        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="fname" placeholder="First Name" required><br><br>

        <label for="lname">Last Name: </label>
        <input type="text" id="lname" name="lname" placeholder="Last Name" required><br><br>

        <label for="username">Create a Username:</label>
        <input type="text" id="username" name="username" placeholder="Username"required><br><br>

        <label for="email">Confirm email</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['google_email'] ?? ''); ?>"required>
        <br><br>

        <label for="user_role">Select Role:</label>
        <select id="user_role" name="user_role" required>
            <option value="resident">Resident</option>
            <option value="admin">Admin</option>
            <option value="visitor">Visitor</option>
        </select>
        <br><br>
        <button class='button' type="submit">Complete Registration</button>
    </form>
    </div>
</body>
</html>

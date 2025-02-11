<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
    <!-- Nav Bar -->
    <div class="nav">
            <h3><a href="index.php">Home</a></h3>
            <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>Login</h1>
    </header>
    Login API
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="js/google-login.js" defer></script> -->
    <div id="g_id_onload"
        data-client_id="425696034712-7ns8jm05qgakn29cmkfvmaffv6bpnvp9.apps.googleusercontent.com"
        data-context="signin"
        data-ux_mode="popup"
        data-callback="handleCredentialResponse"
        data-auto_prompt="false">
    </div>

    <div class="g_id_signin" data-type="standard"></div>
</body>
</html>
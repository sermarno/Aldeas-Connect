<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Linking CSS Stylesheet -->
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
    <!-- Loading Google's library -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- Translate API -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }       
    </script>
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        function translatePage() {
            var translateElement = document.getElementById('google_translate_element');
            translateElement.style.display = 'block';
            var select = translateElement.querySelector('select');
            select.value = 'es';
            select.dispatchEvent(new Event('change'));
        }
    </script>
</head>
<body id="login">
    <div class="google_login">
        <h1>Login with Google</h1>
        <p class="italic-login">If you don't have an account, you will be redirected to register.</p>
        <div id="g_id_onload"
            data-client_id="425696034712-7ns8jm05qgakn29cmkfvmaffv6bpnvp9.apps.googleusercontent.com"
            data-context="signin"
            data-ux_mode="popup"
            data-callback="handleCredentialResponse"
            data-auto_prompt="false">
        </div>

        <div class="g_id_signin" 
            data-type="standard" 
            data-size="large" 
            data-theme="outline" 
            data-shape="rectangular"></div>
    </div>
    <div class="translate-container">
        <div id="google_translate_element" class="translate-box"></div>
        <img src="img/translate_icon.png" alt="Translate" class="translate-icon">
    </div>
    <script src="js/google-login.js"></script>
</body>
</html>
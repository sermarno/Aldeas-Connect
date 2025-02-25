<nav>
    <ul>
        <li class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="home">
            </a>
        </li>
        <li>
            <button onclick="translatePage()">Translate to Spanish</button>
            <div id="google_translate_element" style="display:none;"></div>
        </li>
        <li class="login">
            <a href="login.php">
                <img src="img/account.png" alt="account"></img>
            </a>
        </li>
        <li><?php include "includes/side_nav.php" ?></li>
    </ul>
</nav>
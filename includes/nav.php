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
        <li class="account-dropdown">
            <a href="javascript:void(0)">
                <img src="img/account.png" alt="account"></img>
            </a>
            <div class="dropdown-content">
                <?php
                session_start();
                if (isset($_SESSION['user_role'])) {
                    echo '<a href="account.php">Account Details</a>';
                    echo '<a href="logout.php">Logout</a>';
                } else {
                    echo '<a href="login.php">Login</a>';
                }
                ?>
            </div>
        </li>
        <li><?php include "includes/side_nav.php" ?></li>
    </ul>
</nav>
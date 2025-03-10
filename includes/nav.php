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

        <?php 
        session_start();

        // Only show request icon if user is logged in AND role is 'resident' or 'admin'
        if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'resident' || $_SESSION['user_role'] === 'admin')) {
            echo '<li class="account-dropdown">
                    <a href="requests.php">
                        <img class="request_icon" src="img/request_icon.png" alt="request">
                    </a>
                    <div class="dropdown-content">
                        <a href="requests.php">Requests</a>
                    </div>
                  </li>';
        }
        ?>

        <li class="account-dropdown">
            <a href="javascript:void(0)">
                <img class='account-icon' src="img/account.png" alt="account">
            </a>
            <div class="dropdown-content">
                <?php
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

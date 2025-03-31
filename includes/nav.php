<nav>
    <ul>
        <li>
            <a href="gallery.php">Gallery</a>
        </li>
        <li>
            <a href="investor.php">Projects</a>
        </li>
        <li class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="home">
            </a>
        </li>
        <li class="login">
            <?php if (isset($_SESSION['user_role'])): ?>
                <a href="account.php">Account</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </li>
        <li>
            <div class="openbtn">
                <span class="material-symbols-outlined menu-button" onclick="openNav()">menu</span>
            </div>
            <div class="all-over-bkg"></div>
        </li>
        <li><?php include "includes/side_nav.php" ?></li>
    </ul>
</nav>

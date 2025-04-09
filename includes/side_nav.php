<?php 
session_start();
?>

<nav id="side_nav" class="side_nav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <ul>
        <li><a href="success_stories.php">Success Stories</a></li>
        <li><a href="team.php">Meet the Team</a></li>
        <li><a href="project.php">Our Goal</a></li>
        <li><a href="about.php">About</a></li>

        <?php 
        // Only show request icon if user is logged in AND role is 'resident' or 'admin'
        if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'resident' || $_SESSION['user_role'] === 'admin')) {
            echo '<li>
                    <a href="requests.php">Requests</a>
                  </li>';
        }
        ?>
    </ul>
</nav>

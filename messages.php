<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Nav Bar -->
    <div class="nav">
        <a href="index.php">
            <img src="img/logo.jpg" alt="home">
        </a>
        <?php include 'includes/nav.php' ?>
    </div>
    <header>
        <h1>Messenger</h1>
    </header>
    <div>
    </div>

    <form action="send_message.php" method="POST">
        <input type="text" name="message_content" placeholder="Message..." required>
        <button type="submit">Send</button>
    </form>

<?php include 'includes/footer.php' ?>
    
</body>
</html>
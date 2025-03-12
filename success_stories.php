<?php
    include 'includes/db.php';
    $comm_sql = "SELECT * FROM communities";
    $comm_result = $conn->query($comm_sql);

    // Testimonials
    $query = "SELECT t.*, c.comm_name
    FROM testimonials t 
    JOIN communities c ON t.community_id = c.community_id
    WHERE t.status = 'approved' 
    ORDER BY t.created_at DESC";

    $result = $conn->query($query);
    $testimonials = [];
    while ($row = $result->fetch_assoc()) {
        $testimonials[] = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Stories</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .testimonials {
            width:100%;
            max-width: 1200px; 
            margin: 20px auto;
            justify-content: center;
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            text-align: center;
        }

        .testimonial {
            background:white;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            text-align: center;
            max-width: 500px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .testimonial:hover {
            transform: translateY(-5px);
        }

        .testimonial h3 {
            font-size: 18px;
            color: #444;
            margin-bottom: 10px;
        }

        .testimonial p {
            color: #666;
            font-size: 16px;
            line-height: 1.5;
        }

        .category {
            font-weight: bold;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .category[data-category="Education"] { background-color: #4CAF50; }
        .category[data-category="Economic"] { background-color: #2196F3; }
        .category[data-category="Health"] { background-color: #FF9800; }
        .category[data-category="Other"] { background-color: #9E9E9E; }

        video {
            width: 100%;
            max-height: 300px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .form {
            width: 60%;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        .form input, .form select, .form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form input[type="submit"] {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .form input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <?php include 'includes/side_nav.php'; ?>

    <hr>
    <header>
        <h1>Read Stories From the Villages</h1>
    </header>
    <div class="testimonials">
        <?php foreach ($testimonials as $t) { ?>
            <div class="testimonial">
                <h3><?= htmlspecialchars($t['comm_name']) ?></h3>
                <p><?= htmlspecialchars($t['story_text']) ?></p>
                <?php if (!empty($t['video_url'])) { ?>
                    <video width="300" controls>
                        <source src="<?= htmlspecialchars($t['video_url']) ?>" type="video/mp4">
                    </video>
                <?php } ?>
                <p class="category" data-category="<?= htmlspecialchars($t['category']) ?>">
                    <?= htmlspecialchars($t['category']) ?>
                </p>

            </div>
        <?php } ?>
    </div>
    <header><h2>Add Your Story</h2></header>

    <div class="form">
        <form action="/story_sent.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="request_id">
          

            <label>Your Story:</label>
            <textarea name="story_text" required rows="5"></textarea><br>

            <label>Category:</label>
            <select name="category" required>
                <option value="">Select a Category</option>
                <option value="Education">Education</option>
                <option value="Economic">Economic</option>
                <option value="Health">Health</option>
                <option value="Other">Other</option>
            </select><br>

            <label>Community:</label>
            <select name="community_id" required>
                <option value="">Select a community</option>
                <?php while ($row = $comm_result->fetch_assoc()) { ?>
                    <option value="<?= $row['community_id'] ?>"><?= htmlspecialchars($row['comm_name']) ?></option>
                <?php } ?>
            </select> <br>

            <label>Upload Video (Optional):</label>
            <input type="file" name="video" accept="video/*"><br>

            <input type="submit" value="Share Your Story">
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="js/nav.js"></script>
</body>
</html>

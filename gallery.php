<?php
$categories = [
    'agricultural products' => ['smartvillages2.jpg', 'smartvillagessauce.jpg', 'smartvillagessauces.jpg'],
    'Female Empowerment' => ['female-empowerment2.jpg', 'female-empowerment3.jpg', 'female-empowerment.jpg'],
    'education' => ['education3.jpg', 'education2.jpg', 'education1.jpg'],
    'Handmade Art' => ['artwork1.jpg', 'artwork2.jpg', 'artwork3.jpg'],
    'health' => ['health1.jpg', 'health2.jpg', 'health3.jpg'],
];


// Store uploaded images separately (can also be stored in a DB)
$uploadedImages = [];
foreach (array_keys($categories) as $key) {
    $uploadedImages[$key] = [];
}


// Handle Upload
if (isset($_POST['upload_image']) && isset($_POST['category'])) {
    $category = $_POST['category'];
    $targetDir = "img/";
    $filename = basename($_FILES["new_image"]["name"]);
    $targetFile = $targetDir . $filename;


    if (getimagesize($_FILES["new_image"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $targetFile)) {
            $uploadedImages[$category][] = $filename;
        } else {
            echo "Upload failed.";
        }
    } else {
        echo "File is not an image.";
    }
}


// Handle Delete
if (isset($_POST['delete_image'])) {
    $imagePath = $_POST['image_to_delete'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Village Gallery</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>


<?php include 'includes/nav.php' ?>
<?php include 'includes/side_nav.php' ?>


<header>
    <h1>Village Gallery</h1>
</header>


<?php
function renderGallerySection($title, $categoryKey, $staticImages, $uploadedImages) {
    echo "<div class='gallery-section'>";
    echo "<h2>$title</h2><div class='gallery'>";


    // Merge static and uploaded, remove duplicates
    $allImages = array_unique(array_merge($staticImages, $uploadedImages));


    foreach ($allImages as $img) {
        $path = "img/$img";
        if (file_exists($path)) {
            echo "<div class='gallery-item'>";
            echo "<img src='$path' alt='$img'>";
            echo "<form method='POST' style='display:inline;'>";
            echo "<input type='hidden' name='image_to_delete' value='$path'>";
            echo "<button type='submit' name='delete_image'>Delete</button>";
            echo "</form>";
            echo "</div>";
        }
    }
    echo "</div>";


    // Upload form for this section
    echo "<form method='POST' enctype='multipart/form-data'>";
    echo "<input type='file' name='new_image' accept='image/*' required>";
    echo "<input type='hidden' name='category' value='$categoryKey'>";
    echo "<button type='submit' name='upload_image'>Upload New Image</button>";
    echo "</form>";


    echo "</div><br><br>";
}


// Render each section
foreach ($categories as $key => $images) {
    renderGallerySection(ucwords(str_replace('_', ' ', $key)), $key, $images, $uploadedImages[$key]);
}
?>


<a class="button" href="investor.php">See Ongoing Projects</a>


<?php include 'includes/footer.php' ?>
<script src="js/nav.js"></script>
<script src="js/gallery.js"></script>
</body>
</html>


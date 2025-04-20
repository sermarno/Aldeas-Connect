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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Village Gallery</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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

<div class="translate-container">
    <div id="google_translate_element" class="translate-box"></div>
    <img src="img/translate_icon.png" alt="Translate" class="translate-icon">
</div>
<?php include 'includes/footer.php' ?>
<script src="js/nav.js"></script>
<script src="js/gallery.js"></script>
</body>
</html>


<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <title>Camera Collection App</title>
    <link rel="stylesheet" href="collectionApp.css">
</head>
<body>
<h1>Camera Collection App</h1>
<div class="mainContainer">
    <?php
    require_once 'dbCameras.php';
    global $db;
    $query = $db->prepare("SELECT `brandName`, `model`, `type`, `megapixels`, `weight(g)`, `images` FROM `cameras`");
    $query->execute();
    $results = $query->fetchAll();

    foreach ($results as $result) {
        echo '<div class="imageAndTextContainer">';
        echo '<div class = "imageContainer">';
        echo '<img class="imagesClass" src="' . $result['images'] . '" alt="camera">';
        echo '</div>';
        echo '<div class = "textContainer">';
        echo '<p>' . $result['brandName'] . '</p>';
        echo '<p>' . $result['model'] . '</p>';
        echo '<p>' . $result['type'] . '</p>';
        echo '<p>' . $result['megapixels'] . ' megapixels'.'</p>';
        echo '<p>' . $result['weight(g)'] . 'g'.' </p>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
</body>

</html>
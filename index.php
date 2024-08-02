<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <title>Camera Collection App</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Shrikhand&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="collectionApp.css">
</head>
<body>
<div id="div_id"></div>
<h1>My Camera Collection</h1>
<div class="mainContainer">
    <?php
    require_once 'dbCameras.php';
    global $db;
    $brandName = $model = $type = $megapixels = $weight = $images = '';
    if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
        $brandName = test_input($_POST['brandName']);
        $model = test_input($_POST['model']);
        $type = test_input($_POST['type']);
        $megapixels = isset($_POST['megapixels']) ? test_input($_POST['megapixels']) : null;
        $weight = test_input($_POST['weight(g)']);
        $images = test_input($_POST['images']);
        $query = $db->prepare("INSERT INTO cameras (`brandName`, `model`, `type`, `megapixels`, `weight(g)`, `images`) VALUES (:brandName, :model, :type, :megapixels, :weight, :images)");
        $query->bindParam(':brandName', $brandName);
        $query->bindParam(':model', $model);
        $query->bindParam(':type', $type);
        $query->bindParam(':megapixels', $megapixels);
        $query->bindParam(':weight', $weight);
        $query->bindParam(':images', $images);
        $query->execute();
    }
    function test_input($data)
    {
        if ($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        else
        {
            return null;
        }
    }
    $query = $db->prepare("SELECT `brandName`, `model`, `type`, `megapixels`, `weight(g)`, `images` FROM `cameras`");
    $query->execute();
    $results = $query->fetchAll();
    foreach ($results as $result) {
            if ($results) {
                echo '<div class="imageAndTextContainer">';
                echo '<div class = "imageContainer">';
                echo '<img class="imagesClass" src="' . $result['images'] . '" alt="image of a camera">';
                echo '<br><br>';
                echo '</div>';
                echo '<div class = "textContainer">';
                echo '<p>Brand Name: ' . $result['brandName'] . '</p>';
                echo '<p>Model: ' . $result['model'] . '</p>';
                echo '<p>Type: ' . $result['type'] . '</p>';
                echo '<p>Megapixels: ' . $result['megapixels'] . " MP </p>";
                echo '<p>Weight(g): ' . $result['weight(g)'] . "g</p>";
                echo '</div>';
                echo '</div>';
            }
            else
            {
                return null;
            }
    }
    ?>
</div>
<div class="anchorLink">
<a href="#div_id"><i class='bx bxs-chevrons-up'></i></a>
</div>
<div class="formSection">
<h2>Add to the collection: </h2>
<div class="formContainer">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <p>Brand Name*: <input required type="text" name="brandName"></p>
        <p>Model*: <input required type="text" name="model"></p>
        <p>Type*: <input reuired type="text" name="type"></p>
        <p>Megapixels: <input type="text" name="megapixels"></p>
        <p>Weight(g)*: <input required type="text" name="weight(g)"></p>
        <p>Image*: <input required type="text" name="images"></p>
        <input type="submit" class="button">
    </form>
</div>
</div>
</body>
</html>
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
        echo '<div class="imageAndTextContainer">';
        echo '<div class = "imageContainer">';
        echo '<img class="imagesClass" src="' . $result['images'] . '" alt="image of a camera">';
        echo '<br><br>';
        echo '</div>';

        echo '<div class = "textContainer">';
        echo $result['brandName'] . " <br>" . $result['model'] . " <br>" . $result['type'] . " <br>" .
            $result['megapixels'] . " megapixels<br>" . $result['weight(g)'] . "g<br><br>";
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
<div class="formContainer">
    <h2>Add to the collection: </h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        Brand Name: <input required type="text" name="brandName"><br>
        Model: <input required type="text" name="model"><br>
        Type: <input reuired type="text" name="type"><br>
        Megapixels: <input type="text" name="megapixels"><br>
        Weight(g): <input required type="text" name="weight(g)"><br>
        Image: <input required type="text" name="images"><br><br>
        <input type="submit">
    </form>
</div>

</body>

</html>
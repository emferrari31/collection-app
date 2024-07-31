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

<div>
    <?php
    $brandName = $model = $type = $megapixels = $weight = $images = '';

    if ($_SERVER ['REQUEST_METHOD'] == 'POST')
    {
        $brandName = test_input($_POST['brandName']);
        $model = test_input($_POST['model']);
        $type = test_input ($_POST['type']);
        $megapixels = test_input ($_POST['megapixels']);
        $weight = test_input ($_POST['weight(g)']);
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <h2>Add to the collection: </h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        Brand Name: <input type="text" name="brandName"><br>
        Model: <input type="text" name="model"><br>
        Type: <input type="text" name="type"><br>
        Megapixels: <input type="text" name="megapixels"><br>
        Weight(g): <input type="text" name="weight(g)"><br>
        <input type="submit">
    </form>

    <?php
    echo $brandName;
    echo '<br>';
    echo $model;
    echo '<br>';
    echo $type;
    echo '<br>';
    echo $megapixels;
    echo '<br>';
    echo $weight;
    ?>


</div>
</body>

</html>
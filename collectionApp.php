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
$db = new PDO('mysql:host=db; dbname=cameras', 'root', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT `brandName`, `model`, `type`, `megapixels`, `weight(g)`, `images` FROM `cameras`");
$query->execute();
$results = $query->fetchAll();


foreach ($results as $result)
{
    echo '<div class="imageAndTextContainer">';
    echo '<div class = "imageContainer">';
    echo '<img class="imagesClass" src="' . $result['images'] . '" alt="camera">';
    echo '<br><br>';
    echo '</div>';

    echo '<div class = "textContainer">';
    echo $result['brandName'] ." <br>" . $result['model'] . " <br>" . $result['type'] . " <br>" .
                    $result['megapixels'] . " megapixels<br>" . $result['weight(g)'] . "g<br><br>";
    echo '</div>';
    echo '</div>';
}
?>
</div>
</body>

<footer>

</footer>
</html>
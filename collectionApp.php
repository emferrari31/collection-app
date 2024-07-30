<?php


$db = new PDO('mysql:host=db; dbname=cameras', 'root', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT `brandName`, `model`, `type`, `megapixels`, `weight(g)` FROM `cameras`");
$query->execute();


$results = $query->fetchAll();

var_dump($results);

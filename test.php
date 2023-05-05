<?php 
$path = './data.json';


$id = "16";
$name = "Alger";
$lat = "36.04";
$lng = "2.06";


$jsonData = [
    [
        "id" => "287947",
        "name" => $name,
        "lat" => $lat,
        "lng" => $lng
    ],
];


$jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
// Write in the file
$fp = fopen($path, 'w');
fwrite($fp, $jsonString);
fclose($fp);
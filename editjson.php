<?php

$path = './data-new.json';

$json_array = [];
//$jsonData = [];
foreach($_POST['order'] as $key => $value) {
 
    if ( isset($_POST['status'][$key]) ) { $status = '1'; } 
    else { $status='0'; }
    //echo $value.$_POST['adresse'][$key].'</br>';

    $json_array[]  = [ 
        "order" => $value,
        "willaya" => $_POST['willaya'][$key],
        "ville" => $_POST['ville'][$key],
        "adresse" => $_POST['adresse'][$key],
        "tel" => $_POST['tel'][$key],
        "lat" => $_POST['lat'][$key],
        "lng" => $_POST['lng'][$key],
        "client" => $_POST['client'][$key],
        "image" => $_POST['image'][$key],
        "status" => $status
    ];

    //$value_json = json_decode($key, true);
    //$json_array[] = $value_json;
   
}

$json_response = json_encode($json_array, JSON_PRETTY_PRINT);

$fp = fopen($path, 'w');
fwrite($fp, $json_response);
fclose($fp);

header('Content-Type: application/json');

echo $json_response;

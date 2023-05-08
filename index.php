<?php

$path = 'data-new.json';
$json_string = file_get_contents($path);
$parsed_json = json_decode($json_string, true);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="./stylemaps.css" />  
<script type="module" src="./index.js"></script>




<div id="" class="villecontrol">
  <div class="container">
    <div class="selectville">
      <select id="selectmarker" class="selectvillwillaya">
      <option value="0" datazoom="8" datalat="36.291715" datalng="2.8331188">TOUT</option>
      <?php
        usort($parsed_json, function($a, $b) {
          return strcmp($a['willaya'], $b['willaya']);
        });
        
        foreach ($parsed_json as $data) :
          if ($data['status'] == '1') :
      ?>
        <option value="<?=$data['order'] ?>" datazoom="14" datalat="<?=$data['lat'] ?>" datalng="<?=$data['lng'] ?>"><?=$data['willaya']." - ".$data['ville']?></option>
      <?php
          endif;
        endforeach;
      ?>
      </select>
    </div>
    <div class="checkpro"><button id="proselect" class="selectbutton proselect" data-toggle="tooltip" title="Professionnels"></button></div>
    <div class="checkpart"><button id="partselect" class="selectbutton partselect" data-toggle="tooltip" title="Particuliers"></button></div>
  </div>  
</div>
<div id="infosbulldiv" class=""></div>
<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4fQVeNWjwH32aLmdJ3QT1sXXVbCdgapk&callback=initMap&v=weekly" defer></script>
<script type="module">
  import data from './data-new.json'  assert { type: 'json' };
  let partclients = [];
  let proclients = [];
  for (let i = 0; i < data.length; i++) {
    if (data[i].client == "Particuliers" && data[i].status == "1") { 
      partclients.push( [data[i].willaya, parseFloat(data[i].lat), parseFloat(data[i].lng), data[i].ville, parseFloat(data[i].order)] );    
    }
    if (data[i].client == "Professionnels" && data[i].status == "1") { 
      proclients.push( [data[i].willaya, parseFloat(data[i].lat), parseFloat(data[i].lng), data[i].ville, parseFloat(data[i].order)] );
    }    
  }
  let SelectListVilles = $("select#selectmarker");
  $('button#proselect').on('click', function(e){
   // console.log('pro');
    SelectListVilles.empty();
    SelectListVilles.append('<option value="0" datazoom="8" datalat="36.291715" datalng="2.8331188">TOUT</option>');
    for (let i = 0; i < proclients.length; i++) {
      const ClientPro = proclients[i];
      SelectListVilles.append('<option value="'+ClientPro[4]+'" datazoom="14" datalat="'+ClientPro[1]+'" datalng="'+ClientPro[2]+'" >'+ClientPro[0]+' - '+ClientPro[3]+'</option>');
    }
  });
  $('button#partselect').on('click', function(e){
   // console.log('pro');
    SelectListVilles.empty();
    SelectListVilles.append('<option value="0" datazoom="8" datalat="36.291715" datalng="2.8331188">TOUT</option>');
    for (let i = 0; i < partclients.length; i++) {
      const ClientPar = partclients[i];
      SelectListVilles.append('<option value="'+ClientPar[4]+'" datazoom="14" datalat="'+ClientPar[1]+'" datalng="'+ClientPar[2]+'" >'+ClientPar[0]+' - '+ClientPar[3]+'</option>');
    }
  });
  


</script>
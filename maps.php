<?php
 get_header();
 ?>
<html>
  <head>
    <title>Marker Clustering</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <link rel="stylesheet" type="text/css" href="./stylemaps.css" />
    <script type="module" src="./index.js"></script>
  </head>
  <body>
    <div id="map"></div>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4fQVeNWjwH32aLmdJ3QT1sXXVbCdgapk&callback=initMap&v=weekly"
      defer
    ></script>
  </body>
</html>
<?php
 get_footer();
 ?>
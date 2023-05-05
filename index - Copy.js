
import data from './data-new.json' assert {type: 'json'};

let Marker;

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 8,
      center: { lat: 36.291715, lng: 2.8331188 },
    });
  
    setMarkers(map);
  }
  
  let beaches = [];
  for (let i = 0; i < data.length; i++) {
    beaches.push( [data[i].ville, parseFloat(data[i].lat), parseFloat(data[i].lng)], data[i].client );


    //beaches.push([data[i].ville, data[i].lat, data[i].lng]);

  }



  function setMarkers(map) {
    let imageUrl;
  
    for (let i = 0; i < data.length; i++) {
      if (data[i].client === 'Particuliers') {
      imageUrl = "Baies-marker.png";
    } else if (data[i].client === 'Professionnels'){
      imageUrl = "marker.png";
    }    
    
    
  }
    
      const image = {
        url: ""+imageUrl+"",

        size: new google.maps.Size(34, 51),

        origin: new google.maps.Point(0, 0),

        anchor: new google.maps.Point(17, 51),
      };
    const shape = {
      coords: [1, 1, 1, 51, 34, 51, 34, 1],
      type: "poly",
    };
  
    for (let i = 0; i < beaches.length; i++) {
      const beach = beaches[i];
  
      Marker = new google.maps.Marker({
        position: { lat: beach[1], lng: beach[2] },
        map,
        icon: image,
        shape: shape,
        title: beach[0],
        zIndex: beach[3],
      });
      Marker.addListener('click', function() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 14,
          center: { lat: beach[1], lng: beach[2]  },
        });
        setMarkers(map);
    
       });
    }
   
  }
  

  
//   function zoomin() {
//     google.maps.Marker.addEventListener(marker, 'click', (function() {
//       function zoom() {
//         const map = new google.maps.Map(document.getElementById("map"), {
//           zoom: 7,
//           center: { lat: 36.291715, lng: 2.8331188 },
//         });
//         setMarkers(map);

// }
// }));
//   }


     

 
  window.initMap = initMap;
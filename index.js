import data from './data-new.json' assert {type: 'json'};

let Marker;
let MarkerAll;
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 8,
      center: { lat: 36.291715, lng: 2.8331188 },
      mapTypeControl: false,
    });  
    setMarkerspart(map);
    setMarkerspro(map);
  
  }  
  let beaches = [];
  for (let i = 0; i < data.length; i++) {
    beaches.push( [data[i].ville, parseFloat(data[i].lat), parseFloat(data[i].lng), data[i].client] );    
  }
  
  
  let imagePro = [];
  let imagePart = [];
  for (let i = 0; i < data.length; i++) {
    if (data[i].client == "Particuliers" && data[i].status == "1") {
      imagePart.push( [data[i].client, parseFloat(data[i].lat), parseFloat(data[i].lng), data[i].willaya, parseFloat(data[i].order)] ); 
    }
    else if (data[i].client == "Professionnels" && data[i].status == "1") {
      imagePro.push( [data[i].client, parseFloat(data[i].lat), parseFloat(data[i].lng), data[i].willaya, parseFloat(data[i].order)] ); 
    }
  }   
  
  function setMarkerspart(map) {
    const image = {
      url: "Baies-marker.png",
      size: new google.maps.Size(34, 51),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 51),
    };
    const shape = {
      coords: [1, 1, 1, 51, 34, 51, 34, 1],
      type: "poly",
    };  
    for (let i = 0; i < imagePart.length; i++) {
      const imageP = imagePart[i];  
      Marker = new google.maps.Marker({
        position: { lat: imageP[1], lng: imageP[2] },
        map,
        icon: image,
        shape: shape,
        title: imageP[0],
        zIndex: imageP[4],
      });
      Marker.addListener('click', function() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 14,
          center: { lat: imageP[1], lng: imageP[2]  },
          mapTypeControl: false,
        });
        setMarkerspart(map);
        setMarkerspro(map);    
      });
      $("button#partselect").on('click', function() { 
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: { lat: 36.291715, lng: 2.8331188 },
          mapTypeControl: false,
        });
        $('#infosbulldiv').removeClass('displayedinfos');
        setMarkerspart(map);
      }); 
      $("select#selectmarker").on('change', function(){
        var lngval =  parseFloat(this.options[this.selectedIndex].getAttribute('datalng'));
        var latval =  parseFloat(this.options[this.selectedIndex].getAttribute('datalat'));
        var zomval =  parseFloat(this.options[this.selectedIndex].getAttribute('datazoom'));
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: zomval,
          center: { lat: latval, lng: lngval  },
          mapTypeControl: false,
        });
        $('#infosbulldiv').removeClass('displayedinfos');
        setMarkerspart(map);
        setMarkerspro(map);
      });     
    }   
  }
  
  function setMarkerspro(map) {
    const image = {
      url: "marker.png",
      size: new google.maps.Size(34, 51),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 51),
    };
    const shape = {
      coords: [1, 1, 1, 51, 34, 51, 34, 1],
      type: "poly",
    };  
    for (let i = 0; i < imagePro.length; i++) {
      const imagePr = imagePro[i];  
      MarkerAll = new google.maps.Marker({
        position: { lat: imagePr[1], lng: imagePr[2] },
        map,
        icon: image,
        shape: shape,
        title: imagePr[0],
        zIndex: imagePr[4],
      });
      MarkerAll.addListener('click', function() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 14,
          center: { lat: imagePr[1], lng: imagePr[2]  },
          mapTypeControl: false,
        });
        setMarkerspro(map); 
        setMarkerspart(map);
        function createinfosdiv(){
          $('#infosbulldiv').removeClass('displayedinfos').addClass('displayedinfos');
          //console.log(MarkerAll.offsetTop);
        } 
        return createinfosdiv();  
      });

      $("button#proselect").on('click', function() { 
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: { lat: 36.291715, lng: 2.8331188 },
          mapTypeControl: false,
        });
        $('#infosbulldiv').removeClass('displayedinfos');
        setMarkerspro(map);
      });
      $("select#selectmarker").on('change', function(){
        var lngval =  parseFloat(this.options[this.selectedIndex].getAttribute('datalng'));
        var latval =  parseFloat(this.options[this.selectedIndex].getAttribute('datalat'));
        var zomval =  parseFloat(this.options[this.selectedIndex].getAttribute('datazoom'));
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: zomval,
          center: { lat: latval, lng: lngval  },
          mapTypeControl: false,
        });
        $('#infosbulldiv').removeClass('displayedinfos');
        setMarkerspart(map);
        setMarkerspro(map);
      });  
    }   
  }
  window.initMap = initMap;
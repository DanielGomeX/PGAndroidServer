function moveMarker(markerAux, lat, lng){
        var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        markerAux.setPosition(latlng); 
      }
      function moveMap(mapAux, lat, lng){
        var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        mapAux.setCenter(latlng);
      }

      
      function searchAdress(address, callback){       
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': address }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {   
                retorno = {
                    lat:results[0].geometry.location.lat(),
                    lng:results[0].geometry.location.lng()
                };  
                callback(retorno);                                  
            }
        });        
      }
      
      function searchCoords(lat, lng, callback){  
        var geocoder = new google.maps.Geocoder();
        var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};        
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
              var qualidade = results[0].geometry.location_type;
              //if(qualidade == 'ROOFTOP'){                        
                var aux= {
                   rua: results[0].address_components[1].long_name,
                   numero:results[0].address_components[0].long_name,
                   bairro: results[0].address_components[2].long_name,
                   cidade: results[0].address_components[3].long_name,              
                   uf :results[0].address_components[5].short_name,
                };   
                callback(aux);        
              //}
              
              //+","+street_number+","+neighborhood+"," + postal_code+","+country +","+political
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });   
        
      }

      function createMarkerDragger(latitude, longitude, mapAux){
        var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
        markerAux = new google.maps.Marker({
          map: mapAux,
          draggable: true,
          animation: google.maps.Animation.BOUNCE,
          position: latlng
        });        
        return markerAux;
      }

      function initMap(latitude, longitude) {
        var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
        var mapAux = new google.maps.Map(document.getElementById('mapGoogle'), {
          zoom: 17,
          center: latlng
        });
        
        return mapAux;
      }   
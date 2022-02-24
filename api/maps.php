<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #target {
      width: 550px;
      height: 200px;
    }
  </style>
</head>
<body>
  <div id="target"></div>
  <input type="text" id="address">
  <input type="text" id="keyword">

  <button id="search">Search</button>
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=[APIKEY]&callback=initMap&libraries=places" async defer></script>
  <script>
    function initMap() {
      'use strict';

      var target = document.getElementById('target');
      // ジオコーディング
      var geocoder = new google.maps.Geocoder();

      document.getElementById('search').addEventListener('click', function() {
        geocoder.geocode({
          address: document.getElementById('address').value
        }, function(results, status) {
          if (status !== 'OK') {
            alert('Failed: ' + status);
            return;
          }
          // results[0].geometry.location
          if (results[0]) {
            new google.maps.Map(target, {
              center: results[0].geometry.location,
              zoom: 15
            });
          } else {
            alert('No results found');
            return;
          }
        });
      });

      var service;

      document.getElementById('search').addEventListener('click', function() {
        service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: tokyo,
          radius: '500',
          name: document.getElementById('keyword').value
        }, function(results, status) {
          var i;
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (i = 0; i < results.length; i++) {
              new google.maps.Marker({
                map: map,
                position: results[i].geometry.location,
                title: results[i].name
              });
            }
          } else {
            alert('Failed: ' + status);
            return;
          }
        });
      });




      var map;
      var tokyo = {lat: 35.681167, lng: 139.767052};

      map = new google.maps.Map(target, {
        center: tokyo,
        zoom: 15
      });

      map.addListener('click', function(e) {
        geocoder.geocode({
          location: e.latLng
        }, function(results, status) {
          if (status !== 'OK') {
            alert('Failed: ' + status);
            return;
          }
          // results[0].formatted_address
          if (results[0]) {
            new google.maps.Marker({
              position: e.latLng,
              map: map,
              title: results[0].formatted_address,
              animation: google.maps.Animation.DROP
            });
          } else {
            alert('No results found');
            return;
          }
        });
      });

    }
  </script>
  
</body>
</html>
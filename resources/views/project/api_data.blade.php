<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Restaurant Data</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Include the header -->
    @include('project.header')
    <br><br><br><br>

    <div class="container">
        <h3>Select the business you’d like to review</h3>
        <hr>
        <br>

        <div class="col-md-6">
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
            @endif
        </div>
        <div class="row">
                  
             <!-- Include Google Maps JavaScript API with your API key -->
           
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I&callback=initMap" async defer></script>
    <script>
       
    </script>

<script>
     function isMobileDevice() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

     var reviews = {!! $reviews->toJson() !!}; // Convert PHP array to JavaScript object
     var imageurl = "https://softitdevelopers.com/eggs/public/";
        function initMap() {
            // Initialize map
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 37.7749, lng: -122.4194}, // Default center if user's location cannot be determined
                zoom: 10
            });
           
    console.log(reviews);
    var infowindow = new google.maps.InfoWindow();
    var infoWindowHovered = false;
    reviews.forEach(function(location , index) {
      
        var marker = new google.maps.Marker({
            position: {lat: location.latitude, lng: location.longitude},
            label: (index + 1).toString(), 
            map: map,
            title: location.subject
        });

       
        marker.addListener('mouseover', function() {
            // infowindow.setContent('<h3 class="custom">' + location.subject + '</h3><p>' + location.review_points + '</p><Img src= https://softitdevelopers.com/eggs/public/'+ location.image+'><p>' + location.review_message + '</p>');
           infowindow.setContent(
            '<div  style="width: 200px; text-align: ;">' +
                '<img src="https://softitdevelopers.com/eggs/public/' +
                location.image +
                '" style="width: 100%; height: 100px; border-radius: 8px; margin-bottom: 12px; max-width: 200px;">' +
                '<h3 style="color: #333; font-size: 18px; margin-bottom: 8px;">' +
                '<b>'+location.subject+'</b>' +
                '</h3>' +
                '<p style="color: #666; margin-bottom: 12px;"><small><b>Review Points:- </b></small>' +
                location.review_points +'/10'+
                '</p>' +
                '<p style="color: #666; margin-bottom: 12px;">' +
                location.vicinity +
                '</p>' +
                
            '</div>'
            );
            infowindow.open(map, marker);
        });
       

        // Add mouseout event listener to close the info window when mouse leaves marker
        marker.addListener('mouseout', function() {
            //infowindow.close();
        });
        infowindow.addListener('mouseover', function() {
            infoWindowHovered = true;
        });

       
        infowindow.addListener('mouseout', function () {
                infoWindowHovered = false;
                
            });
            google.maps.event.addListener(map, 'click', function () {
               
                if (!infoWindowHovered) {
                    infowindow.close();
                   
                }
            });
        /*** for mobile devices */
        if (isMobileDevice()) {
            marker.addListener('click', function() {
            // infowindow.setContent('<h3 class="custom">' + location.subject + '</h3><p>' + location.review_points + '</p><Img src= https://softitdevelopers.com/eggs/public/'+ location.image+'><p>' + location.review_message + '</p>');
           infowindow.setContent(
            '<div  style="width: 200px; text-align: ;">' +
                '<img src="https://softitdevelopers.com/eggs/public/' +
                location.image +
                '" style="width: 100%; height: 100px; border-radius: 8px; margin-bottom: 12px; max-width: 200px;">' +
                '<h3 style="color: #333; font-size: 18px; margin-bottom: 8px;">' +
                '<b>'+location.subject+'</b>' +
                '</h3>' +
                '<p style="color: #666; margin-bottom: 12px;"><small><b>Review Points:- </b></small>' +
                location.review_points +'/10'+
                '</p>' +
                '<p style="color: #666; margin-bottom: 12px;">' +
                location.vicinity +
                '</p>' +
                
            '</div>'
            );
            infowindow.open(map, marker);
        });
       

        }
    });

  
            // Try HTML5 geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Center map on user's location
                    map.setCenter(pos);

                    reviews.forEach(function(review) {
                        console.log(pos);
                   var marker = new google.maps.Marker({
                position:  pos,
                map: map,
                title: 'test',
                // Add additional properties if needed
            });
        });                   
                }, function() {
                    // Handle geolocation error
                    handleLocationError(true, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, pos) {
            var infoWindow = new google.maps.InfoWindow;
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                                  'Error: The Geolocation service failed.' :
                                  'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
    </script>

   

            <div id="map" style="height: 400px; width: 100%;"></div>
           
        </div>
        <br><br>
        @foreach ($places as $place)
        <a href="{{ route('single_api', ['place_id' => $place['place_id']]) }}" class="card-link"
            style="color: black; text-decoration: none;">
            <div class="row mt-4">
                <div class="col-md-4">
                    @if (isset($place['photos'][0]['photo_reference']))
                    <?php
                            $photoReference = $place['photos'][0]['photo_reference'];
                            $photoUrl = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=800&photoreference={$photoReference}&key=AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I";
                        ?>
                    <img src="{{ $photoUrl }}" alt="{{ $place['name'] }} Photo" width="100%" height="220px;">
                    @endif
                </div>
                <div class="col-md-4">
                    <h3>{{ $place['name'] }}</h3>
                    <p>Rating: {{ $place['rating'] }}</p>
                    <p>Vicinity: {{ $place['vicinity'] }}</p>
                    <!-- <p>Latitude: {{ $place['geometry']['location']['lat'] }}</p>
                    <p>Longitude: {{ $place['geometry']['location']['lng'] }}</p> -->
                </div>
            </div>
        </a>
        @endforeach
        <div class="mt-4">
            {{ $places->links('pagination::bootstrap-4') }}
        </div>

        
    </div>
    <br><br><br><br>
    <footer style="background-color:#EEEEEE;">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <br>
                        <small> COPYRIGHT © 2024 EGGS BENEDICT NEAR ME - ALL RIGHTS RESERVED. </small>
                    <br><br>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <br>
                    <small>POWERED BY MEDEX</small>
                    <br><br>
                </div>
            </div>
        </div>
    </footer>


    <!-- Add Bootstrap and jQuery JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

@include('project.header')
<br><br><br><br>
<h3 style="text-align:center;color:rgb(184, 139, 116);"><strong> Add a Review </strong></h3>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <p style="text-align:center;">By adding a review we appreciate your important thoughts for us.</p>
        </div>
    </div>
</div>
<br><br>

<form action="{{ url('/add_review') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                <br><br>
                <iframe
                id="mapIframe"
                width="600"
                height="450"
                frameborder="0"
                style="border:0"
                allowfullscreen
                ></iframe>
                <label for="subject" class="mt-4"><strong>Subject</strong><span style="color:red;"> *</span></label>
                <input type="text" class="form-control mt-2" placeholder="Enter Subject" name="subject" id="locationInput">
                <label for="review_message" class="mt-4"><strong>Review Message</strong><span style="color:red;"> *</span></label>
                <textarea class="form-control mt-2" placeholder="Enter Your Review Message" name="review_message" cols="10" rows="6"></textarea>
                <label for="file" class="mt-4"><strong>Upload Resturant Image</strong><span style="color:red;"> *</span></label>
                <input type="file" class="form-control mt-2" name="image">
                <label for="date" class="mt-4"><strong>Date</strong><span style="color:red;"> *</span></label>
                <input type="date" class="form-control mt-2" name="date" value="{{ now()->format('Y-m-d') }}">
                <button type="submit" style="background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large mt-4"><b>POST REVIEW</b></button>                
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <h4 style="text-align:center;" class="mb-4 mt-4"><strong>Recent Reviews</strong></h4>
              @foreach($reviews->sortByDesc('created_at')->take(4) as $review)
                <a href="{{ route('single-card', ['id' => $review->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="card shadow mt-4" style="width: 18rem;" >
                    @if($review->image)
                        <img src="{{ asset('public/' . $review->image) }}" class="card-img-top d-block mx-auto rounded-circle" style="width: 100px; height: 100px; object-fit: cover; padding:10px;" alt="Review Image">
                        <!-- <img src="data:image/png;base64,{{ $review->image }}" alt="Image"> -->
                    @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $review->subject }}</h5>
                            <p class="card-text text-center" style="font-size: 14px;">
                                {{ substr($review->review_message, 0, 150) }}
                                @if(strlen($review->review_message) > 150)
                                    ...
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
        </div>
    </div>
</form>
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

<input type="hidden" id="locationInput" placeholder="Current Location">


<script>
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    console.error("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;

  const locationInput = document.getElementById("locationInput");

  // Use Google Maps Geocoding API to get location name
  fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I&q`)
    .then(response => response.json())
    .then(data => {
      const address = data.results[0].formatted_address;
      locationInput.value = address;

      const mapIframe = document.getElementById("mapIframe");
      mapIframe.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I&q=${latitude},${longitude}`;
    })
    .catch(error => console.error("Error fetching location:", error));
}

function showError(error) {
  console.error("Error getting location:", error.message);
}

// Call getLocation when the page loads
getLocation();
</script>
<script>
    function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showMap);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    }

    function showMap(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    const iframe = document.getElementById("mapIframe");
    iframe.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I&q=${latitude},${longitude}`;
    }
</script>
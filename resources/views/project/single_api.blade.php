@include('project.header')
<br><br><br><br>
<style>
    .star-rating {
        font-size: 0;
    }

    .star {
        display: inline-block;
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background-color: red;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-right: 5px;
    }

    .star:hover,
    .star.active {
        background-color: green;
    }
</style>
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

<form action="{{ route('add_review') }}" method="post" enctype="multipart/form-data">
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
                <label for="subject" class="mt-4"><strong>Subject</strong><span style="color:red;"> *</span></label>
                @if (isset($restaurant))
                <input type="text" class="form-control mt-2" placeholder="Enter Subject" name="subject" id="locationInput" value="{{ $restaurant['name'] }}">
                <input type="hidden" value=" {{ $restaurant['geometry']['location']['lat'] }}" name="latitude">
                <input type="hidden" value=" {{ $restaurant['geometry']['location']['lng'] }}" name="longitude">
                <input type="hidden" value=" {{ $restaurant['vicinity'] }}" name="vicinity">
                @else
                    <p>{{ isset($error) ? $error : 'Restaurant not found' }}</p>
                @endif
                <label for="review_message" class="mt-4"><strong>Review Message</strong><span style="color:red;"> *</span></label>
                <textarea class="form-control mt-2" placeholder="Enter Your Review Message" name="review_message" cols="10" rows="6"></textarea>
                <label for="file" class="mt-4"><strong>Upload Resturant Image</strong><span style="color:red;"> *</span></label>
                <input type="file" class="form-control mt-2" name="image">
                <label for="date" class="mt-4"><strong>Date</strong><span style="color:red;"> *</span></label>
                <input type="date" class="form-control mt-2" name="date" value="{{ now()->format('Y-m-d') }}">
                <label for="review_points" class="mt-4"><strong>Review Points</strong><span style="color:red;"> *</span></label>
                <div class="input-group mt-2">
                    <input type="number" class="form-control" name="review_points" id="review_points" min="0" max="10" step="0.1">
                    <div class="input-group-append">
                        <span class="input-group-text">/10</span>
                    </div>
                </div>
                <button type="submit" style="background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large mt-4"><b>POST REVIEW</b></button>                
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                <h4 style="text-align:center;" class="mb-4 mt-4"><strong>Recent Reviews</strong></h4>
                @foreach($reviews->sortByDesc('created_at')->take(3) as $review)

                <a href="{{ route('single-card', ['id' => $review->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="card shadow mt-4" style="width: 18rem;" >
                         <img src="{{ asset('public/' . $review->image) }}" class="card-img-top d-block mx-auto rounded-circle" style="width: 100px; height: 100px; object-fit: cover; padding:10px;" alt="Review Image">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $review->subject }}</h5>
                            <p class="card-text text-center" style="font-size: 14px;">
                                {{ substr($review->review_message, 0, 150) }}
                                @if(strlen($review->review_message) > 150)
                                    ...
                                @endif
                                <br>
                                <p class="card-text" style="text-align:center;"><small class="text-muted"><b> Review Points: </b>- {{ $review->review_points }}/10.0</small></p>
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

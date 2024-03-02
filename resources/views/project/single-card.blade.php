@include('project.header')
<br><br><br><br>
<h4 style="text-align:center;"><strong>Single Review Page</strong></h4>
<br>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('public/' . $review->image) }}" alt="No image" width="100%" height="400px;">
        </div>
        <div class="col-md-6">
            
            <h5 class="card-title mt-4">{{ strtoupper($review->subject) }}</h5>
            <p class="card-text mt-4">{{ $review->review_message }}</p>
            <p class="card-text mt-4"><strong>{{ $review->created_at }}</strong></p>
        </div>
    </div>
</div>
<br><br><br><br><br>
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

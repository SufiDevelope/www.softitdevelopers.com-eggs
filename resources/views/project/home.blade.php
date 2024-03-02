@include('project.header') 
<style>
    .card {
        position: relative;
        overflow: hidden;
    }

    .card:hover .hover-content {
        opacity: 1;
        transform: translateY(0);
    }

    .hover-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color:rgb(184, 139, 116);
        color: white;
        display: flex;
        flex-direction: column;
        text-align: center;
        opacity: 0;
        transform: translateY(-100%);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .hover-content p {
        margin: 0;
    }

     
    .checked {
        color: orange;
    }
    
</style>
<br><br>
<div style="position: relative;">
    <img src="public/images/slider-bg.jpg" alt="" width="100%">
    <div class="container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); ">
        <h3>Help us find the Best Eggs Benedict!</h3>
        <h1 style="font-size: 60px;">Happy <br> People eat <br> Eggs <br> Benedict</h1>
        <br>
        <button type="button" style="background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large"><b><a href="{{Route('api')}}" style="color:black;text-decoration:none;">REVIEWS</a></b></button>
    </div>
</div>
<br><br><br><br>
<div class="container">
    <h2 style="text-align:center;color:rgb(184, 139, 116);"><b>Hello there!</b></h2>
    <br><br>
    <div class="row">
        <div class="col-md-4">
            <img src="https://img1.wsimg.com/isteam/stock/11757/:/cr=t:0%25,l:16.67%25,w:66.67%25,h:100%25/rs=w:365,h:365,cg:true" alt="" width="100%">
            <br><br>
            <h4 style="text-align:center;" >Busy?</h4>
            <p style="text-align:center;" class="mt-3">Let us know if your favorite place serves up take-out or roadside eggs benedict!</p>
        </div>
        <div class="col-md-4">
            <img src="https://img1.wsimg.com/isteam/stock/90218/:/cr=t:0%25,l:16.67%25,w:66.67%25,h:100%25/rs=w:730,h:730,cg:true" alt="" width="100%">
            <br><br>
            <h4 style="text-align:center;" >Picky Eaters?</h4>
            <p style="text-align:center;" class="mt-3">Don't want spinach or Arugula but your favorite place won't do a special order? <br>We'll show who will...</p>

        </div>
        <div class="col-md-4">
            <img src="https://img1.wsimg.com/isteam/stock/5zlr5pE/:/cr=t:0%25,l:16.63%25,w:66.75%25,h:100%25/rs=w:730,h:730,cg:true" alt="" width="100%">
            <br><br>
            <h4 style="text-align:center;" >Not a Great Cook?</h4>
            <p style="text-align:center;" class="mt-3">Neither are we.  That's why we eat out and have little patience for wasting time.  Go to the places with great food, and skip the rest.</p>
        </div>
    </div>
</div>
<br><br><br>
<style>
.customise {
    text-decoration: none; /* Remove underline */
    color: inherit; /* Use the default text color */
}

.customise:hover {
    /* Optional: Change styles on hover if needed */
    color: #007bff; /* Change text color on hover */
}
</style>

<div style="background-image:url('public/images/slider-bg.jpg'); width:100%; height:800px; display: flex; align-items: center; justify-content: center;">
    <div class="container">
        <div class="card-group">
           @foreach($reviews->sortByDesc('created_at')->take(3) as $review)
                <div class="card" style="border:none;margin-right: 28px;">
                <a href="{{ route('single-card', ['id' => $review->id]) }}" class="customise">
                    <img class="card-img-top mx-auto" src="{{ asset('public/' . $review->image) }}" alt="Card image cap" style="width: 100%; height: 200px;">
                    <div style="text-align:center; font-size:18px;" class="mt-4">
                        <!-- Your star rating code goes here -->
                    </div>
                    <div class="hover-content">
                        <p style="padding:30px;">{{ $review->review_message }}</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="text-align:center;font-size:25px; color:black;">{{ $review->subject }}</h5>
                        <p class="card-text" style="text-align:center;padding:10px;font-size:19px; color:black;">
                            "{{ substr($review->review_message, 0, 250) }}"
                            @if(strlen($review->review_message) > 250)
                                ...
                            @endif
                        </p>
                        <p class="card-text" style="text-align:center;"><small class="text-muted"><b>Date</b>- {{ $review->date }}</small></p>
                        <p class="card-text" style="text-align:center;"><small class="text-muted"><b> Review Points: </b>- {{ $review->review_points }}/10.0</small></p>
                        <!-- <p class="card-title text-center" ><strong></strong></p> -->
                    </div>
                </a>
                </div>
            @endforeach
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="row mt-4">
        <div class="col mt-4">
            <h3 style="font-size:30px;text-align:center;" class="mt-6">Join Our Mailing List</h3>
            <p style="font-size:;text-align:center;" class="mt-4">Be the first to hear about our latest Eggs Benedict adventures!</p>
        </div>
        <form action="">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 mt-4">
                        <input type="text" name="email" placeholder="Enter Your Email" class="form-control" style="height:58px;">
                    </div>
                    <div class="col-md-3  mt-4">
                        <button type="submit" style="background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large"><b>SIGN UP</b></button>
                    </div>
                </div>
           </div>
        </form>
    </div>
</div>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="text-align:center;">
            <h3 style="font-size:30px;text-align:center;">Eggs Benedict Encounters</h3>
        </div>
        <br><br>

       @foreach($reviews->sortBy('created_at')->take(3) as $review)
            <div class="col-md-3 mt-4 mb-4">
                <img src="{{ asset('public/' . $review->image) }}" alt="No Image" style="width: 80%; height: 150px;">
            </div>
            <div class="col-md-5 mt-4">
                
                    {{ $review->subject }} <br>
                    {{ substr($review->review_message, 0, 200) }}
                    @if(strlen($review->review_message) > 200)
                        ...
                    @endif
                
                <br>
                <a href="{{ route('single-card', ['id' => $review->id]) }}" class="customise">
                <button type="button" class="btn btn-sm mr-4" style="background-color:white; color:rgb(184, 139, 116);font-size:18px;margin-left: -13px;">+ View Details</button>
                </a>
                <br><br>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 mt-4">
                <h3 style="font-size:24px;">{{ $review->created_at }}</h3>
                <p>{{ $review->subject }}</p>
                <p class="card-text" style="text-align:;"><small class="text-muted"><b> Review Points: </b>- {{ $review->review_points }}/10.0</small></p>
            </div>
            <br>
            <hr>
        @endforeach

    </div>
</div>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <h3 style="font-size:30px;text-align:center;">Contact Us</h3>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex flex-column justify-content-center" style="margin-top: 50px;">
                <p style="font-size: 20px;">Better yet, see us in person!</p>
                <p style="">Invite us to your place and we may drop by for a stealth review...</p>
                <p style="font-size: 26px; font-weight: 500;">Eggs Benedict Near Me</p>
                <br>
                <button type="button" style="width: 100%; max-width: 200px; background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large"><b>DROP US A LINE! </b></button>
            </div>
            <div class="col-md-6 d-flex align-items-center" style="margin-top: 50px;">
                <img src="https://img1.wsimg.com/isteam/stock/3785/:/rs=w:1160/qt=q:15" alt="" width="100%" height="300px">
            </div>
        </div>
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

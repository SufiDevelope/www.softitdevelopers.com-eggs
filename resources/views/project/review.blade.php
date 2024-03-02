@include('project.header')
<br><br><br><br>
<h3 style="text-align:center;color:rgb(184, 139, 116);font-size:30px;"><strong> Hello {{Auth::guard('customer')->user()->first_name}} </strong></h3>
<br><br>
<form action="{{Route('signin')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2" style="color:rgb(184, 139, 116);"><b>Account</b></div>
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
            <label for="subject" style="font-size:25px;"><strong>{{Auth::guard('customer')->user()->first_name}} {{Auth::guard('customer')->user()->last_name}}</strong></label>
        </div>
        <br><br><br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <label for="review" class="mt-2"> Email: <br>{{Auth::guard('customer')->user()->email}}</label>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <br>
            <label for="review" class="mt-2"> Phone: <br>{{Auth::guard('customer')->user()->phone}}</label>
        </div>
        <br><br><br><br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <br>
             <a href="{{Route('editUserProfile')}}">Edit Profile</a>
             <br><br>
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
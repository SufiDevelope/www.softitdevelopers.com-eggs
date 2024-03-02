@include('project.header')
<br><br><br><br>
<h3 style="text-align:center;color:rgb(184, 139, 116);font-size:30px;"><strong> Hello {{Auth::guard('customer')->user()->first_name}} </strong></h3>
<br><br>
<form action="{{Route('editUserProfile')}}" method="post">
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
            <label for="subject" style="font-size:25px;"><strong>Profile</strong></label>
        </div>
        <br><br><br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <!-- <label for="email" class="mt-2"> Email:</label> -->
            <input type="text" name="first_name" placeholder="First Name" class="form-control" value="{{Auth::guard('customer')->user()->first_name}}" >
        </div>
        <div class="col-md-3">
            <!-- <label for="email" class="mt-2"> Email:</label> -->
            <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="{{Auth::guard('customer')->user()->last_name}}">
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <br>
            <!-- <label for="email" class="mt-2"> Email:</label> -->
            <input type="number" name="phone" placeholder="Phone" class="form-control" value="{{Auth::guard('customer')->user()->phone}}">
            <!-- <input type="hidden" name="email" value="{{Auth::guard('customer')->user()->email}}">
            <input type="hidden" name="password" value="{{Auth::guard('customer')->user()->password}}"> -->
        </div>
        <div class="col-md-3"></div>
        <br><br><br><br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
             <button type="submit" style="background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large"><b>SAVE</b></button>
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
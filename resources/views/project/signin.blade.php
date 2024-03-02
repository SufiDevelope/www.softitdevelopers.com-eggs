@include('project.header')
<br><br><br><br>
<h3 style="text-align:center;color:rgb(184, 139, 116);"><strong> Account sign in </strong></h3>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <p style="text-align:center;">Sign in to your account to access your profile, history, and any private pages you've been granted access to.</p>
        </div>
    </div>
</div>
<br><br>
<form action="{{Route('signin')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-3"></div>
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
            <label for="email"><strong>Email</strong><span style="color:red;"> *</span></label>
            <input type="email" class="form-control mt-2" placeholder="Enter Your Email" name="email">
        </div>
        <br><br>
        <br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <label for="password" class="mt-2"><strong>Password</strong><span style="color:red;"> *</span></label>
            <input type="password" class="form-control mt-2" placeholder="Enter Your Password" name="password">
        </div>
        <br><br><br><br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
             <center><button type="submit" style="background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large"><b>SIGN IN</b></button></center>
             <br><br>
             <p style="text-align:center;">Not a member?<a href="signup" style='color:rgb(184, 139, 116);'> Create account.</a></p>
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
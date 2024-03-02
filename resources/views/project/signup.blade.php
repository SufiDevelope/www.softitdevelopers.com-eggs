@include('project.header')
<br><br><br><br>
<h3 style="text-align:center;color:rgb(184, 139, 116);"><strong> Create Account </strong></h3>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <p style="text-align:center;">By creating an account, you may receive newsletters or promotions.</p>
        </div>
    </div>
</div>
<br><br>

<form action="{{ route('signup') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-3"></div>
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
            <label for="first_name"><strong>First Name</strong><span style="color:red;"> *</span></label>
            <input type="text" class="form-control mt-2" placeholder="Enter Your Fisrt Name" name="first_name">
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <label for="last_name" class="mt-3"><strong>Last Name</strong><span style="color:red;"> *</span></label>
            <input type="text" class="form-control mt-2" placeholder="Enter Your Last Name" name="last_name">
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <label for="email" class="mt-3"><strong>Email</strong><span style="color:red;"> *</span></label>
            <input type="email" class="form-control mt-2" placeholder="Enter Your Email" name="email">
        </div>
        <br><br>
        <br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <label for="password" class="mt-3"><strong>Password</strong><span style="color:red;"> *</span></label>
            <input type="password" class="form-control mt-2" placeholder="Enter Your Password" name="password">
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6" >
            <label for="phone" class="mt-3"><strong>Phone </strong>(Optional)</label>
            <input type="number" class="form-control mt-2" placeholder="Enter Your Phone Number" name="phone">
        </div>
        <br><br><br><br>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
             <center><button type="submit" style="background-color: rgb(184, 139, 116); border-radius: 0; padding: 15px 20px; font-size: 16px;" class="btn btn-large mt-4"><b>CREATE ACCOUNT</b></button></center>
             <br><br>
             <p style="text-align:center;">Already have an account? <a href="signin" style='color:rgb(184, 139, 116);'>Sign in</a></p>
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
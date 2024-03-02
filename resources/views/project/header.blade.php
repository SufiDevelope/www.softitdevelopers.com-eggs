<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container">
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mx-auto" href="/"><b><span style="font-size:20px;">Eggs Benedict Near Me</span></b></a>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#f8f9fa;border:none;color:black">
          <i class="fa fa-user" style="font-size: 25px;color:black;"></i>
        </button>
        @if(Auth::guard('customer')->check())
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
            <li style="padding:10px;"><b>Signed In as:</b></li>
            <li><a class="dropdown-item" href="signin">{{Auth::guard('customer')->user()->email}} </a></li>
            <li><a class="dropdown-item" href="{{Route('api')}}">Add a Review</a></li>
            <li><a class="dropdown-item" href="{{Route('review')}}">My Account</a></li>
            <hr>
            <li><a class="dropdown-item" href="{{Route('logout')}}">Logout</a></li>
          </ul>
        @else
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="signin">Sign In</a></li>
          <li><a class="dropdown-item" href="signup">Create Account</a></li>
          <li><a class="dropdown-item" href="{{Route('api')}}">Add a Review</a></li>
          <hr>
          <li><a class="dropdown-item" href="signin">My Account</a></li>
        </ul>
      </div>
      @endif
    <div class="offcanvas offcanvas-start" tabindex="1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color:rgb(184, 139, 116);">Eggs Benedict</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/eggs" style="color:rgb(184, 139, 116); font-size:20px;">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="about_us" style="color:rgb(184, 139, 116); font-size:20px;">About</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
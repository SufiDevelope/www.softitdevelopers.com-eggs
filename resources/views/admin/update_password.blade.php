@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Settings</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Update Admin Password</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
   <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Change Admin Password</h3>
                      </div>
                      @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                          {{Session::get('error')}}
                        </div>
                      @endif
                      @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                          {{Session::get('success')}}
                        </div>
                      @endif
                      <form action="{{url('update_password')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                              <label for="Email address">Email address</label>
                              <input type="email" class="form-control" id="Email address" value="{{Auth::guard('admin')->user()->email}}" placeholder="Enter email" style="background-color:#666;" readonly>
                            </div>
                            <div class="form-group">
                              <label for="Current Password">Current Password</label>
                              <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Old Password" style="background-color:#666;"><span id="verifyCurrentPassword"></span>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">New Password</label>
                              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" style="background-color:#666;">
                            </div>
                            <div class="form-group">
                              <label for="Old pass">Confirm Password</label>
                              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder=" Confirm Password" style="background-color:#666;">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </div>

  @endsection
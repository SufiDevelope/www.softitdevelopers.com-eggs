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
                <li class="breadcrumb-item active">Update Admin Details</li>
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
                        <h3 class="card-title">Change Admin Details</h3>
                      </div>
                      @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                      @endif
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
                      <form action="{{url('/admin/admin_details')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" style="background-color:#666;" value="{{Auth::guard('admin')->user()->name}}">
                            </div>
                            <div class="form-group">
                                <label for="Mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" style="background-color:#666;" value="{{Auth::guard('admin')->user()->mobile}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" style="background-color:#666;" value="{{Auth::guard('admin')->user()->email}}" >
                            </div>
                            <!-- <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" style="background-color:#666;">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                    <a href="{{url('public/storage/admin/images/'.Auth::guard('admin')->user()->image)}}" target="_blank">View Image</a>
                                <input type="hidden" name="current_image" value="{{Auth::guard('admin')->user()->image}}">
                                
                                @endif
                            </div> -->
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
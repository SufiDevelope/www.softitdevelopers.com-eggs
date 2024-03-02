@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
           
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form name="cmsForm" id="cmsForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label for="name">Name*</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" @if(!empty($subadmin['name'])) value="{{ $subadmin['name'] }}" @endif>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="mobile">Mobile*</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" @if(!empty($subadmin['mobile'])) value="{{ $subadmin['mobile'] }}" @endif>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" @if(!empty($subadmin['email'])) value="{{ $subadmin['email'] }}" @endif>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="password">Password*</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" @if(!empty($subadmin['password'])) value="{{ $subadmin['password'] }}" @endif>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="type">Type*</label>
                        <select name="type" id="type" class="form-control" >
                            <option value="">Choose</option>
                            <option value="subadmin">Subadmin</option>
                        </select>
                  </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
    </section>
  </div>
@endcontent
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
                <form name="categoryForm" id="categoryForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label for="category_name">Category Name*</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="category_image">Category Image</label>
                        <input type="file" class="form-control" id="category_image" name="category_image">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="discount">Discount Amount</label>
                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter discount amount">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="url">Category URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="description">Category Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows=3></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Category Meta Title">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Category Meta Keywords">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Category Meta Description">
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
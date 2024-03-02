@extends('admin.layout.layout')
@section('content')



<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Documentation</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Documentation</a></li>
                <li class="breadcrumb-item active">Admin Documentation</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
    <hr>
   <section class="content">
    <h4 style="text-align:center;">Documentation</h4>
    <p>
        <ul>
            <li>
                For image usage this command is required in controller
                "use Illuminate\Support\Facades\Storage;".
            </li>
            <li>
                to find any link like for storage(php artisan storage:link).
                this is when image oath is not setting up then try this and restart your server..
            </li>
            <li>
                To highliht the current opened tab we will use sessions.
            </li>
        </ul>
    </p>
    </section>
  </div>
@endsection

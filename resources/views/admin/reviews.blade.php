@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registered Customers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
          {{Session::get('success')}}
      </div>
    @endif
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reviews</h3>
                <!-- <a href="{{url('/admin/customers/add_customers/')}}" style="max-width:150px; display:inline-block; float:right" class="btn btn-block btn-primary">Add Customer</a> -->
              </div>
              <div class="card-body">
                <table id="subadmins" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Review Message</th>
                    <th>Customer Name</th>
                    <th>Created On</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($reviews as $review)
                  <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->subject }}</td>
                    <td>{{ $review->review_message }}</td>
                    <td>{{ optional($review->customer)->first_name }} {{ optional($review->customer)->last_name }}</td>                    
                    <td><?php echo date("F j, Y, g:i a", strtotime($review['created_at'])); ?></td>
                    <td>
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;
                    <a href="/admin/delete-review/{{ $review->id }}" record="review" recordid="{{ $review->id }}" class="" name="reviews" title="Delete Review"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection
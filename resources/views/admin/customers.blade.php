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
                <h3 class="card-title">Customers</h3>
                <a href="{{url('/admin/customers/add_customers/')}}" style="max-width:150px; display:inline-block; float:right" class="btn btn-block btn-primary">Add Customer</a>
              </div>
              <div class="card-body">
                <table id="subadmins" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created On</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($customers as $c)
                  <tr>
                    <td>{{$c['id']}}</td>
                    <td>{{$c['first_name']}}</td>
                    <td>{{$c['last_name']}}</td>
                    <td>{{$c['email']}}</td>
                    <td>{{$c['phone']}}</td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($c['created_at'])); ?></td>
                    <td>
                    <!-- @if($c['status'] == 1)
                        <a class="updateCustomersStatus" id="customer-{{$c['id']}}" customer_id="{{$c['id']}}" href="javascript:void(0)">
                            <i class="fas fa-toggle-on" status="Active"></i>
                        </a>
                    @else
                        <a class="updateCustomersStatus" id="page-{{$c['id']}}" customer_id="{{$c['id']}}" href="javascript:void(0)">
                            <i class="fas fa-toggle-off" status="Inactive" style="color:red;"></i>
                        </a>
                    @endif -->
                    &nbsp;&nbsp;
                    <a href="{{url('/admin/customers/add_customers/'.$c['id'])}}"><i class="fas fa-edit"></i></a>
                    &nbsp;&nbsp;
                    <a href="{{url('/admin/delete-customer/'.$c['id'])}}" record="customer" recordid="{{$c['id']}}" class="" name="customer" title="Delete Customer" onclick="return confirm('Are you sure you want to delete this customer?');"><i class="fas fa-trash"></i></a>
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
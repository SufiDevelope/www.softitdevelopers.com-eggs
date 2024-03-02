@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
                <h3 class="card-title">Categories</h3>
                <a href="{{url('admin/add-edit-category/')}}" style="max-width:150px; display:inline-block; float:right" class="btn btn-block btn-primary">Add Categories</a>
              </div>
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Url(s)</th>
                    <th>Created On</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($category as $c)
                  <tr>
                    <td>{{$c['id']}}</td>
                    <td>{{$c['category_name']}}</td>
                    <td>
                        @if(isset($c['parentCategory']['category_name']))
                            {{$c['parentCategory']['category_name']}}
                        @else
                            N / A
                        @endif
                    </td>
                    <td>{{$c['url']}}</td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($c['created_at'])); ?></td>
                    <td>
                        @if($c['status'] == 1)
                          <a class="updateCategoryStatus" id="category-{{$c['id']}}" category_id="{{$c['id']}}" href="javascript:void(0)">
                              <i class="fas fa-toggle-on" status="Active"></i>
                          </a>
                        @else
                          <a class="updateCategoryStatus" id="category-{{$c['id']}}" category_id="{{$c['id']}}" href="javascript:void(0)">
                              <i class="fas fa-toggle-off" status="Inactive" style="color:red;"></i>
                          </a>
                        @endif
                        &nbsp;&nbsp;
                        <a href="javascript:void(0)" record="category" recordid="{{$c['id']}}" <?php //for simple alert tha ye wala href="{{url('admin/delete-cms-category/'.$c['id'])}}"?> class="confirmDelete" title="Delete Category"><i class="fas fa-trash"></i></a>
                      &nbsp;&nbsp;
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
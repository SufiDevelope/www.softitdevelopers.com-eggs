@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cms Pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cms Pages</li>
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
                <h3 class="card-title">Cms Pages</h3>
                @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                <a href="{{url('admin/add-edit-cms-page/')}}" style="max-width:150px; display:inline-block; float:right" class="btn btn-block btn-primary">Add CMS page</a>
                @endif
              </div>
              <div class="card-body">
                <table id="cmspages" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Url(s)</th>
                    <th>Created On</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($cmsPages as $c)
                  <tr>
                    <td>{{$c['id']}}</td>
                    <td>{{$c['title']}}</td>
                    <td>{{$c['url']}}</td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($c['created_at'])); ?></td>
                    <td>
                    @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                      @if($c['status'] == 1)
                          <a class="updateCmsPageStatus" id="page-{{$c['id']}}" page_id="{{$c['id']}}" href="javascript:void(0)">
                              <i class="fas fa-toggle-on" status="Active"></i>
                          </a>
                      @else
                          <a class="updateCmsPageStatus" id="page-{{$c['id']}}" page_id="{{$c['id']}}" href="javascript:void(0)">
                              <i class="fas fa-toggle-off" status="Inactive" style="color:red;"></i>
                          </a>
                      @endif
                      &nbsp;&nbsp;
                    @endif
                    @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                      <a href="{{url('admin/add-edit-cms-page/'.$c['id'])}}"><i class="fas fa-edit"></i></a>
                      &nbsp;&nbsp;
                    @endif
                    @if($pagesModule['full_access']==1)
                      <a href="javascript:void(0)" record="cms-page" recordid="{{$c['id']}}" <?php //for simple alert tha ye wala href="{{url('admin/delete-cms-page/'.$c['id'])}}"?> class="confirmDelete" name="CMS Page" title="Delete CMS Page"><i class="fas fa-trash"></i></a>
                    @endif
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
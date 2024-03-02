@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subadmins</h1>
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
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form name="cmsForm" id="cmsForm" method="post" action="{{url('update-role/'.$id)}}">
                @csrf
                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label for="cms_pages">Cms Pages: &nbsp;&nbsp;</label>
                        @if(!empty($subadminRoles))
                            @foreach($subadminRoles as $s)
                                @if($s['module']=='cms_pages')
                                    @if($s['view_access']==1)
                                        @php $viewCMSPages = "checked" @endphp
                                    @else
                                        @php $viewCMSPages = "" @endphp
                                    @endif
                                    @if($s['edit_access']==1)
                                        @php $editCMSPages = "checked" @endphp
                                    @else
                                        @php $editCMSPages = "" @endphp
                                    @endif
                                    @if($s['full_access']==1)
                                        @php $fullCMSPages = "checked" @endphp
                                    @else
                                        @php $fullCMSPages = "" @endphp
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        <input type="hidden" name="subadmin_id" value="{{ $id }}">
                        <input type="checkbox" name="cms_pages[view]" value="1" @if(isset($viewCMSPages)) {{ $viewCMSPages }} @endif>&nbsp;View Access &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="cms_pages[edit]" value="1" @if(isset($editCMSPages)) {{ $editCMSPages }} @endif>&nbsp;View/Edit Access &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="cms_pages[full]" value="1" @if(isset($fullCMSPages)) {{ $fullCMSPages }} @endif>&nbsp;Full Access &nbsp;&nbsp;&nbsp;&nbsp;
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
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link">
      <img src="{{asset('public/admin/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         
              <img src="{{ asset('public/admin/img/avatar5.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- for current link highlight -->
         @if(Session::get('page')=='dashboard')
            @php $active="active" @endphp
        @else
            @php $active="" @endphp
        @endif
          <li class="nav-item">
              <a href="{{url('admin/dashboard')}}" class="nav-link {{ $active }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Dashboard
                  </p>
              </a>
          </li>
          @if(Auth::guard('admin')->user()->type=="admin")
          @if(Session::get('page')=='update_password' || Session::get('page')=='update_details')
              @php $active="active" @endphp
          @else
              @php $active="" @endphp
          @endif
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Session::get('page')=='update_password')
                  @php $active="active" @endphp
              @else
                  @php $active="" @endphp
              @endif
              <li class="nav-item">
                <a href="{{url('update_password')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password</p>
                </a>
              </li>
              @if(Session::get('page')=='update_details')
                  @php $active="active" @endphp
              @else
                  @php $active="" @endphp
              @endif
              <li class="nav-item">
                <a href="{{url('admin/admin_details')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>
            </ul>
          </li>
           @endif

          @if(Session::get('page')=='customers')
            @php $active="active" @endphp
          @else
            @php $active="" @endphp
          @endif
          <li class="nav-item">
            <a href="{{url('/admin/customers')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          @if(Session::get('page')=='reviews')
            @php $active="active" @endphp
          @else
            @php $active="" @endphp
          @endif
          <li class="nav-item">
            <a href="{{url('/admin/reviews')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Reviews
              </p>
            </a>
          </li>

          @if(Auth::guard('admin')->user()->type=="admin")
            @if(Session::get('page')=='subadmins')
              @php $active="active" @endphp
            @else
              @php $active="" @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('admin/subadmin')}}" class="nav-link {{$active}}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Subadmins
                </p>
              </a>
            </li>
          @endif
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
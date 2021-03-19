  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <p class="brand-link">
      <img src="{{ asset('public/design/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </p>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="{{__('search')}}" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  {{__('dashboard')}}
                </p>
              </a>
            </li>
            <!-- Admins -->
            <li class="nav-item">
              <a href="{{ route('admins') }}" class="nav-link">
                <i class="nav-icon fa fa-user-tie" ></i>
                <p>
                  {{__('admins')}}
                </p>
              </a>
            </li>

            <!-- Banks -->
            <li class="nav-item">
              <a href="{{ route('banks') }}" class="nav-link">
                <i class="nav-icon fa fa-building"></i>
                <p>
                  {{__('banks')}}
                </p>
              </a>
            </li>
            <!-- Categories -->
            <li class="nav-item">
              <a href="{{ route('categories') }}" class="nav-link">
                <i class="nav-icon fa fa-list-alt" ></i>
                <p>
                  {{__('categories')}}
                </p>
              </a>
            </li>

            <!-- Products -->
            <li class="nav-item">
              <a href="{{ route('products') }}" class="nav-link">
                <i class="nav-icon fab fa-product-hunt"></i>
                <p>
                  {{__('products')}}
                </p>
              </a>
            </li>

            <!-- Settings -->
            <li class="nav-item">
              <a href="{{ route('settings') }}" class="nav-link">
                <i class="nav-icon fa fa-cog"></i>
                <p>
                  {{__('settings')}}
                </p>
              </a>
            </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
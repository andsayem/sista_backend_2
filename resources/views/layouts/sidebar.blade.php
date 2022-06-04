<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="{{ asset('public/vendors/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name','Web Sista')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('public/vendors/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column  " data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{ (request()->is('admin/cagegory*' )) ? 'menu-open' : '' }} {{ (request()->is('admin/posts*' )) ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link {{ (request()->is('admin/cagegory*' )) ? 'active' : '' }} {{ (request()->is('admin/posts*' )) ? 'active' : '' }}  "> 
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Posts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('post_category')}}" class="nav-link {{ (request()->is('admin/cagegory*')) ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{ route('posts')}}" class="nav-link {{ (request()->is('admin/posts*')) ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Post List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ (request()->is('admin/product*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('admin/product*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="#" class="nav-link  ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ route('product_list')}}" class="nav-link {{ (request()->is('admin/product/list*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ (request()->is('admin/event*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('admin/event*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Event
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="#" class="nav-link  ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ route('event_list')}}" class="nav-link {{ (request()->is('admin/event/list*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Event</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ (request()->is('admin/journal*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('admin/journal*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Journal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="#" class="nav-link  ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ route('journal_list')}}" class="nav-link {{ (request()->is('admin/journal/list*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Journal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ (request()->is('admin/users*' )) ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link {{ (request()->is('admin/users*' )) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users')}}" class="nav-link  {{ (request()->is('admin/posts*')) ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Users</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
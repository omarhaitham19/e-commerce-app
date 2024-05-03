<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{route('redirect')}}"><img src="{{asset("admin/assets")}}/images/logo.svg" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="{{route('redirect')}}"><img src="{{asset("admin/assets")}}/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="{{asset("admin/assets")}}/images/faces/face15.jpg" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{Auth::user()->name}}</h5>
              <span>{{Auth::user()->email}} </span>
            </div>
          </div>
         
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('redirect')}}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('categories')}}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Categories</span>
        </a>
      </li>
      @can('all-products')      
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('products')}}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">All Products</span>
        </a>
      </li>
      @endcan

      @can('add-products')          
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('products/create')}}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Add new product</span>
        </a>
      </li>
      @endcan

      @can('all-admins')       
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('users')}}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">All Admins</span>
        </a>
      </li>
      @endcan

      @can('role-list')          
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('roles')}}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Roles and Permissions</span>
        </a>
      </li>
      @endcan

      @can('manage-users')         
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('manageUser')}}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Manage Users</span>
        </a>
      </li>
      @endcan
      @can('orders')
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('orders')}}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      @endcan
    </ul>
  </nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ url('public/template/admin') }}/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
      <span class="brand-text font-weight-light">UniMart</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('public/template/admin') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-bars"></i>
              <p>&ensp;Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('menu.add') }}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>&ensp;Add menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('menu.list') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>&ensp;List menu</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Product --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fab fa-shopify"></i>
              <p>&ensp;Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.add') }}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>&ensp;Add product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.list') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>&ensp;List product</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Order --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-store"></i>
              <p>&ensp;Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('cart.list') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>&ensp;List order</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Slider --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-image"></i>
              <p>&ensp;Slider
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('slider.add') }}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>&ensp;Add Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('slider.list') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>&ensp;List Slider</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
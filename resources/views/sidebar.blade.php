 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="http://127.0.0.1:8000/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">WorkShop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="http://127.0.0.1:8000/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
          <a href="#" class="nav-link {{ Request::is('admin*', 'category*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <b>
              Categories
              <i class="right fas fa-angle-left"></i>
            </b>
          </a>
          <ul class="nav nav-treeview" style="display: {{ Request::is('admin*', 'category*') ? 'block' : 'none' }}">
            <li class="nav-item">
            <a href="{{ route('category.add')}}" class="nav-link {{ Request::is('category/add') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Add New
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('category.list')}}" class="nav-link {{ Request::is('category/list') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Listing
              </p>
            </a>
          </li>
          </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('product*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <b>
                Products
                <i class="right fas fa-angle-left"></i>
              </b>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('product.add')}}" class="nav-link {{ Request::is('product/add') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Add New
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product.list')}}" class="nav-link {{ Request::is('product/list') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Listing
                </p>
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
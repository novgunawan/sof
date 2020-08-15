  
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/questions" class="brand-link">
      <img src="{{ asset('/adminlte/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Larahub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/questions" class="nav-link {{ (request()->segment(2) == '') ? 'active' : '' }}">
              <i class="nav-icon fas fa-globe-asia"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="/questions/create" class="nav-link {{ (request()->segment(2) == 'create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Buat Pertanyaan
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
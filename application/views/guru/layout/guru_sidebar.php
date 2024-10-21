    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/AdminLTE-3.0.5/');?>dist/img/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">SIPS - Guru</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-header">Main Navigation</li>
           <li class="nav-item">
            <a href="<?= base_url('Guru')?>" class="nav-link <?php if($page == 'Dashboard' || $page == 'Detail Pelanggaran'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Guru/listPelanggaran')?>" class="nav-link <?php if($page == 'List Pelangaran' || $page == 'List Pelanggaran Add' || $page == 'List Pelanggaran Detail' || $page == 'List Pelanggaran Edit'){echo 'active';} ?>">
              <i class="nav-icon far fa-list-alt"></i>
              <p>
                List pelanggaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Guru/listSiswa')?>" class="nav-link <?php if($page == 'List Siswa' || $page == 'Data Siswa Add' || $page == 'Data Siswa Detail' || $page == 'Data Siswa Edit'){echo 'active';} ?>">
              <i class="nav-icon far fa-address-book"></i>
              <p>
                List Siswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#logOutModal">
              <i class="nav-icon fa-fw fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('Admin');?>" class="brand-link">
        <img src="<?= base_url('assets/AdminLTE-3.0.5/');?>dist/img/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">SIPS</span>
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
            <a href="<?= base_url('Admin')?>" class="nav-link <?php if($page == 'Dashboard' || $page == 'Detail Pelanggaran'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if($parent == 'Data Kategori' || $parent == 'Data Kategori' || $parent == 'List Pelanggaran'){echo 'menu-open';} ?>">
            <a href="#" class="nav-link <?php if($parent == 'Data Kategori' || $parent == 'Data Kategori' || $parent == 'List Pelanggaran'){echo 'active';} ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Kategori
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="<?= base_url('Admin/dataKategoriKategoriPelanggaran')?>" class="nav-link <?php if($page == 'Kategori Pelanggaran' || $page == 'Kategori Pelanggaran Add' || $page == 'Kategori Pelanggaran Edit'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Pelanggaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/dataKategoriListPelanggaran')?>" class="nav-link <?php if($page == 'List Pelanggaran' || $page == 'List Pelanggaran Add' || $page == 'List Pelanggaran Detail' || $page == 'List Pelanggaran Edit'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Pelanggaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php if($parent == 'Data Master' || $parent == 'Data Guru' || $parent == 'Data Kelas' || $parent == 'Data Siswa'){echo 'menu-open';} ?>">
            <a href="#" class="nav-link <?php if($parent == 'Data Master' || $parent == 'Data Guru' || $parent == 'Data Kelas' || $parent == 'Data Siswa'){echo 'active';} ?>">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/dataMasterGuru')?>" class="nav-link <?php if($page == 'Data Semua Guru' || $page == 'Add Data Guru' || $page == 'Detail Data Guru' || $page == 'Edit Data Guru'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/dataMasterKelas')?>" class="nav-link <?php if($page == 'Data Semua Kelas' || $page == 'Add Data Kelas' || $page == 'Detail Data Kelas' || $page == 'Edit Data Kelas'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/dataMasterSiswa')?>" class="nav-link <?php if($page == 'Data Semua Siswa' || $page == 'Add Data Siswa' || $page == 'Detail Data Siswa' || $page == 'Edit Data Siswa'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php if($parent == 'Pengguna' || $parent == 'Data Pengguna' || $parent == 'Website'){echo 'menu-open';} ?>">
            <a href="#" class="nav-link <?php if($parent == 'Pengguna' || $parent == 'Data Pengguna' || $parent == 'Website'){echo 'active';} ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pengaturan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/pengaturanPengguna') ;?>" class="nav-link <?php if($page == 'Data Pengguna' || $page == 'Data Pengguna Add' || $page == 'Data Pengguna Detail' || $page == 'Data Pengguna Edit'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/pengaturanWebsite') ;?>" class="nav-link <?php if($page == 'Data Website'){echo 'active';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Website</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/laporanAll')?>" class="nav-link <?php if($parent == 'Data Laporan'){echo 'active';} ?>">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
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
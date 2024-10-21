    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/AdminLTE-3.0.5/');?>dist/img/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">SIPS - Siswa</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <div class="card-body box-profile">
          <div class="text-center">
            <?php
            if(file_exists('assets/sips/img/siswa/'.$oneSiswa->nisn.'.png')) : ?>

              <img class="profile-user-img img-fluid img-circle"
              src="<?= base_url('assets/sips/img/siswa/'.$oneSiswa->nisn.'.png');?>"
              alt="User profile picture">

              <?php else :?>

                <img class="profile-user-img img-fluid img-circle"
                src="<?= base_url('assets/sips/img/siswa/default.jpg');?>"
                alt="User profile picture">

              <?php endif ;?>
            </div>
            <h3 class="profile-username text-center text-white"><?= $oneSiswa->std_name?></h3>
            <p class="text-muted text-center"><?= $oneSiswa->class_name?></p>
          </div>
          <!-- /.card-body -->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-header">Main Navigation</li>
           <li class="nav-item">
            <a href="<?= base_url('Siswa')?>" class="nav-link <?php if($page == 'Profile Siswa'){echo 'active';} ?>">
              <i class="nav-icon far fa-user"></i>
              <p>
                Profile Siswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Siswa/listPelanggaran')?>" class="nav-link <?php if($page == 'List Pelanggaran' || $page == 'List Pelanggaran Detail'){echo 'active';} ?>">
              <i class="nav-icon far fa-list-alt"></i>
              <p>
                List pelanggaran
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
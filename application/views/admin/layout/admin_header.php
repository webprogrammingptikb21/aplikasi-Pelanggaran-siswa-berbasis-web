  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

          <?php
          if(file_exists('assets/sips/img/admin/'.$user->username.'.png')) : ?>

            <img class="user-image img-circle elevation-2"
            src="<?= base_url('assets/sips/img/admin/'.$user->username.'.png');?>"
            alt="User profile picture">

            <?php else :?>

              <img class="user-image img-circle elevation-2"
              src="<?= base_url('assets/sips/img/admin/default.jpg');?>"
              alt="User profile picture">

            <?php endif ;?>
            <span class="d-none d-md-inline"><?= $this->session->userdata('username');?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-info">
              <?php
              if(file_exists('assets/sips/img/admin/'.$user->username.'.png')) : ?>

                <img class="profile-user-img img-fluid img-circle"
                src="<?= base_url('assets/sips/img/admin/'.$user->username.'.png');?>"
                alt="User profile picture">

                <?php else :?>

                  <img class="profile-user-img img-fluid img-circle"
                  src="<?= base_url('assets/sips/img/admin/default.jpg');?>"
                  alt="User profile picture">

                <?php endif ;?>

                <p>
                  <?= $this->session->userdata('username');?>
                  <small> <?= $this->session->userdata('level');?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <a href="<?= base_url('Admin/profile')?>" class="btn btn-info btn-sm"><i class="fas fa-user"></i>&ensp;Profile</a>
                <a href="#" class="btn btn-danger float-right btn-sm" data-toggle="modal" data-target="#logOutModal" data-backdrop="static" data-keyboard="true"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
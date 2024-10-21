<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $page ;?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small>Admin</small></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pengaturanPengguna');?>"><small><?= $parent ;?></small></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pengaturanPenggunaAdd');?>"><small><?= $page ;?></small></a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <?php if(validation_errors()) : ?>
        <!-- Row Note -->
        <div class="row">
          <div class="col-12">
            <div class="alert callout callout-info bg-danger" role="alert">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <?= validation_errors(); ?>
            </div>
          </div>
          <!--/. Col -->
        </div>
      <?php endif ;?>
      <?php if($this->session->flashdata('message') == TRUE) : ?>
        <!-- Row Note -->
        <div class="row">
          <div class="col-12">
            <div class="alert callout callout-info bg-danger" role="alert">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <?= $this->session->flashdata('message'); ?>
            </div>
          </div>
          <!--/. Col -->
        </div>
      <?php endif ;?>             
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content ">
    <div class="container-fluid">

      <div class="row">

        <div class="col-sm-8">

          <div>
            <div class="callout callout-danger">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <text class="text-danger"><b>Silahkan Memilih Level Terlebih Dahulu Nanti ada Petujuk Selanjutnya!!!</b></text>
            </div>
          </div>

          <!-- Default box -->
          <div class="card card-outline card-info">
            <div class="card-header">
              <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
              <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('Admin/pengaturanPengguna');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
            </div>
            <div class="card-body">


              <form action="<?= base_url('admin/pengaturanPenggunaAdd')?>" method="post">


                <!-- Level -->
                <div class="form-group">
                  <label for="addPenggunaLevel" class="col-form-label">Level</label>
                  <select class="form-control" name="level" id="addPenggunaLevel">
                    <option value="">Silahkan Memilih Level</option>
                    <option value="Admin">Admin</option>
                    <option value="Guru">Guru</option>
                    <option value="Wali">Wali</option>
                    <option value="Siswa">Siswa</option>
                  </select>
                  <?= form_error('level', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <!-- / Level -->


                <div id=addPenggunaAdmin style="display: none">

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaFullnameAdmin" class="col-form-label">Fullname</label>
                    <input type="text" name="fullnameAdmin" class="form-control" id="addPenggunaFullnameAdmin" placeholder="Fullname" value="<?= set_value('fullname')?>" />
                    <?= form_error('fullnameAdmin', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaEmailAdmin" class="col-form-label">Email</label>
                    <input type="text" name="emailAdmin" class="form-control" id="addPenggunaEmailAdmin" placeholder="Email" value="<?= set_value('email')?>" />
                    <?= form_error('emailAdmin', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->

                  <!-- Username -->
                  <div class="form-group">
                    <label for="addPenggunaUsernameAdmin" class="col-form-label">Username</label>
                    <input type="text" name="usernameAdmin" class="form-control" id="addPenggunaUsernameAdmin" placeholder="Username" value="<?= set_value('username')?>" />
                    <?= form_error('usernameAdmin', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Username -->

                  <!-- Password -->
                  <div class="form-group">
                    <label for="addPenggunaPasswordAdmin" class="col-form-label">Password</label>
                    <input type="text" name="passwordAdmin" class="form-control" id="addPenggunaPasswordAdmin" placeholder="Password" value="<?= set_value('password')?>" />
                    <?= form_error('passwordAdmin', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Password -->

                </div>

                <div id=addPenggunaGuru style="display: none">

                  <!-- NIK -->
                  <div class="form-group">
                    <label for="addNIKGuru" class="col-form-label">Silahkan Cari NIK Guru</label>
                    <select class="form-control select2" name="addNIKGuru" id="addNIKGuru">
                      <option value="">Tulis NIK / Nama Guru</option>
                      <?php
                      foreach ($guruAll as $guru) {
                        echo '<option value="'.$guru->id.'">'.$guru->nik.' / '. $guru->teacher_name .'</option>';
                      }
                      ;?>
                    </select>
                  </div>
                  <!-- / NIK -->

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaFullnameGuru" class="col-form-label">Nama Guru</label>
                    <input type="text" name="fullnameGuru" class="form-control" id="addPenggunaFullnameGuru" placeholder="Nama Guru" readonly/>
                    <?= form_error('fullnameGuru', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaEmailGuru" class="col-form-label">Email</label>
                    <input type="text" name="emailGuru" class="form-control" id="addPenggunaEmailGuru" placeholder="Email" value="<?= set_value('email')?>" />
                    <?= form_error('emailGuru', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->
                  <!-- Username -->
                  <div class="form-group">
                    <label for="addPenggunaUsernameGuru" class="col-form-label">Username</label>
                    <input type="text" name="usernameGuru" class="form-control" id="addPenggunaUsernameGuru" placeholder="Username" value="<?= set_value('username')?>" readonly/>
                    <?= form_error('usernameGuru', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Username -->

                  <!-- Password -->
                  <div class="form-group">
                    <label for="addPenggunaPasswordGuru" class="col-form-label">Password</label>
                    <input type="text" name="passwordGuru" class="form-control" id="addPenggunaPasswordGuru" placeholder="Password" value="<?= set_value('password')?>" />
                    <?= form_error('passwordGuru', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Password -->

                </div>

                <div id=addPenggunaWali style="display: none">

                  <!-- NISN -->
                  <div class="form-group">
                    <label for="addNISNWali" class="col-form-label">Silahkan Cari NISN Siswa</label>
                    <select class="form-control select2" name="addNISNWali" id="addNISNWali">
                      <option value="">Tulis NISN / Nama Siswa</option>
                      <?php
                      foreach ($siswaAll as $siswa) {
                        echo '<option value="'.$siswa->id.'">'.$siswa->nisn.' / '. $siswa->std_name .'</option>';
                      }
                      ;?>
                    </select>
                  </div>
                  <!-- / NISN -->

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaFullnameWali" class="col-form-label">Fullname</label>
                    <input type="text" name="fullnameWali" class="form-control" id="addPenggunaFullnameWali" placeholder="Fullname" readonly/>
                    <?= form_error('fullnameWali', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaEmailWali" class="col-form-label">Email</label>
                    <input type="text" name="emailWali" class="form-control" id="addPenggunaEmailWali" placeholder="Email" value="<?= set_value('email')?>" />
                    <?= form_error('emailWali', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->
                  <!-- Username -->
                  <div class="form-group">
                    <label for="addPenggunaUsernameWali" class="col-form-label">Username</label>
                    <input type="text" name="usernameWali" class="form-control" id="addPenggunaUsernameWali" placeholder="Username" value="<?= set_value('username')?>" readonly/>
                    <?= form_error('usernameWali', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Username -->

                  <!-- Password -->
                  <div class="form-group">
                    <label for="addPenggunaPasswordWali" class="col-form-label">Password</label>
                    <input type="text" name="passwordWali" class="form-control" id="addPenggunaPasswordWali" placeholder="Password" value="<?= set_value('password')?>" />
                    <?= form_error('passwordWali', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Password -->

                </div>

                <div id=addPenggunaSiswa style="display: none">

                  <!-- NISN -->
                  <div class="form-group">
                    <label for="addNISNSiswa" class="col-form-label">Silahkan Cari NISN Siswa</label>
                    <select class="form-control select2" name="addNISNSiswa" id="addNISNSiswa">
                      <option value="">Tulis NISN / Nama Siswa</option>
                      <?php
                      foreach ($siswaAll as $siswa) {
                        echo '<option value="'.$siswa->id.'">'.$siswa->nisn.' / '. $siswa->std_name .'</option>';
                      }
                      ;?>
                    </select>
                  </div>
                  <!-- / NISN -->

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaFullnameSiswa" class="col-form-label">Fullname</label>
                    <input type="text" name="fullnameSiswa" class="form-control" id="addPenggunaFullnameSiswa" placeholder="Fullname" readonly/>
                    <?= form_error('fullnameSiswa', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->

                  <!-- Fullname -->
                  <div class="form-group">
                    <label for="addPenggunaEmailSiswa" class="col-form-label">Email</label>
                    <input type="text" name="emailSiswa" class="form-control" id="addPenggunaEmailSiswa" placeholder="Email" value="<?= set_value('email')?>" />
                    <?= form_error('emailSiswa', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Fullname -->
                  <!-- Username -->
                  <div class="form-group">
                    <label for="addPenggunaUsernameSiswa" class="col-form-label">Username</label>
                    <input type="text" name="usernameSiswa" class="form-control" id="addPenggunaUsernameSiswa" placeholder="Username" value="<?= set_value('username')?>" readonly/>
                    <?= form_error('usernameSiswa', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Username -->

                  <!-- Password -->
                  <div class="form-group">
                    <label for="addPenggunaPasswordSiswa" class="col-form-label">Password</label>
                    <input type="text" name="passwordSiswa" class="form-control" id="addPenggunaPasswordSiswa" placeholder="Password" value="<?= set_value('password')?>" />
                    <?= form_error('passwordSiswa', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / Password -->

                </div>

                <div class="form-group text-right">
                  <a class="btn btn-danger btn-sm" href="<?= base_url('admin/pengaturanPenggunaAdd');?>"><i class="fa fa-undo"></i>&ensp;Reset</a>
                  <button type="submit" class="btn btn-primary btn-sm ">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
                </div> 

              </form>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>


        <div class="col-sm-4">

          <!-- Default box -->
          <div class="card card-outline card-info">
            <div class="card-header">
              <h4 class="card-title " text-align="center"><strong>List Level</strong></h4>
              <div class="card-tools">
                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <ol>
                <li><b>Admin</b></li>
                <p>Untuk Level Admin Bisa Memasukkan Username Yang Diingkan</p>
                <li><b>Guru</b></li>
                <p>Untuk Level Guru Silahkan Mencari berdasarkan NIK<br> <b>Contoh</b> guru12345</p>
                <li><b>Wali</b></li>
                <p>Untuk Level Wali Silahkan Mencari berdasarkan NISN Siswa<br> <b>Contoh</b> wali12345</p>
                <li><b>Siswa</b></li>
                <p>Untuk Level Siswa Silahkan Mencari berdasarkan NISN Siswa<br> <b>Contoh</b> siswa12345</p>
              </ol>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>

      </div>


    </div>
    <!-- /.Container Fluid -->
  </section>
  <!-- /.content -->

</div>
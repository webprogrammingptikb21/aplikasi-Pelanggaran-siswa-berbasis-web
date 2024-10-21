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
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/pengaturanPenggunaEdit/'.$this->encrypt->encode($oneUsers->id));?>"><small><?= $page ;?></small></a></li>
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
            <div class="container-fluid col-sm-8">
              <!-- Default box -->
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
                  <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('admin/pengaturanPengguna');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                </div>
                <div class="card-body">

                  <form action="<?= base_url('admin/pengaturanPenggunaEdit/'.$this->encrypt->encode($oneUsers->id))?>" method="post">

                    <input type="hidden" name="z" value="<?= $oneUsers->id ;?>">

                    <!-- Fullname -->
                    <div class="form-group">
                      <label for="editPenggunaFullname" class="col-form-label">Fullname</label>
                      <input type="text" name="fullname" class="form-control" id="editPenggunaFullname" placeholder="Fullname" value="<?= $oneUsers->full_name?>" />
                      <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Fullname -->

                    <!-- Fullname -->
                    <div class="form-group">
                      <label for="editPenggunaEmail" class="col-form-label">Email</label>
                      <input type="text" name="email" class="form-control" id="editPenggunaEmail" placeholder="Email" value="<?= $oneUsers->email; ?>"/>
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Fullname -->
                    
                    <!-- Username -->
                    <div class="form-group">
                      <label for="editPenggunaUsername" class="col-form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="editPenggunaUsername" placeholder="Username" value="<?= $oneUsers->username?>" />
                      <?= form_error('username', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Username -->

                    <!-- Username -->
                    <div class="form-group">
                      <label for="editPenggunaUsername" class="col-form-label">Password</label>
                      <input type="text" name="password" class="form-control" id="editPenggunaUsername" placeholder="Password" value="<?= set_value('password')?>" />
                      <p class="text-danger">*Catatan : Kosongkan Jika Tidak Diubah</p>
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Password -->



                    <!-- Level -->
                    <div class="form-group">
                      <label for="detailPenggunaLevel" class="col-form-label">Level</label>
                      <select class="form-control select2" name="level" id="addPenggunaLevel">

                        <?php 
                        if($oneUsers->level == 'Admin'){
                          $output ='
                          <option value="Admin" selected>Admin</option>
                          <option value="Guru">Guru</option>
                          <option value="Wali">Wali</option>
                          <option value="Siswa">Siswa</option>
                          ';
                        }elseif($oneUsers->level == 'Guru'){
                          $output .='
                          <option value="Admin">Admin</option>
                          <option value="Guru" selected>Guru</option>
                          <option value="Wali">Wali</option>
                          <option value="Siswa">Siswa</option>
                          ';
                        }elseif($oneUsers->level == 'Wali'){
                          $output .='
                          <option value="Admin">Admin</option>
                          <option value="Guru">Guru</option>
                          <option value="Wali" selected>Wali</option>
                          <option value="Siswa">Siswa</option>
                          ';
                        }elseif($oneUsers->level == 'Siswa'){
                          $output .='
                          <option value="Admin">Admin</option>
                          <option value="Guru">Guru</option>
                          <option value="Wali">Wali</option>
                          <option value="Siswa" selected>Siswa</option>
                          ';
                        };
                        echo $output;
                        ;?>
                      </select>
                      <?= form_error('level', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Level -->

                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-warning btn-sm" ><i class="fa fa-edit"></i>&ensp;Edit</button>
                    </div> 

                  </form>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.Container Fluid -->
          </section>
          <!-- /.content -->

        </div>
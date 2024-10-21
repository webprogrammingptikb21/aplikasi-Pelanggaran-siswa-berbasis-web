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
                <li class="breadcrumb-item"><small><?= $this->session->userdata('level') ;?></small></li>
                <li class="breadcrumb-item"><a href="<?= base_url('Guru/Profile')?>"><small><?= $page ;?></small></a></li>
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
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">

                    <?php
                    if(file_exists('assets/sips/img/guru/'.$user->username.'.png')) : ?>

                      <img class="profile-user-img img-fluid img-circle"
                      src="<?= base_url('assets/sips/img/guru/'.$user->username.'.png');?>"
                      alt="User profile picture">

                      <?php else :?>

                        <img class="profile-user-img img-fluid img-circle"
                        src="<?= base_url('assets/sips/img/guru/default.jpg');?>"
                        alt="User profile picture">

                      <?php endif ;?>

                    </div>

                    <h3 class="profile-username text-center"><?= $user->username?></h3>

                    <p class="text-muted text-center"><?= $user->level?></p>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#detailProfile" data-toggle="tab">Detail Profile</a></li>
                      <li class="nav-item"><a class="nav-link" href="#EditProfile" data-toggle="tab">Update Profile</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="detailProfile">
                        <form>
                          <div class="form-group row">
                            <label for="profileUsername" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control" id="profileUsername" value="<?php echo $user->username; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="profileUserFullname" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control" id="profileUserFullname" value="<?php echo $user->full_name; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="profileUserEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control" id="profileUserEmail" value="<?php echo $user->email; ?>">
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="EditProfile">
                       <?php echo form_open_multipart('guru/editprofile');?>
                       <input type="hidden" name="z" readonly value="<?php echo $user->id;?>"  class="form-control" >
                       <div class="form-group row">
                        <label for="inputProfileUsrename" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputProfileUsrename" value="<?php echo $user->username?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputProfileFullname" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="fullname" class="form-control" id="inputProfileFullname" value="<?php echo $user->full_name?>">
                          <?php echo form_error('fullname', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputProfilEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" name="email" class="form-control" id="inputProfilEmail" placeholder="Email" value="<?php echo $user->email; ?>">
                          <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-2">
                         <label for="inputProfilAddress"  class="col-form-label">Picture</label>
                       </div>
                       <div class="col-sm-10">
                        <div class="row">
                          <div class="col-sm-3">
                            <?php
                            if(file_exists('assets/sips/img/guru/'.$user->username.'.png')) : ?>

                              <img class="img-thumbnail"
                              src="<?= base_url('assets/sips/img/guru/'.$user->username.'.png');?>"
                              alt="User profile picture">

                              <?php else :?>

                                <img class="img-thumbnail"
                                src="<?= base_url('assets/sips/img/guru/default.jpg');?>"
                                alt="User profile picture">

                              <?php endif ;?>
                            </div>
                            <div class="col-sm-9">
                              <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-warning btn-sm float-left"><i class="fas fa-edit"></i>&ensp;Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="<?= base_url('Admin/changepassword');?>" method="post">
                      <input type="hidden" name="dd" readonly value="<?= $user->id;?>"  class="form-control" >
                      <div class="form-group row">
                        <label for="inputNewPass" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-6">
                          <input type="password" name="bb" class="form-control" id="inputNewPass" placeholder="New Password">
                          <?php echo form_error('bb', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputRepeatPass" class="col-sm-3 col-form-label">Repeat Password</label>
                        <div class="col-sm-6">
                          <input type="password" name="cc" class="form-control" id="inputRepeatPass" placeholder="Repeat Password">
                          <?php echo form_error('cc', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-3 col-sm-10">
                          <button type="submit" class="btn btn-danger btn-sm">Change</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
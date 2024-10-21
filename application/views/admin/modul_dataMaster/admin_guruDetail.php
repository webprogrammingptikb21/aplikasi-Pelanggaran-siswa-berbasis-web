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
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dataMasterGuru');?>"><small><?= $parent ;?></small></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dataMasterGuruDetail/'.$this->encrypt->encode($oneGuru->id));?>"><small><?= $page ;?></small></a></li>
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
                  <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('admin/dataMasterGuru');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                </div>
                <div class="card-body">

                  <form action="<?= base_url('admin/dataMasterGuruAdd')?>" method="post">

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailGuruNIK">NIK</label>
                      <input name="nik" id="detailGuruNIK" type="text" placeholder="NIK" class="form-control" value="<?= $oneGuru->nik ;?>" readonly>
                      <?= form_error('nik', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailGuruNama">Nama Guru</label>
                      <input name="nama" id="detailGuruNama" type="text" placeholder="Nama Guru" class="form-control" value="<?= $oneGuru->teacher_name ;?>" readonly>
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->
                    
                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailGuruMapel">Mata Pelajaran</label>
                      <input name="mapel" id="detailGuruMapel" type="text" placeholder="Mata Pelajaran" class="form-control" value="<?= $oneGuru->subject ;?>" readonly>
                      <?= form_error('mapel', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group text-right">
                      <a class="btn btn-warning btn-sm" href="<?= base_url('admin/dataMasterGuruEdit/'.$this->encrypt->encode($oneGuru->id));?>"><i class="fa fa-edit"></i>&ensp;Edit</a>
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
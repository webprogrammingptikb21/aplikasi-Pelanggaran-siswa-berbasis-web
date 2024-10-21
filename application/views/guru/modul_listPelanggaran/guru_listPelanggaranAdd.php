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
                    <li class="breadcrumb-item"><small><?= $this->session->userdata('level');?></small></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('Guru/listPelanggaran');?>"><small><?= $parent ;?></small></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('Guru/listPelanggaranAdd');?>"><small><?= $page ;?></small></a></li>
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
                  <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('Guru/listPelanggaran');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                </div>
                <div class="card-body">

                  <form action="<?= base_url('Guru/listPelanggaranAdd')?>" method="post">
                    <div class="row ">

                      <div class="col-md-6">

                        <!-- form-group -->
                        <div class="form-group">
                          <label for="kelas">Kategori Kelas</label>
                          <select id="kelas" name="kelas" class="form-control select2" style="width: 100%;">
                            <option value="I" selected="selected">Pilih Kategori Kelas</option>
                            <option value="X">10</option>
                            <option value="XI">11</option>
                            <option value="XII">12</option>
                          </select>
                          <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- /.form-group -->

                      </div>
                      <div class="col-md-6">

                        <!-- form-group -->
                        <div class="form-group">
                          <label for="namaKelas">Nama Kelas</label>
                          <select id="namaKelas" name="namaKelas" class="form-control select2" style="width: 100%;">
                            <option value="0" selected="selected">Pilih Kategori Kelas Terlebih Dahulu</option>
                          </select>
                          <?= form_error('namaKelas', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- /.form-group -->

                      </div>

                    </div>
                    <!-- /.row -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="namaSiswa">Nama Siswa</label>
                      <select id="namaSiswa" name="namaSiswa" class="form-control select2" style="width: 100%;">
                        <option selected="selected">Pilih Kategori Kelas Terlebih Dahulu</option>
                      </select>
                      <?= form_error('namaSiswa', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- Pelapor -->
                    <div class="form-group">
                      <label for="pelapor" class="col-form-label">Pelapor</label>
                      <select name="pelapor" id="pelapor" class="form-control select2" style="width: 100%;" >
                        <option value="" selected>Pilih Salah Satu</option>
                        <?php
                        foreach ($guruAll as $guru) {
                          echo '<option value="'.$guru->id.'">'.$guru->teacher_name.'</option>';
                        }
                        ;?>
                      </select>
                      <?= form_error('pelapor', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Pelapor -->

                    <!-- Kategori Pelanggaran -->
                    <div class="form-group">
                      <label for="pelanggaran" class="col-form-label">Kategori Pelanggaran</label>
                      <select name="pelanggaran" id="pelanggaran" class="form-control select2" style="width: 100%;" >
                        <option value="" selected>Pilih Salah Satu</option>
                        <?php
                        foreach ($pelanggaranAll as $pel) {
                          echo '<option value="'.$pel->id.'">'.$pel->violation_name.'</option>';
                        }
                        ;?>
                      </select>
                      <?= form_error('pelanggaran', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Kategori Pelanggaran -->

                    <!-- Catatan -->
                    <div class="form-group">
                      <label for="catatan" class="col-form-label">Catatan</label>
                      <textarea type="text" name="catatan" class="form-control" id="catatan" placeholder="Catatan"><?= set_value('catatan')?></textarea>
                      <?= form_error('catatan', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Catatan -->

                    <div class="form-group text-right">
                      <a class="btn btn-danger btn-sm" href="<?= base_url('Guru/listPelanggaranAdd');?>"><i class="fa fa-undo"></i>&ensp;Reset</a>
                      <button type="submit" class="btn btn-primary btn-sm ">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
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
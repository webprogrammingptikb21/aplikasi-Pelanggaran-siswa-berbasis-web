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
                    <li class="breadcrumb-item"><a href="<?= base_url('Siswa/listPelanggaran');?>"><small><?= $parent ;?></small></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('Siswa/listPelanggaranDetail');?>"><small><?= $page ;?></small></a></li>
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
                  <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('Siswa/listPelanggaran');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                </div>
                <div class="card-body">

                  <form action="#" method="post">
                    <div class="row ">

                      <div class="col-md-6">

                        <!-- form-group -->
                        <div class="form-group">
                          <label for="kelas">Kategori Kelas</label>
                          <?php if($onepel->sub_class == 'XII') {
                            echo '<input type="text" class="form-control" id="kelas" placeholder="Kategori Kelas" value="12" readonly>';
                          }elseif($onepel->sub_class == 'XI'){
                            echo '<input type="text" class="form-control" id="kelas" placeholder="Kategori Kelas" value="11" readonly>';
                          }else{
                            echo '<input type="text" class="form-control" id="kelas" placeholder="Kategori Kelas" value="10" readonly>';
                          };?>
                        </div>
                        <!-- /.form-group -->

                      </div>
                      <div class="col-md-6">

                        <!-- form-group -->
                        <div class="form-group">
                          <label for="namaKelas">Nama Kelas</label>
                          <input type="text" class="form-control" id="kelas" placeholder="Nama Kelas" value="<?= $onepel->class_name?>" readonly>
                        </div>
                        <!-- /.form-group -->

                      </div>

                    </div>
                    <!-- /.row -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="namaSiswa">Nama Siswa</label>
                      <input type="text" class="form-control" id="namaSiswa" placeholder="Nama Siswa" value="<?= $onepel->std_name?>" readonly>
                    </div>
                    <!-- /.form-group -->
                    <!-- form-group -->
                    <div class="form-group">
                      <label for="namaSiswa">Nama Wali Siswa</label>
                      <input type="text" class="form-control" id="namaSiswa" placeholder="Nama Siswa" value="<?= $onepel->parent_name?>" readonly>
                    </div>
                    <!-- /.form-group -->

                    <!-- Pelapor -->
                    <div class="form-group">
                      <label for="pelapor" class="col-form-label">Pelapor</label>
                      <input type="text" class="form-control" id="pelapor" placeholder="pelapor" value="<?= $onepel->teacher_name?>" readonly>
                    </div>
                    <!-- / Pelapor -->

                    <!-- Kategori Pelanggaran -->
                    <div class="form-group">
                      <label for="pelanggaran" class="col-form-label">Kategori Pelanggaran</label>
                      <input type="text" class="form-control" id="pelanggaran" placeholder="Kategori Pelanggaran" value="<?= $onepel->violation_name?>" readonly>
                    </div>
                    <!-- / Kategori Pelanggaran -->

                    <!-- point Pelanggaran -->
                    <div class="form-group">
                      <label for="pelanggaran" class="col-form-label">Point Pelanggaran</label>
                      <input type="text" class="form-control" id="pelanggaran" placeholder="Point Pelanggaran" value="<?= $onepel->get_point?>" readonly>
                    </div>
                    <!-- / point Pelanggaran -->

                    <!-- Catatan -->
                    <div class="form-group">
                      <label for="catatan" class="col-form-label">Catatan</label>
                      <textarea type="text" name="catatan" class="form-control" id="catatan" placeholder="Catatan" readonly><?= $onepel->note?></textarea>
                      <?= form_error('catatan', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Catatan -->

                    <!-- Di Laporankan Pada -->
                    <div class="form-group">
                      <label for="laporkanPada" class="col-form-label">Di Laporankan Pada</label>
                      <input type="text" class="form-control" id="laporkanPada" placeholder="Di Laporankan Pada" value="<?= date('d F Y H:i:s', strtotime($onepel->reported_on))?>" readonly>
                    </div>
                    <!-- / Di Laporankan Pada -->

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
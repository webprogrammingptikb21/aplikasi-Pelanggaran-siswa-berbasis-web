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
                    <li class="breadcrumb-item"><a href="<?= base_url('Admin/dataMasterSiswa');?>"><small><?= $parent ;?></small></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('Admin/dataMasterSiswaDetail/'.$this->encrypt->encode($oneSiswa->id_siswa));?>"><small><?= $page ;?></small></a></li>
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
                  <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('Admin/dataMasterSiswa');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                </div>
                <div class="card-body">

                  <form action="#" method="post">

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailSiswaNISN">NISN</label>
                      <input name="nisn" id="detailSiswaNISN" type="text" placeholder="NISN" class="form-control" value="<?= $oneSiswa->nisn ;?>"  readonly>
                      <?= form_error('nisn', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->
                    
                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailSiswaNama">Nama Siswa</label>
                      <input name="nama" id="detailSiswaNama" type="text" placeholder="Nama Siswa" class="form-control" value="<?= $oneSiswa->std_name ;?>" readonly>
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailSiswaWali">Orang Tua / Wali</label>
                      <input name="wali" id="detailSiswaWali" type="text" placeholder="Orang Tua / Wali" class="form-control" value="<?= $oneSiswa->parent_name ;?>" readonly>
                      <?= form_error('wali', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <div class="row">

                      <div class="col-sm-6">

                        <!-- form-group -->
                        <div class="form-group">
                          <label for="addkelas">Kategori Kelas</label>
                          <?php if($oneSiswa->sub_class == 'XII') {
                            echo '<input type="text" class="form-control" id="kelas" placeholder="Kategori Kelas" value="12" readonly>';
                          }elseif($oneSiswa->sub_class == 'XI'){
                            echo '<input type="text" class="form-control" id="kelas" placeholder="Kategori Kelas" value="11" readonly>';
                          }else{
                            echo '<input type="text" class="form-control" id="kelas" placeholder="Kategori Kelas" value="10" readonly>';
                          };?>
                          <?= form_error('addkelas', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- /.form-group -->
                        
                      </div>

                      <div class="col-sm-6">

                        <!-- form-group -->
                        <div class="form-group">
                          <label for="addnamaKelas">Nama Kelas</label>
                          <input type="text" class="form-control" id="addnamaKelas" placeholder="Nama Kelas" value="<?= $oneSiswa->class_name?>" readonly>
                          <?= form_error('addnamaKelas', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- /.form-group -->

                      </div>
                      
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                      <label for="detailSiswaAlamat" class="col-form-label">Alamat</label>
                      <textarea type="text" name="alamat" id="detailSiswaAlamat" class="form-control" placeholder="Alamat"readonly><?= $oneSiswa->address ;?></textarea>
                      <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Alamat -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailSiswaTelepon">Nomor  HP</label>
                      <input name="telepon" id="detailSiswaTelepon" type="text" class="form-control" placeholder="Nomer HP Yang Bisa Di Hubungi(Utamakan Nomer HP Orang Tua)" value="<?= $oneSiswa->phone_number_wali ;?>" readonly>
                      <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group text-right">
                      <a class="btn btn-warning btn-sm" href="<?= base_url('Admin/dataMasterSiswaEdit/'.$this->encrypt->encode($oneSiswa->id_siswa));?>"><i class="fa fa-edit"></i>&ensp;Edit</a>
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
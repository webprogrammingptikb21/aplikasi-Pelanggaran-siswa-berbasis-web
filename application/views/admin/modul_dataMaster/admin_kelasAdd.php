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
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dataMasterKelas');?>"><small><?= $parent ;?></small></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dataMasterKelasAdd');?>"><small><?= $page ;?></small></a></li>
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
                  <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('admin/dataMasterKelas');?>">
                    <i class="fas fa-arrow-left"></i>&ensp;Back
                  </a>
                </div>
                <div class="card-body">

                  <form action="<?= base_url('admin/dataMasterKelasAdd')?>" method="post">

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasKelas">Kelas</label>
                      <select id="addKelasKelas" name="kelas" class="form-control select2" style="width: 100%;">
                        <option value="" selected="selected">Pilih Kategori Kelas</option>
                        <option value="X">10</option>
                        <option value="XI">11</option>
                        <option value="XII">12</option>
                      </select>
                      <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasNama">Nama Kelas</label>
                      <input name="nama" id="addKelasNama" type="text" placeholder="Contoh Nama Kelas : XII-RPL-1" class="form-control" value="<?= set_value('nama') ;?>" >
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->
                    
                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasMurid">Jumlah Murid</label>
                      <input name="jumlah" id="addKelasMurid" type="text" placeholder="Jumlah Murid" class="form-control" value="<?= set_value('jumlah') ;?>">
                      <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasWali">Wali Kelas</label>
                      <select id="addKelasWali" name="wali" class="form-control select2">
                        <option value="" selected="selected">Pilih Wali Kelas</option>
                        <?php 
                        foreach ($guruAll as $wali) {
                          echo '<option value="'.$wali->teacher_name.'">'.$wali->teacher_name.'</option>';
                        }
                        ;?>
                      </select>
                      <?= form_error('wali', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group text-right">
                      <a class="btn btn-danger btn-sm" href="<?= base_url('admin/dataMasterKelasAdd');?>"><i class="fa fa-undo"></i>&ensp;Reset</a>
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

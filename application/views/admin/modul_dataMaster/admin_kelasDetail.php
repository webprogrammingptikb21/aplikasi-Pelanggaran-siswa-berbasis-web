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
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dataMasterKelasDetail/'.$this->encrypt->encode($oneKelas->id));?>"><small><?= $page ;?></small></a></li>
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
                      <label for="detailKelasKelas">Kelas</label>
                      <input name="nama" id="detailKelasKelas" type="text" placeholder="Kelas" class="form-control" value="<?= $oneKelas->sub_class ;?>" readonly>
                      <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailKelasNama">Nama Kelas</label>
                      <input name="nama" id="detailKelasNama" type="text" placeholder="Contoh Nama Kelas : XII-RPL-1" class="form-control" value="<?= $oneKelas->class_name ;?>" readonly>
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->
                    
                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailKelasMurid">Jumlah Murid</label>
                      <input name="jumlah" id="detailKelasMurid" type="text" placeholder="Jumlah Murid" class="form-control" value="<?= $oneKelas->total_students ;?>" readonly>
                      <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="detailKelasWali">Wali Kelas</label>
                      <input name="wali" id="detailKelasWali" type="text" placeholder="Wali Kelas" class="form-control" value="<?= $oneKelas->wali_name ;?>" readonly>
                      <?= form_error('wali', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group text-right">
                      <a class="btn btn-warning btn-sm" href="<?= base_url('admin/dataMasterKelasEdit/'.$this->encrypt->encode($oneKelas->id));?>"><i class="fa fa-edit"></i>&ensp;Edit</a>

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

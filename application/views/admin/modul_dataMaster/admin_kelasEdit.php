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
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dataMasterKelasEdit/'.$this->encrypt->encode($oneKelas->id));?>"><small><?= $page ;?></small></a></li>
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

                  <form action="<?= base_url('admin/dataMasterKelasEdit/'.$this->encrypt->encode($oneKelas->id));?>" method="post">
                    
                    <input type="hidden" name="z" value="<?= $oneKelas->id ;?>">
                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasKelas">Kelas</label>
                      <select id="kelas" name="kelas" class="form-control select2" style="width: 100%;">
                        <?php if($oneKelas->sub_class == 'XII') {
                          $output .= '
                          <option value="I">Pilih Kategori Kelas</option>
                          <option value="X">X</option>
                          <option value="XI">XI</option>
                          <option value="XII" selected>XII</option>
                          ';
                        }elseif($oneKelas->sub_class == 'XI'){
                          $output .= '
                          <option value="I">Pilih Kategori Kelas</option>
                          <option value="X">X</option>
                          <option value="XI" selected>XI</option>
                          <option value="XII">XII</option>
                          ';
                        }else{
                          $output .= '
                          <option value="I">Pilih Kategori Kelas</option>
                          <option value="X"  selected>X</option>
                          <option value="XI">XI</option>
                          <option value="XII">XII</option>
                          ';
                        }
                        echo $output;
                        ?>
                      </select>
                      <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasNama">Nama Kelas</label>
                      <input name="nama" id="addKelasNama" type="text" placeholder="Contoh Nama Kelas : XII-RPL-1" class="form-control" value="<?= $oneKelas->class_name ;?>" >
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->
                    
                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasMurid">Jumlah Murid</label>
                      <input name="jumlah" id="addKelasMurid" type="text" placeholder="Jumlah Murid" class="form-control" value="<?= $oneKelas->total_students ;?>">
                      <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->

                    <!-- form-group -->
                    <div class="form-group">
                      <label for="addKelasWali">Wali Kelas</label>
                      <select class="form-control select2" id="addKelasWali" name="wali">
                        <?php foreach ($guruAll as $guru) {
                          if($oneKelas->wali_name == $guru->teacher_name){
                            echo '<option value="'.$guru->teacher_name.'" selected>'.$guru->teacher_name.'</option>';
                          }else{
                            echo '<option value="'.$guru->teacher_name.'">'.$guru->teacher_name.'</option>';
                            echo '<option value="'.$guru->teacher_name.'">'.$guru->teacher_name.'</option>';
                          }
                        } 
                        ;?>
                      </select>
                      <?= form_error('wali', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-warning btn-sm ">Update &ensp;<i class="fas fa-edit"></i></button>
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

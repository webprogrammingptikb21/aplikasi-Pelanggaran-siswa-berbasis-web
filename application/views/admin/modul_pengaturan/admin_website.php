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
                <li class="breadcrumb-item"><small><?= $user->username ;?></small></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/pengaturanWebsite')?>"><small><?= $page ;?></small></a></li>
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
            </div>
            <div class="card-body">

              <form action="<?= base_url('admin/pengaturanWebsite')?>" method="post">

                <input type="hidden" name="z" value="<?= $oneWeb->id ;?>">

                <!-- Fullname -->
                <div class="form-group">
                  <label for="editPenggunaFullname" class="col-form-label">Nama Sekolah</label>
                  <input type="text" name="sekolah" class="form-control" id="editPenggunaFullname" placeholder="Nama Sekolah" value="<?= $oneWeb->school_name?>" />
                  <?= form_error('sekolah', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <!-- / Fullname -->

                <!-- Fullname -->
                <div class="form-group">
                  <label for="editPenggunaEmail" class="col-form-label">Point</label>
                  <input type="text" name="point" class="form-control" id="editPenggunaEmail" placeholder="Point" value="<?= $oneWeb->point; ?>"/>
                  <p class="text-danger">*Catatan : Batas point, jika point siswa melebihi batas yang ditentukan, tombol print surat akan keluar</p>
                  <?= form_error('point', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <!-- / Fullname -->

                <div class="form-group text-right">
                  <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>&ensp;Update</button>
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
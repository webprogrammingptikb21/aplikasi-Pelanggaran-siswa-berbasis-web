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
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dataMasterGuru')?>"><small><?= $page ;?></small></a></li>
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
          <!-- Default box -->
          <div class="card card-outline card-info">
            <div class="card-header">
              <h4 class="card-title " text-align="center"><strong><?= $page; ?></strong></h4>
              <a class="btn btn-sm btn-outline-info float-right" href="<?= base_url('admin/dataMasterGuruAdd')?>" >
                <i class="fas fa-plus"></i> Add Data
              </a>
            </div>
            <div class="card-body">
              <!-- SEARCH FORM -->

              <div class="input-group ">
                <input class="form-control col-sm-12" name="seachKategoriPelanggaran" id="seachKategoriPelanggaran" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>

              <table id="myTable" class="table table-bordered table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama Guru</th>
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($guruAll as $guru) :  $i++;?>
                  <tr>
                    <td><?= $i ;?></td>
                    <td><?= $guru->nik;?></td>
                    <td><?= $guru->teacher_name ;?></td>
                    <td><?= $guru->subject ;?></td>
                    <td>
                      <a class="btn btn-sm btn-info" style="margin-right:10px; height: 30px; width: 30px;" href="<?= base_url('admin/dataMasterGuruDetail/'.$this->encrypt->encode($guru->id)) ;?>" title="Detail"><i class="fas fa-info"></i></a>
                      <a class="btn btn-sm btn-warning"  style="margin-right:10px; height: 30px; width: 30px;" href="<?= base_url('admin/dataMasterGuruEdit/'.$this->encrypt->encode($guru->id)) ;?>" title="Edit"><i class="fas fa-edit text-white"></i></a>
                      <a class="btn btn-sm btn-danger"style="margin-right:10px; height: 30px; width: 30px;" onclick=" deleteDataGuru(<?= $guru->id?>)" id="<?= $guru->id ;?>" title="Delete"><i class="fas fa-trash text-white"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
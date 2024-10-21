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
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dAdministrator')?>"><small><?= $page ;?></small></a></li>
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
          <!-- Main row -->
          <div class="row">
            <div class="col-12">
              <div class="callout callout-danger">
                <h5><i class="fas fa-info"></i> Note:</h5>
                <text class="text-danger"><b>Jika Siswa Melebihi Batas Point dari database Maka Akan Diberi Surat Teguran!!!</b></text>
              </div>
            </div>
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title h5">
                    <i class="far fa-list-alt"></i>
                    Top Pelanggaran
                  </h5>
                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="terbanyak" class="table table-bordered table-striped display nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pelanggaran</th>
                        <th scope="col">Total Pelanggaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=0; foreach($pelanggaran as $terbanyak) :  $i++;?>
                      <tr>
                        <td><?= $i ;?></td>
                        <td><?= $terbanyak->violation_name ;?></td>
                        <td><?= $terbanyak->total_pelanggaran ;?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-list-alt"></i>
                  Top Siswa
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="terakhir" class="table table-bordered table-striped display nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama Siswa</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach($murid as $terakhir) :  $i++;?>
                    <tr>
                      <td><?= $i ;?></td>
                      <td><?= $terakhir->std_name ;?></td>
                      <td><?= $terakhir->total_poin ;?> Dari <?= $terakhir->total_pelanggaran ;?> Pelanggaran</td>
                      <td class="text-center">
                        <a href="<?= base_url('Guru/dashboardDetail/'.$this->encrypt->encode($terakhir->id_siswa).'')?>" title="Detail"><i class="fas fa-info-circle text-info"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->


        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>

</div>
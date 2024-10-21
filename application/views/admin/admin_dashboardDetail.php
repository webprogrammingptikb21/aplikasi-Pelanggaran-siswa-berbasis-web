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
                <li class="breadcrumb-item"><a href="<?= base_url('Admin/dashboardDetail/'.$this->encrypt->encode($onePelanggaranAll->id_siswa).'')?>"><small><?= $page ;?></small></a></li>
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

      <section class="content">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-list-alt"></i>
              <?= $page;?>
            </h3>
            <a class="btn btn-secondary btn-sm float-right" href="<?php echo base_url('Admin');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Back
            </a>
          </div><!-- /.card-header -->
          <div class="card-body ">
            <table id="a" class="table table-bordered table-striped display nowrap" style="width:100%">
              <tr>
                <th colspan="3">Data Pelanggaran Yang Telah Dilakukan Siswa:</th>
              </tr>
              <tr>
                <td style="width: 200px;">NISN</td>
                <td style="width: 20px;">:</td>
                <td><?= $oneSiswa->nisn ;?></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $oneSiswa->std_name ;?></td>
              </tr>
              <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?= $oneSiswa->class_name ;?></td>
              </tr>
              <tr>
                <td>Nama Orang Tua / Wali</td>
                <td>:</td>
                <td><?= $oneSiswa->parent_name ;?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $oneSiswa->address ;?></td>
              </tr>
              <tr>
                <td>No Telp / HP</td>
                <td>:</td>
                <td><?= $oneSiswa->phone_number_wali ;?></td>
              </tr>
            </table>
            <br>
            <table id="b" class="table table-bordered table-striped display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Pelanggaran</th>
                  <th>Catatan</th>
                  <th>Di Laporakan Pada</th>
                  <th>Point Pelanggaran</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($pelanggaran as $pel) :  $i++;?>
                <tr>
                  <td><?= $i ;?></td>
                  <td><?= $pel->violation_name;?></td>
                  <td><?= $pel->note ;?></td>
                  <td><?= $pel->reported_on ;?></td>
                  <td><?= $pel->point ;?></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="2">Jumlah Pelanggaran Yang Telah Di Lakukan</td>
                <td><?= $pelanggaranTotal->total_pelanggaran ;?></td>
                <td >Jumlah Point</td>
                <td><?= $pelanggaranTotal->total_point ;?></td>
              </tr>
            </tbody>
          </table>
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>

  </div>
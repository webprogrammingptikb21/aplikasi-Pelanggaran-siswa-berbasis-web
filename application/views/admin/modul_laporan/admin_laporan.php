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
                <li class="breadcrumb-item"><a href="<?= base_url('admin/laporanAll')?>"><small><?= $page ;?></small></a></li>
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
          <div class="row">
            <div class="col-12">
              <div class="callout callout-danger">
                <h5><i class="fas fa-info"></i> Note:</h5>
                Silahkan Melengkapi Form Untuk Menampilkan Data yang di inginkan?>
              </div>
            </div>
            <!--/. Col -->
          </div>
          <!--/. Row -->
          <!-- Row Form Select Tabel -->
          <div class="row">
            <div class="col-md-9">
              <!-- general form elements -->
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <h3 class="card-title">Pilih Laporan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url('admin/laporanAll')?>" method="post">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="tipePencarian">Tipe Pencarian</label>
                      <select name="pencarian" id="tipePencarian" class="form-control">
                        <option value="">-- Pilih Tipe Pencarian --</option>
                        <option value="siswa">Pencarian Siswa</option>
                        <option value="kelas">Pencarian Kelas</option>
                      </select>
                      <?php echo form_error('pencarian', '<small class="text-danger pl-3">', '</small>');?>
                    </div>

                    <div class="form-group" id="pencarianSiswa" style="display: none;">
                      <label for="selectSiswalaporan">Nama Siswa</label>
                      <select name="siswa" id="selectSiswalaporan" class="form-control select2">
                        <option value="">-- Silahkan Mencari Berdasarkan NISN / Nama Siswa  --</option>
                        <?php
                        foreach ($siswaAll as $siswa) {

                          echo '<option value="'.$siswa->id.'">'.$siswa->nisn.' / '.$siswa->std_name.'</option>';

                        }
                        ;?>
                      </select>
                      <?php echo form_error('search', '<small class="text-danger pl-3">', '</small>');?>
                    </div>


                    <div class="form-group" id="pencarianKelas" style="display: none;">
                      <label for="selectKelaslaporan">Nama Kelas</label>
                      <select name="kelas" id="selectKelaslaporan" class="form-control select2">
                        <option value="">-- Silahkan Mencari Berdasarkan Nama Kelas  --</option>
                        <?php
                        foreach ($kelasAll as $kelas) {

                          echo '<option value="'.$kelas->id.'">'.$kelas->class_name.' </option>';

                        }
                        ;?>
                      </select>
                      <?php echo form_error('search', '<small class="text-danger pl-3">', '</small>');?>
                    </div>


                    <div class="form-group">
                      <label>Periode:</label>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" name="awal" class="form-control float-right" id="reservation">
                          </div>
                          <?php echo form_error('awal', '<small class="text-danger pl-3">', '</small>');?>
                          <!-- /.input group -->
                        </div>
                        <div class="col-md-2">
                          <p class="form-control text-center">S.D</p>
                        </div>
                        <div class="col-md-5">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" name="akhir" class="form-control float-right" id="akhir">
                          </div>
                          <?php echo form_error('akhir', '<small class="text-danger pl-3">', '</small>');?>
                          <!-- /.input group -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer justify-content-between">
                    <a class="btn btn-sm btn-danger" href="<?= base_url('admin/laporanAll')?>"><i class="fa fa-undo"></i>&ensp;Reset</a>
                    <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-check"></i>&ensp;Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>

            <div class="col-md-12">
              <?php 


              $siswa = $this->input->post('siswa');
              $kelas = $this->input->post('kelas');
              $dataSiswa = $this->admin_model->getOneSiswa($siswa);
              $dataKelas = $this->admin_model->getOneKelas($kelas);
              $awal = $this->input->post('awal');
              $akhir = $this->input->post('akhir');


              switch ($tipe) {

                case 'siswa':

                if($hasilOne == NULL){
                  $out ='
                  <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">
                  <i class="far fa-list-alt"></i>
                  Pelanggaran Siswa
                  </h3>';
                  $out .='
                  </div><!-- /.card-header -->
                  <div class="card-body ">
                  <table id="a" class="table table-bordered table-striped display nowrap" style="width:100%">
                  <tr>
                  <th colspan="3">Data Pelanggaran Yang Telah Dilakukan Siswa:</th>
                  </tr>
                  <tr>
                  <td style="width: 200px;">NISN</td>
                  <td style="width: 20px;">:</td>
                  <td>'.$dataSiswa->nisn.'</td>
                  </tr>
                  <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td>'.$dataSiswa->std_name.'</td>
                  </tr>
                  <tr>
                  <td>Kelas</td>
                  <td>:</td>
                  <td>'.$dataSiswa->class_name.'</td>
                  </tr>
                  <tr>
                  <td>Nama Orang Tua / Wali</td>
                  <td>:</td>
                  <td>'.$dataSiswa->parent_name.'</td>
                  </tr>
                  <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td>'.$dataSiswa->address.'</td>
                  </tr>
                  <tr>
                  <td>No Telp / HP</td>
                  <td>:</td>
                  <td>'.$dataSiswa->phone_number_wali.'</td>
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
                  <tbody>';

                  $out .='<tr >';
                  $out .='<td colspan="5" class"text-center">Siswa '.$dataSiswa->std_name.' Tersebut Belum Melakukan Pelanggaran</td>';
                  $out .='</tr>';

                  $out .='
                  <tr>
                  <td colspan="2">Jumlah Pelanggaran Yang Telah Di Lakukan</td>
                  <td>' .$hasilTotal->total_pelanggaran. '</td>
                  <td >Jumlah Point</td>
                  <td>' .$hasilTotal->total_point. '</td>
                  </tr>';
                  $out .='
                  </tbody>
                  </table>
                  </div><!-- /.card-body -->
                  </div>';

                }else{

                  $out ='
                  <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">
                  <i class="far fa-list-alt"></i>
                  Pelanggaran Siswa
                  </h3>';

                  $out .='
                  <div class="btn-group float-right">
                  <div class="row">
                  <form action="'. base_url('admin/laporanPdf').'" method="post" target="blank" >
                  <input type="hidden" readonly value="'.$tipe.'" name="pencarianPdf" class="form-control" >
                  <input type="hidden" readonly value ="'.$siswa.'" name="siswaPdf" class="form-control" >
                  <input type="hidden" readonly value ="'.$awal.'" name="awalPdf" class="form-control" >
                  <input type="hidden" readonly value ="'.$akhir.'" name="akhirPdf" class="form-control" >
                  <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
                  </form>
                  </div>
                  </div>';

                  $out .='
                  </div><!-- /.card-header -->
                  <div class="card-body ">
                  <table id="a" class="table table-bordered table-striped display nowrap" style="width:100%">
                  <tr>
                  <th colspan="3">Data Pelanggaran Yang Telah Dilakukan Siswa:</th>
                  </tr>
                  <tr>
                  <td style="width: 200px;">NISN</td>
                  <td style="width: 20px;">:</td>
                  <td>'.$hasilOne->nisn.'</td>
                  </tr>
                  <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td>'.$hasilOne->std_name.'</td>
                  </tr>
                  <tr>
                  <td>Kelas</td>
                  <td>:</td>
                  <td>'.$hasilOne->class_name.'</td>
                  </tr>
                  <tr>
                  <td>Nama Orang Tua / Wali</td>
                  <td>:</td>
                  <td>'.$hasilOne->parent_name.'</td>
                  </tr>
                  <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td>'.$hasilOne->address.'</td>
                  </tr>
                  <tr>
                  <td>No Telp / HP</td>
                  <td>:</td>
                  <td>'.$hasilOne->phone_number_wali.'</td>
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
                  <tbody>';

                  $i=0; 
                  foreach($hasilAll as $all): $i++;

                    $out .='<tr>';
                    $out .='<td>' .$i. '</td>';
                    $out .='<td>' .$all->violation_name. '</td>';
                    $out .='<td>' .$all->note. '</td>';
                    $out .='<td>' .date('d F Y', strtotime($all->reported_on)). '</td>';
                    $out .='<td>' .$all->point. '</td>';
                    $out .='</tr>';

                  endforeach;

                  $out .='
                  <tr>
                  <td colspan="2">Jumlah Pelanggaran Yang Telah Di Lakukan</td>
                  <td>' .$hasilTotal->total_pelanggaran. '</td>
                  <td >Jumlah Point</td>
                  <td>' .$hasilTotal->total_point. '</td>
                  </tr>';
                  $out .='
                  </tbody>
                  </table>
                  </div><!-- /.card-body -->
                  </div>';
                };
                break;

                case 'kelas':

                if($hasilOne == NULL){

                  $out ='
                  <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">
                  <i class="far fa-list-alt"></i>
                  Pelanggaran Siswa
                  </h3>';
                  $out .='
                  </div><!-- /.card-header -->
                  <div class="card-body ">
                  <table id="a" class="table table-bordered table-striped display nowrap" style="width:100%">
                  <tr>
                  <th colspan="3">Data Pelanggaran Yang Telah Dilakukan Siswa:</th>
                  </tr>
                  <tr>
                  <td style="width: 200px;">Kelas</td>
                  <td style="width: 20px;">:</td>
                  <td>'.$dataKelas->sub_class.'</td>
                  </tr>
                  <tr>
                  <td>Nama Kelas</td>
                  <td>:</td>
                  <td>'.$dataKelas->class_name.'</td>
                  </tr>
                  <tr>
                  <td>Wali Kelas</td>
                  <td>:</td>
                  <td>'.$dataKelas->wali_name.'</td>
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
                  <tbody>';

                  $out .='<tr >';
                  $out .='<td colspan="5" class"text-center">Siswa '.$dataKelas->class_name.' Tersebut Belum Melakukan Pelanggaran</td>';
                  $out .='</tr>';

                  $out .='
                  <tr>
                  <td colspan="2">Jumlah Pelanggaran Yang Telah Di Lakukan</td>
                  <td>' .$hasilTotal->total_pelanggaran. '</td>
                  <td >Jumlah Point</td>
                  <td>' .$hasilTotal->total_point. '</td>
                  </tr>';
                  $out .='
                  </tbody>
                  </table>
                  </div><!-- /.card-body -->
                  </div>';

                }else{

                  $out = '
                  <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">
                  <i class="far fa-list-alt"></i>
                  Kelas
                  </h3>';
                  $out .='
                  <div class="btn-group float-right">
                  <div class="row">
                  <form action="'. base_url('admin/laporanPdf').'" method="post" target="blank" >
                  <input type="hidden" readonly value="'.$tipe.'" name="pencarianPdf" class="form-control" >
                  <input type="hidden" readonly value ="'.$kelas.'" name="kelasPdf" class="form-control" >
                  <input type="hidden" readonly value ="'.$awal.'" name="awalPdf" class="form-control" >
                  <input type="hidden" readonly value ="'.$akhir.'" name="akhirPdf" class="form-control" >
                  <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
                  </form>
                  </div>
                  </div>';
                  $out .='
                  </div><!-- /.card-header -->
                  <div class="card-body ">
                  <table id="a" class="table table-bordered table-striped display nowrap" style="width:100%">
                  <tr>
                  <th colspan="3">Data Pelanggaran Yang Telah Dilakukan Siswa:</th>
                  </tr>
                  <tr>
                  <td style="width: 200px;">Kelas</td>
                  <td style="width: 20px;">:</td>
                  <td>'.$hasilOne->sub_class.'</td>
                  </tr>
                  <tr>
                  <td>Nama Kelas</td>
                  <td>:</td>
                  <td>'.$hasilOne->class_name.'</td>
                  </tr>
                  <tr>
                  <td>Wali Kelas</td>
                  <td>:</td>
                  <td>'.$hasilOne->wali_name.'</td>
                  </tr>
                  </table>
                  <br>
                  <table id="b" class="table table-bordered table-striped display nowrap" style="width:100%">
                  <thead>
                  <tr>
                  <th>#</th>
                  <th>Nama Siswa</th>
                  <th>Nama Pelanggaran</th>
                  <th>Catatan</th>
                  <th>Di Laporakan Pada</th>
                  <th>Point Pelanggaran</th>
                  </tr>
                  </thead>
                  <tbody>';
                  $i=0; 
                  foreach($hasilAll as $all): $i++;

                    $out .='<tr>';
                    $out .='<td>' .$i. '</td>';
                    $out .='<td>' .$all->std_name. '</td>';
                    $out .='<td>' .$all->violation_name. '</td>';
                    $out .='<td>' .$all->note. '</td>';
                    $out .='<td>' .date('d F Y', strtotime($all->reported_on)). '</td>';
                    $out .='<td>' .$all->point. '</td>';
                    $out .='</tr>';

                  endforeach;
                  $out .='
                  <tr>
                  <td colspan="2">Jumlah Pelanggaran Yang Telah Di Lakukan</td>
                  <td>' .$hasilTotal->total_pelanggaran. '</td>
                  <td colspan="2">Jumlah Point</td>
                  <td>' .$hasilTotal->total_point. '</td>
                  </tr>';
                  $out .='
                  </tbody>
                  </table>
                  </div><!-- /.card-body -->
                  </div>';
                };
                break;

                default:
                $out = '
                <div class="row">
                <div class="col-12">
                <div class="callout callout-danger">
                <h5><i class="fas fa-info"></i> Note:</h5>
                Silahkan Melengkapi Form Untuk Menampilkan Data yang di inginkan
                </div>
                </div>
                <!--/. Col -->
                </div>
                <!--/. Row -->
                ';
                break;

              };

              echo $out;
              ?>

            </div>
          </div>
          <!-- Default box -->

        </section>
        <!-- /.content -->
      </div>
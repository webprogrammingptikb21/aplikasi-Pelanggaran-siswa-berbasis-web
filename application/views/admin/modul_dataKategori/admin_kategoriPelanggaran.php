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
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dataKategoriKategoriPelanggaran')?>"><small><?= $page ;?></small></a></li>
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
              <a class="btn btn-sm btn-outline-info float-right" href="#" data-toggle="modal" data-target="#kategoriPelanggaranAdd">
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
                    <th scope="col">Nama Pelanggaran</th>
                    <th scope="col">Point Yang di Dapatkan</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($tipePelanggaran as $pel) :  $i++;?>
                  <tr id="<?= $pel->id; ?>">
                    <td><?= $i ;?></td>
                    <td><?= $pel->violation_name;?></td>
                    <td><?= $pel->get_point ;?></td>
                    <td>
                      <a class="btn btn-sm btn-info" style="margin-right:10px; height: 30px; width: 30px;" href="#" data-toggle="modal" data-target="#pelanggaranDetailModal<?= $pel->id;?>" title="Detail"><i class="fas fa-info"></i></a>
                      <a class="btn btn-sm btn-warning"  style="margin-right:10px; height: 30px; width: 30px;" href="#" data-toggle="modal" data-target="#pelanggaranEditModal<?= $pel->id;?>" title="Edit"><i class="fas fa-edit text-white"></i></a>
                      <a class="btn btn-sm btn-danger"style="margin-right:10px; height: 30px; width: 30px;" onclick=" deletePel(<?= $pel->id?>)" id="<?= $pel->id ;?>" title="Delete"><i class="fas fa-trash text-white"></i></a>
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

      <!-- Modal Add-->
      <div class="modal fade" id="kategoriPelanggaranAdd">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title">Add Kategori Pelanggaran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo base_url('admin/dataKategoriKategoriPelanggaranAdd'); ?>" method="post">
              <div class="modal-body">

                <div class="form-group">
                 <label  for="addNama">Nama Kategori Pelanggaran</label>
                 <input type="text" name="nama" class="form-control" id="addNama" placeholder="Nama Kategori Pelanggaran">
                 <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
               </div>

               <div class="form-group">
                 <label for="addPoint">Jumlah Point</label>
                 <input type="text" name="point" class="form-control" id="addPoint" placeholder="Jumlah Point">
                 <?php echo form_error('point', '<small class="text-danger pl-3">', '</small>');?>
               </div>

             </div>
             <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&ensp;Add</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal Detail-->
    <?php $i=0; foreach($tipePelanggaran as $pel) : $i++; ?>
    <div class="modal fade" id="pelanggaranDetailModal<?= $pel->id;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title">Detail Kategori Pelanggaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">

              <div class="form-group">
                <label id="detailNama">Nama Kategori Pelanggaran</label>
                <input type="text" readonly class="form-control" for="detailNama" placeholder="Nama Kategori Pelanggaran" value="<?= $pel->violation_name ;?>">
              </div>
              <div class="form-group">
                <label id="detailPoint">Jumlah Point</label>
                <input type="text" readonly class="form-control" for="detailPoint" placeholder="Jumlah Point" value="<?= $pel->get_point;?>">
              </div>

            </div>
            <div class="modal-footer" style='clear:both'>
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Close</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <?php endforeach; ?>

  <!-- Modal Edit-->
  <?php $i=0; foreach($tipePelanggaran as $pel) : $i++; ?>
  <div class="modal fade" id="pelanggaranEditModal<?= $pel->id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Edit Kategori Pelanggaran </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/dataKategoriKategoriPelanggaranEdit'); ?>" method="post">
          <div class="modal-body">

            <input type="hidden" name="z" readonly value="<?= $pel->id ;?>"  class="form-control" >

            <div class="form-group">
              <label id="editNama">Nama Kategori Pelanggaran</label>
              <input type="text" name="nama" class="form-control" for="editNama" value="<?= $pel->violation_name ;?>" placeholder="Nama Kategori Pelanggaran">
            </div>
            <div class="form-group">
              <label id="editPoint">Jumlah Point</label>
              <input type="text" name="point" class="form-control" for="editPoint" value="<?= $pel->get_point ;?>" placeholder="Jumlah Point">
            </div>

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Close</button>
            <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>&ensp;Update</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php endforeach; ?>
<!--End Modal -->


</section>
<!-- /.content -->

</div>
<!-- Barang Hapus Modal-->

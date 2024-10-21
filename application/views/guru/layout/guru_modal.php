  <!-- Logout Modal-->
  <div class="modal fade" id="logOutModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header card-outline">
          <h5 class="modal-title">Ready to Leave?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Select "Logout" below if you are ready to end your current session.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Close</button>
          <a class="btn btn-sm btn-danger" href="<?= base_url('home/logout') ;?>"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
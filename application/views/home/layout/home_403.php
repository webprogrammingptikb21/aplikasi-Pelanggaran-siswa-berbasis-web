<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $title;?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $title; ?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>"><small>Home</small></a></li>
              <li class="breadcrumb-item active"><small>Acces Forbidden</small></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">403</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Acces Forbidden.</h3>

          <p>
           It look you dont have permission to access that pages. <br>
           you may <a href="<?= base_url('home');?>">return to Home</a>
         </p>
       </div>
     </div>
     <!-- /.error-page -->

   </section>
   <!-- /.content -->

 </div>
 <!-- ./wrapper -->

 <!-- REQUIRED SCRIPTS -->
 <!-- jQuery -->
 <script src="<?php echo base_url('assets/AdminLTE-3.0.5/');?>plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap -->
 <script src="<?php echo base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="<?php echo base_url('assets/AdminLTE-3.0.5/');?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="<?php echo base_url('assets/AdminLTE-3.0.5/');?>dist/js/adminlte.js"></script>   


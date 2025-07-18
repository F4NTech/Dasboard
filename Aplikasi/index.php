<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('header.php');?>
<?php include ('../conf/config.php');?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php include ('preloader.php');?>

  <!-- Navbar -->
  <?php include ('navbar.php');?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php include ('logo.php');?>

    <!-- Sidebar -->
    <?php include ('sidebar.php');?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <?php include ('content_header.php');?>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php 
      if (!isset($_GET['page']) || $_GET['page'] == '' || $_GET['page'] == 'Dashboard-PLTS') {
          include('dashboard.php');
      } elseif ($_GET['page'] == 'Data-EPM') {
          include('data_epm.php');
      }elseif ($_GET['page'] == 'Data-KWH') {
          include('data_kwh.php');
      }else if($_GET['page']=='Data-Inverter'){
        include('data_inv.php');
      }
   
    // else if ($_GET['page']=='Data-kWh'){
    //   include('data_mahasiswa.php');
    // }
    
    // else if($_GET['page']=='Data-Pyrano'){
    //     include('data_pyn.php');
    // }
    // else if($_GET['page']=='laporan-invoice'){
    //     include('invoice.php');}
    ?> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include ('footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>
</html>



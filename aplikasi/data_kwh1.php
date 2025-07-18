<?php
include 'koneksi.php';  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data KWH</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
</head>

<section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data KWH</h3>
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form method="GET" class="form-inline">
                <span for="tanggal" class="mr-1">Tanggal:</span>
                <input type="date" name="tanggal" id="tanggal" class="form-control mr-2"
                    value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
                <!-- <button type="submit" class="btn btn-primary">Tampilkan</button> -->
                </form>
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Time</th>
                        <th>NAME</th>
                        <th>KWH V1</th>
                        <th>KWH V2</th>
                        <th>KWH V3</th>
                        <th>KWH V</th>
                        <th>KWH I1</th>
                        <th>KWH I2</th>
                        <th>KWH I3</th>
                        <th>KWH I</th>
                        <th>KWH P</th>
                        <th>KWH q</th>
                        <th>KWH S</th>
                        <th>KWH pF</th>
                        <th>KWH F</th>
                        <th>KWH Eimp</th>
                        <th>KWH Eexp</th>

                    </tr>
                </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>
            </div>
            
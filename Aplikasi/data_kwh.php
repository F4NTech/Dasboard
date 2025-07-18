    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data kWh Meter</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="GET" action="">
                   <div class="form-group">
                       <label for="tanggal">Pilih Tanggal:</label>
                     <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
                   </div>
                  <button type="submit" class="btn btn-primary mb-3">Tampilkan</button>
                </form>
                <table id="example1" class="table table-bordered table-striped">
                <!-- ... -->
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Time</th>
                    <th>name</th>
                    <th>i1</th>
                    <th>i2</th>
                    <th>i3</th>
                    <th>f</th>
                    <th>pf</th>
                    <th>v1</th>
                    <th>v2</th>
                    <th>v3</th>
                    <th>p</th>
                    <th>q</th>
                    <th>s</th>
                    <th>eimp</th>
                    <th>eexp</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
$no = 0;
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
$query = mysqli_query($koneksi, "SELECT * FROM acp_cosmaxs where name = 'EPM' AND DATE(dbtime) = '$tanggal' ORDER BY dbtime DESC");
if (mysqli_num_rows($query) > 0) {
  while($mhs = mysqli_fetch_array($query)){
    $no++;
?>
<tr>
  <td width='1%'><?php echo $no;?></td>
  <td><?php echo $mhs['dbtime'];?></td>
  <td><?php echo $mhs['name'];?></td>
  <td><?php echo $mhs['kwh_i1'];?></td>
  <td><?php echo $mhs['kwh_i2'];?></td>
  <td><?php echo $mhs['kwh_i3'];?></td>
  <td><?php echo $mhs['kwh_f'];?></td>
  <td><?php echo $mhs['kwh_pf'];?></td>
  <td><?php echo $mhs['kwh_v1'];?></td>
  <td><?php echo $mhs['kwh_v2'];?></td>
  <td><?php echo $mhs['kwh_v3'];?></td>
  <td><?php echo $mhs['kwh_p'];?></td>
  <td><?php echo $mhs['kwh_q'];?></td>
  <td><?php echo $mhs['kwh_s'];?></td>
  <td><?php echo $mhs['kwh_eimp'];?></td>
  <td><?php echo $mhs['kwh_eexp'];?></td>
</tr>
<?php
  } // <-- penutup while dipindah ke sini
} else {
  echo "<tr><td colspan='16'>Tidak ada data pada tanggal ini.</td></tr>";
}
?>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

 
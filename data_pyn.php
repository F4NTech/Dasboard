    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pyranometer</h3>
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
                    <th>solrad</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 0;
                    $query = mysqli_query($koneksi,"SELECT * FROM tb_pyn1");
                    while($mhs = mysqli_fetch_array($query)){
                      $no++;
                    ?>
                  <tr>
                    <td width='1%'><?php echo $no;?></td>
                    <td><?php echo $mhs['dbtime'];?></td>
                    <td><?php echo $mhs['solrad'];?></td>
                  </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
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

 
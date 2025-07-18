    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Inverter</h3>
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
                    <th>pv_event</th>
                    <th>pv_i1</th>
                    <th>pv_i2</th>
                    <th>pv_i3</th>
                    <th>pv_f</th>
                    <th>pv_pf</th>
                    <th>pv_v1</th>
                    <th>pv_v2</th>
                    <th>pv_v3</th>
                    <th>pv_p</th>
                    <th>pv_q</th>
                    <th>pv_s</th>
                    <th>pv_emonth</th>
                    <th>pv_eyear</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 0;
                    $query = mysqli_query($koneksi,"SELECT * FROM tb_inv");
                    while($mhs = mysqli_fetch_array($query)){
                      $no++;
                    ?>
                  <tr>
                    <td width='1%'><?php echo $no;?></td>
                    <td><?php echo $mhs['dbtime'];?></td>
                    <td><?php echo $mhs['pv_event'];?></td>
                    <td><?php echo $mhs['pv_i1'];?></td>
                    <td><?php echo $mhs['pv_i2'];?></td>
                    <td><?php echo $mhs['pv_i3'];?></td>
                    <td><?php echo $mhs['pv_f'];?></td>
                    <td><?php echo $mhs['pv_pf'];?></td>
                    <td><?php echo $mhs['pv_v1'];?></td>
                    <td><?php echo $mhs['pv_v2'];?></td>
                    <td><?php echo $mhs['pv_v3'];?></td>
                    <td><?php echo $mhs['pv_p'];?></td>
                    <td><?php echo $mhs['pv_q'];?></td>
                    <td><?php echo $mhs['pv_s'];?></td>
                    <td><?php echo $mhs['pv_emonth'];?></td>
                    <td><?php echo $mhs['pv_eyear'];?></td>
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

 
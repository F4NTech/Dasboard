    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data EPM</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="GET" action="">
                   <div class="form-group">
                      <input type="hidden" name="page" id="page" value="Data-EPM">
                       <label for="tanggal">Pilih Tanggal:</label>
                     <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
                     <button type="submit" class="btn btn-primary mb-3">Tampilkan</button>
                    </div>
                </form>
                <table id="example1" class="table table-bordered table-striped">
                <!-- ... -->
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Time</th>
                    <th>Load Power</th>
                    <th>Load Energy</th>
                  </tr>
                </thead>
                <tbody id="dataTableBody">
                  
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

    <script>
  document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formTanggal");
  const tanggalInput = document.getElementById("tanggal");
  const pageInput = document.getElementById("page");
  const tbody = document.getElementById("dataTableBody");

  function loadData(tanggal) {
    const page = pageInput.value || "Data-EPM";
    const newUrl = `index.php?page=${page}&tanggal=${tanggal}`;
    history.pushState({}, '', newUrl);

    fetch(`get_data_by_date.php?tanggal=${tanggal}`)
      .then(res => res.json())
      .then(data => {
        tbody.innerHTML = "";
        if (data.length === 0) {
          tbody.innerHTML = "<tr><td colspan='4'>Tidak ada data</td></tr>";
          return;
        }
        data.forEach((row, index) => {
          tbody.innerHTML += `
            <tr>
              <td>${index + 1}</td>
              <td>${row.dbtime}</td>
              <td>${row.load_power}</td>
              <td>${row.load_energy}</td>
            </tr>
          `;
        });
      })
      .catch(err => {
        tbody.innerHTML = "<tr><td colspan='4'>Gagal memuat data</td></tr>";
        console.error(err);
      });
  }

  // Load awal
  const urlParams = new URLSearchParams(window.location.search);
  const urlTanggal = urlParams.get("tanggal") || tanggalInput.value;
  tanggalInput.value = urlTanggal;
  loadData(urlTanggal);

  // Saat form disubmit
  form.addEventListener("submit", function () {
    loadData(tanggalInput.value);
  });
});

 
    </script>

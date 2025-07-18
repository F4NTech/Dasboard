<section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
    <!-- Link Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- Box pertama: Daily Production -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3 id="dailyKwh">0</h3>
            <p>Daily Production (Realtime)</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">
            <i class="small-box bg-green"></i>
          </a>
        </div>
      </div>
       <!-- Box kedua: Sun Hour -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3 id="sunHour">0</h3>
            <p>Sun Hour</p>
          </div>
          <div class="icon">
            <i class="fas fa-sun"></i>
          </div>
          <a href="#" class="small-box-footer">
            <i class="small-box bg-warning"></i>
          </a>
        </div>
      </div>
      <!-- Box ketiga: Capacity Factor -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-gray">
          <div class="inner">
            <h3 id="capacityFactor">0</h3>
            <p>CF</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">
            <i class="small-box bg-gray"></i>
          </a>
        </div>
      </div>
       <!-- Box keempat: Gateway Status -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3 id="gatewayStatus">0</h3>
            <p>Gateway Status</p>
          </div>
          <div class="icon">
            <i class="fas fa-power-off"></i>
          </div>
          <a href="#" class="small-box-footer">
            <i class="small-box bg-danger"></i>
          </a>
        </div>
      </div>
</section>

      <!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  function updateData() {
    $.ajax({
      url: 'get_daily_kwh.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        if (data) {
          $('#dailyKwh').text(data.total_kwh.toFixed(2) + " kWh");
          $('#sunHour').text(data.sun_hour.toFixed(2) + " jam");
          $('#capacityFactor').text(data.capacity_factor.toFixed(2) + " %");
          $('#gatewayStatus').text(data.gateway_status === "On" ? "Online" : "Offline")
            .css("color", data.gateway_status === "On" ? "white" : "white");
        } else {
          console.error("Data tidak ditemukan!");
        }
      },
      error: function(xhr, status, error) {
        console.error("Gagal mengambil data:", error);
      }
    });
  }

  updateData();
  setInterval(updateData, 60000); // Update setiap 1 menit
</script>
</body>

<section class="content">
    <div class="container-fluid py-4">
     <!-- Button Control -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

      <body>
       <div class="d-flex ms-auto gap-2">
         <button class="small-box bg-blue" id="ONLineChart">ON</button>
         <button class="small-box bg-red" id="OFFLineChart">OFF</button>
         <button class="small-box bg-yellow" id="limitLineChart">Limit</button>
       </div>
     </div> <!-- Tutup row -->
<section>

    <script>
      function sendAction(action, value = null) {
        fetch('control_inverter.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ action: action, value: value })
        })
        .then(response => response.json())
        .then(data => {
          alert(data.message);
          console.log(data);
        })
        .catch(err => {
          alert('Terjadi kesalahan saat mengirim permintaan.');
          console.error(err);
        });
      }

      document.getElementById('OFFLineChart').addEventListener('click', () => {
        sendAction('off');
      });

      document.getElementById('ONLineChart').addEventListener('click', () => {
        sendAction('on');
      });

      document.getElementById('limitLineChart').addEventListener('click', () => {
        let limit = prompt("Masukkan batas produksi inverter (dalam %):", "50");
        limit = parseInt(limit);
        if (!isNaN(limit) && limit >= 0 && limit <= 100) {
          sendAction('limit', limit);
        } else {
          alert("Input tidak valid. Masukkan angka antara 0 sampai 100.");
        }
      });
    </script>


    <!-- Grafik Line Chart -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Energy Trend</h3>
            <form id="filterForm" class="form-inline ml-auto">
              <label for="tanggal" class="mr-2 mb-0">Tanggal:</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm mr-2" value="<?= date('Y-m-d') ?>">
              <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
            </form>
          </div>
          <h3></h3>
          <div class="card-body">
            <canvas id="lineChart" style="height:300px;min-height:300px"></canvas> <!-- CHART PRODUKSI  -->
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Monthly Energy</h3>
          </div>
          <h3></h3>
          <div class="card-body">
            <canvas id="lineChart" style="height:300px;min-height:300px"></canvas> <!-- CHART PRODUKSI  -->
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Energy Saving</h3>
          </div>
          <h3></h3>
          <div class="card-body">
            <canvas id="lineChart" style="height:300px;min-height:300px"></canvas> <!-- CHART PRODUKSI  -->
          </div>
        </div>
      </div>
    </div>
  
          
  </div>





  <!-- <div class="row">
      <div class="col-12">
        <div class="card mt-4">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i>Energy Production</h3>
          </div>
          <div class="card-body">
            <canvas id="barChart" style="height:300px;min-height:300px"></canvas>
          </div>
        </div>
      </div>
    </div>          -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let chartInstance;

function updateChart() {
  fetch("get_daily_energy_trend.php") // Pastikan path ini sesuai dengan lokasi file PHP Anda
    .then(response => response.json())
    .then(data => {
      const ctx = document.getElementById("lineChart").getContext("2d");

      const labels = data.labels;
      const produksi = data.dataProduksi;

      if (chartInstance) {
        chartInstance.data.labels = labels;
        chartInstance.data.datasets[0].data = produksi;
        chartInstance.update();
      } else {
        chartInstance = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Produksi Harian (kWh)',
              data: produksi,
              backgroundColor: produksi.map(value =>
                value > 0 ? 'rgba(8, 51, 113, 0.55)' : 'rgba(192, 192, 192, 0.5)'
              ),
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            animation: false,
            scales: {
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: 'kWh'
                }
              }
            },
            plugins: {
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return context.raw + ' kWh';
                  }
                }
              }
            }
          }
        });
      }
    })
    .catch(error => {
      console.error('Gagal mengambil data:', error);
    });
}

// Panggil pertama kali dan ulangi tiap 60 detik
document.addEventListener("DOMContentLoaded", function () {
  updateChart();
  setInterval(updateChart, 60000); // setiap 1 menit
});
</script>



    <!-- Grafik Bar Chart -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
   
  </div>
</body>
</section>
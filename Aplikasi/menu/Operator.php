<?php
$page = $_GET['page'] ?? '';

// Daftar halaman untuk menentukan menu yang aktif
$operationPages = ['Data-kWh', 'Data-Inverter', 'Data-Pyrano', 'Data-EPM'];
$laporanPages = ['Laporan-Harian', 'Laporan-Mingguan', 'Laporan-Bulanan'];

$isOperationOpen = in_array($page, $operationPages);
$isLaporanOpen = in_array($page, $laporanPages);
?>

<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-dashboard="treeview" role="menu" data-accordion="false">
    <!-- Dashboard -->
    <li class="nav-item">
      <a href="index.php?page=Dashboard-PLTS" class="nav-link <?php if ($page == 'Dashboard-PLTS') echo 'active'; ?>">
        <i class="nav-icon fas fa-th"></i>
        <p>Dashboard PLTS</p>
      </a>
    </li>

    <!-- Menu Data Operation -->
    <li class="nav-item">
      <a href="#" class="nav-link <?php if ($isOperationOpen) echo 'active'; ?>" id="dataOperationToggle">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Data Operation
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview" id="dataOperationMenu" style="display: <?php echo $isOperationOpen ? 'block' : 'none'; ?>">
        <li class="nav-item">
          <a href="index.php?page=Data-kWh" class="nav-link <?php if ($page == 'Data-kWh') echo 'active'; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>kWh Meter</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=Data-Inverter" class="nav-link <?php if ($page == 'Data-Inverter') echo 'active'; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Inverter</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=Data-Pyrano" class="nav-link <?php if ($page == 'Data-Pyrano') echo 'active'; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Pyranometer</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=Data-EPM" class="nav-link <?php if ($page == 'Data-EPM') echo 'active'; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>EPM</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=alarm-inverter" class="nav-link <?php if ($page == 'alarm-inverter') echo 'active'; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Alarm Inverter</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Menu Laporan -->
    <li class="nav-item">
      <a href="#" class="nav-link <?php if ($isLaporanOpen) echo 'active'; ?>" id="laporanToggle">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
          Laporan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview" id="laporanMenu" style="display: <?php echo $isLaporanOpen ? 'block' : 'none'; ?>">
        <li class="nav-item">
          <a href="index.php?page=laporan-invoice" class="nav-link <?php if ($page == 'laporan-invoice') echo 'active'; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Keterangan Produksi</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>

<!-- Tambahkan jQuery jika belum ada di halaman -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Fungsi untuk toggle (expand/collapse) menu Data Operation
  $('#dataOperationToggle').on('click', function() {
    $('#dataOperationMenu').slideToggle();
  });

  // Fungsi untuk toggle (expand/collapse) menu Laporan
  $('#laporanToggle').on('click', function() {
    $('#laporanMenu').slideToggle();
  });
</script>
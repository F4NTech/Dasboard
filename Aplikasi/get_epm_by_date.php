<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi MySQL

// Ambil parameter tanggal dari URL, atau pakai tanggal hari ini
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');

// Validasi format tanggal: harus YYYY-MM-DD
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
  echo json_encode([]);
  exit;
}

// Query data berdasarkan tanggal
$query = mysqli_query($koneksi, "
  SELECT dbtime, load_power, load_energy 
  FROM acp_cosmaxs 
  WHERE name = 'EPM' AND DATE(dbtime) = '$tanggal' 
  ORDER BY dbtime DESC
");

// Ambil hasil sebagai array
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
  $data[] = $row;
}

// Kirim sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

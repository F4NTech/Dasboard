<?php
date_default_timezone_set('Asia/Jakarta');

$koneksi = mysqli_connect('127.0.0.1:8111', 'admin', '', 'db_sicampus');
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Tanggal hari ini
$tanggal = date('Y-m-d');
$label = date('d M');

// Periksa apakah sudah ada data untuk hari ini
$cek = $koneksi->query("SELECT * FROM daily_produksi WHERE tanggal = '$tanggal'");
if ($cek && $cek->num_rows > 0) {
    echo "Data untuk hari ini sudah ada.\n";
    exit;
}

// Ambil data pertama (awal hari)
$q_awal = $koneksi->query("SELECT kwh_eimp, kwh_eexp FROM db_pabriks WHERE dbtime >= '$tanggal 00:00:00' ORDER BY dbtime ASC LIMIT 1");

// Ambil data terakhir (hingga saat ini)
$q_akhir = $koneksi->query("SELECT kwh_eimp, kwh_eexp FROM db_pabriks WHERE dbtime <= '$tanggal 23:59:59' AND dbtime >= '$tanggal 00:00:00' ORDER BY dbtime DESC LIMIT 1");

if ($q_awal && $q_akhir && $q_awal->num_rows > 0 && $q_akhir->num_rows > 0) {
    $awal = $q_awal->fetch_assoc();
    $akhir = $q_akhir->fetch_assoc();

    // Hitung produksi: eimp - eexp
    $produksi = ($akhir['kwh_eimp'] - $awal['kwh_eimp']) - ($akhir['kwh_eexp'] - $awal['kwh_eexp']);
    $produksi = round($produksi, 2);

    // Simpan ke tabel daily_produksi
    $stmt = $koneksi->prepare("INSERT INTO daily_produksi (tanggal, label, produksi) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $tanggal, $label, $produksi);
    $stmt->execute();

    echo "Produksi hari ini berhasil disimpan: $produksi kWh\n";
} else {
    echo "Data awal/akhir tidak lengkap, tidak dihitung.\n";
}
?>
<?php
date_default_timezone_set('Asia/Jakarta');

$koneksi = mysqli_connect('127.0.0.1:8111', 'admin', '', 'db_sicampus');

$tanggal = new DateTime('yesterday', new DateTimeZone('Asia/Jakarta'));

$start = $tanggal->format('Y-m-d 00:00:00');
$end = $tanggal->format('Y-m-d 23:59:59');

$label = $tanggal->format('d M');

// Data awal
$q_awal = $koneksi->query("SELECT kwh_eimp, kwh_eexp FROM db_pabriks WHERE dbtime >= '$start' ORDER BY dbtime ASC LIMIT 1");

// Data akhir
$q_akhir = $koneksi->query("SELECT kwh_eimp, kwh_eexp FROM db_pabriks WHERE dbtime <= '$end' AND dbtime >= '$start' ORDER BY dbtime DESC LIMIT 1");

if ($q_awal && $q_akhir && $q_awal->num_rows > 0 && $q_akhir->num_rows > 0) {
    $awal = $q_awal->fetch_assoc();
    $akhir = $q_akhir->fetch_assoc();

    $produksi = ($awal['kwh_eexp'] - $akhir['kwh_eexp']) - ($awal['kwh_eimp'] - $akhir['kwh_eimp']);
    $produksi = round($produksi, 2);

    // Simpan ke database atau file log jika perlu
    $koneksi->query("INSERT INTO daily_produksi (tanggal, label, produksi) VALUES ('".$tanggal->format('Y-m-d')."', '$label', '$produksi')");
}
?>
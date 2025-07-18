<?php
session_start();

date_default_timezone_set('Asia/Jakarta'); // Sesuaikan zona waktu jika perlu

// Koneksi ke database
$koneksi = mysqli_connect('127.0.0.1:8111', 'admin', '', 'db_sicampus');
if (!$koneksi) {
    die(json_encode([
        'error' => 'Koneksi database gagal'
    ]));
}

// Ambil data pertama dan terakhir berdasarkan waktu (asc dan desc)
$sql1 = "SELECT kwh_eimp, kwh_eexp FROM db_pabriks ORDER BY dbtime ASC LIMIT 1";
$result1 = $koneksi->query($sql1);

$sql2 = "SELECT kwh_eimp, kwh_eexp, dbtime FROM db_pabriks ORDER BY dbtime DESC LIMIT 1";
$result2 = $koneksi->query($sql2);

$kapasitasPLTS = 604.80; // Kapasitas PLTS dalam kWp

// Pastikan data tersedia
if ($result1 && $result2 && $result1->num_rows > 0 && $result2->num_rows > 0) {
    // Ambil data awal
    $row1 = $result1->fetch_assoc();
    $kwh_eimp1 = (float)$row1['kwh_eimp'];
    $kwh_eexp1 = (float)$row1['kwh_eexp'];

    // Ambil data terakhir
    $row2 = $result2->fetch_assoc();
    $kwh_eimp2 = (float)$row2['kwh_eimp'];
    $kwh_eexp2 = (float)$row2['kwh_eexp'];
    $last_dbtime = $row2['dbtime'];

    // Hitung produksi (energi bersih yang diekspor - diimpor)
    $produksi = ($kwh_eimp2 - $kwh_eexp2) - ($kwh_eimp1 - $kwh_eexp1);

    // Hitung sun hour dan capacity factor
    $sunHour = $kapasitasPLTS > 0 ? round($produksi / $kapasitasPLTS, 2) : 0;
    $capacityFactor = $kapasitasPLTS > 0 ? round(($produksi / ($kapasitasPLTS * 24)) * 100, 2) : 0;

    // Hitung selisih waktu antara data terakhir dengan waktu sekarang
    $lastTime = strtotime($last_dbtime);
    $now = time();
    $selisihMenit = ($now - $lastTime) / 60;

    // Logika status gateway
    $gatewayStatus = ($selisihMenit > 10) ? 'Off' : 'On';

    // Output dalam format JSON
    echo json_encode([
        'total_kwh' => round($produksi, 2),
        'sun_hour' => $sunHour,
        'capacity_factor' => $capacityFactor,
        'gateway_status' => $gatewayStatus,
        'last_update' => $last_dbtime,
        'selisih_menit' => round($selisihMenit, 2)
    ]);
} else {
    // Jika data tidak ditemukan atau query gagal
    echo json_encode([
        'total_kwh' => 0,
        'sun_hour' => 0,
        'capacity_factor' => 0,
        'gateway_status' => 'Off',
        'last_update' => null
    ]);
}

$koneksi->close();
?>
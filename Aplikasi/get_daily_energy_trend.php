<?php
date_default_timezone_set('Asia/Jakarta');

$koneksi = mysqli_connect('127.0.0.1:8111', 'admin', '', 'db_sicampus');

$response = [
    'labels' => [],
    'dataProduksi' => []
];

// Ambil data dari tabel hasil update harian (daily_produksi)
$result = $koneksi->query("SELECT label, produksi FROM daily_produksi ORDER BY tanggal ASC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response['labels'][] = $row['label'];
        $response['dataProduksi'][] = (float)$row['produksi'];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
exit;
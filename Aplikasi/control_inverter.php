<?php
// control_inverter.php

// Ambil data dari body JSON
$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'] ?? '';
$value = $data['value'] ?? null;

$response = [
  "success" => false,
  "message" => "Aksi tidak dikenal."
];

// Simulasi logic kontrol
switch ($action) {
  case 'off':
    // Logika untuk matikan produksi (set ke 0)
    // Contoh: update database atau kirim ke perangkat fisik
    $response = [
      "success" => true,
      "message" => "Produksi inverter dimatikan (0%)"
    ];
    break;

  case 'on':
    // Logika untuk nyalakan kembali
    $response = [
      "success" => true,
      "message" => "Produksi inverter diaktifkan kembali (100%)"
    ];
    break;

  case 'limit':
    if (is_numeric($value) && $value >= 0 && $value <= 100) {
      // Logika set limit produksi
      $response = [
        "success" => true,
        "message" => "Produksi inverter dibatasi hingga $value%"
      ];
    } else {
      $response = [
        "success" => false,
        "message" => "Limit tidak valid."
      ];
    }
    break;
}

header('Content-Type: application/json');
echo json_encode($response);
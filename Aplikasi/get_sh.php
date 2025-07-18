<?php
// Kapasitas PLTS dalam kWp
$kapasitasPLTS = 604.80;

// Fungsi untuk menghitung Sun Hour
function hitungSunHour($total, $kapasitasPLTS) {
    if ($kapasitasPLTS <= 0) {
        return "Kapasitas PLTS tidak valid.";
    }

    $sunHour = $total / $kapasitasPLTS;
    return round($sunHour, 2); // dibulatkan ke 2 angka desimal
}

// Contoh data produksi harian (dalam kWh)
$produksiHariIni = $total;

// Hitung Sun Hour
$sunHourHariIni = hitungSunHour($produksiHariIni, $kapasitasPLTS);

// Tampilkan hasil
echo "Produksi Hari Ini: {$produksiHariIni} kWh<br>";
echo "Sun Hour Hari Ini: {$sunHourHariIni} jam";
?>

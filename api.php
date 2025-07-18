<?php
// Konfigurasi koneksi database
$host = "0.0.0.0:8111";
$user = "admin"; // ganti jika bukan root
$pass = "";     // ganti jika ada password
$dbname = "db_sicampus";

// Koneksi ke MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Gagal koneksi ke database."]);
    exit;
}

// Set header JSON
header("Content-Type: application/json");

// Cek method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Hanya metode POST yang diizinkan."]);
    exit;
}

// Ambil data JSON dari body
$input = json_decode(file_get_contents("php://input"), true);

// Validasi data
if (!isset($input['nama']) || !isset($input['usia'])) {
    http_response_code(400);
    echo json_encode(["error" => "Data 'nama' dan 'usia' harus dikirim."]);
    exit;
}

// Bersihkan data
$nama = $conn->real_escape_string($input['nama']);
$NIM = (int)$input['usia'];
$Semester = (int)$input['semester'];

// Query insert
$sql = "INSERT INTO users (nama, usia) VALUES ('$nama', $usia)";
 $query = mysqli_query($koneksi,"SELECT * FROM tb_mahasiswa");

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => "sukses",
        "pesan" => "Data berhasil disimpan.",
        "data" => [
            "id" => $conn->insert_id,
            "Nama" => $nama,
            "NIM" => $usia,
            "Semester" => $semseter
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Gagal menyimpan data: " . $conn->error]);
}

$conn->close();
?>
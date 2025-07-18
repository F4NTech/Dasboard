<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
    $search = $_POST['search']['value'] ?? '';

    // Validasi tanggal
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
        echo json_encode([
            "draw" => intval($_POST['draw'] ?? 1),
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => []
        ]);
        exit;
    }

    // Hitung total data
    $stmtTotal = $koneksi->prepare("SELECT COUNT(*) FROM acp_cosmaxs WHERE name = 'EPM' AND DATE(dbtime) = ?");
    $stmtTotal->bind_param("s", $tanggal);
    $stmtTotal->execute();
    $stmtTotal->bind_result($recordsTotal);
    $stmtTotal->fetch();
    $stmtTotal->close();

    $query = "SELECT dbtime, load_power, load_energy FROM acp_cosmaxs WHERE name = 'EPM' AND DATE(dbtime) = ?";
    $params = [$tanggal];
    $types = "s";

    // Jika ada pencarian, tambahkan filter LIKE
    if (!empty($search)) {
        $query .= " AND (
            TIME(dbtime) LIKE ? OR 
            load_power LIKE ? OR 
            load_energy LIKE ?
        )";
        $searchTerm = "%$search%";
        array_push($params, $searchTerm, $searchTerm, $searchTerm);
        $types .= "sss";
    }

    // Tambahkan order dan limit
    $query .= " ORDER BY dbtime ASC LIMIT ?, ?";
    $start = intval($_POST['start'] ?? 0);
    $length = intval($_POST['length'] ?? 10);
    array_push($params, $start, $length);
    $types .= "ii";

    // Prepare dan eksekusi
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    $no = $start + 1;
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "no" => $no++,
            "time" => date("Y-m-d H:i:s", strtotime($row['dbtime'])),
            "load_power" => $row['load_power'],
            "load_energy" => $row['load_energy']
        ];
    }

    $recordsFiltered = count($data); // bisa juga dihitung ulang tanpa LIMIT jika diperlukan

    echo json_encode([
        "draw" => intval($_POST['draw'] ?? 1),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsTotal, // Jika ingin lebih akurat, harus dihitung ulang dengan search
        "data" => $data
    ]);
    exit;
}
?>

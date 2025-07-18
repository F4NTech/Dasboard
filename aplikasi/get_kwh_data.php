<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
    $search = $_POST['search']['value'] ?? '';

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
        echo json_encode([
            "draw" => intval($_POST['draw'] ?? 1),
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => []
        ]);
        exit;
    }

    // Total tanpa filter
    $stmtTotal = $koneksi->prepare("SELECT COUNT(*) FROM acp_cosmaxs WHERE name LIKE '%KWH%' AND DATE(dbtime) = ?");
    $stmtTotal->bind_param("s", $tanggal);
    $stmtTotal->execute();
    $stmtTotal->bind_result($recordsTotal);
    $stmtTotal->fetch();
    $stmtTotal->close();

    // Query data
    $query = "SELECT dbtime, name, kwh_v1, kwh_v2, kwh_v3, kwh_v, kwh_i1, 
                     kwh_i2, kwh_i3, kwh_i, kwh_p, kwh_q, kwh_s, 
                     kwh_pf, kwh_f, kwh_eimp, kwh_eexp
              FROM acp_cosmaxs 
              WHERE name LIKE '%KWH%' AND DATE(dbtime) = ?";
    $params = [$tanggal];
    $types = "s";

    if (!empty($search)) {
        $query .= " AND (
            TIME(dbtime) LIKE ? OR 
            name LIKE ? OR
            kwh_v1 LIKE ? OR
            kwh_v2 LIKE ? OR
            kwh_v3 LIKE ? OR
            kwh_v LIKE ? OR
            kwh_i1 LIKE ? OR
            kwh_i2 LIKE ? OR
            kwh_i3 LIKE ? OR
            kwh_i LIKE ? OR
            kwh_p LIKE ? OR
            kwh_q LIKE ? OR
            kwh_s LIKE ? OR
            kwh_pf LIKE ? OR
            kwh_f LIKE ? OR
            kwh_eimp LIKE ? OR
            kwh_eexp LIKE ?
        )";
        $searchTerm = "%$search%";
        for ($i = 0; $i < 17; $i++) {
            $params[] = $searchTerm;
            $types .= "s";
        }
    }

    $query .= " ORDER BY dbtime ASC LIMIT ?, ?";
    $start = intval($_POST['start'] ?? 0);
    $length = intval($_POST['length'] ?? 10);
    $params[] = $start;
    $params[] = $length;
    $types .= "ii";

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
            "name" => $row['name'],
            "kwh_v1" => $row['kwh_v1'],
            "kwh_v2" => $row['kwh_v2'],
            "kwh_v3" => $row['kwh_v3'],
            "kwh_v" => $row['kwh_v'],
            "kwh_i1" => $row['kwh_i1'],
            "kwh_i2" => $row['kwh_i2'],
            "kwh_i3" => $row['kwh_i3'],
            "kwh_i" => $row['kwh_i'],
            "kwh_p" => $row['kwh_p'],
            "kwh_q" => $row['kwh_q'],
            "kwh_s" => $row['kwh_s'],
            "kwh_pf" => $row['kwh_pf'],
            "kwh_f" => $row['kwh_f'],
            "kwh_eimp" => $row['kwh_eimp'],
            "kwh_eexp" => $row['kwh_eexp'],
        ];
    }

    // Filtered count
    $recordsFiltered = $recordsTotal;
    if (!empty($search)) {
        $filterQuery = "SELECT COUNT(*) FROM acp_cosmaxs WHERE name LIKE '%KWH%' AND DATE(dbtime) = ? AND (
            TIME(dbtime) LIKE ? OR 
            name LIKE ? OR
            kwh_v1 LIKE ? OR
            kwh_v2 LIKE ? OR
            kwh_v3 LIKE ? OR
            kwh_v LIKE ? OR
            kwh_i1 LIKE ? OR
            kwh_i2 LIKE ? OR
            kwh_i3 LIKE ? OR
            kwh_i LIKE ? OR
            kwh_p LIKE ? OR
            kwh_q LIKE ? OR
            kwh_s LIKE ? OR
            kwh_pf LIKE ? OR
            kwh_f LIKE ? OR
            kwh_eimp LIKE ? OR
            kwh_eexp LIKE ?
        )";
        $filterParams = [$tanggal];
        $filterTypes = "s";
        for ($i = 0; $i < 17; $i++) {
            $filterParams[] = $searchTerm;
            $filterTypes .= "s";
        }

        $stmtFiltered = $koneksi->prepare($filterQuery);
        $stmtFiltered->bind_param($filterTypes, ...$filterParams);
        $stmtFiltered->execute();
        $stmtFiltered->bind_result($recordsFiltered);
        $stmtFiltered->fetch();
        $stmtFiltered->close();
    }

    echo json_encode([
        "draw" => intval($_POST['draw'] ?? 1),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
?>

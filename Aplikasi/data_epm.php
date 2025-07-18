<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data EPM</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
</head>
<body>
<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">
            <form method="GET" class="form-inline">
                <label for="tanggal" class="mr-2">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control mr-2"
                value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
            </form>
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Time</th>
                        <th>Load Power</th>
                        <th>Load Energy</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- JS Dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- DataTable Init -->
<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "get_epm_data.php",
            type: "POST",
            data: function(d) {
                d.tanggal = $('#tanggal').val();
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        columns: [
            { data: "no" },
            { data: "time" },
            { data: "load_power" },
            { data: "load_energy" }
        ]
    });

    $('#tanggal').change(function() {
        table.ajax.reload();
    });
});
</script>
</body>
</html>

<?php include 'koneksi.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Data KWH</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data KWH</h3>
            <form method="GET" class="form-inline mt-5">
                <span for="tanggal" class="mr-1">Tanggal:</span>
                <input type="date" name="tanggal" id="tanggal" class="form-control mr-2"
                    value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
            </form>
        </div>

        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Time</th>
                        <th>NAME</th>
                        <th>KWH V1</th>
                        <th>KWH V2</th>
                        <th>KWH V3</th>
                        <th>KWH V</th>
                        <th>KWH I1</th>
                        <th>KWH I2</th>
                        <th>KWH I3</th>
                        <th>KWH I</th>
                        <th>KWH P</th>
                        <th>KWH q</th>
                        <th>KWH S</th>
                        <th>KWH pF</th>
                        <th>KWH F</th>
                        <th>KWH Eimp</th>
                        <th>KWH Eexp</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "get_kwh_data.php",
            "type": "POST",
            "data": function(d) {
                d.tanggal = $('#tanggal').val(); // Kirim tanggal saat ini
            }
        },
        "columns": [
            { "data": "no" },
            { "data": "time" },
            { "data": "name" },
            { "data": "kwh_v1" },
            { "data": "kwh_v2" },
            { "data": "kwh_v3" },
            { "data": "kwh_v" },
            { "data": "kwh_i1" },
            { "data": "kwh_i2" },
            { "data": "kwh_i3" },
            { "data": "kwh_i" },
            { "data": "kwh_p" },
            { "data": "kwh_q" },
            { "data": "kwh_s" },
            { "data": "kwh_pf" },
            { "data": "kwh_f" },
            { "data": "kwh_eimp" },
            { "data": "kwh_eexp" }
        ],
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    // Reload tabel saat tanggal diganti
    $('#tanggal').change(function() {
        table.ajax.reload();
    });
});
</script>
</body>
</html>

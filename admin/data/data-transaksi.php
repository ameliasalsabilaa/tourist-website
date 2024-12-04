<?php
require '../../config/koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title><?php echo namaweb; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta name="author" content="Themesberg">
    <meta name="description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="og:title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta property="og:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="twitter:title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta property="twitter:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="../../assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="../../assets/vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="../../assets/css/volt.css" rel="stylesheet">
    <link type="text/css" href="../../assets/vendor/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link type="text/css" href="../../assets/vendor/datatables/dataTables.bootstrap5.css" rel="stylesheet">

</head>

<body>
    
    <?php include 'menu-kiri.php'; ?>
    
        <main class="content">

    <?php include 'menu-atas.php'; ?>

            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <a href="../tambah/tambah-transaksi.php" class="btn btn-primary mb-2" title="Tambah transaksi"><i class="bi-plus"></i> Tambah Transaksi</a>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded" id="tabeltransaksi" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">No</th>
                                    <th class="border-0">Invoice</th>
                                    <th class="border-0">Nama Pelanggan</th>
                                    <th class="border-0">Nama Paket</th>
                                    <th class="border-0">Harga Paket</th>
                                    <th class="border-0">Jumlah Pelanggan</th>
                                    <th class="border-0">Total Transaksi</th>
                                    <th class="border-0">Tanggal Transaksi</th>
                                    <th class="border-0">Mulai Trip</th>
                                    <th class="border-0">Akhir Trip</th>
                                    <th class="border-0">Metode Transaksi</th>
                                    <th class="border-0">Status Transaksi</th>
                                    <th class="border-0">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT transaksi.idtransaksi, invoice, namapelanggan, namapaket, hargapaket, jumlahpelanggantransaksi, tanggaltransaksi, totaltransaksi, statustransaksi, mulaitriptransaksi, akhirtriptransaksi, metodetransaksi
                                FROM transaksi
                                LEFT JOIN pelanggan ON pelanggan.idpelanggan = transaksi.idpelanggan
                                LEFT JOIN paket ON paket.idpaket = transaksi.idpaket
                                GROUP BY transaksi.idtransaksi");
                                while($data = mysqli_fetch_assoc($sql)) {
                                    if ($data['statustransaksi'] == 1) {
                                        $status = "<span class='badge bg-success'>Selesai</span>";
                                    } else {
                                        $status = "<span class='badge bg-danger'>Proses</span>";
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['invoice']; ?></td>
                                    <td><?php echo $data['namapelanggan']; ?></td>
                                    <td><?php echo $data['namapaket']; ?></td>
                                    <td><?php echo 'Rp ' . number_format($data['hargapaket'], 0, ',', '.'); ?></td>
                                    <td><?php echo $data['jumlahpelanggantransaksi']; ?></td>
                                    <td>
                                        <?php 
                                        $totaltransaksi = $data['totaltransaksi'];
                                        $numericValue = preg_replace('/[^\d,]/', '', $totaltransaksi); 
                                        $numericValue = str_replace(',', '.', $numericValue);
                                        if (is_numeric($numericValue)) {
                                            $formattedValue = number_format(floatval($numericValue), 2, ',', '.');
                                            echo 'Rp ' . $formattedValue;
                                        } else {
                                            echo $totaltransaksi;
                                        }
                                        ?>
                                    </td>
                                    <td data-date="<?php echo $data['tanggaltransaksi']; ?>"></td>
                                    <td data-date="<?php echo $data['mulaitriptransaksi']; ?>"></td>
                                    <td data-date="<?php echo $data['akhirtriptransaksi']; ?>"></td>
                                    <td><?php echo $data['metodetransaksi']; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <a href="../ubah/ubah-transaksi.php?id=<?php echo $data['idtransaksi'];?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="../proses/proses-transaksi.php?id=<?php echo $data['idtransaksi'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php include '../footer.php'; ?>

</main>

    <!-- Core -->
<script src="../../assets/vendor/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Jquery JS -->
<script src="../../assets/vendor/jquery/jquery-3.7.1.min.js"></script>

<!-- Vendor JS -->
<script src="../../assets/vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
<script src="../../assets/vendor/nouislider/dist/nouislider.min.js"></script>

<!-- Smooth scroll -->
<script src="../../assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<!-- Charts -->
<script src="../../assets/vendor/chartist/dist/chartist.min.js"></script>
<script src="../../assets/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

<!-- Datepicker -->
<script src="../../assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Sweet Alerts 2 -->
<script src="../../assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="../../assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Notyf -->
<script src="../../assets/vendor/notyf/notyf.min.js"></script>

<!-- Simplebar -->
<script src="../../assets/vendor/simplebar/dist/simplebar.min.js"></script>

<!-- Volt JS -->
<script src="../../assets/js/volt.js"></script>

<!-- Datatables JS -->
<script src="../../assets/vendor/datatables/dataTables.js"></script>
<script src="../../assets/vendor/datatables/dataTables.bootstrap5.js"></script>

<script>
    $(document).ready(function() {
    $('#tabeltransaksi').DataTable({
        "processing": true,
        "serverSide": false, 
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "columnDefs": [
            { targets: 4, render: function (data, type, row) {
                return data;
            }},
            { targets: 6, render: function (data, type, row) {
                return data ? data.replace(/,/g, ', ') : ''; 
            }}
        ]
    });
});

    document.addEventListener('DOMContentLoaded', function() {
    function formatDateToIndonesian(dateString) {
        // Array of Indonesian days and months
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        const date = new Date(dateString);
        const dayOfWeek = days[date.getDay()];
        const day = date.getDate();
        const month = months[date.getMonth()];
        const year = date.getFullYear();

        return `${dayOfWeek}, ${day} ${month} ${year}`;
    }

    // Find all <td> elements with data-date attribute
    document.querySelectorAll('td[data-date]').forEach(function(td) {
        const dateString = td.getAttribute('data-date');
        td.textContent = formatDateToIndonesian(dateString);
    });
});
</script>

    
</body>

</html>

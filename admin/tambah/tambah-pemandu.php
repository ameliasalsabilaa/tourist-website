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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
</head>

<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
        

    <?php include 'menu-kiri.php'; ?>
    
        <main class="content">

    <?php include 'menu-atas.php'; ?>

            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    
                    <a href="../data/data-pemandu.php" class="btn btn-warning" title="Kembali"><i class="bi-arrow-left"></i> Kembali</a>
                    <h3 class="text-center mt-3">Form Tambah Data Pemandu</h3>
                    <form action="../proses/proses-pemandu.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profilpemandu">Profil Pemandu</label>
                            <input type="file" class="form-control" id="profilpemandu" name="coverpemandu" required>
                        </div>
                        <div class="mb-3">
                            <label for="namapemandu">Nama Pemandu</label>
                            <input type="text" class="form-control" id="namapemandu" name="namapemandu" required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Gender Pemandu</label>
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="genderpemandu" id="genderpemandu1" value="Laki - Laki" checked>
                                <label class="form-check-label" for="genderpemandu1">Laki - Laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genderpemandu" id="genderpemandu2" value="Perempuan" >
                                <label class="form-check-label" for="genderpemandu2">Perempuan</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggalpemandu">Tanggal Masuk Pemandu</label>
                            <input type="date" class="form-control" id="tanggalpemandu" name="tanggalpemandu" required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Status Pemandu</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="statuspemandu" id="statuspemandu1" value="1" checked>
                                <label class="form-check-label" for="statuspemandu1">Aktif</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="statuspemandu" id="statuspemandu2" value="0" >
                                <label class="form-check-label" for="statuspemandu2">Tidak Aktif</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="asalpemandu">Asal Pemandu</label>
                            <input rows="8" class="form-control" id="asalpemandu" name="asalpemandu" required>  
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="simpan"><i class="bi-save"></i> Simpan</button>
                        </div>
                    </form>
                                
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#idaktivitas').select2({
            placeholder: 'Pilih aktivitas pemandu',
            theme: 'bootstrap-5'
        });
    });

    // kalender
    document.getElementById('tanggalpemandu').addEventListener('click', function() {
        this.showPicker();
    });
</script>

</body>

</html>

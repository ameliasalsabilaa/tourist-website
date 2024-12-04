<?php
require '../../config/koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: ../data/data-transaksi.php');
    exit();
}

$idtransaksi = $_GET['id'];
$_SESSION['idtransaksi'] = $idtransaksi;

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE idtransaksi = '$idtransaksi'");
$data = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    header('Location: ../data/data-transaksi.php');
    exit();
}


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
    <?php include 'menu-kiri.php'; ?>
    
        <main class="content">

    <?php include 'menu-atas.php'; ?>

            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    
                    <a href="../data/data-transaksi.php" class="btn btn-warning" title="Kembali"><i class="bi-arrow-left"></i> Kembali</a>
                    <h3 class="text-center mt-3">Form Ubah Data Transaksi</h3>
                    <form action="../proses/proses-transaksi.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="idpelanggan" class="mb-2">Nama Pelanggan</label>
                            <select class="form-control" name="idpelanggan" id="idpelanggan" required>
                              <?php 
                              $sql = mysqli_query($koneksi, "SELECT idpelanggan FROM transaksi WHERE idtransaksi = '$idtransaksi'");
                              $cekpelanggan = [];

                              while ($rowcekpelanggan = mysqli_fetch_assoc($sql)){
                                $cekpelanggan[] = $rowcekpelanggan['idpelanggan'];
                              }
                              $query = mysqli_query ($koneksi, "SELECT idpelanggan, namapelanggan FROM pelanggan");
                              while($row = mysqli_fetch_assoc($query)){
                                $selected = in_array($row['idpelanggan'], $cekpelanggan) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $row['idpelanggan'];?>" <?php echo $selected; ?>><?php echo $row['namapelanggan'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="idpaket" class="mb-2">Nama Paket</label>
                            <select class="form-control" name="idpaket" id="idpaket" required onchange="updatePrice()">
                                <?php 
                                $sql = mysqli_query($koneksi, "SELECT idpaket FROM transaksi WHERE idtransaksi = '$idtransaksi'");
                                $rowcekpaket = mysqli_fetch_assoc($sql);
                                $selected_idpaket = $rowcekpaket['idpaket'];

                                $query = mysqli_query($koneksi, "SELECT idpaket, namapaket, hargapaket FROM paket");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($row['idpaket'] == $selected_idpaket) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $row['idpaket']; ?>" data-price="<?php echo $row['hargapaket']; ?>" <?php echo $selected; ?>>
                                        <?php echo $row['namapaket']; ?>
                                    </option>
                                    <?php 
                                } 
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hargapaket" class="form-label">Harga Paket</label>
                            <input type="text" class="form-control" id="hargapaket" name="hargapaket" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlahpelanggantransaksi" class="form-label">Jumlah Pelanggan</label>
                            <input type="number" class="form-control" id="jumlahpelanggantransaksi" name="jumlahpelanggantransaksi" value="<?php echo $data['jumlahpelanggantransaksi']; ?>" required oninput="calculateTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="totaltransaksi">Total Transaksi</label>
                            <input type="text" class="form-control" id="totaltransaksi" name="totaltransaksi" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggaltransaksi" class="form-label">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="tanggaltransaksi" name="tanggaltransaksi" value="<?php echo $data['tanggaltransaksi']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="mulaitriptransaksi" class="form-label">Tanggal Mulai Trip</label>
                            <input type="date" class="form-control" id="mulaitriptransaksi" name="mulaitriptransaksi" value="<?php echo $data['mulaitriptransaksi']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="akhirtriptransaksi" class="form-label">Tanggal Akhir Trip</label>
                            <input type="date" class="form-control" id="akhirtriptransaksi" name="akhirtriptransaksi" value="<?php echo $data['akhirtriptransaksi']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Transaksi</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="statustransaksi" id="statustransaksi1" value="1" <?php if ($data['statustransaksi'] == '1') echo 'checked'; ?>>
                                <label class="form-check-label" for="statustransaksi1">Selesai</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statustransaksi" id="statustransaksi2" value="0" <?php if ($data['statustransaksi'] == '0') echo 'checked'; ?>>
                                <label class="form-check-label" for="statustransaksi2">Proses</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="ubah"><i class="bi-save"></i> Ubah</button>
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
function updatePrice() {
    const selectPaket = document.getElementById('idpaket');
    const selectedOption = selectPaket.options[selectPaket.selectedIndex];
    const hargaPaket = parseFloat(selectedOption.getAttribute('data-price')) || 0;

    document.getElementById('hargapaket').dataset.rawPrice = hargaPaket;

    document.getElementById('hargapaket').value = hargaPaket.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR'
    });

    calculateTotal();
}

function calculateTotal() {
    const rawHargaPaket = parseFloat(document.getElementById('hargapaket').dataset.rawPrice) || 0;
    const jumlahPelanggan = parseInt(document.getElementById('jumlahpelanggantransaksi').value) || 0;
    const totalTransaksi = rawHargaPaket * jumlahPelanggan;

    document.getElementById('totaltransaksi').value = totalTransaksi.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR'
    });
}

window.onload = updatePrice;

    document.getElementById('tanggaltransaksi').addEventListener('click', function() {
        this.showPicker();
    });
    document.getElementById('mulaitriptransaksi').addEventListener('click', function() {
        this.showPicker();
    });

    document.getElementById('akhirtriptransaksi').addEventListener('click', function() {
        this.showPicker();
    });

</script>

    
</body>

</html>

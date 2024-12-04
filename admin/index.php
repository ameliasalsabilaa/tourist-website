<?php
require '../config/koneksi.php';

$query = "SELECT MONTH(tanggaltransaksi) AS bulan, SUM(totaltransaksi) AS total 
          FROM transaksi 
          GROUP BY MONTH(tanggaltransaksi)";
$result = mysqli_query($koneksi, $query);

$bulan = [];
$total = [];

while ($row = mysqli_fetch_assoc($result)) {
    $bulan[] = $row['bulan'];
    $total[] = $row['total'];
}

$bulan_json = json_encode($bulan);
$total_json = json_encode($total);
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
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="../assets/vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="../assets/css/volt.css" rel="stylesheet">
    <link type="text/css" href="../assets/vendor/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Tambahkan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        #transaksiChart {
            max-width: 100%;
            height: 400px; 
        }
        .imgpemandu{
            object-fit: cover;
        }
    </style>

</head>

<body>        

<?php include 'menu-kiri.php'; ?>
    
        <main class="content">

<?php include 'menu-atas.php'; ?>

            <div class="py-4">
                <div class="dropdown">
                    <button class="btn btn-gray-800 d-inline-flex align-items-center me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Data
                    </button>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center" href="tambah/tambah-aktivitas.php">
                            <i class="bi bi-activity me-3"></i>
                            Tambah Aktivitas
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="tambah/tambah-destinasi.php">
                            <i class="bi bi-airplane-engines me-3"></i>                          
                            Tambah Destinasi
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="tambah/tambah-pemandu.php">
                            <i class="bi bi-person-workspace me-3"></i>                          
                            Tambah Pemandu
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="tambah/tambah-paket.php">
                            <i class="bi bi-box2-heart me-3"></i>
                            Tambah Paket
                        </a>
                        <div role="separator" class="dropdown-divider my-1"></div>
                        <a class="dropdown-item d-flex align-items-center" href="tambah/tambah-pelanggan.php">
                            <i class="bi bi-file-earmark-person me-3"></i>
                            Tambah Pelanggan
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="tambah/tambah-transaksi.php">
                            <i class="bi bi-credit-card me-3"></i>
                            Tambah Transaksi
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="tambah/tambah-pengguna.php">
                            <i class="bi bi-person-video2 me-3"></i>
                            Tambah Pengguna
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card bg-yellow-100 border-0 shadow">
                        <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                            <div class="d-block mb-3 mb-sm-0">
                                <div class="fs-5 fw-normal mb-2">Transaksi Penjualan</div>
                                <h2 class="fs-3 fw-extrabold">Rp <?= number_format(mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(totaltransaksi) AS total FROM transaksi"))['total'], 0, ',', '.'); ?></h2>
                                <div class="small mt-2">                              
                                    <span class="fas fa-angle-up text-success"></span>
                                </div>
                            </div>
                            <div class="d-flex ms-auto">
                                <a href="#" class="btn btn-secondary text-dark btn-sm me-2">Bulan</a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <canvas id="transaksiChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                        <i class="bi bi-file-earmark-person" style="font-size: 3rem;"></i>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Pelanggan</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">Pelanggan</h2>
                                        <h3 class="fw-extrabold mb-2">
                                            <?php
                                                $sql = "SELECT COUNT(*) AS jumlah FROM pelanggan";
                                                $result = mysqli_query($koneksi, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                ?>
                                                <?php echo $row['jumlah'];
                                            ?>
                                        </h3>
                                        <small class="text-gray-400">Januari - Desember 2024</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                        <i class="bi bi-airplane-engines" style="font-size: 3rem;"></i>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Destinasi</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">Destinasi</h2>
                                        <h3 class="fw-extrabold mb-2">
                                            <?php
                                                $sql = "SELECT COUNT(*) AS jumlah FROM destinasi";
                                                $result = mysqli_query($koneksi, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                ?>
                                                <?php echo $row['jumlah'];
                                            ?>
                                        </h3>
                                        <small class="text-gray-400">Januari - Desember 2024</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                        <i class="bi bi-activity" style="font-size: 3rem;"></i>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Aktivitas</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">Aktivitas</h2>
                                        <h3 class="fw-extrabold mb-2">
                                            <?php
                                                $sql = "SELECT COUNT(*) AS jumlah FROM aktivitas";
                                                $result = mysqli_query($koneksi, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                ?>
                                                <?php echo $row['jumlah'];
                                            ?>
                                        </h3>
                                        <small class="text-gray-400">Januari - Desember 2024</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="row">

                        <!-- transaksi terakhir -->
                        <div class="col-12 mb-4">
                            <div class="card border-0 shadow">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h2 class="fs-5 fw-bold mb-0">Transaksi Terakhir</h2>
                                        </div>
                                        <div class="col text-end">
                                            <a href="data/data-transaksi.php" class="btn btn-sm btn-primary">Semuanya</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="border-bottom" scope="col">Invoice</th>
                                            <th class="border-bottom" scope="col">Harga Paket</th>
                                            <th class="border-bottom" scope="col">Jumlah Pelanggan</th>
                                            <th class="border-bottom" scope="col">Total Transaksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($koneksi, "SELECT transaksi.idtransaksi, invoice,  namapaket, hargapaket, jumlahpelanggantransaksi, tanggaltransaksi, totaltransaksi, statustransaksi, mulaitriptransaksi, akhirtriptransaksi, metodetransaksi
                                        FROM transaksi
                                        LEFT JOIN pelanggan ON pelanggan.idpelanggan = transaksi.idpelanggan
                                        LEFT JOIN paket ON paket.idpaket = transaksi.idpaket
                                        GROUP BY transaksi.idtransaksi
                                        ORDER BY tanggaltransaksi DESC
                                        LIMIT 5");
                                        while($data = mysqli_fetch_assoc($sql)) {
                                        ?>
                                        <tr>
                                            <th class="text-gray-900" scope="row">
                                                <?php echo $data['invoice']; ?>
                                            </th>
                                            <td class="fw-bolder text-gray-500">
                                                <?php echo 'Rp ' . number_format($data['hargapaket'], 0, ',', '.'); ?>
                                            </td>
                                            <td class="fw-bolder text-gray-500">
                                                <?php echo $data['jumlahpelanggantransaksi']; ?>
                                            </td>
                                            <td class="fw-bolder text-gray-500">
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
                                            <?php $no++; } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- pemandu -->
                        <div class="col-12 col-xxl-6 mb-4">
                            <div class="card border-0 shadow">
                                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                                   <h2 class="fs-5 fw-bold mb-0">Para Pemandu</h2>
                                    <a href="data/data-pemandu.php" class="btn btn-sm btn-primary">Semuanya</a>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush list my--3">
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($koneksi, "SELECT idpemandu, namapemandu, coverpemandu, statuspemandu  FROM pemandu ORDER BY RAND() LIMIT 5");
                                        while($data = mysqli_fetch_assoc($sql)) {
                                            if ($data['statuspemandu'] == 1) {
                                                $status = "<span class='badge bg-success'>Aktif</span>";
                                            } else {
                                                $status = "<span class='badge bg-danger'>Tidak Aktif</span>";
                                            }
                                        ?>
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <div class="avatar">
                                                    <img class="imgpemandu rounded" alt="Image placeholder" src="../assets/cover/<?php echo $data['coverpemandu']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-auto ms--2">
                                                <h4 class="h6 mb-0">
                                                    <?php echo $data['namapemandu']; ?>
                                                </h4>
                                                <div class="d-flex align-items-center">
                                                    <small><td><?php echo $status; ?></td></small>
                                                </div>
                                            </div>
                                            <div class="col text-end">
                                                <a href="data/data-pemandu.php" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                                                    <svg class="icon icon-xxs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                    Telusuri
                                                </a>
                                            </div>
                                            </div>
                                        </li>
                                        <?php $no++; } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- prlsnggsn -->
                        <div class="col-12 col-xxl-6 mb-4">
                            <div class="card border-0 shadow">
                                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                                    <h2 class="fs-5 fw-bold mb-0">Pelanggan Terawal</h2>
                                     <a href="data/data-pelanggan.php" class="btn btn-sm btn-primary">Semuanya</a>
                                 </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush list my--3">
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($koneksi, "SELECT *  FROM pelanggan LIMIT 5");
                                        while($data = mysqli_fetch_assoc($sql)) {
                                        ?>
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                    <i class="bi bi-file-earmark-person"></i>
                                            </div>
                                            <div class="col-auto ms--2">
                                                <h4 class="h6 mb-0">
                                                    <a href="#"><?php echo $data['namapelanggan']; ?></a>
                                                </h4>
                                                <div class="d-flex align-items-center">
                                                    <small class="text-gray-500"><?php echo $data['tanggalpelanggan']; ?></small>
                                                </div>
                                            </div>
                                            <div class="col text-end">
                                                <a href="data/data-pelanggan.php" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                                                    <svg class="icon icon-xxs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                    Telusuri
                                                </a>
                                            </div>
                                            </div>
                                        </li>
                                        <?php $no++; } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                <!-- chart 2 -->
                    <div class="col-12 px-0 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                                <div class="d-block">
                                    <div class="h6 fw-normal text-gray mb-2">Total Transaksi</div>
                                    <h2 class="h3 fw-extrabold">
                                        <?php
                                            $sql = "SELECT COUNT(*) AS jumlah FROM transaksi";
                                            $result = mysqli_query($koneksi, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            ?>
                                            <?php echo $row['jumlah'];
                                                $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                                                $transaksiSelesai = array_fill(0, 12, 0); 
                                                $transaksiProses = array_fill(0, 12, 0); 

                                                for ($i = 0; $i < 12; $i++) {
                                                    $sqlSelesai = "SELECT COUNT(*) AS jumlah FROM transaksi WHERE MONTH(tanggaltransaksi) = " . ($i + 1) . " AND statustransaksi = 1";
                                                    $resultSelesai = mysqli_query($koneksi, $sqlSelesai);
                                                    $rowSelesai = mysqli_fetch_assoc($resultSelesai);
                                                    $transaksiSelesai[$i] = $rowSelesai['jumlah'];

                                                    $sqlProses = "SELECT COUNT(*) AS jumlah FROM transaksi WHERE MONTH(tanggaltransaksi) = " . ($i + 1) . " AND statustransaksi = 0";
                                                    $resultProses = mysqli_query($koneksi, $sqlProses);
                                                    $rowProses = mysqli_fetch_assoc($resultProses);
                                                    $transaksiProses[$i] = $rowProses['jumlah'];
                                                }
                                                $data = [
                                                    "labels" => $bulan,
                                                    "datasets" => [
                                                        [
                                                            "label" => "Transaksi Selesai",
                                                            "data" => $transaksiSelesai,
                                                            "backgroundColor" => "rgb(16, 185, 129)",
                                                            "borderWidth" => 1
                                                        ],
                                                        [
                                                            "label" => "Transaksi Proses",
                                                            "data" => $transaksiProses,
                                                            "backgroundColor" => "rgb(225, 29, 72)",
                                                            "borderWidth" => 1
                                                        ]
                                                    ]
                                            ];
                                        ?>
                                    </h2>
                                </div>
                                <div class="d-block ms-auto">
                                    <div class="d-flex align-items-center text-end mb-2">
                                        <span class="dot rounded-circle bg-success me-2"></span>
                                        <span class="fw-normal small">Selesai</span>
                                    </div>
                                    <div class="d-flex align-items-center text-end">
                                        <span class="dot rounded-circle bg-danger me-2"></span>
                                        <span class="fw-normal small">Proses</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- global -->
                    <div class="col-12 px-0 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                    <div>
                                        <div class="h6 mb-0 d-flex align-items-center">
                                            <i class="bi bi-airplane-engines me-3"></i>
                                            Destinasi
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#" class="d-flex align-items-center fw-bold">
                                            #<?php
                                            $sql = "SELECT COUNT(*) AS jumlah FROM destinasi";
                                            $result = mysqli_query($koneksi, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            ?>
                                            <?php echo $row['jumlah'];?>
                                            <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pt-3">
                                    <div>
                                        <div class="h6 mb-0 d-flex align-items-center">
                                            <i class="bi bi-box2-heart me-3"></i>
                                            Paket
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#" class="d-flex align-items-center fw-bold">
                                            #<?php
                                            $sql = "SELECT COUNT(*) AS jumlah FROM paket";
                                            $result = mysqli_query($koneksi, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            ?>
                                            <?php echo $row['jumlah'];?>
                                            <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between  pb-3 pt-3">
                                    <div>
                                        <div class="h6 mb-0 d-flex align-items-center">
                                            <i class="bi bi-person-workspace me-3"></i>
                                            Pemandu
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#" class="d-flex align-items-center fw-bold">
                                            #<?php
                                            $sql = "SELECT COUNT(*) AS jumlah FROM pemandu";
                                            $result = mysqli_query($koneksi, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            ?>
                                            <?php echo $row['jumlah'];?>
                                            <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include 'footer.php'; ?>

</main>

    <!-- Core -->
<script src="../assets/vendor/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vendor JS -->
<script src="../assets/vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
<script src="../assets/vendor/nouislider/dist/nouislider.min.js"></script>

<!-- Smooth scroll -->
<script src="../assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<script>
    var ctx = document.getElementById('transaksiChart').getContext('2d');
    var transaksiChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Total Transaksi',
                data: <?= $total_json; ?>, 
                backgroundColor: 'rgb(255, 193, 7)', 
                borderColor: 'rgb(255, 193, 7)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true, 
            maintainAspectRatio: false, 
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false 
                    },
                    ticks: {
                    display: false,
                }
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return 'Rp ' + tooltipItem.yLabel.toLocaleString('id-ID');
                    }
                }
            }
        }
    });

    // chart 2
    const ctx2 = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx2, {
        type: 'bar',
        data: <?php echo json_encode($data); ?>, 
        options: {
            responsive: true,
            maintainAspectRatio: false, 
            scales: {
                x: {
                    grid: {
                        display: false,
                    }
                },
                y: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        display: false, 
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                        }
                    }
                }
            },
            elements: {
                bar: {
                    borderRadius: 10, 
                }
            }
        }
    });
</script>




<!-- Datepicker -->
<script src="../assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Sweet Alerts 2 -->
<script src="../assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="../assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Notyf -->
<script src="../assets/vendor/notyf/notyf.min.js"></script>

<!-- Simplebar -->
<script src="../assets/vendor/simplebar/dist/simplebar.min.js"></script>

<!-- Volt JS -->
<script src="../assets/js/volt.js"></script>

    
</body>

</html>

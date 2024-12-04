<?php 
require_once 'config/koneksi.php';

if(!isset($_GET['id'])){
    header('Location: index.php');
    exit;
}

$iddestinasi = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE iddestinasi = '$iddestinasi'");
$datadestinasi = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) < 1){
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'navbar.php';?>


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Tourist</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="service.php" class="nav-item nav-link">Services</a>
                    <a href="package.php" class="nav-item nav-link">Packages</a>                    
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <a href="" class="btn btn-primary rounded-pill py-2 px-4">Register</a>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Destination</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Destination</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Single Product Start -->
        <div class="container">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <a href="#" class="h1 display-5"><?php echo $datadestinasi ['juduldestinasi']?></a>
                            <div class="d-flex align-items-center my-2 pt-3">
                                <small class="text-body"><i class="fas fa-calendar-alt me-1"></i> 
                                    <?php
                                            $timestamp = strtotime($datadestinasi['tanggaldestinasi']);
                                            $dayName = $days[date('l', $timestamp)]; 
                                            $day = date('d', $timestamp); 
                                            $month = $months[date('m', $timestamp)];
                                            $year = date('Y', $timestamp); 
                                            echo $dayName . ', ' . $day . ' ' . $month . ' ' . $year;
                                    ?>
                                </small>
                            </div>
                        </div>
                        <div class="position-relative rounded overflow-hidden mb-3">
                            <img src="assets/cover/<?php echo $datadestinasi['coverdestinasi']; ?>" class="img-fluid rounded w-100 " style="height: 600px; object-fit: cover" alt="">
                        </div>
                        <?php echo $datadestinasi ['isidestinasi']?>
                        <?php echo $datadestinasi ['isidestinasi']?>
                        <div class="tab-class mt-5">
                            <div class="d-flex justify-content-between border-bottom mb-4">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 me-3">Bagikan:</h5>
                                    <i class="fab fa-facebook-f link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                    <i class="btn fab bi-twitter link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                    <i class="btn fab fa-instagram link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                    <i class="btn fab fa-linkedin-in link-hover btn btn-square rounded-circle border-primary text-dark"></i>
                                </div>
                            </div>
                        </div>

                        <!-- komen -->
                        <div class="bg-light rounded p-4">
                            <h4 class="mb-4">Komen</h4>
                            <div class="p-4 bg-white rounded mb-4">
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT idpemandu, coverpemandu, namapemandu FROM pemandu LIMIT 2");
                                while($data = mysqli_fetch_assoc($sql)) {
                                ?>
                                <div class="row g-4 mt-4">
                                    <div class="col-3">
                                        <img src="assets/cover/<?php echo $data['coverpemandu']; ?>" class="img-fluid rounded-circle" style="width:200px;height:180px; object-fit:cover" alt="">
                                    </div>
                                    <div class="col-9">
                                        <div class="d-flex justify-content-between">
                                            <h5><?php echo $data['namapemandu'];?></h5>
                                            <a href="#" class="link-hover text-body fs-6"><i class="fas fa-long-arrow-alt-right me-1"></i> Balas</a>
                                        </div>
                                        <small class="text-body d-block mb-3"><i class="fas fa-calendar-alt me-1"></i> 
                                            <?php echo $date1; ?>
                                        </small>
                                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum has been the industry's standard dummy type and scrambled it to make a type specimen book. It has survived not only five centuries,
                                        </p>
                                    </div>
                                </div>
                                <?php $no++; } ?>
                            </div>
                        </div>

                        <div class="bg-light rounded p-4 my-4">
                            <h4 class="mb-4">Tinggalkan Komentar</h4>
                            <form id="commentForm">
                            <!-- Alert Placeholder -->
                            <div id="alertPlaceholder" class="mt-4"></div>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control py-3" id="namaLengkap" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" class="form-control py-3" id="email" placeholder="Alamat Email" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" id="komentar" cols="30" rows="7" placeholder="Tulis Komentar Anda disini" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="form-control btn py-3" type="button" onclick="submitForm()">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- sidebar content -->
                    <div class="col-lg-4">
                        <div class="row g-4">
                            <div class="col-12">
                                    <div class="p-3 rounded border"> 
                                        <div class="row g-4">
                                            <?php
                                                $sql = mysqli_query($koneksi, "SELECT iddestinasi, coverdestinasi, juduldestinasi, tanggaldestinasi FROM destinasi ORDER BY RAND() LIMIT 1  ");
                                                $data = mysqli_fetch_assoc($sql);
                                            ?>
                                            <div class="position-relative overflow-hidden rounded">
                                                <img src="assets/cover/<?php echo $datadestinasi['coverdestinasi']; ?>" class=" img-fluid rounded-top w-100" alt="">
                                                <div class="d-flex justify-content-center px-4 position-absolute flex-wrap bg-primary">
                                                    <a href="#" class="text-dark me-3 link-hover"><i class="fas fa-calendar-alt me-2"></i> <?php
                                                    $timestamp = strtotime($data['tanggaldestinasi']);
                                                    $dayName = $days[date('l', $timestamp)]; 
                                                    $day = date('d', $timestamp); 
                                                    $month = $months[date('m', $timestamp)];
                                                    $year = date('Y', $timestamp); 
                                                    echo $dayName . ', ' . $day . ' ' . $month . ' ' . $year;
                                                ?></a>
                                            </div>

                                            <div class="border-bottom pb-3">
                                                <a href="berita.php?id=<?php echo $datadestinasi['iddestinasi'];?>" class="h5 text-dark mb-0 link-hover"><?php echo $datadestinasi ['juduldestinasi']; ?></a>
                                            </div>
                                        </div>
                                        <h4 class=" py-2">Destinasi Popular</h4>
                                       <?php
                                        $sql = mysqli_query($koneksi, "SELECT * FROM destinasi ORDER BY RAND() LIMIT 6");

                                        while ($data = mysqli_fetch_assoc($sql)) {
                                            $coverdestinasi = $data['coverdestinasi'];
                                            $juduldestinasi = $data['juduldestinasi'];
                                            $tanggaldestinasi = date('F d, Y', strtotime($data['tanggaldestinasi']));
                                            $iddestinasi = $data['iddestinasi'];
                                            $gambarPath = 'assets/cover/' . $coverdestinasi;
                                            ?>

                                            <div class="row g-2 align-items-center mb-3 news-item">
                                                <!-- Kolom Gambar -->
                                                <div class="col-5 pt-2">
                                                    <div class="overflow-hidden rounded img-container">
                                                        <img src="<?php echo $gambarPath; ?>" class="img-content img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                
                                                <!-- Kolom Konten -->
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column content-container">
                                                        <a href="destinasi.php?id=<?php echo $iddestinasi; ?>" class="mb-2"><?php echo $juduldestinasi; ?></a>
                                                        <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> 
                                                            <?php
                                                                    $timestamp = strtotime($datadestinasi['tanggaldestinasi']);
                                                                    $dayName = $days[date('l', $timestamp)]; 
                                                                    $day = date('d', $timestamp); 
                                                                    $month = $months[date('m', $timestamp)];
                                                                    $year = date('Y', $timestamp); 
                                                                    echo $dayName . ', ' . $day . ' ' . $month . ' ' . $year;
                                                            ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                        ?>

                                        
                                        <h4 class="mb-4 pt-4">Tetap Terhubung</h4>
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <a href="#" class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                                    <i class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                                    <span class="text-white"><?php echo number_format(rand(10000, 1000000), 0, '', '.'); ?> Penggemar</span>
                                                </a>
                                                <a href="#" class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                                    <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                                                    <span class="text-white"><?php echo number_format(rand(10000, 1000000), 0, '', '.'); ?> Pengikut</span>
                                                </a>
                                                <a href="#" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                                    <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                                    <span class="text-white"><?php echo number_format(rand(10000, 1000000), 0, '', '.'); ?> Pelanggan</span>
                                                </a>
                                                <a href="#" class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                                    <i class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                                    <span class="text-white"><?php echo number_format(rand(10000, 1000000), 0, '', '.'); ?> Pengikut</span>
                                                </a>
                                                <a href="#" class="w-100 rounded btn btn-secondary d-flex align-items-center p-3 mb-2">
                                                    <i class="bi-cloud btn btn-light btn-square rounded-circle me-3"></i>
                                                    <span class="text-white"><?php echo number_format(rand(10000, 1000000), 0, '', '.'); ?> Pelanggan</span>
                                                </a>
                                                <a href="#" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-4">
                                                    <i class="fab fa-dribbble btn btn-light btn-square rounded-circle me-3"></i>
                                                    <span class="text-white"><?php echo number_format(rand(10000, 1000000), 0, '', '.'); ?> Pelanggan</span>
                                                </a>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Single Product End -->
    
    <?php include 'footer.php';?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>

    <script>
        function submitForm() {
                // Get form values
                const namaLengkap = document.getElementById('namaLengkap').value;
                const email = document.getElementById('email').value;
                const komentar = document.getElementById('komentar').value;

                // Check if all fields are filled
                if (namaLengkap && email && komentar) {
                    // Show success alert
                    showAlert('success', 'Komentar Anda telah berhasil dikirim!');
                } else {
                    // Show error alert
                    showAlert('danger', 'Semua kolom harus diisi sebelum mengirim komentar.');
                }
            }

            function showAlert(type, message) {
                const alertPlaceholder = document.getElementById('alertPlaceholder');
                alertPlaceholder.innerHTML = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }
    </script>
</body>

</html>
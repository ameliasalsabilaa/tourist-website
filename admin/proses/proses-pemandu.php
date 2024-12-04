<?php
require '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    
    $idpemandu = uniqid();
    $coverpemandu = $_FILES['coverpemandu'];
    $namapemandu = $_POST['namapemandu'];
    $genderpemandu = $_POST['genderpemandu'];
    $asalpemandu = $_POST['asalpemandu'];
    $tanggalpemandu = $_POST['tanggalpemandu'];
    $statuspemandu = $_POST['statuspemandu'];

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $nama_file = $coverpemandu['name'];
    $ukuran_file = $coverpemandu['size'];
    $tmp_file = $coverpemandu['tmp_name'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file_baru = strtolower(end($ekstensi_file));
    $lokasi_file = '../../assets/cover/'. $nama_file;
    if ($ukuran_file > 1000000) {
        echo "<script>alert('Ukuran cover pemandu terlalu besar');window.location='../data/data-pemandu.php'</script>";
        exit();
    }
    if (!in_array($ekstensi_file_baru, $ekstensi_diperbolehkan)) {
        echo "<script>alert('Format cover pemandu yang diperbolehkan adalah PNG, JPG, dan JPEG');window.location='../data/data-pemandu.php'</script>";
        exit();
    }
    move_uploaded_file($tmp_file, $lokasi_file); 
    $query = "INSERT INTO pemandu (idpemandu, coverpemandu, namapemandu, genderpemandu, asalpemandu, tanggalpemandu, statuspemandu) VALUES ('$idpemandu', '$nama_file', '$namapemandu', '$genderpemandu', '$asalpemandu', '$tanggalpemandu', '$statuspemandu')";
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        echo "<script>alert('Data pemandu berhasil disimpan');window.location='../data/data-pemandu.php'</script>";
    } else {
        echo "<script>alert('Data pemandu gagal disimpan');window.location='../data/data-pemandu.php'</script>";
    }

}

if (isset($_POST['ubah'])) {
$idpemandu = $_SESSION['idpemandu'];
$namapemandu = $_POST['namapemandu'];
$genderpemandu = $_POST['genderpemandu'];
$tanggalpemandu = $_POST['tanggalpemandu'];
$asalpemandu = $_POST['asalpemandu'];
$statuspemandu = $_POST['statuspemandu'];

if ($_FILES['coverpemandu']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['coverpemandu']['tmp_name'];
    $fileName = $_FILES['coverpemandu']['name'];
    $fileSize = $_FILES['coverpemandu']['size'];
    $fileType = $_FILES['coverpemandu']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $uploadFileDir = '../../assets/cover/';
    $dest_path = $uploadFileDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $sql = mysqli_query($koneksi, "SELECT coverpemandu FROM pemandu WHERE idpemandu='$idpemandu'");
        $data = mysqli_fetch_assoc($sql);
        if ($data['coverpemandu'] && file_exists($uploadFileDir . $data['coverpemandu'])) {
            unlink($uploadFileDir . $data['coverpemandu']);
        }
        
        $query = "UPDATE pemandu SET coverpemandu='$newFileName', namapemandu='$namapemandu', genderpemandu='$genderpemandu', tanggalpemandu='$tanggalpemandu', asalpemandu='$asalpemandu', statuspemandu='$statuspemandu' WHERE idpemandu='$idpemandu'";
    } else {
        $query = "UPDATE pemandu SET namapemandu='$namapemandu', genderpemandu='$genderpemandu', tanggalpemandu='$tanggalpemandu', asalpemandu='$asalpemandu', statuspemandu='$statuspemandu' WHERE idpemandu='$idpemandu'";
    }
} else {
    $query = "UPDATE pemandu SET namapemandu='$namapemandu', genderpemandu='$genderpemandu', tanggalpemandu='$tanggalpemandu', asalpemandu='$asalpemandu', statuspemandu='$statuspemandu' WHERE idpemandu='$idpemandu'";
}

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data pemandu berhasil diubah');window.location='../data/data-pemandu.php'</script>";
    } else {
        echo "<script>alert('Data pemandu gagal diubah');window.location='../data/data-pemandu.php'</script>";
    }
}

if (isset($_GET['id'])) {
    $idpemandu = $_GET['id'];

    if (!empty($idpemandu)) {
        $queryDeleteTransaksi = "DELETE FROM transaksi WHERE idpaket IN (SELECT idpaket FROM paket WHERE idpemandu = '$idpemandu')";
        $resultDeleteTransaksi = mysqli_query($koneksi, $queryDeleteTransaksi);

        if ($resultDeleteTransaksi) {
            $queryDeletePaket = "DELETE FROM paket WHERE idpemandu = '$idpemandu'";
            $resultDeletePaket = mysqli_query($koneksi, $queryDeletePaket);

            if ($resultDeletePaket) {
                $queryDeletePemandu = "DELETE FROM pemandu WHERE idpemandu = '$idpemandu'";
                $resultDeletePemandu = mysqli_query($koneksi, $queryDeletePemandu);

                if ($resultDeletePemandu) {
                    echo "<script>alert('Data berhasil dihapus'); window.location='../data/data-pemandu.php';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data dari tabel pemandu'); window.location='../data/data-pemandu.php';</script>";
                }
            } else {
                echo "<script>alert('Gagal menghapus data terkait di tabel paket'); window.location='../data/data-pemandu.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal menghapus data terkait di tabel transaksi'); window.location='../data/data-pemandu.php';</script>";
        }
    } else {
        echo "<script>alert('ID pemandu tidak valid'); window.location='../data/data-pemandu.php';</script>";
    }
}






?>
<?php
require '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    
    $idpaket = uniqid();
    $idpemandu = $_POST['idpemandu'];
    $coverpaket = $_FILES['coverpaket'];
    $namapaket = $_POST['namapaket'];
    $hargapaket = str_replace('.', '', $_POST['hargapaket']); 
    $tanggalpaket = $_POST['tanggalpaket'];
    $statuspaket = $_POST['statuspaket'];

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $nama_file = $coverpaket['name'];
    $ukuran_file = $coverpaket['size'];
    $tmp_file = $coverpaket['tmp_name'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file_baru = strtolower(end($ekstensi_file));
    $lokasi_file = '../../assets/cover/'. $nama_file;
    if ($ukuran_file > 1000000) {
        echo "<script>alert('Ukuran cover paket terlalu besar');window.location='../data/data-paket.php'</script>";
        exit();
    }
    if (!in_array($ekstensi_file_baru, $ekstensi_diperbolehkan)) {
        echo "<script>alert('Format cover paket yang diperbolehkan adalah PNG, JPG, dan JPEG');window.location='../data/data-paket.php'</script>";
        exit();
    }
    move_uploaded_file($tmp_file, $lokasi_file); 
    $query = "INSERT INTO paket (idpaket, idpemandu, coverpaket, namapaket, hargapaket, tanggalpaket, statuspaket) VALUES ('$idpaket', '$idpemandu', '$nama_file', '$namapaket', '$hargapaket', '$tanggalpaket', '$statuspaket')";
    $result = mysqli_query($koneksi, $query);

    $iddestinasi = $_POST['iddestinasi'];
    if (!empty($idpaket) && !empty($iddestinasi)) {
        foreach ($iddestinasi as $iddestinasi) {
            $idpaketdestinasi = uniqid(); 

            $query = "INSERT INTO paketdestinasi (idpaketdestinasi, iddestinasi, idpaket) VALUES ('$idpaketdestinasi', '$iddestinasi', '$idpaket')";
            $result = mysqli_query($koneksi, $query);
        }
    }
    
    if ($result) {
        echo "<script>alert('Data paket berhasil disimpan');window.location='../data/data-paket.php'</script>";
    } else {
        echo "<script>alert('Data paket gagal disimpan');window.location='../data/data-paket.php'</script>";
    }

}

if (isset($_POST['ubah'])) {
    $idpaket = $_SESSION['idpaket']; 
    $idpemandu = $_POST['idpemandu'];
    $coverpaket = $_FILES['coverpaket'];
    $namapaket = $_POST['namapaket'];
    $hargapaket = str_replace('.', '', $_POST['hargapaket']); 
    $tanggalpaket = $_POST['tanggalpaket'];
    $statuspaket = $_POST['statuspaket'];

    $query = "SELECT coverpaket FROM paket WHERE idpaket='$idpaket'";
    $result = mysqli_query($koneksi, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $coverpaket_lama = $row['coverpaket'];
    } else {
        $coverpaket_lama = null; 
    }

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $nama_file = $coverpaket['name'];
    $ukuran_file = $coverpaket['size'];
    $tmp_file = $coverpaket['tmp_name'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file_baru = strtolower(end($ekstensi_file));
    $lokasi_file = '../../assets/cover/' . $nama_file;

    if ($nama_file != "") {
        if ($ukuran_file > 1000000) {
            echo "<script>alert('Ukuran cover paket terlalu besar');window.location='../data/data-paket.php'</script>";
            exit();
        }
        if (!in_array($ekstensi_file_baru, $ekstensi_diperbolehkan)) {
            echo "<script>alert('Format cover paket yang diperbolehkan adalah PNG, JPG, dan JPEG');window.location='../data/data-paket.php'</script>";
            exit();
        }
        
        if ($coverpaket_lama && file_exists('../../assets/cover/' . $coverpaket_lama)) {
            unlink('../../assets/cover/' . $coverpaket_lama);
        }
        move_uploaded_file($tmp_file, $lokasi_file);
        $cover_query_part = "coverpaket='$nama_file', ";
    } else {
        $cover_query_part = "";
    }

    $query = "UPDATE paket SET 
                $cover_query_part
                idpemandu='$idpemandu', 
                namapaket='$namapaket', 
                hargapaket='$hargapaket', 
                tanggalpaket='$tanggalpaket', 
                statuspaket='$statuspaket' 
              WHERE idpaket='$idpaket'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $sql = "DELETE FROM paketdestinasi WHERE idpaket = '$idpaket'";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $iddestinasi = $_POST['iddestinasi'];
            if(!empty($iddestinasi)){
                foreach($iddestinasi as $iddestinasi){
                    $idpaketdestinasi = uniqid();
                    $query = "INSERT INTO paketdestinasi (idpaketdestinasi, idpaket, iddestinasi) 
                              VALUES ('$idpaketdestinasi', '$idpaket', '$iddestinasi')";
                    $result = mysqli_query($koneksi, $query);
                    if (!$result) {
                        echo "<script>alert('Data destinasi gagal diubah');window.location='../data/data-paket.php'</script>";
                        exit();
                    }
                }
            }
            echo "<script>alert('Data paket berhasil diubah');window.location='../data/data-paket.php'</script>";
        } else {
            echo "<script>alert('Data destinasi gagal dihapus');window.location='../data/data-paket.php'</script>";
        }
    } else {
        echo "<script>alert('Data paket gagal diubah');window.location='../data/data-paket.php'</script>";
    }
}

if (isset($_GET['id'])) {
 
    $idpaket = $_GET['id'];

    if (!empty($idpaket)) {

        $queryDeleteAktivitasDestinasi = "DELETE FROM paketdestinasi WHERE idpaket = '$idpaket'";
        $resultDeleteAktivitasDestinasi = mysqli_query($koneksi, $queryDeleteAktivitasDestinasi);

        if ($resultDeleteAktivitasDestinasi) {
            $queryDeleteAktivitas = "DELETE FROM paket WHERE idpaket = '$idpaket'";
            $resultDeleteAktivitas = mysqli_query($koneksi, $queryDeleteAktivitas);

            if ($resultDeleteAktivitas) {
                echo "<script>alert('Data berhasil dihapus'); window.location='../data/data-paket.php';</script>";
            } else {
                echo "<script>alert('Data gagal dihapus dari tabel aktivitas'); window.location='../data/data-paket.php';</script>";
            }
        } else {
            echo "<script>alert('Data gagal dihapus dari tabel aktivitasdestinasi'); window.location='../data/data-paket.php';</script>";
        }
    } else {
        echo "<script>alert('ID Aktivitas tidak valid'); window.location='../data/data-paket.php';</script>";
    }
}


?>
<?php
require '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    
    $iddestinasi = uniqid();
    $coverdestinasi = $_FILES['coverdestinasi'];
    $tempatdestinasi = $_POST['tempatdestinasi'];
    $juduldestinasi = $_POST['juduldestinasi'];
    $tanggaldestinasi = $_POST['tanggaldestinasi'];
    $isidestinasi = $_POST['isidestinasi'];
    $statusdestinasi = $_POST['statusdestinasi'];

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $nama_file = $coverdestinasi['name'];
    $ukuran_file = $coverdestinasi['size'];
    $tmp_file = $coverdestinasi['tmp_name'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file_baru = strtolower(end($ekstensi_file));
    $lokasi_file = '../../assets/cover/'. $nama_file;
    if ($ukuran_file > 1000000) {
        echo "<script>alert('Ukuran cover destinasi terlalu besar');window.location='data-destinasi.php'</script>";
        exit();
    }
    if (!in_array($ekstensi_file_baru, $ekstensi_diperbolehkan)) {
        echo "<script>alert('Format cover destinasi yang diperbolehkan adalah PNG, JPG, dan JPEG');window.location='data-destinasi.php'</script>";
        exit();
    }
    move_uploaded_file($tmp_file, $lokasi_file); 
    $query = "INSERT INTO destinasi (iddestinasi, coverdestinasi, tempatdestinasi, juduldestinasi, tanggaldestinasi, isidestinasi, statusdestinasi) VALUES ('$iddestinasi', '$nama_file', '$tempatdestinasi', '$juduldestinasi', '$tanggaldestinasi', '$isidestinasi', '$statusdestinasi')";
    $result = mysqli_query($koneksi, $query);

    $idaktivitas = $_POST['idaktivitas'];
    if (!empty($iddestinasi) && !empty($idaktivitas)) {
        foreach ($idaktivitas as $idaktivitas) {
            $idaktivitasdestinasi = uniqid(); 

            $query = "INSERT INTO aktivitasdestinasi (idaktivitasdestinasi, iddestinasi, idaktivitas) VALUES ('$idaktivitasdestinasi', '$iddestinasi', '$idaktivitas')";
            $result = mysqli_query($koneksi, $query);
        }
    }
    
    if ($result) {
        echo "<script>alert('Data destinasi berhasil disimpan');window.location='../data/data-destinasi.php'</script>";
    } else {
        echo "<script>alert('Data destinasi gagal disimpan');window.location='../data/data-destinasi.php'</script>";
    }

}

if (isset($_POST['ubah'])) {
    $iddestinasi = $_SESSION['iddestinasi'];
    $coverdestinasi = $_FILES['coverdestinasi'];
    $tempatdestinasi = $_POST['tempatdestinasi'];
    $juduldestinasi = $_POST['juduldestinasi'];
    $tanggaldestinasi = $_POST['tanggaldestinasi'];
    $isidestinasi = $_POST['isidestinasi'];
    $statusdestinasi = $_POST['statusdestinasi'];

    $query = "SELECT coverdestinasi FROM destinasi WHERE iddestinasi='$iddestinasi'";
    $result = mysqli_query($koneksi, $query);
    $coverdestinasi_lama = null;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $coverdestinasi_lama = $row['coverdestinasi'];
    }

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $nama_file = $coverdestinasi['name'];
    $ukuran_file = $coverdestinasi['size'];
    $tmp_file = $coverdestinasi['tmp_name'];
    $ekstensi_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $lokasi_file = '../../assets/cover/' . $nama_file;

    $query = "UPDATE destinasi SET 
                tempatdestinasi='$tempatdestinasi', 
                juduldestinasi='$juduldestinasi', 
                tanggaldestinasi='$tanggaldestinasi', 
                isidestinasi='$isidestinasi', 
                statusdestinasi='$statusdestinasi' 
              WHERE iddestinasi='$iddestinasi'";

    if ($nama_file != "") {
        if ($ukuran_file > 1000000) {
            echo "<script>alert('Ukuran cover destinasi terlalu besar');window.location='../data/data-destinasi.php'</script>";
            exit();
        }
        if (!in_array($ekstensi_file, $ekstensi_diperbolehkan)) {
            echo "<script>alert('Format cover destinasi yang diperbolehkan adalah PNG, JPG, dan JPEG');window.location='../data/data-destinasi.php'</script>";
            exit();
        }

        if ($coverdestinasi_lama && file_exists('../../assets/cover/' . $coverdestinasi_lama)) {
            unlink('../../assets/cover/' . $coverdestinasi_lama);
        }

        move_uploaded_file($tmp_file, $lokasi_file);
        
        $query = "UPDATE destinasi SET 
                    coverdestinasi='$nama_file', 
                    tempatdestinasi='$tempatdestinasi', 
                    juduldestinasi='$juduldestinasi', 
                    tanggaldestinasi='$tanggaldestinasi', 
                    isidestinasi='$isidestinasi', 
                    statusdestinasi='$statusdestinasi' 
                  WHERE iddestinasi='$iddestinasi'";
    }

    $result = mysqli_query($koneksi, $query);

    $sql = "DELETE FROM aktivitasdestinasi WHERE iddestinasi = '$iddestinasi'";
    $result = mysqli_query($koneksi, $sql);

    $idaktivitas = $_POST['idaktivitas'];
    if (!empty($idaktivitas)) {
        foreach ($idaktivitas as $idaktivitas_item) {
            $idaktivitasdestinasi = uniqid();
            $query = "INSERT INTO aktivitasdestinasi (idaktivitasdestinasi, iddestinasi, idaktivitas) VALUES ('$idaktivitasdestinasi', '$iddestinasi', '$idaktivitas_item')";
            mysqli_query($koneksi, $query);
        }
    }

    if ($result) {
        echo "<script>alert('Data destinasi berhasil diubah');window.location='../data/data-destinasi.php'</script>";
    } else {
        echo "<script>alert('Data destinasi gagal diubah');window.location='../data/data-destinasi.php'</script>";
    }
}

if (isset($_GET['id'])) {
 
    $iddestinasi = $_GET['id'];

    if (!empty($iddestinasi)) {

        $queryDeleteAktivitasDestinasi = "DELETE FROM aktivitasdestinasi WHERE iddestinasi = '$iddestinasi'";
        $resultDeleteAktivitasDestinasi = mysqli_query($koneksi, $queryDeleteAktivitasDestinasi);

        if ($resultDeleteAktivitasDestinasi) {
            $queryDeleteAktivitas = "DELETE FROM destinasi WHERE iddestinasi = '$iddestinasi'";
            $resultDeleteAktivitas = mysqli_query($koneksi, $queryDeleteAktivitas);

            if ($resultDeleteAktivitas) {
                echo "<script>alert('Data berhasil dihapus'); window.location='../data/data-destinasi.php';</script>";
            } else {
                echo "<script>alert('Data gagal dihapus dari tabel aktivitas'); window.location='../data/data-destinasi.php';</script>";
            }
        } else {
            echo "<script>alert('Data gagal dihapus dari tabel aktivitasdestinasi'); window.location='../data/data-destinasi.php';</script>";
        }
    } else {
        echo "<script>alert('ID Aktivitas tidak valid'); window.location='../data/data-destinasi.php';</script>";
    }
}



?>
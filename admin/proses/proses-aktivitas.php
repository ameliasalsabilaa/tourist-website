<?php
require '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    
    $idaktivitas = uniqid();
    $namaaktivitas = $_POST['namaaktivitas'];

    $query = "INSERT INTO aktivitas (idaktivitas, namaaktivitas)
            VALUES ('$idaktivitas', '$namaaktivitas')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil disimpan');window.location='../data/data-aktivitas.php'</script>";
    } else {
        echo "<script>alert('Data gagal disimpan');window.location='../data/data-aktivitas.php'</script>";
    }

}

if (isset($_POST['ubah'])) {
    $idaktivitas = $_SESSION['idaktivitas'];
    $namaaktivitas = $_POST['namaaktivitas'];

    $query = "UPDATE aktivitas SET namaaktivitas = '$namaaktivitas' WHERE idaktivitas = '$idaktivitas'";
    $result = mysqli_query($koneksi, $query);

    if (!empty($_POST['idaktivitas'])) {
        foreach ($_POST['idaktivitas'] as $idaktivitas) {
            $idaktivitasaktivitas = uniqid();
            $query = "INSERT INTO aktivitas (idaktivitasaktivitas, namaaktivitas) VALUES ('$idaktivitasaktivitas', '$namaaktivitas')";
            mysqli_query($koneksi, $query);
        }
    }

    if ($result) {
        echo "<script>alert('Data berhasil diubah'); window.location='../data/data-aktivitas.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah'); window.location='../data/data-aktivitas.php';</script>";
    }
}


if (isset($_GET['id'])) {

    $idaktivitas = $_GET['id'];

    if (!empty($idaktivitas)) {

        $queryDeleteAktivitasDestinasi = "DELETE FROM aktivitasdestinasi WHERE idaktivitas = '$idaktivitas'";
        $resultDeleteAktivitasDestinasi = mysqli_query($koneksi, $queryDeleteAktivitasDestinasi);

        if ($resultDeleteAktivitasDestinasi) {
            $queryDeleteAktivitas = "DELETE FROM aktivitas WHERE idaktivitas = '$idaktivitas'";
            $resultDeleteAktivitas = mysqli_query($koneksi, $queryDeleteAktivitas);

            if ($resultDeleteAktivitas) {
                echo "<script>alert('Data berhasil dihapus'); window.location='../data/data-aktivitas.php';</script>";
            } else {
                echo "<script>alert('Data gagal dihapus dari tabel aktivitas'); window.location='../data/data-aktivitas.php';</script>";
            }
        } else {
            echo "<script>alert('Data gagal dihapus dari tabel aktivitasdestinasi'); window.location='../data/data-aktivitas.php';</script>";
        }
    } else {
        echo "<script>alert('ID Aktivitas tidak valid'); window.location='../data/data-aktivitas.php';</script>";
    }
}



?>
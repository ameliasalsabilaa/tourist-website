<?php
require '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    
    $idpengguna = uniqid();
    $namapengguna = $_POST['namapengguna'];
    $levelpengguna = $_POST['levelpengguna'];
    $statuspengguna = $_POST['statuspengguna'];

    $query = "INSERT INTO pengguna (idpengguna, namapengguna, levelpengguna, statuspengguna) VALUES ('$idpengguna', '$namapengguna', '$levelpengguna', '$statuspengguna')";
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        echo "<script>alert('Data pengguna berhasil disimpan');window.location='../data/data-pengguna.php'</script>";
    } else {
        echo "<script>alert('Data pengguna gagal disimpan');window.location='../data/data-pengguna.php'</script>";
    }

}

if (isset($_POST['ubah'])) {
    $idpengguna = $_SESSION['idpengguna'];  
    $namapengguna = $_POST['namapengguna'];
    $levelpengguna = $_POST['levelpengguna'];
    $statuspengguna = $_POST['statuspengguna'];

    $query = "UPDATE pengguna SET namapengguna = '$namapengguna', levelpengguna = '$levelpengguna', statuspengguna = '$statuspengguna' WHERE idpengguna = '$idpengguna'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil diubah'); window.location='../data/data-pengguna.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah'); window.location='../data/data-pengguna.php';</script>";
    }
}

if (isset($_GET['id'])) {

    $idpengguna = $_GET['id'];

    if (!empty($idpengguna)) {
        $query = "DELETE FROM pengguna WHERE idpengguna = '$idpengguna'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>alert('Data berhasil dihapus'); window.location='../data/data-pengguna.php';</script>";
        } else {
            echo "<script>alert('Data gagal dihapus'); window.location='../data/data-pengguna.php';</script>";
        }
    } else {
        echo "<script>alert('ID pengguna tidak valid'); window.location='../data/data-pengguna.php';</script>";
    }
}


?>
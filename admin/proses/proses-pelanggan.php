<?php
require '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    
    $idpelanggan = uniqid();
    $namapelanggan = $_POST['namapelanggan'];
    $nopelanggan = $_POST['nopelanggan'];
    $emailpelanggan = $_POST['emailpelanggan'];
    $alamatpelanggan = $_POST['alamatpelanggan'];
    $tanggalpelanggan = $_POST['tanggalpelanggan'];

    $query = "INSERT INTO pelanggan (idpelanggan, namapelanggan, nopelanggan, emailpelanggan, alamatpelanggan, tanggalpelanggan) VALUES ('$idpelanggan', '$namapelanggan', '$nopelanggan', '$emailpelanggan', '$alamatpelanggan', '$tanggalpelanggan')";
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        echo "<script>alert('Data pelanggan berhasil disimpan');window.location='../data/data-pelanggan.php'</script>";
    } else {
        echo "<script>alert('Data pelanggan gagal disimpan');window.location='../data/data-pelanggan.php'</script>";
    }

}

if (isset($_POST['ubah'])) {
    $idpelanggan = $_SESSION['idpelanggan']; 
    $namapelanggan = $_POST['namapelanggan'];
    $nopelanggan = $_POST['nopelanggan'];
    $emailpelanggan = $_POST['emailpelanggan'];
    $alamatpelanggan = $_POST['alamatpelanggan'];
    $tanggalpelanggan = $_POST['tanggalpelanggan'];

    $query = "UPDATE pelanggan SET namapelanggan = '$namapelanggan', nopelanggan = '$nopelanggan', emailpelanggan = '$emailpelanggan', alamatpelanggan = '$alamatpelanggan', tanggalpelanggan = '$tanggalpelanggan' WHERE idpelanggan = '$idpelanggan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil diubah'); window.location='../data/data-pelanggan.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah'); window.location='../data/data-pelanggan.php';</script>";
    }
}

if (isset($_GET['id'])) {

    $idpelanggan = $_GET['id'];

    if (!empty($idpelanggan)) {
        $query = "DELETE FROM pelanggan WHERE idpelanggan = '$idpelanggan'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>alert('Data berhasil dihapus'); window.location='../data/data-pelanggan.php';</script>";
        } else {
            echo "<script>alert('Data gagal dihapus'); window.location='../data/data-pelanggan.php';</script>";
        }
    } else {
        echo "<script>alert('ID Pelanggan tidak valid'); window.location='../data/data-pelanggan.php';</script>";
    }
}


?>
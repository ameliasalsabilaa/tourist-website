<?php
require '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $idtransaksi = uniqid();
    $idpelanggan = $_POST['idpelanggan'];
    $idpaket = $_POST['idpaket'];
    $jumlahpelanggantransaksi = $_POST['jumlahpelanggantransaksi'];
    $tanggaltransaksi = $_POST['tanggaltransaksi'];
    $statustransaksi = $_POST['statustransaksi'];
    $mulaitriptransaksi = $_POST['mulaitriptransaksi'];
    $akhirtriptransaksi = $_POST['akhirtriptransaksi'];
    $metodetransaksi = $_POST['metodetransaksi'];

    $invoice = "INV" . date("YmdHis") . rand(100, 999);

    $result = mysqli_query($koneksi, "SELECT hargapaket FROM paket WHERE idpaket='$idpaket'");
    $row = mysqli_fetch_assoc($result);
    $hargapaket = $row['hargapaket'];

    $totaltransaksi = $hargapaket * $jumlahpelanggantransaksi;

    $query = "INSERT INTO transaksi (idtransaksi, invoice, idpelanggan, idpaket, jumlahpelanggantransaksi, tanggaltransaksi, statustransaksi, mulaitriptransaksi, akhirtriptransaksi, metodetransaksi, totaltransaksi) 
              VALUES ('$idtransaksi', '$invoice', '$idpelanggan', '$idpaket', '$jumlahpelanggantransaksi', '$tanggaltransaksi', '$statustransaksi', '$mulaitriptransaksi', '$akhirtriptransaksi', '$metodetransaksi', '$totaltransaksi')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Transaksi berhasil disimpan');window.location='../data/data-transaksi.php'</script>";
    } else {
        echo "<script>alert('Transaksi gagal disimpan');window.location='../data/data-transaksi.php'</script>";
    }
}

if (isset($_POST['ubah'])) {
    $idtransaksi = $_SESSION['idtransaksi']; 
    $idpelanggan = $_POST['idpelanggan'];
    $idpaket = $_POST['idpaket'];
    $jumlahpelanggantransaksi = $_POST['jumlahpelanggantransaksi'];
    $tanggaltransaksi = $_POST['tanggaltransaksi'];
    $totaltransaksi = $_POST['totaltransaksi'];
    $statustransaksi = $_POST['statustransaksi'];
    $mulaitriptransaksi = $_POST['mulaitriptransaksi'];
    $akhirtriptransaksi = $_POST['akhirtriptransaksi'];

    $query = "UPDATE transaksi SET 
                idpelanggan = '$idpelanggan', 
                idpaket = '$idpaket', 
                jumlahpelanggantransaksi = '$jumlahpelanggantransaksi', 
                tanggaltransaksi = '$tanggaltransaksi', 
                totaltransaksi = '$totaltransaksi', 
                statustransaksi = '$statustransaksi', 
                mulaitriptransaksi = '$mulaitriptransaksi', 
                akhirtriptransaksi = '$akhirtriptransaksi'
              WHERE idtransaksi = '$idtransaksi'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Transaksi berhasil diubah');window.location='../data/data-transaksi.php'</script>";
    } else {
        echo "<script>alert('Transaksi gagal diubah');window.location='../data/data-transaksi.php'</script>";
    }
}

if (isset($_GET['id'])) {
    $idtransaksi = $_GET['id'];

    $query = "DELETE FROM transaksi WHERE idtransaksi = '$idtransaksi'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Transaksi berhasil dihapus');window.location='../data/data-transaksi.php'</script>";
    } else {
        echo "<script>alert('Transaksi gagal dihapus');window.location='../data/data-transaksi.php'</script>";
    }
}


?>
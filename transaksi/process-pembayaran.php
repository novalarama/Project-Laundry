<?php
include ("../connection.php");

$id_transaksi = $_GET["id_transaksi"];
date_default_timezone_set('Asia/Jakarta');
$tgl_bayar = date_create(date("Y-m-d H:i:s"));
$tgl_bayar_fix = date("Y-m-d H:i:s");
# denda = selisih tgl_bayar dan tgl_transaksi
# jika selisih hari > 7, maka selisih hari - 7 * 1000
# else denda = 0

$sql = "select * from transaksi where id_transaksi='$id_transaksi'";

$hasil = mysqli_query($connect, $sql);
$transaksi = mysqli_fetch_array($hasil);

$tgl_transaksi = date_create($transaksi["tgl_transaksi"]);
#menghitung selisih 2 tanggal
$selisih = date_diff($tgl_bayar, $tgl_transaksi);
# mengkonversi hasil selisih format jumlah hari
$selisih_hari = $selisih->format("%a");

$sql = "insert into pembayaran values
('','$id_transaksi','$tgl_bayar_fix')";

if (mysqli_query($connect, $sql)) {
    header("Location:list-transaksi.php");
}else{
    echo mysqli_error($connect);
}

?>
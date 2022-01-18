<?php

include("../connection.php");

$id_transaksi=$_GET["id_transaksi"];

$sql = "delete from transaksi where id_transaksi= '".$id_transaksi."'";

$result = mysqli_query($connect, $sql);

if ($result) {
    header('Location:list-transaksi.php');
} else {
    printf('Gagal'.mysqli_error($connect));
    exit();
}

?>
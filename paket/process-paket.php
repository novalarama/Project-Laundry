<?php
include("../connection.php");

if (isset($_POST["simpan_paket"])) {
    // tampung data input paket dari user
    
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    
    //membuat perintah sql untuk insert data ke table paket
    $sql = "insert into paket values
    ('','$jenis','$harga')";

    //eksekusi perintah sql
    $tambah = mysqli_query($connect, $sql);

    //direct ke halaman list-paket
    if ($tambah) {
        header('Location:list-paket.php');
    } else {
        printf('Gagal'.mysqli_error($connect));
        exit();
    }

# untuk update

}else if(isset($_POST["edit_paket"])){
        # menampung dulu data yang akan di update
        $id_paket = $_POST["id_paket"];
        $jenis = $_POST["jenis"];
        $harga = $_POST["harga"];

        $sql = "update paket set jenis='$jenis', harga='$harga'
        where id_paket='$id_paket'";
        
        $edit = mysqli_query($connect, $sql);
        
        if ($edit) {
            header('Location:list-paket.php');
        } else {
            printf('Gagal'.mysqli_error($connect));
            exit();
        }
        
}
?>
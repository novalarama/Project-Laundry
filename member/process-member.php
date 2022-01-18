<?php
include("../connection.php");

if (isset($_POST["simpan_member"])) {
    // tampung data input member dari user
    
    $nama_member = $_POST["nama_member"];
    $alamat_member = $_POST["alamat_member"];
    $jk_member = $_POST["jk_member"];
    $tlp_member = $_POST["tlp_member"];

    //membuat perintah sql untuk insert data ke table member
    $sql = "insert into member values
    ('','$nama_member','$alamat_member','$jk_member','$tlp_member')";

    //eksekusi perintah sql
    $tambah = mysqli_query($connect, $sql);

    //direct ke halaman list-member
    if ($tambah) {
        header('Location:list-member.php');
    } else {
        printf('Gagal'.mysqli_error($connect));
        exit();
    }

# untuk update

}else if(isset($_POST["edit_member"])){
        # menampung dulu data yang akan di update
        $id_member = $_POST["id_member"];
        $nama_member = $_POST["nama_member"];
        $alamat_member = $_POST["alamat_member"];
        $jk_member = $_POST["jk_member"];
        $tlp_member = $_POST["tlp_member"];

        $sql = "update member set nama_member='$nama_member', alamat_member='$alamat_member',jk_member='$jk_member',
        tlp_member='$tlp_member' where id_member='$id_member'";
        
        $edit = mysqli_query($connect, $sql);
        
        if ($edit) {
            header('Location:list-member.php');
        } else {
            printf('Gagal'.mysqli_error($connect));
            exit();
        }
        
}
?>
<?php
session_start(); //ini harus ada pada baris pertama
# session -> tempat penyimpanan data di sisi server
# yang dapat diakses secara global pada halaman web yang membutuhkan
include("../connection.php");
if (isset($_POST["login"])) {
    # menampung data username dan password
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    # ambil data user sesuai password dan username
    $sql = "select * from user where
    username = '$username' and password = '$password'";

    $hasil = mysqli_query($connect, $sql);

    # cek hasil query
    # mysqli_num_rows untuk jumlah baris
    if (mysqli_num_rows($hasil)>0) {
        # login berhasil
        # data disimpan ke dalam session
        $user = mysqli_fetch_array($hasil);
        $_SESSION["user"] = $user;
        echo "<script>alert('Login Berhasil, Selamat Datang!');window.location='../dashboard/dashboard.php'</script>";
        
    }else{
        # login gagal
        echo "<script>alert('Login gagal!');history.go(-1);</script>";
    }
}
?>
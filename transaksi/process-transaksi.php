<?php
include("../connection.php");
if (isset($_POST["simpan_transaksi"])) {
    # menampung data yang dikirim

    $id_transaksi = $_POST["id_transaksi"];
    $id_member = $_POST["id_member"];
    $id_user = $_POST["id_user"];
    $tgl_laundry = $_POST["tgl_laundry"];
    $batas_waktu = $_POST["batas_waktu"];
    $status = $_POST["status"];
    $pembayaran = $_POST["pembayaran"];
    $kategori = $_POST["kategori"];
    $qty = $_POST["qty"];
    $paket = $_POST["id_paket"]; //array

    $total = 0;
    for ($i=0; $i < count($paket); $i++) { 
    // select transaksi
        $id_paket = $paket[$i];
        $sql = "select * from paket where id_paket ='$id_paket'";
        $hasil = mysqli_query($connect, $sql);
        $laund = mysqli_fetch_array($hasil);
        $harga = $laund["harga"];
        if ($kategori == 'Cuci') {
            $harga += 0;
        } else if($kategori == 'Cuci & Setrika') {
            $harga += 1500;
        } else if($kategori == 'Setrika'){
            $harga += 500;
        }
        

        $total += $qty * $harga;
    }

    // $total_bayar = $biaya_transaksi*$batas_waktu;
    # perintah SQL untuk insert ke table transaksi
    $sql = "insert into transaksi values
    ('$id_transaksi','$id_member','$id_user','$tgl_laundry','$batas_waktu','$status','$pembayaran','$kategori','$total')";

    if (mysqli_query($connect, $sql)) {
        # jika berhasil insert ke tabel transaksi
        # insert ke tabel detail transaksi
        for ($i=0; $i < count($paket); $i++) { 
            $id_paket = $paket[$i];
        
            $sql = "insert into detail_transaksi values
            ('','$id_transaksi','$id_paket','$qty')";
            if (mysqli_query($connect, $sql)) {
            
            }else {
                # jika gaga insert ke table detail_transaksi
                echo mysqli_error($connect);
                exit;
            }
        }
        header('Location:list-transaksi.php');
    }else{
        # jia gagal insert tabel transaksi
        echo mysqli_error($connect);
    }
}else if(isset($_POST["edit_transaksi"])){
    $id_transaksi = $_POST["id_transaksi"];
    $id_member = $_POST["id_member"];
    $id_user = $_POST["id_user"];    
    $tgl_laundry = $_POST["tgl_laundry"];
    $batas_waktu = $_POST["batas_waktu"];
    $status = $_POST["status"];
    $pembayaran = $_POST["pembayaran"];
    $kategori = $_POST["kategori"];
    $qty = $_POST["qty"];
    $total = $_POST["total"];


    $sql = "update transaksi set 
    status='$status',pembayaran='$pembayaran'
    where id_transaksi='$id_transaksi'";
        
        $edit = mysqli_query($connect, $sql);
        
        if ($edit) {
            header('Location:list-transaksi.php');
        } else {
            printf('Gagal'.mysqli_error($connect));
            exit();
        }
}

?>
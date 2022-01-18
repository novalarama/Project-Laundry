<?php 
session_start();
# jika saat load halaman ini, pastikan telah login sebagai user
if (!isset($_SESSION["user"])) {
    header("Location:../login/login.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Co.Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="background">
    <?php include("../home.php") ?>
    
            <?php
            if (isset($_GET["id_transaksi"])) {
                include("../connection.php");
                $id_transaksi = $_GET["id_transaksi"];
                $sql = "select * from transaksi where id_transaksi='$id_transaksi'";

                // eksekusi perintah sql
                $ubah = mysqli_query($connect, $sql);

                // konversi hasil query ke array
                $transaksi = mysqli_fetch_array($ubah);
                ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h2 class="login text-center mt-2">
                    <?=$transaksi["id_transaksi"];?>
                </h2>
                <h6 class="text-center">
                    Co.Laundry - <?=$transaksi["tgl_laundry"];?>
                </h6>
            </div>

            <div class="card-body">
                <small>
                    Nama Member
                </small>
                <?php
                include("../connection.php");
                $sql = "select * from member
                inner join transaksi
                on member.id_member = transaksi.id_member
                where id_transaksi = '$id_transaksi'";
                $hasil = mysqli_query($connect, $sql);
                while($member = mysqli_fetch_array($hasil)){
                    ?>
                    <h2>
                        <?=$member["nama_member"];?>
                    </h2>
                    <?php
                }
                ?>

                Nama User
                <?php
                include("../connection.php");
                $sql = "select * from user
                inner join transaksi
                on user.id_user = transaksi.id_user
                where id_transaksi = '$id_transaksi'";
                $hasil = mysqli_query($connect, $sql);
                while($user = mysqli_fetch_array($hasil)){
                    ?>
                    <input type="text" name="id_user" class="form-control mb-2"
                    value="<?=$user["nama_user"];?>" readonly>
                    <?php
                }
                ?>

                Paket yang dilaundry 
                <div class="form-control">
                <?php
                include("../connection.php");
                $id_transaksi = $transaksi["id_transaksi"];
                    $sql = "select * from detail_transaksi 
                    inner join paket
                    on detail_transaksi.id_paket = paket.id_paket
                    where id_transaksi = '$id_transaksi'";
                $hasil = mysqli_query($connect, $sql);
                while($paket = mysqli_fetch_array($hasil)){
                    ?>
                    <input type="text" name="id_paket[]" class="form-control mb-2"
                    value="<?=$paket["jenis"];?>" readonly>
                    
                    Jumlah
                    <input type="number" name="qty" class="form-control" required
                    value="<?=$detail_transaksi["qty"];?>" readonly>
                </div>
                <?php
                }
                ?>

                Durasi
                <input type="text" name="batas_waktu" class="form-control mb-2"
                value="<?=$transaksi["batas_waktu"];?>" readonly>

                Kategori
                <select name="kategori" class="form-control mb-2" readonly>
                    <option value="<?=$transaksi["kategori"];?>" selected><?=$transaksi["kategori"];?></option>
                    <option value="Cuci">Cuci</option>
                    <option value="Cuci & Setrika">Cuci & Setrika</option>
                    <option value="Setrika">Setrika</option>
                </select>

                Status
                <select name="status" class="form-control mb-2" readonly>
                    <option value="<?=$transaksi["status"];?>" selected><?=$transaksi["status"];?></option>
                    <option value="Baru">Baru</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>
                </select>

                Pembayaran
                <select name="pembayaran" class="form-control mb-2" readonly>
                    <option value="<?=$transaksi["pembayaran"];?>" selected><?=$transaksi["pembayaran"];?></option>
                    <option value="Terbayar">Terbayar</option>
                    <option value="Belum Terbayar">Belum Terbayar</option>
                </select>

                Total Bayar
                <input type="text" name="total" class="form-control mb-2"
                value="<?=$transaksi["total"];?>" readonly>

                <button type="submit" class="btn btn-block btn-dark mt-2" name="edit_transaksi">
                    Simpan Transaksi
                </button>
                </form>
                <?php
            }?>
</body>
</html>
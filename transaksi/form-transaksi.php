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
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h2 class="login text-center mt-2">
                    Transaksi
                </h2>
            </div>

            <div class="card-body">
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
                <form action="process-transaksi.php" method="post"
                onsubmit="return confirm('Are you sure edit this people?')">
                
                ID Transaksi
                <input type="text" name="id_transaksi" class="form-control mb-2"
                value="<?=$transaksi["id_transaksi"];?>" readonly>

                Tanggal Laundry
                <input type="text" name="tgl_laundry" class="form-control mb-2"
                value="<?=$transaksi["tgl_laundry"];?>" readonly>

                Nama Member
                <?php
                include("../connection.php");
                $sql = "select * from member
                inner join transaksi
                on member.id_member = transaksi.id_member
                where id_transaksi = '$id_transaksi'";
                $hasil = mysqli_query($connect, $sql);
                while($member = mysqli_fetch_array($hasil)){
                    ?>
                    <input type="text" name="id_member" class="form-control mb-2"
                    value="<?=$member["nama_member"];?>" readonly>
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
                </select>

                Status
                <select name="status" class="form-control mb-2">
                    <option value="<?=$transaksi["status"];?>" selected><?=$transaksi["status"];?></option>
                    <option value="Baru">Baru</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>
                </select>

                Pembayaran
                <select name="pembayaran" class="form-control mb-2">
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
            }else{
                ?>
                <form action="process-transaksi.php" method="post">
                ID Transaksi
                <input type="text" name="id_transaksi"
                class="form-control mb-2"
                readonly
                value="CL-<?=(time())?>"
                required>
                <!-- Tgl transaksi dibuat otomatis -->
                <?php
                date_default_timezone_set('Asia/Jakarta');
                ?>
                Tanggal Laundry
                <input type="text" name="tgl_laundry"
                class="form-control mb-2"
                value="<?=(date("Y-m-d H:i:s"))?>">
                <!-- pilih member dengan nama -->
                Nama Member
                <select name="id_member" class="form-control mb-2">
                <?php
                include("../connection.php");
                $sql = "select * from member";
                $hasil = mysqli_query($connect, $sql);
                while($member = mysqli_fetch_array($hasil)){
                    ?>
                    <option value="<?=($member["id_member"])?>">
                        <?=($member["nama_member"])?>
                    </option>
                    <?php
                }
                ?>
                </select>
                
                
                <!-- user ambil dari data login -->
                <input type="hidden" name="id_user"
                value="<?=($_SESSION["user"]["id_user"])?>">

                User
                <input type="text" name="nama_user"
                class="form-control mb-2" readonly
                value="<?=($_SESSION["user"]["nama_user"])?>">

                <!-- tampilan pilihan paket yang akan disewa -->
                Pilih Paket yang Akan dilaundry
                <div class="form-control">
                <select name="id_paket[]" class="form-control mb-2" required >
                    <?php
                    $sql = "select * from paket";
                    $hasil = mysqli_query($connect, $sql);
                    while ($paket = mysqli_fetch_array($hasil)) {
                        ?>
                        
                        <option value="<?=($paket["id_paket"])?>">
                            Paket <?=($paket["id_paket"])?> : 
                            <?=($paket["jenis"].", Harga = Rp ".$paket["harga"])?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                    Jumlah
                    <input type="number" name="qty" class="form-control" required>
                </div>

                Durasi (hari)
                <input type="number" name="batas_waktu"
                class="form-control mb-2 mt-2">

                Kategori
                <select name="kategori" class="form-control mb-2">
                    <option value="Cuci">Cuci</option>
                    <option value="Cuci & Setrika">Cuci & Setrika</option>
                    <option value="Setrika">Setrika</option>
                </select>

                Status
                <select name="status" class="form-control mb-2">
                    <option value="Baru">Baru</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>
                </select>
                
                Pembayaran
                <select name="pembayaran" class="form-control mb-2">
                    <option value="Belum Terbayar">Belum Terbayar</option>
                    <option value="Terbayar">Terbayar</option>
                </select>

                <button type="submit" class="btn btn-block btn-dark mt-2" name="simpan_transaksi">
                    Tambah Transaksi
                </button>
                </form>
            </div>
            <?php
            }
            
            ?>
        </div>
    </div>
</body>
</html>
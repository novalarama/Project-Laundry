<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location:../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket - Co.Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="background">
<?php include("../home.php") ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h1 class="login">Paket Baru</h1>
                <h5 class="login">Tambahkan Paket baru</h5>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_paket"])) {
                    //memeriksa ketika load file ini, apakah membawa
                    //data GET dgn nama "id_paket"
                    //jika true, form paket digunakan untuk edit

                    # mengakses data paket dari id_paket yang dikirim
                    include("../connection.php");
                    $id_paket = $_GET["id_paket"];
                    $sql = "select * from paket where id_paket='$id_paket'";

                    //eksekusi perintah sql
                    $ubah = mysqli_query($connect, $sql);

                    // konversi hasil query ke bentuk array
                    $paket = mysqli_fetch_array($ubah);
                ?>

                    <form action="process-paket.php" method="post"
                    onsubmit="return confirm('Are you sure edit this packet?')">
                    
                        ID Paket
                        <input type="text" name="id_paket"
                        class="form-control mb-2" required
                        value="<?=$paket["id_paket"];?>" readonly>
                        Jenis
                            <select name="jenis" class="form-control mb-2" required>
                                <option value="<?=$paket["jenis"];?>" selected><?=$paket["jenis"];?></option>
                                <option value="Kiloan">Kiloan</option>
                                <option value="Baju Putih">Baju Putih</option>
                                <option value="Bed Cover">Bed Cover</option>
                                <option value="Karpet">Karpet</option>
                                <option value="Baju Panjang">Baju Panjang</option>
                            </select>
                        Harga
                        <input type="number" name="harga"
                        class="form-control mb-2" required
                        value="<?=$paket["harga"];?>">

                        <button type="submit" class="btn btn-success btn-block"
                        name="edit_paket">
                            Save
                        </button>
                    </form>
                <?php
                }else{
                    //jika false, menggunakan ini untuk insert
                ?>
                    <form action="process-paket.php" method="post">
    
                        Jenis
                            <select name="jenis" class="form-control mb-2" required>
                                <option value="Kiloan">Kiloan</option>
                                <option value="Baju Putih">Baju Putih</option>
                                <option value="Bed Cover">Bed Cover</option>
                                <option value="Karpet">Karpet</option>
                                <option value="Baju Panjang">Baju Panjang</option>
                            </select>
                        Harga
                        <input type="number" name="harga"
                        class="form-control mb-2" required>

                        <button type="submit" class="btn btn-danger btn-block"
                        name="simpan_paket">
                            Save
                        </button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
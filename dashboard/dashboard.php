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
    <title>Co.Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="background">
    <?php include("../home.php") ?>
    <div class="container">
        <div class="card form-control">
            <div class="card-header col-lg-12 col-md-12">
                <div class="col-lg-12 col-md-12">
                    <h2 class="text-danger mt-3"><b>Hi <?=($_SESSION["user"]["nama_user"])?> !</b></h2>
                    <h5 class="text-danger">Welcome to Co.Laundry as <?=($_SESSION["user"]["role"])?></h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 form-control mt-2 bg-danger">
                        <h4 class="mt-2 text-white"><b>Transaksi Terbaru<b></h4>
                        <ul class="list-group">
                        <?php
                        include("../connection.php");
                        $sql ="select transaksi.*, member.*, user.*, pembayaran.id_pembayaran, pembayaran.tgl_bayar
                        from transaksi inner join member
                        on member.id_member=transaksi.id_member
                        inner join user
                        on transaksi.id_user=user.id_user
                        left outer join pembayaran
                        on transaksi.id_transaksi=pembayaran.id_transaksi
                        order by transaksi.tgl_laundry desc limit 3";

                        $hasil = mysqli_query($connect, $sql);
                        while ($transaksi = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-danger">Tanggal Transaksi</small>
                                    <h5><?=($transaksi["tgl_laundry"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-danger">Member</small>
                                    <h5><?=($transaksi["nama_member"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-danger">Total</small>
                                    <h5><?=($transaksi["total"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-danger">Status</small>
                                    <h5><?=($transaksi["status"])?></h5>
                                </div>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="col-lg-12 col-md-12 mt-2 bg-danger">
                        <a href="../transaksi/list-transaksi.php">
                            <button class="btn btn-danger form-control">
                                <b class="text-white">Lihat lebih banyak</b>
                            </button>
                        </a>
                    </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 form-control mt-2 bg-danger">
                        <h4 class="text-white mt-2"><b>Total Pendapatan</b></h4>
                        <ul class="list-group">
                        <?php
                        include("../connection.php");
                        $total = 0;
                        $sql = mysqli_query($connect,"select sum(total) from transaksi");
                        while ($data = mysqli_fetch_array($sql)) {
                            $total += $data['sum(total)'];
                        
                    ?>
                        <li class="list-group-item">
                            <div class="row">
                                <h1 class="text-danger">
                                    <b> Rp <?=($total)?>,00</b>
                                </h1>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 form-control mt-2 bg-danger">
                        <h4 class="text-white mt-2"><b>Member yang Terdaftar</b></h4>
                        <ul class="list-group">
                        <?php
                        include("../connection.php");
                        $sql = "select * from member";
                        $data_member = mysqli_query($connect, $sql);
                        $jumlah = mysqli_num_rows($data_member);
                    ?>
                        <li class="list-group-item">
                            <div class="row">
                                <h1 class="text-danger">
                                    <b> <?=($jumlah)?> Orang</b>
                                </h1>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
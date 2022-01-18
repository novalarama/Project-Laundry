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
    <title>Transaksi - Co.Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="background">
    <?php include("../home.php") ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="login text-center">Daftar Transaksi</h4>
                    <a href="form-transaksi.php" class="text-center text-white">
                        <button class="btn btn-outline-danger form-control">
                            Tambah Transaksi
                        </button>
                    </a>
            </div>

            <div class="card-body">
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
                        order by transaksi.id_transaksi desc";

                        $hasil = mysqli_query($connect, $sql);
                        while ($transaksi = mysqli_fetch_array($hasil)) {
                    ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <small class="text-danger">ID Transaksi</small>
                                    <h5><?=($transaksi["id_transaksi"])?></h5>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Member</small>
                                    <h5><?=($transaksi["nama_member"])?></h5>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">User</small>
                                    <h5><?=($transaksi["nama_user"])?></h5>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Tanggal transaksi</small>
                                    <h5><?=($transaksi["tgl_laundry"])?></h5>  
                                </div>
                                <div class="row col-lg-2 col-md-2">
                                    <div class="col-lg-6 col-md-6 mt-2">
                                        <a href="form-transaksi.php?id_transaksi=<?php echo $transaksi["id_transaksi"];?>">
                                            <button class="btn btn-outline-danger form-control btn-block">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a> 
                                    </div>
                                    <div class="col-lg-6 col-md-6 mt-2">
                                        <a href="detail-transaksi.php?id_transaksi=<?php echo $transaksi["id_transaksi"];?>">
                                            <button class="btn btn-outline-danger  form-control btn-block">
                                                <i class="fa fa-info"></i>
                                            </button>
                                        </a> 
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <small class="text-danger">List Laundry</small>
                                        <ul>
                                        <?php
                                        $id_transaksi = $transaksi["id_transaksi"];
                                        $sql = "select * from detail_transaksi 
                                        inner join paket
                                        on detail_transaksi.id_paket = paket.id_paket
                                        where id_transaksi = '$id_transaksi'";

                                        //eksekusi
                                        $hasil_paket = mysqli_query($connect, $sql);
                            
                                        //dijadikan array
                                        while ($paket = mysqli_fetch_array($hasil_paket)) {
                                        ?>
                                            <li>
                                                <h6>
                                                    <?=($paket["jenis"])?>
                                                    <i class="text-secondary">
                                                        <br><small>(Dengan harga Rp<?=($paket["harga"])?>)</small>
                                                        <br><small>(Durasi transaksi <?=($transaksi["batas_waktu"])?> hari)</small>
                                                    </i>
                                                </h6>
                                            </li>
                                        
                                        </ul>
                                </div>

                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Jumlah</small></br>
                                            <h5><?=($paket["qty"])?></h5>
                                </div>
                                <?php
                                        }
                                        ?>

                                <?php if ($transaksi["id_pembayaran"] ==  null){?>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Status</small></br>
                                    <div class="badge badge-pill badge-dark">
                                        <?=($transaksi["status"])?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Pembayaran</small></br>
                                    <div class="badge badge-pill badge-danger">
                                        <?=($transaksi["pembayaran"])?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="process-pembayaran.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Apakah paket sudah selesai dan terbayarkan?')">
                                        <button class="btn btn-danger btn-block">
                                            <b>Bayar Rp<?=($transaksi["total"])?></b>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="delete-process.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Apakah anda ingin menghapus transaksi ini?')">
                                        <button class="btn btn-dark btn-block">
                                            Hapus
                                        </button>
                                    </a>
                                </div>
                            </div>


                                <?php } else if($transaksi["id_pembayaran" > 0]) {?>
                                <div class="col-lg-2 col-md-2">
                                    <small class="text-danger">Status</small></br>
                                        <div class="badge badge-pill badge-dark">
                                            <?=($transaksi["status"])?>
                                        </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <?php
                                    $id_transaksi = $transaksi["id_transaksi"];
                                    $sql = "update transaksi set pembayaran = 'Terbayar'
                                        where id_transaksi='$id_transaksi'";
                                    $edit = mysqli_query($connect, $sql);

                                    if ($edit) {
                                        $sql2 = "select * from transaksi where id_transaksi='$id_transaksi'";

                                        //eksekusi
                                        $trans = mysqli_query($connect, $sql2);
                                        while($transaksi = mysqli_fetch_array($trans)){
                                    ?>
                                            <small class="text-danger">Pembayaran</small></br>
                                            <div class="badge badge-pill badge-success">
                                                <?=($transaksi["pembayaran"])?>
                                            </div>
                                </div>
                                      
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="process-pembayaran.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Apakah paket sudah selesai dan terbayarkan?')">
                                        <button class="btn btn-danger btn-block" disabled>
                                            <b>Terbayar Rp<?=$transaksi["total"]?></b>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="delete-process.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Apakah anda ingin menghapus transaksi ini?')">
                                        <button class="btn btn-dark btn-block">
                                            Hapus
                                        </button>
                                    </a>
                                </div>
                                        <?php } ?>
                                    <?php } ?>
                            </div>
                            <?php }?>    
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
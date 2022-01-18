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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="background">
    <?php
    // menyambungkan dengan database
    include("../home.php");
    ?>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h2 class="text-dark text-center"><b>Paket Co.Laundry</b></h2>
                <a href="form-paket.php">
                    <button class="btn btn-danger mb-2 form-control">
                        Add Package
                    </button>
                </a>
            </div>

            <div class="card-body">
                <form action="list-paket.php" method="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Search">
                </form>
                
                <ul class="list-group list-group-horizontal">
                <?php
                include("../connection.php");
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];

                    $sql = "select * from paket where id_paket like '%$search%'
                    or jenis like '%$search%'
                    or kategori like '%$search%'
                    or harga like '%$search%'";
                }else {
                    $sql = "select * from paket";
                }

                $query = mysqli_query($connect, $sql);
                while ($paket = mysqli_fetch_array($query)) {
                    ?>
                    <li class="list-group-item flex-fill">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 align-self-center">
                                <h5><b><?php echo $paket["id_paket"];?></b></h5>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <h5><b><?php echo $paket["jenis"];?></b></h5>
                                <h6>Harga : <?php echo $paket["harga"];?></h6>
                            </div>

                            <div class="col-lg-1 col-md-1">
                                <a href="form-paket.php?id_paket=<?php echo $paket["id_paket"];?>">
                                    <button class="btn btn-secondary mb-2 form-control"><i class="fa fa-edit"></i> 
                                    </button>
                                </a>
                            </div>
                            <div class="col-lg-1 col-md-1">
                                <a href="delete-paket.php?id_paket=<?=$paket["id_paket"];?>">
                                    <button class="btn btn-danger form-control"><i class="fa fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
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
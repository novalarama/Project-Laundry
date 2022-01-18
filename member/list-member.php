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
    <title>Member - Co.Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="background">
    <?php
    // menyambungkan dengan database
    include("../home.php");
    ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h2 class="text-dark text-center"><b>Member Co.Laundry</b></h2>
                <a href="form-member.php">
                    <button class="btn btn-danger mb-2 form-control">
                        Add Member
                    </button>
                </a>
            </div>

            <div class="card-body">
                <form action="list-member.php" method="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Search">
                </form>
                
                <ul class="list-group">
                <?php
                include("../connection.php");
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];

                    $sql = "select * from member where id_member like '%$search%'
                    or nama_member like '%$search%'
                    or alamat_member like '%$search%'
                    or jk_member like '%$search%'
                    or tlp_member like '%$search%'";
                }else {
                    $sql = "select * from member";
                }

                $query = mysqli_query($connect, $sql);
                while ($member = mysqli_fetch_array($query)) {
                    ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 align-self-center">
                                <h5><b><?php echo $member["id_member"];?></b></h5>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <h5><b><?php echo $member["nama_member"];?></b></h5>
                                <h6>Alamat : <?php echo $member["alamat_member"];?></h6>
                                <h6>Jenis Kelamin : <?php echo $member["jk_member"];?></h6>
                                <h6>Nomor Telepon : <?php echo $member["tlp_member"];?></h6>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <a href="form-member.php?id_member=<?php echo $member["id_member"];?>">
                                    <button class="btn btn-block btn-outline-dark mb-2">
                                        Edit
                                    </button>
                                </a>
                                <a href="delete-member.php?id_member=<?=$member["id_member"];?>">
                                    <button class="btn btn-block btn-outline-danger">
                                        Delete
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
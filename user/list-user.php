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
    <title>User - Co.Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="background">
<?php include("../home.php") ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h2 class="login text-center">
                    List User
                </h2>
                <a href="form-user.php">
                    <button class="btn btn-danger form-control">
                        Add user
                    </button>
                </a>
            </div>

            <div class="card-body">
                <form action="list-user.php" method="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Search" required>
                </form>

                <ul class="list-group">
                <?php
                include("../connection.php");
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];

                    $sql = "select * from user where id_user like'%$search%'
                    or nama_user like '%$search%'
                    or username like '%$search%'
                    or role like '%$role%'";
                }else{
                    $sql = "select * from user";
                }

                //eksekusi perintah SQL
                $query = mysqli_query($connect, $sql);
                while ($user = mysqli_fetch_array($query)) {
                ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-9 col-md-10">
                                <h4><b><?php echo $user["nama_user"];?></b></h4>
                                <h6>ID : <?php echo $user["id_user"];?></h6>
                                <h6>Username : <?php echo $user["username"];?></h6>
                                <h6>Role : <?php echo $user["role"];?></h6>
                            </div>

                            <div class="col-lg-3 col-md-2">
                                <a href="form-user.php?id_user=<?php echo $user["id_user"];?>">
                                    <button class="btn btn-block btn-outline-dark mb-2">
                                        Edit
                                    </button>
                                </a>

                                <a href="delete-user.php?id_user=<?=$user["id_user"];?>"
                                    onclick="return confirm('Are you sure delete this person?')">
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
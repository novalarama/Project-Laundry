<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Co.Laundry</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        .log{
            float: right;
        }
        *{
            list-style-type: none;
            text-decoration : none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse bg-danger navbar-dark sticky-top mb-2">
        <div class="col-lg-3">
            <a href="dashboard.php" class="navbar-brand text-white"><b>Co.Laundry</b></a>
        </div>

        <div >
        <div">
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                <a href="../dashboard/dashboard.php" class="nav-link log">
                    Dashboard
                </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                <a href="../transaksi/list-transaksi.php" class="nav-link log">
                    Transaksi
                </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                <a href="../paket/list-paket.php" class="nav-link log">
                    Paket
                </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                <a href="../member/list-member.php" class="nav-link log">
                    Member
                </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                <a href="../user/list-user.php" class="nav-link log">
                    User
                </a>
                </li>
            </ul>
        </div>
        </div>

        <div class="col-lg-3">
            <ul class="nav navbar-nav navbar-right">
             <li class="nav-item">
                <a class="nav-link log" href="../login/login.php">
                    <button class="btn btn-outline-light">
                        Log Out
                    </button>    
                </a>
            </li>
        </ul>
        </div>
        
<!--             
            <li class="nav-item dropdown">
                <a href="../paket/list-paket.php" class="nav-link log">
                    Paket
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="../member/list-member.php" class="nav-link log">
                    Member
                </a>

            </li>

            <li class="nav-item dropdown">
                <a href="../user/list-user.php" class="nav-link log">
                    User
                </a>
            </li>
        </ul>
    </div>
        <div>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link log" href="../login/login.php">Log in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link log" href="../user/form-user.php">Sign up</a>
            </li>
        </ul>
        <div> -->
    </nav>
</body>
</html>
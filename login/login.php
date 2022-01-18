<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Co.Laundry</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="background1">
    <h1 class="login1 text-center" style=margin-top:60px;>Co.Laundry</h1>
    <div class="container" style=margin-top:40px;>
        <div class="card col-lg-6 mx-auto">
            <div class="card-header bg-white">
                <h3 class="login text-center" style=margin-top:10px;>Login</h3>
            </div>

            <div class="card-body">
                <form action="login-proses.php" method="POST">
                    <b>Username</b>
                    <input type="text" name="username" class="form-control mb-2"
                    placeholder="Username" required>
                    <b>Password</b>
                    <input type="password" name="password" class="form-control mb-2"
                    placeholder="Password" required>
                    <!-- <b>Anda Login sebagai :</b>
                    <p><input type='radio' name='role' value='Kasir' /> Kasir</p>
                    <p><input type='radio' name='role' value='Admin' /> Admin</p> -->
                    
                    <div class="card-footer">
                        <button type="submit" name="login" class="btn btn-block btn-danger form-control">Login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
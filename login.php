<?php

include "_conn.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass  = $_POST['ulpass'];
    if ($email != "" && $pass != "") {
        $isuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'"));
        if ($isuser > 0) {
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'"));
            if ($pass == $data['userpass']) {
                if ($data['isadmin'] == '1') {
                    $_SESSION['admin'] = true;
                    $_SESSION['adminid'] = $data['userid'];
                    header("location:admin/index.php");
                } else {
                    $_SESSION['user'] = true;
                    $_SESSION['userid'] = $data['userid'];
                    header("location:index.php?login=true");
                }
            } else {
                $er = 1;
                unset($_POST['login']);
                // echo "<script>alert('Wrong Password')</script>";
            }
        }
    } else {
        $er = 2;
        unset($_POST['login']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="admin/js/tostar/build/toastr.min.css" rel="stylesheet" type="text/css">
    
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="validation.js"></script>
    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<script src="admin/js/tostar/build/toastr.min.js"></script>
    <?php
        if (isset($er) && $er == 1) {
            echo "
        <script>toastr.warning('Incorect Password or Email','Sorry');
        </script>";
        $er = 0;
        }
        if (isset($er) && $er == 2) {
            echo "
        <script>toastr.warning('Please fill up all the fields','Sorry');
        </script>";
            $er = 0;
        }
    ?>
    <div class="container">
   
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            

                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" id="login-form">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="login-email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="ulpass" class="form-control form-control-user" id="login-pass" placeholder="Password">
                                        </div>

                                        <input type="submit" id="login-btn" onclick="login_page('login-btn','login-email','login-pass')" name="login" class="btn btn-primary btn-user btn-block" value="Login">

                                        <hr>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
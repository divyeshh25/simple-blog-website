<?php
include "_conn.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['upass'];
    $rpass = $_POST['urpass'];
    if($fname!= "" && $lname != "" && $email != "" && $pass != "")
    {
    if($pass == $rpass)
    {
        $getid =  mysqli_fetch_row(mysqli_query($conn,"SELECT max(userid) FROM users"))[0];
        $id = $getid + 1;
        echo "<script>alert('$hash')</script>";
        $adduser = mysqli_query($conn,"
        INSERT INTO `users`(`userid`, `userpass`, `fname`, `lname`, `email`,`isadmin`) VALUES 
        ('$id','$pass','$fname','$lname','$email','0')");
        if($adduser)
        {
            header("location:login.php");
        }
        else
        {
            echo "<script>alert('something wrong')</script>";
        }
    }
    else
    {
        echo "<script>alert('something wrong')</script>";
    }
    }
    else
    {
        echo "<script>alert('Please fill up all the fields')</script>";
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

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="admin/js/tostar/build/toastr.min.css" rel="stylesheet" type="text/css">

    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>

    <link href="admin/css/sb-admin-2.css" rel="stylesheet">
    <script src="validation.js"></script>

</head>

<body class="bg-gradient-primary">
<script src="admin/js/tostar/build/toastr.min.js"></script>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                

                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" onsubmit="return RegisterPage('fname','lname','sign-email','sign-pass1','sign-pass2')">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="fname" class="form-control form-control-user" id="fname"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="lname" class="form-control form-control-user" id="lname"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-control-user" id="sign-email"
                                        placeholder="Email Address" onfocusout="Check_Email()">
                                        <input type="hidden" id="email-er">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="upass" class="form-control form-control-user"
                                            id="sign-pass1" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="urpass" class="form-control form-control-user"
                                            id="sign-pass2" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <input type="submit" name="register" class="btn btn-primary btn-user btn-block" value=" Register Account">
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
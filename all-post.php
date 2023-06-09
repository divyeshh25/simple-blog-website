<?php
include "_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- navbar -->
    
    <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <?php include "nav.php";?>
    </header>
    <center><h2>You Can See All the blog here</h2></center>
    <hr>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                <?php
                $all = mysqli_query($conn, "SELECT * FROM `subcategory` WHERE `status` ='0' ORDER BY `time`;");
                while ($data = mysqli_fetch_assoc($all)) {
                    $user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `fname`,`lname` FROM `users` WHERE `userid` = '". $data['userid']."'"));
                    $username = $user['fname']." ".$user['lname'];
                    $id = $data['subcat_id'];
                    $cat_name = mysqli_fetch_row(mysqli_query($conn, "SELECT `cat_name` FROM `category` WHERE `cat_id` ='" . $data['cat_id'] . "'"))[0];

                ?>
                   <div class="jumbotron">
                        <h1 class="display-5">Blog About <?= $cat_name ?></h1>
                        <p class="lead"><?= $data['title'] ?></p>
                        <hr class="my-4">
                        <p>
                            <?= $data['subcat_desc'] ?>
                        </p>
                    </div>
                    
                <?php
                }
                ?>

                <!-- Divider-->
                <hr class="my-4" />

                <!-- Pager-->
            </div>
        </div>
    </div>
</body>
</html>


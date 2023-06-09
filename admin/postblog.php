<?php
session_start();
include "_conn.php";

if ($_SESSION['admin'] == true) {
    $id = $_SESSION['adminid'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `userid` = '$id'"));
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['postblog'])) {
        $msg = $_POST['msg'];
        $cat = $_POST['cat'];
        $title = $_POST['title'];
        $img = $_FILES['image2']['name'];
        $status = $_POST['status'];
        $upload = "uploads/" . $img;
        move_uploaded_file($_FILES['image2']['tmp_name'], $upload);
        $time = mysqli_fetch_row(mysqli_query($conn, "SELECT CURRENT_TIMESTAMP"))[0];
        $sub_id = mysqli_fetch_row(mysqli_query($conn, "SELECT max(`subcat_id`) FROM `subcategory`"))[0] + 1;
        $insertcat = mysqli_query($conn, "
    INSERT INTO `subcategory`(`subcat_id`, `subcat_desc`, `cat_id`, `userid` ,`time`,`status`,`image`,`title`) 
    VALUES ('$sub_id','$msg','$cat','$id','$time','$status','$upload','$title')");
        if ($insertcat) {
            if ($status == 0) {
                $_SESSION['flagbin'] = true;
                header("location:manage_blog.php");
            } else {
                $_SESSION['flagbin'] = true;
                header("location:manage_blog.php");
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['editblog'])) {
        $msg = $_POST['umsg'];
        $cat = $_POST['ucat_name'];
        $status = $_POST['ustatus'];
        $id = $_POST['uid'];
        $title = $_POST['utitle'];
        $img = $_FILES['image1']['name'];
        if ($img != "") {
            $upload = "uploads/" . $img;
            move_uploaded_file($_FILES['image1']['tmp_name'], $upload);
            $time = mysqli_fetch_row(mysqli_query($conn, "SELECT CURRENT_TIMESTAMP"))[0];
            $updatecat = mysqli_query($conn, "UPDATE `subcategory` SET  `subcat_desc`='$msg',`status`='$status',`time`='$time',`title`='$title',`image`='$upload' WHERE `subcat_id` = '$id'");
        } else {
            $time = mysqli_fetch_row(mysqli_query($conn, "SELECT CURRENT_TIMESTAMP"))[0];
            $updatecat = mysqli_query($conn, "UPDATE `subcategory` SET  `subcat_desc`='$msg',`status`='$status',`time`='$time',`title`='$title' WHERE `subcat_id` = '$id'");
        }
        if ($updatecat) {
            if ($status == 0) {
                $_SESSION['flagbup'] = true;
                header("location:manage_blog.php");
            } else {
                $_SESSION['flagbup'] = true;
                header("location:manage_blog.php");
            }
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

        <title>SB Admin 2 - Blank</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <script src="admin-validation.js"></script>
        <script src="vendor/jquery/jquery.min.js"></script>

        <link href="js/tostar/build/toastr.min.css" rel="stylesheet" type="text/css">
        <script src="js/tostar/build/toastr.min.js"></script>

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php include "sidebar.php"; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include "adminnav.php"; ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <?php
                        if (isset($_GET['editid'])) {
                            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `subcategory` WHERE `subcat_id` = '" . $_GET['editid'] . "'"));
                        ?>
                            <h1 class="h3 mb-4 text-gray-800">Post Blog Here</h1>

                            <form id="contactForm" method="POST" enctype="multipart/form-data" onsubmit="return EditPost('title','message')">
                                <input type="hidden" name="uid" value="<?= $_GET['editid'] ?>">
                                <label for="email">Category</label>
                                <?php
                                $cat = mysqli_fetch_row(mysqli_query($conn, "SELECT cat_name FROM `category` WHERE cat_id = '" . $data['cat_id'] . "'"))[0];
                                ?>
                                <input type="text" name="ucat_name" value="<?= $cat ?>" readonly style="border:none;" id="select1">
                                <div class="form-floating">
                                    <label for="message">Title</label>
                                    <textarea class="form-control" id="title" name="utitle" placeholder="Enter your blog title.." style="height: 5rem" data-sb-validations="required"><?= $data['title'] ?></textarea>
                                </div>
                                <div class="form-floating">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" name="umsg" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"><?= $data['subcat_desc'] ?></textarea>
                                </div>

                                <div class="form-floating mt-2">
                                    <label for="message">Choose Image</label>
                                    <input type="file" name="image1" id="image1" data-default-file="<?= $data['image'] ?>">

                                </div>
                                <div class="form-floating mt-2">
                                    <label> Select Status</label>
                                    <?php
                                    if ($data['status'] == 0) {
                                        echo '
                                    <input type="radio" value="0" name="ustatus" checked> Active
                                    <input type="radio" value="1" name="ustatus"> Inactive
                                    ';
                                    } else {
                                        echo '
                                    <input type="radio" value="0" name="ustatus"> Active
                                    <input type="radio" value="1" name="ustatus" checked> Inactive
                                    ';
                                    }
                                    ?>
                                </div>
                                <button class="mt-2 btn btn-primary text-uppercase" name="editblog" id="submitButton" type="submit">Update</button>


                                <br />
                                <!-- Submit Button-->
                            </form>
                        <?php
                        } else {
                        ?>
                            <h1 class="h3 mb-4 text-gray-800">Post Blog Here</h1>

                            <form id="contactForm" method="POST" enctype="multipart/form-data" onsubmit="return AddPost('select1','title','message','image2','status')">
                                <label for="email">Select Category</label>
                                <select class="form-control" name="cat" id="select1">
                                    <option>Select Category</option>
                                    <?php
                                    $cat = mysqli_query($conn, "SELECT * FROM `category` WHERE status = '0'");
                                    while ($data = mysqli_fetch_assoc($cat)) {
                                        echo '
                                            <option value="' . $data['cat_id'] . '">' . $data['cat_name'] .
                                            '
                                            </option>
                                            ';
                                    }
                                    ?>
                                </select>
                                <div class="form-floating">
                                    <label for="message">Title</label>
                                    <textarea class="form-control" id="title" name="title" placeholder="Enter your Blog Title..." style="height: 5rem" data-sb-validations="required"></textarea>
                                </div>
                                <div class="form-floating">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" name="msg" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                                </div>

                                <div class="form-floating mt-2">
                                    <label for="message">Choose Image</label>
                                    <input type="file" name="image2" id="image2">
                                </div>
                                <div class="form-floating mt-2">
                                    <label> Select Status</label>
                                    <input type="radio" value="0" name="status"> Active
                                    <input type="radio" value="1" name="status"> Inactive
                                </div>
                                <button class="mt-2 btn btn-primary text-uppercase" name="postblog" id="submitButton" type="submit">Post</button>
                    </div>

                    <br />
                    <!-- Submit Button-->
                    </form>
                <?php
                        }
                ?>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
        <!-- Footer -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure ?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/logout.php">Logout</a>
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
        <!-- summer notes link -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $('#message').summernote({
                placeholder: 'write your post description here..',
                tabsize: 2,
                height: 200,
                height: 200,

            });
            $('#message').summernote('insertImage', url, function($image) {
                $image.css('width', $image.width() / 3);
                $image.attr('data-filename', 'retriever');
            });

            $('#umsg').summernote({
                placeholder: 'write your post description here..',
                tabsize: 2,
                height: 200
            });
        </script>
        <!-- Here is dropify links -->
        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
        <script>
            $('#image2').dropify();

            $('#image1').dropify();
        </script>

    </body>

    </html>
<?php
} else {
    header("location:404.php");
}
?>
<?php
include "_conn.php";
session_start();
$query = mysqli_query($conn, "SELECT * FROM `subcategory`");
if ($_SESSION['admin'] == true) {
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
        <link href="js/tostar/build/toastr.min.css" rel="stylesheet" type="text/css">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.css" rel="stylesheet">

    </head>

    <body id="page-top">
        <script src="js/tostar/build/toastr.min.js"></script>
        <?php
        if (isset($_SESSION['flagbin']) && $_SESSION['flagbin'] = true) {
            echo "
        <script>toastr.success('Blog Posted','Done')
        </script>";
            unset($_SESSION['flagbin']);
        }
        if (isset($_SESSION['flagbrm']) && $_SESSION['flagbrm'] = true) {
            echo "
        <script>toastr.success('Blog Remove','Done')
        </script>";
            unset($_SESSION['flagbrm']);
        }
        if (isset($_SESSION['flagbup']) && $_SESSION['flagbup'] = true) {
            echo "
        <script>toastr.success('Blog Update','Done')
        </script>";
            unset($_SESSION['flagbup']);
        }
        if (isset($_SESSION['flagstatus']) && $_SESSION['flagstatus'] = true) {
            echo "
        <script>toastr.success('Status Update','Done')
        </script>";
            unset($_SESSION['flagstatus']);
        }


        ?>
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
                        <div>
                            <span style="float:left">
                                <h1 class="h3 mb-4 text-gray-800">View Active Blog Here</h1>
                            </span>
                            <span style="float:right">
                                <a href="postblog.php" class="card-link" style="font-size:x-large">
                                    <i class="fas fa-plus fa-sm fa-fw mr-2 text-primary "></i>
                                </a>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-subcat" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Title </th>
                                        <th style="width:500px">Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th style="width:105px">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    while ($data = mysqli_fetch_assoc($query)) {
                                        $cat = mysqli_fetch_row(mysqli_query($conn, "SELECT * FROM `category` WHERE cat_id = '" . $data['cat_id'] . "'"))[1];
                                    ?>
                                        <tr>
                                            <td>
                                                <h6 class="card-subtitle mb-2 text-dark font-weight-bold"><?= $cat ?></h6>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $data['title'] ?></p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $data['subcat_desc'] ?></p>
                                            </td>
                                            <td>
                                                <img src="<?= $data['image'] ?>" width="100" height="100">
                                            </td>
                                            <td>
                                                <?php
                                                if ($data['status'] == '0') {
                                                    echo '
                                                    <div class="form-check form-check-inline" style="top: .8rem;
                                                    scale: 1.4;
                                                    margin-right: 0.7rem;">
                                                        <input class="form-check-input ml-2" type="checkbox" id="status' . $data['subcat_id'] . '" value="option1" checked onchange="update_status(' . $data['subcat_id'] . ')">
                                                    </div>';
                                                } else {
                                                    echo '
                                                    <div class="form-check form-check-inline" style="top: .8rem;
                                                    scale: 1.4;
                                                    margin-right: 0.7rem;">
                                                        <input class="form-check-input ml-2" type="checkbox" id="status' . $data['subcat_id'] . '" value="option1"
                                                        onchange="update_status(' . $data['subcat_id'] . ')">
                                                    </div>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div>
                                                    <span style="float:left">
                                                        <a href="postblog.php?editid=<?= $data['subcat_id'] ?>" class="card-link " style="font-size:large">
                                                            <i class="fas fa-edit fa-sm fa-fw  text-danger "></i>
                                                        </a>
                                                    </span>
                                                    <span style="float:right">
                                                        <a href="#" onclick="remove_subcat('<?= $data['subcat_id'] ?>')" class="card-link" style="font-size:large">
                                                            <i class="fas fa-trash fa-sm fa-fw text-warning"></i>
                                                        </a>
                                                    </span>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
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

        <script>
            function remove_subcat(id) {
                var obj = new XMLHttpRequest();
                obj.onreadystatechange = function() {
                    if (obj.status == 200 && obj.readyState == 4) {
                        if (obj.responseText == 1) {
                            window.location.href = "manage_blog.php";
                        }
                    }
                }
                obj.open("GET", "edit_cat.php?del_subid=" + id, true);
                obj.send();
            }

            function update_status(id) {

                var val = document.getElementById("status" + id);
                var status;
                if (val.checked) {
                    status = 0;
                } else {
                    status = 1;
                }
                var obj = new XMLHttpRequest();
                obj.onreadystatechange = function() {
                    if (obj.status == 200 && obj.readyState == 4) {
                        if (obj.responseText == 1) {
                            window.location.href = "manage_blog.php";
                        }
                    }
                }
                obj.open("GET", "edit_cat.php?id=" + id + "&status=" + status);
                obj.send();
            }
            // open view modal Script
        </script>
        <!-- View Modal -->
        <div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script>
            var table = $('#table-subcat').DataTable();
        </script>


    </body>

    </html>
<?php
} else {
    header("location:404.php");
}
?>
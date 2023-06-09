<?php
session_start();
include "_conn.php";
if($_SESSION['admin'] == true)
{
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Buttons</title>

    <!-- Custom fonts for this template-->
    <link href="js/tostar/build/toastr.min.css" rel="stylesheet" type="text/css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="admin-validation.js"></script>
</head>

<body id="page-top">
    <script src="js/tostar/build/toastr.min.js"></script>
    <?php
    if (isset($_SESSION['flagup']) && $_SESSION['flagup'] == true) {
        echo "<script>toastr.success('Category Update','Done')
                </script>";
        unset($_SESSION['flagup']);
    }
    if (isset($_SESSION['flagrm']) && $_SESSION['flagrm'] == true) {
        echo "<script>toastr.success('Category & It\'s Blog Remove','Done')
                </script>";
        unset($_SESSION['flagrm']);
    }
    if (isset($_SESSION['flagin']) && $_SESSION['flagin'] == true) {
        echo "<script>toastr.success('Category Add','Done')
                </script>";
        unset($_SESSION['flagin']);
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span style="width:300px;float:left">
                                <h6 class="m-0 font-weight-bold text-primary text-left">Blog Category</h6>
                            </span>
                            <span style="float:right"> <button style="font-size:x-large;border:none;background-color:white" data-toggle="modal" data-target="#addmodal">
                                    <i class="fas fa-plus fa-sm fa-fw mr-2 text-primary-800"></i>
                                </button></span>
                        </div>
                        <!-- view category -->
                        <div class="table-responsive ml-5">
                            <table class="table table-bordered" id="table-cat" width="70%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $cat = mysqli_query($conn, "SELECT * FROM `category`");
                                    while ($data = mysqli_fetch_assoc($cat)) {

                                    ?>
                                        <tr>
                                            <td>
                                                <?= $data['cat_id'] ?>
                                                <input type="hidden" id="editid<?= $data['cat_id'] ?>" value="<?= $data['cat_id'] ?>" style="border:none">
                                            </td>
                                            <td>
                                                <?= $data['cat_name'] ?>
                                                <input type="hidden" id="editname<?= $data['cat_id'] ?>" value="<?= $data['cat_name'] ?>" style="border:none">
                                            </td>
                                            <td>
                                                <?php
                                                if ($data['status'] == 0) {
                                                    echo "Active";
                                                } else {
                                                    echo "Inactive";
                                                }
                                                ?>
                                                <input type="hidden" id="editstatus<?= $data['cat_id'] ?>" value="<?= $data['status'] ?>" style="border:none">
                                            </td>
                                            <td>
                                                <button id="viewmodal" style="font-size:large;border:none;background-color:white" value="<?= $data['cat_id'] ?>">
                                                    <i class="fas fa-edit fa-sm fa-fw mr-2 text-primary"></i>
                                                </button>
                                                <button class="text-danger" href="#" onclick="remove_cat('<?= $data['cat_id'] ?>')" style="font-size:large;border:none;background-color:white">
                                                    <i class="fas fa-trash fa-sm fa-fw mr-2"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                    </div>


                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- add modal -->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_cat.php" method="POST" onsubmit="return AddCategory('acatname')">
                            <table>
                                <tr>
                                    <?php
                                    $id = mysqli_fetch_row(mysqli_query($conn, "SELECT MAX(`cat_id`) FROM `category` WHERE 1"))[0] + 1;
                                    ?>
                                    <td><input type="hidden" id="acatid" readonly name="acatid" class="form-control form-control-user" value="<?= $id ?>">
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td colspan="2"><input type="text" id="acatname" name="acatname" class="form-control form-control-user" onfocusout="Check_name('acatname')">
                                </tr>
                                <tr>
                                    <td><label> Select Status</label></td>
                                    <td><input type="radio" value="0" name="status"> Active</td>
                                    <td><input type="radio" value="1" name="status"> Inactive</td>
                                </tr>
                            </table>
                            <div class="modal-footer">
                                <input type="hidden" id="error">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" name="AddCat">Add</a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <!-- edit modal -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <tr>
                            <input type="hidden" id="mid">
                            <td>
                                <h4>Name:</h4>
                            </td>
                            <td>
                                <input type="text" id="mname" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <div class="form-floating mt-2">
                                <label> Select Status</label>
                                <input type="radio" value="0" name="mstatus" id="mstatus"> Active
                                <input type="radio" value="1" name="mstatus" id="mstatus"> Inactive
                            </div>
                        </tr>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" onclick="update_cat()">Update</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
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

        <!-- all script -->
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <script>
            var table = $('#table-cat').DataTable();

            function update_cat() {
                var id = document.getElementById("mid").value;
                var name = document.getElementById("mname").value;
                var radio = document.getElementsByName("mstatus");
                
                for(let i=0;i<radio.length;i++)
                {
                    if(radio[i].checked)
                    {
                        var status = radio[i].value;
                    }
                }
                var obj = new XMLHttpRequest();
                obj.onreadystatechange = function() {
                    if (obj.readyState == 4 && obj.status == 200) {
                        if (obj.responseText == 1) {
                            window.location.href = "subcat.php";
                        }
                    }
                }
                obj.open("POST", "edit_cat.php", true);
                obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                // obj.open("GET", "edit_cat.php?id=" + id + "&name=" + name, true);
                obj.send("id=" + id + "&name=" + name+"&status="+status);

            }

            function remove_cat(id) {
                var obj = new XMLHttpRequest();
                obj.onreadystatechange = function() {
                    if (obj.readyState == 4 && obj.status == 200) {
                        if (obj.responseText == 1) {
                            window.location.href = "subcat.php";
                        }
                    }
                }
                obj.open("GET", "edit_cat.php?delid=" + id, true);
                obj.send();
            }
            $(document).ready(function() {
                $(document).on('click', '#addmodalbtn', function() {
                    var id = $(this).val();
                    var name = $("#editname" + id).val();
                    $('#addmodal').modal('show');
                    $('#mname').val(name);
                    $('#mid').val(id);
                    
                });
            });
            $(document).ready(function() {
                $(document).on('click', '#viewmodal', function() {
                    var id = $(this).val();
                    var name = $("#editname" + id).val();
                    var status = $('#editstatus'+id).val();
                    $('#editmodal').modal('show');
                    $('#mname').val(name);
                    $('#mid').val(id);
                    if(status == 0)
                    {
                        $("input[name='mstatus'][value='0']").prop('checked',true);
                    }
                    else
                    {
                        $("input[name='mstatus'][value='1']").prop('checked',true);
                    }
                });
            });
        </script>



</body>

</html>
<?php
}
else
{
    header("location:404.php");
}
?>
<?php
session_start();
// $_SESSION['flag'] = false;
include "_conn.php";
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['AddCat'])) {
    echo "enter";
    $insert = mysqli_query($conn,
        "INSERT INTO `category`(`cat_id`, `cat_name`,`status`) VALUES ('".$_POST['acatid']."','". 
        $_POST['acatname']."','". $_POST['status'] ."')");
    if($insert)
    {
        header("location:subcat.php");
        $_SESSION['flagin'] = true;
    }
    else
    {
        echo "npo";
    }

}
if(isset($_GET['id']) && isset($_GET['status']))
{
    $update_status = mysqli_query($conn,"UPDATE `subcategory` SET `status`='". $_GET['status'] ."' WHERE `subcat_id` = '". $_GET['id'] ."'");
    if($update_status)
    {
        echo 1;
        $_SESSION['flagstatus'] = true;
    }
    else
    {
        echo "out";
    }
}
if (isset($_POST['id']) && isset($_POST['name'])) {
    $update = mysqli_query($conn, "UPDATE `category` SET `cat_name`='". $_POST['name'] ."',`status`='". $_POST['status'] ."' WHERE `cat_id` = '". $_POST['id'] ."'");
    if ($update) {
        echo 1;
        $_SESSION['flagup'] = true;
    }
    else
    {
        echo mysqli_error($conn);
    }
}
if (isset($_GET['delid'])) {
    $delete_sub = mysqli_query($conn,"DELETE FROM `subcategory` WHERE `cat_id` = '". $_GET['delid'] ."'");
    $delete = mysqli_query($conn, "DELETE FROM `category` WHERE `cat_id` = '" . $_GET['delid'] . "'");
    if ($delete && $delete_sub) {
        echo 1;
        $_SESSION['flagrm'] = true;
    }
}
if(isset($_GET['del_subid']))
{
    $delete = mysqli_query($conn, "DELETE FROM `subcategory` WHERE `subcat_id` = '" . $_GET['del_subid'] . "'");
    if ($delete) {
        echo 1;
        $_SESSION['flagbrm'] = true;
    }
}
if(isset($_GET['cat_name']))
{
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `category` WHERE LOWER(`cat_name`) LIKE 
    LOWER('". $_GET['cat_name'] ."')"));
    if($check > 0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}
if(isset($_POST['email']))
{
    $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `email` = '". $_POST['email'] ."'"));
    if($check > 0)
    {
        echo 1;
    }   
    else
    {
        echo 0;
    }
}
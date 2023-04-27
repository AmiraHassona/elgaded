<?php
session_start();
$user = $_SESSION["user"];

$errors = [];

if (empty($_POST['post_title'])) $errors['post_title'] = "post_title is Required";
if (empty($_POST['post_body'])) $errors['post_body'] = "post_body is Required";

$post_id = $_POST['post_id'];
$post_title  = filter_var(trim($_POST['post_title']), FILTER_SANITIZE_STRING);
$post_body = filter_var(trim($_POST['post_body']), FILTER_SANITIZE_STRING);

if (empty($errors)) {
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PASSWORD, DB_NAME, DB_PORT);

    $qyr = "select id ,image_post from posts where id = $post_id ";
    $rslt = mysqli_query($cn, $qyr);
    if ($row = mysqli_fetch_assoc($rslt)) {
        $file_image = $row['image_post'];
        //mysqli_error($cn);
    }
    if (!empty($_FILES["img_post"]["name"])) {
        unlink($row["image_post"]);
        $file_image = "assets/images/" . date("YmdHis") . "_" . ["img_post"]["name"] . "." . pathinfo($_FILES["img_post"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["img_post"]["tmp_name"], $file_image);
    }


    if ($user['role'] == "admin") $status = "approved";
    else $status = "pending";

    $qyr = "update posts set post_title ='$post_title',post_body ='$post_body',image_post ='$file_image',created_by =" . $user['id'] . ",statues ='$status' where id ='$post_id'";
    $rslt = mysqli_query($cn, $qyr);
    //var_dump(mysqli_error($cn));
    mysqli_close($cn);
    if ($rslt) {
        header("location:index.php");
    }
} else {
    $_SESSION["errors"] = $errors;
    header("location:index.php");
}

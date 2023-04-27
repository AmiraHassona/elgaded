<?php
session_start();
$user = $_SESSION["user"];

$errors = [];

if(empty($_POST['post_title'])) $errors['post_title'] = "post_title is Required" ;
if(empty($_POST['post_body'])) $errors['post_body'] = "post_body is Required" ;


$post_title  = filter_var(trim($_POST['post_title']) ,FILTER_SANITIZE_STRING );

if($_FILES["img_post"]){
$file_image = "assets/images/".date("YmdHis")."_".["img_post"]["name"].".".pathinfo($_FILES["img_post"]["name"] , PATHINFO_EXTENSION);
move_uploaded_file($_FILES["img_post"]["tmp_name"],$file_image);
}else{
 $file_image  = "null";
}
$post_body = filter_var(trim($_POST['post_body']) ,FILTER_SANITIZE_STRING);



if (empty($errors)){
     if($user['role'] == "admin") $status = "approved";
     else $status = "pending";

    $qyr = "insert into posts (post_title,post_body,image_post,created_by,statues)values('$post_title','$post_body','$file_image',".$user['id'].",'$status')";
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
    $rslt = mysqli_query($cn , $qyr);
    //var_dump(mysqli_error($cn));
    mysqli_close($cn);
    if ($rslt){
        header("location:index.php");
    }
}else{
    $_SESSION["errors"] = $errors;
    header("location:index.php");
}


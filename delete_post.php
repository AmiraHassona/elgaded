<?php
session_start();
$user = $_SESSION["user"];
$post_delete  = $_GET["post_id"];

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);

    if($user['role'] != "admin")  $del_cond = "and created_by =". $user['id'] ;

    $qyr = "select id,image_post from posts where id = $post_delete $del_cond ";
    $rslt = mysqli_query($cn,$qyr);
         if($row=mysqli_fetch_assoc($rslt)){
             unlink($row["image_post"]);
             $qyr = "delete from posts where id = $post_delete";
             $rslt = mysqli_query($cn , $qyr);
             //mysqli_error($cn);
         }
    
    mysqli_close($cn);
    if ($rslt){
        header("location:index.php");
    }

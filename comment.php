<?php
session_start();
$user = $_SESSION["user"];


$errors = [];
$old_values = [];

if(empty($_POST['comment_body'])) $errors['comment_body'] = "comment is Required" ;
else {
    $_old_values['old_com'] = $_POST['comment_body'];
    $_SESSION["old_comment"] = $old_values ;
}
$_comment = filter_var(trim($_POST['comment_body']) , FILTER_SANITIZE_STRING) ;
$post_id = $_POST["post_id"];
$page = $_POST["n_page"];
if(empty($errors)){
    
   $qyr = "insert into comments (comment_body,post_id ,user_id)values('$_comment','$post_id',".$user['id'] .")";
   require_once("config.php");
   $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
   $rslt = mysqli_query($cn , $qyr);
   var_dump(mysqli_error($cn));
   mysqli_close($cn);
   if ($rslt){

    header("location:index.php?page=".($page));
    
   }

}else{

    $_SESSION["errors"] = $errors;
    header("location:index.php");
}

<?php
session_start();

$errors = [];

if(empty($_POST['email'])) $errors['email'] = "Email is Required";
if(empty($_POST['password'])) $errors['password'] = "Password is Required";

$email = filter_var(trim($_POST['email']) ,FILTER_SANITIZE_EMAIL);
$password =md5( htmlspecialchars($_POST['password']));

if(isset($_POST["remember"])){
setcookie("email","$email",time()+60*60*24*30);
setcookie("password","$password",time()+60*60*24*30);
}

if(empty($errors)){
    $rslt = "select id,name,email,password,gender,role,avtar,created_by from users where email = '$email' and  password = '$password' ";
    require_once("config.php");
    $cn  = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
    $rslt_row = mysqli_query($cn ,$rslt);
   
     if ($row = mysqli_fetch_assoc($rslt_row)){
         $_SESSION["user"] = $row;
         header("location:index.php") ;
     }
     else{
        $_SESSION["errors"] = $errors;
        header("location:login.php") ;
     }
    mysqli_close($cn);
}


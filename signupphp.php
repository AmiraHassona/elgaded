<?php
session_start();

$errors = [];
$old_values =['name'=>null,'email'=>null,];

if(empty($_POST['name'])) $errors['name'] = "Name is Required" ;
else $old_values['name'] = $_POST['name'];

if(empty($_POST['email'])) $errors['email'] = "Email is Required";
else $old_values["email"] =$_POST['email'];

if(empty($_POST['password']) || empty($_POST['rep_password'])) $errors['password'] = "Password and Confirm Passowrd is Required" ;
else if ($_POST['password'] != $_POST['rep_password']) $errors['rep_password'] = "Password and Confirm Password not matched";


$name  = filter_var(trim($_POST['name']) ,FILTER_SANITIZE_STRING );
$email = filter_var(trim($_POST['email']) ,FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars($_POST['password']);
$gender = $_POST['gender'];
var_dump($gender);


if (empty($errors)){
    $password = md5($password);
    $qyr = "insert into users (name,email,password,gender)values('$name','$email','$password',$gender)";
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
    $rslt = mysqli_query($cn , $qyr);
    mysqli_close($cn);
    if ($rslt){
        header("location:login.php");
    }
}else{
    $_SESSION["errors"] = $errors;
    $_SESSION["old_values"] = $old_values ;
    header("location:signup.php");
}



<?php
session_start();
$id = $_SESSION["user"]["id"];

// echo "<pre>";
// var_dump($_FILES);
// var_dump($_SESSION["user"]);

require_once("config.php");
$cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PASSWORD, DB_NAME, DB_PORT);

$qyr = "select avtar from users where id = $id ";
$rslt = mysqli_query($cn, $qyr);
if ($row = mysqli_fetch_assoc($rslt)) {
    $avtar = $row['avtar'];
    //mysqli_error($cn);
}
if (!empty($_FILES["avtar"]["name"])) {
    unlink($row["avtar"]);
    $avtar = "assets/images/".date("YmdHis")."_".$_FILES["avtar"]["name"].".".pathinfo($_FILES["avtar"]["name"] , PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["avtar"]["tmp_name"],$avtar);
}
require_once("config.php");
$cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
$qyr = "update users set avtar = '$avtar' where id = '$id'";
$rslt = mysqli_query($cn , $qyr);
//var_dump(mysqli_error($cn));
mysqli_close($cn);

if ($rslt) {
    header("location:index.php");
}


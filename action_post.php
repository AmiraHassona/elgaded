
<?php
session_start();
if (!empty($_SESSION["user"]) && $_SESSION["user"]["role"] =="admin") {
   $user = $_SESSION["user"];

   $post_id = $_GET["post_id"];
   $action = $_GET["action"];
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
    $qyr = "update posts set statues='$action',action_by = ".$user["id"] ." where id =$post_id ";
    $rslt = mysqli_query($cn,$qyr);
    mysqli_close($cn);
    
       header("location:index.php");
    
}




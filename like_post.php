<?php
session_start();
$user = $_SESSION["user"];




$post_id = $_POST["post_id"];
$page = $_POST["n_page"];

// echo "<pre>";
// var_dump($_POST);

if(isset( $_POST['like'])){
    $_like = $_POST['like'] ;
}
elseif(isset($_POST['dislike'])){
    $_like = $_POST['dislike'] ;
}else{
    header("location:index.php?page=".($page));
}
if ($_like){
   require_once("config.php");
   $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);

   $qyr = "SELECT * FROM likes where user_id=" .$user['id'] ." and post_id=$post_id" ;
   $rslt = mysqli_query($cn , $qyr);
 
   if( !( $rows = mysqli_fetch_assoc($rslt))){    
      
            $qyr = "INSERT INTO `likes`( `like`, `post_id`, `user_id`) VALUES ('$_like','$post_id',".$user['id'].")";
            $rslt = mysqli_query($cn , $qyr);
            var_dump(mysqli_error($cn));
            mysqli_close($cn);
            
        }        
    }
    header("location:index.php?page=".($page));

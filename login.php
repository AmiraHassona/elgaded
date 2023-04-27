<?php
   session_start();
   $lang = "en";
   if(!empty($_SESSION["lang"])){
     $lang = $_SESSION["lang"] ;
   }
   if(isset($_SESSION["lang"]) && $_SESSION["lang"] == "ar") require_once("messages_ar.php");
   else require_once("messages_en.php");
   

?>


<!doctype html>
<html lang="<?=$lang;?>" dir="<?=$masseges["dir"]?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Free Dental Medical Hospital Website Template | Smarteyeapps.com</title>

  <link rel="shortcut icon" href="assets/images/fav.jpg">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body class="h-100">
  <div class="container-fluid full-bg h-100">
    <div class="container h-100">
      <div class="row no-margin h-100">
        <div class="bg-layer d-flex col-md-4">
          <div class="login-box row">
            <h3><?=$masseges["User login"]?></h3>
            <form action="loginphp.php" method="post" class="input-group ">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
              </div>
              <input type="email" name="email" class="form-control" placeholder="<?=$masseges["Email Address"]?>" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="password" class="form-control" placeholder="<?=$masseges["Password"]?>" aria-label="Username" aria-describedby="basic-addon1">
             </div>
             <p>
              <label class="container">
                <input type="checkbox" name="remember" >
                <span class="checkmark"></span><?=$masseges["Remember me"]?>
              </label>
              <?=$masseges["forget password ?"]?>
             </p>
             <button class="btn btn-success"><?=$masseges["Click to Login"]?></button>
            </form>
            <p class="no-c"><?=$masseges["Not a member yet?"]?> <a href="signup.php"><?=$masseges["Create your Account"]?></a></p>
            <p class="no-c">* 
              <a href="chang_lang.php?lang=en" > English</a> *
              <a href="chang_lang.php?lang=ar">اللغة العربيه</a> *
            </p>
          </div>
        </div>
      </div>

      <div class="foter-credit">
        <a href="https://smarteyeapps.com/">Designed by : Smarteyeapps.com</a>
      </div>
    </div>

  </div>
</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>


</html>
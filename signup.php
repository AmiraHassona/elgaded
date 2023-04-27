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
  <title> EL GADED </title>

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
            <h3> <?=$masseges["User Registeration"]?></h3>
            <form action="signupphp.php" method="post" class="input-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="name" class="form-control" placeholder="<?=$masseges["Full Name"]?>" aria-label="Username" aria-describedby="basic-addon1" value="<?PHp if(!empty( $_SESSION["old_values"]["name"])) echo $_SESSION["old_values"]["name"] ?>" >
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
              </div>
              <input type="email" name="email" class="form-control" placeholder="<?=$masseges["Email Address"]?>" aria-label="Username" aria-describedby="basic-addon1" value="<?php if (!empty($_SESSION["old_values"]["email"])) echo $_SESSION["old_values"]["email"] ?>" >
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="password" class="form-control" placeholder="<?=$masseges["Password"]?>" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" name="rep_password" class="form-control" placeholder="<?=$masseges["Repeat Password"]?>" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="wrap-input100 mb-3 ml-1 ">
              <input type="radio" name="gender" value="0" checked><?=$masseges["Male"]?> 
              <input type="radio" name="gender" value="1"><?=$masseges["Female"]?>
            </div>
            <button class="btn btn-success"><?=$masseges["Click to Login"]?></button>
            </form>

            <?php
	          if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
	          if (!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);
	          ?>
            
            <p class="no-c"><?=$masseges["Already have Account?"]?> <a href="login.php"><?=$masseges["Sign In"]?></a></p>
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
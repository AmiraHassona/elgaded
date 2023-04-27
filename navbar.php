<?php
session_start();
if (empty($_SESSION["user"])) {
    header("location:login.php");
} else {
    $user = $_SESSION["user"];
}
$lang = "en";
if (!empty($_SESSION["lang"])) {
    $lang = $_SESSION["lang"];
}
if (isset($_SESSION["lang"]) && $_SESSION["lang"] == "ar") require_once("messages_ar.php");
else require_once("messages_en.php");

require_once("header.php");

require_once("config.php");
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
    $qyr = "select * from users where id =".$user['id'] ;
    $rslt = mysqli_query($cn,$qyr);
    $userr = mysqli_fetch_assoc($rslt)
?>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">
                <h1><?= $masseges["ELGADED"] ?></h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 flex align-items-center">
                    <li class="nav-item ">
                   
<!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
<?php
if($userr['avtar'] == null){
?>
<img src="assets/images/profile-picture.png" alt="user_photo" class="rounded-circle" style="width: 60px;">
<?Php
} else {
?>  
<img src="<?=$userr['avtar'];?>" alt="user_photo" class="rounded-circle" style="width: 60px;">
<?php } ?>
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php
            if($userr['avtar'] == null){
            ?>
            <img src="assets/images/profile-picture.png" alt="user_photo" class="rounded-circle" style="width: 60px;">
            <?Php
            } else {
            ?>  
            <img src="<?=$userr['avtar'];?>" alt="user_photo" class="rounded-circle" style="width: 60px;">
            <?php } ?>
           <form action="photou.php" method="post" enctype="multipart/form-data" class="mt-2  w-25">
              <input type="file" name="avtar" class="mb-2 " >
              <button type="submit" class="px-3  btn btn-primary"><?= $masseges["SEND"] ?></button>
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>         
                    </li>        
                    <li class="nav-item">
                    <!-- <button type="button" class="btn rounded-circle" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><img src="<?=$userr['avtar'];?>" alt="user_photo" class="mx-2 rounded-circle" style="width: 80px;"></button> -->
                    
                    </li>
                    <li class="nav-item">
                        <h6 class="nav-link text-white "><?=$userr['name'];?></h6>
                    </li>
                    <li class="nav-item"><a class="nav-link active p-2 mx-2" aria-current="page" href="#">
                            <h6><?= $masseges["Home"] ?></h6>
                        </a></li>
                    <li class="nav-item"><a class="badge bg-info text-decoration-none link-light  " href="logout.php">
                            <h6><?= $masseges["LOG OUT"] ?></h6>
                        </a></li>
                </ul>
            </div>
        </div>
    </nav>
   
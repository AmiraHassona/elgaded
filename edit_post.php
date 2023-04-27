<?php
require_once("navbar.php");
$user = $_SESSION["user"];
 
  if(!empty($_GET["post_id"]) ){
    $post_id= $_GET["post_id"];
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PASSWORD,DB_NAME,DB_PORT);
    $qyr = "select * from posts where id = $post_id and created_by =".$user['id'] ;
    $rslt = mysqli_query($cn,$qyr);
     if($post = mysqli_fetch_assoc($rslt)){
       
      }
     else{
        header("location:index.php");
      }
    }else{
        header("location:index.php");
    }
?>
<!-- Page content-->
<div class="container mt-5 m">
    <div class="row">
        <div class="col-lg-12">
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header"><?= $masseges["Edit Your Post .."] ?> </div>
                <div class="card-body">
                    <div class="row">
                        <form action="update_post.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="post_id" value="<?=$post['id']?>">
                                <label for="inputAddress"><?= $masseges["Title Post"] ?></label>
                                <input type="text" name="post_title" class="form-control mb-2" id="inputAddress" value="<?=$post['post_title']?>"></br>
                                <img src="<?=$post['image_post']?>" alt="post_photo" class="form-control mb-2">
                                <input type="file" name="img_post" class="form-control mb-2"> </br>
                                <label for="inputAddress2"><?= $masseges["Write Post"] ?></label>
                                <textarea name="post_body" class="form-control mb-2" id="inputAddress2" rows="5"><?=$post['post_body']?> </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= $masseges["POST"] ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>
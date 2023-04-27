<?php
// echo "<pre>";
// var_dump($_SERVER);
require_once("navbar.php");

require_once("config.php");
$cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PASSWORD, DB_NAME, DB_PORT);


$page_limet = 1;
$qyr = "select count(`id`) as totalpages from posts ";
$rslt = mysqli_query($cn, $qyr);
$posts = mysqli_fetch_assoc($rslt);
$total_pages = $posts['totalpages'];
$pages_num = ceil($total_pages / $page_limet);
if (isset($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pages_num) {
    $page = filter_var(trim($_GET['page']), FILTER_SANITIZE_NUMBER_INT);
} else {
    $page = 1;
}
$offset = ($page - 1) * $page_limet;

//var_dump($page_limet ,$total_pages ,$pages_num,$offset,$page);

?>
<!-- Page content-->
<div class="container mt-5 m">
    <div class="row">
        <div class="col-lg-12">
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header"><?= $masseges["Write Your Post .."] ?> </div>
                <div class="card-body">
                    <div class="row">
                        <form action="create_post.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputAddress"><?= $masseges["Title Post"] ?></label>
                                <input type="text" name="post_title" class="form-control mb-2" id="inputAddress"></br>
                                <input type="file" name="img_post" class="form-control mb-2"> </br>
                                <label for="inputAddress2"><?= $masseges["Write Post"] ?></label>
                                <textarea name="post_body" class="form-control mb-2" id="inputAddress2" rows="5"> </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= $masseges["POST"] ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <!-- Post content-->
            <article>
                <?php

                if ($user["role"] != "admin") $status_cond = "statues = 'approved'";
                else $status_cond = "statues in ('approved' ,'pending')";

                $qyr = "SELECT po.id,po.post_title,po.post_body,po.image_post, po.created_by, po.created_at,po.statues,us.name FROM posts po join users us on (us.id = po.created_by) where $status_cond  order by po.created_at desc LIMIT $page_limet OFFSET $offset";
                $rslt = mysqli_query($cn, $qyr);
                while ($post = mysqli_fetch_assoc($rslt)) {
                ?>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?= $post['post_title']; ?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on <?= $post['created_at']; ?> by <?= $post['name']; ?></div>
                        <!-- Post categories-->
                        <?php
                        if ($user["role"] == "admin" && $post["statues"] != "approved") {
                        ?>
                            <a class="badge bg-success text-decoration-none link-light p-2" href="action_post.php?post_id=<?= $post['id'] ?>&action=approved"><?= $masseges["Approve"] ?></a>
                            <a class="badge bg-danger text-decoration-none link-light p-2" href="action_post.php?post_id=<?= $post['id'] ?>&action=rejected"><?= $masseges["Reject"] ?></a>
                            <?php
                        } else {
                            if ($user["id"] == $post['created_by'] || $user["role"] == "admin") {
                            ?>
                                <a class="badge bg-danger text-decoration-none link-light p-2" href="delete_post.php?post_id=<?= $post['id'] ?>"><?= $masseges["DELETE"] ?>
                                </a>
                            <?php
                            }
                            if ($user["id"] == $post['created_by']) {
                            ?>
                                <a class="badge bg-primary text-decoration-none link-light p-2" href="edit_post.php?post_id=<?= $post['id'] ?>"><?= $masseges["EIDIT"] ?>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4 row justify-content-center">
                        <?php if($post['image_post'] != 'null'){ ?>
                        <div style="width: 75%;">   
                        <img class="img-fluid rounded" src="<?= $post['image_post'];?>" alt="<?= $post['post_title'];?>"  />
                        </div> 
                        <?php }else{ ?>
                         <div> </div>   
                        <?php }?>   
                    </figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-0">
                            <?= $post['post_body'];?>
                        </p></br>
                        <!-- start rate code -->
                        <?php
                        $qyr = "SELECT count(*) c  FROM likes   where `like` ='like' and post_id =".$post['id'];  
                        $rslt = mysqli_query($cn , $qyr);
                        echo mysqli_error($cn);
                        $likes = mysqli_fetch_assoc($rslt);  
                        ?>
                        <div class="row">
                        <div class="col-2">
                        <form action="like_post.php" method="post" >
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <input type="hidden" name="n_page" value="<?= $page ?>">
                        <button type="submit"  onclick="cgreen()" class="font_rate rounded-circle" name="like" value="like">
                        <i class="far fa-thumbs-up rounded-circle" id="like"></i> 
                        </button>
                        <span  class="font_rate"><?php  echo $likes['c']?></span>
                        </form>
                        </div>    

                        <?php
                        $qyr = "SELECT count(*) c   FROM likes   where `like` ='dislike' and post_id =".$post['id'];  
                        $rslt = mysqli_query($cn , $qyr);
                        $likes = mysqli_fetch_assoc($rslt);
                        ?>
                        <div class="col-2">
                        <form action="like_post.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <input type="hidden" name="n_page" value="<?= $page ?>">
                        <button type="submit"  onclick="cred()" class="font_rate rounded-circle" name="dislike" value="dislike">
                        <i class="far fa-thumbs-down rounded-circle" id="dislike"></i>
                        </button>
                        <span  class="font_rate"><?=  $likes['c']?></span>
                        </form>
                        </div>
                        </div>
                        <!--end rate code -->
                    </section>

            </article>

            <!-- Comments section-->
            <section class="mb-5 ">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4" action="comment.php" method="post">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <input type="hidden" name="n_page" value="<?= $page ?>">
                            <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" name="comment_body"></textarea>
                            <button type="submit" class="btn btn-primary mt-2"><?= $masseges["SEND"] ?></button>
                        </form>
                        <!-- Comment with nested comments-->
                        <?php
                        
                        $qyr = "SELECT us.name, us.avtar ,us.id, po.id , com.comment_body,com.post_id,com.user_id , com.created_at from users us join comments com on (us.id = com.user_id) join posts po on (po.id = com.post_id)  where com.post_id = po.id  order by com.created_at desc";
                        $rslt = mysqli_query($cn, $qyr);
                        while ($comment = mysqli_fetch_assoc($rslt)) {
                        if($post['id'] == $comment['post_id']){
                        ?>
                            <div class="d-flex mb-4 ">
                                <!-- Parent comment-->
                                <div class="flex-shrink-0">
                                    <?php
                                    if($comment['avtar'] == null){
                                    ?>
                                    <img src="assets/images/profile-picture.png" alt="user_photo" class="rounded-circle" style="width: 60px;">
                                    <?Php
                                    } else {
                                    ?>  
                                    <img class="rounded-circle" src="<?= $comment["avtar"] ?>" alt="photo" width="50px" />
                                    <?php } ?>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold"><?= $comment["name"] ?></div>
                                    <?= $comment["comment_body"] ?>
                                    <!-- Child comment 1-->
                                    <!-- <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                    </div>
                                </div> -->
                                </div>
                            </div>
                            <span class=" mb-3"><?= $comment["created_at"] ?></span>
                        <?php 
                         };
                        } ;
                     ?>
                    </div>
                </div>
            </section>

        <?Php
                 };  
                mysqli_close($cn);
        ?>


        </div>
    </div>
</div>
<!-- start pagination -->
<div class="container  ">
    <div aria-label="Page navigation example" class="w-25 ">
        <ul class="pagination">
            <li class="page-item  <?php if ($page == 1) echo "disabled" ?>">
                <a class="page-link" href="<?php echo $_SERVER["PHP_SELF"] . '?page=' . ($page - 1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php if ($page == $pages_num) $page = $pages_num - 1; ?>
            <li class="page-item"><a class="page-link" href="index.php?page=<?= $page ?>"><?= $page ?></a></li>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?= $pages_num ?>">
                    <?= $pages_num ?></a>
            </li>
            <li class="page-item <?php if ($page == $total_pages - 1) echo "disabled" ?>">
                <a class="page-link" href="<?php echo $_SERVER["PHP_SELF"] . '?page=' . ($page + 1) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>

    </div>
</div>
<!-- end pagination -->
<?php
require_once("footer.php");
?>
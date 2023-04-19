<?php include('components/header.php'); ?>
<div class="container mt-1">
    <?php if(isset($_SESSION['id'])  && $_SESSION['is_active'] == 1){ ?>
        <h2>Welcome <?= $_SESSION['first_name']?></h2>
        <a class="btn btn-outline-warning" href="create_post.php">Create Blog</a>
        <br>
        <br>
        <h3>Blog Posts</h3>
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
        <br>
        <div class="row m-1 p-1 ">
            <div class="col ">
                <?php foreach(getAllPosts() as $res) {?>
                <div class="card border-dark p-1 m-1">
                <h4 class=""><a href="single_post.php?id=<?= $res['bid']?>" style="color: black"><?= $res['title']?></a></h4>
                <h6>Author: <?= strtoupper($res['first_name'] . " " . $res['last_name'])?></h6>
                <?php $tags = explode(',', $res['tags']) ?>
                <h5>Tags: 
                    <?php foreach($tags as $tag){?>
                        <a href="all_posts.php?tag=<?=$tag?>" class="badge bg-warning" style="text-decoration: none"><?= $tag ?></a>
                    <?php } ?>
                </h5>
                <h6>Date Published: <?= $res['date_created']?></h6>
                </div>
                <br>
                <?php } ?>
            </div>
        </div>
    <?php }else{ ?>
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
        <br>
        <h3>Blog Posts</h3>
        
        <div class="row m-1 p-1">
            <div class="col">
                <?php foreach(getAllPosts() as $res) {?>
                <div class="card border-dark p-1 m-1">
                <h4><a href="single_post.php?id=<?= $res['bid']?>" style="color: black"><?= $res['title']?></a></h4>
                <h6>Author: <?= strtoupper($res['first_name'] . " " . $res['last_name'])?></h6>
                <?php $tags = explode(',', $res['tags']) ?>
                <h5>Tags: 
                    <?php foreach($tags as $tag){?>
                        <a href="all_posts.php?tag=<?=$tag?>" class="badge bg-warning" style="text-decoration: none"><?= $tag ?></a>
                    <?php } ?>
                </h5>
                <h6>Date Published: <?= $res['date_created']?></h6>
                </div>
                <br>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php include('components/footer.php'); ?>

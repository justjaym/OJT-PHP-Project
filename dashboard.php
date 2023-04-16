<?php include('components/header.php'); ?>

<div class="container mt-5">
    <h2>Welcome <?= $_SESSION['first_name']?></h2>
    <a class="btn btn-outline-warning" href="create_post.php">Create Blog</a>
    <h3>Manage Posts</h3>

    <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <br>
    <br>
    <div class="row m-1 p-1">
        <div class="col-4">
            <?php foreach(getPosts() as $res) {?>
            <h4><a href="single_post.php?id=<?= $res['bid']?>" style="color: black"><?= $res['title']?></a></h4>
            <h5>(<?= $res['tags']?>)</h5>
            <br>
            <?php } ?>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>

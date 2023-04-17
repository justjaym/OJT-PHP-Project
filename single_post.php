<?php include('components/header.php'); ?>

<div class="container mt-1">
<div class="row m-1 p-1 ">
        <div class="col-4">
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
            <?php foreach(getSinglePosts() as $res) {?>
            <h1><?= $res['title']?></h1>
            <br>
            <h4>(<?= $res['tags']?>)</h4>
            <br>
            <h5><?= $res['body']?></h5>
            <br>
            <br>
            <br>
            <h6>Created By: <?= $res['first_name'] . " " . $res['last_name']?></h6>
            <h6>Date Published: <?= $res['date_created']?></h6>

            <br>
            <?php } ?>
        </div>
    </div>
</div>
<?php include('components/footer.php'); ?>

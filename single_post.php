<?php include('components/header.php'); ?>

<div class="container mt-5 ">
<div class="row m-1 p-1 text-center ">
        <div class="col">
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
            <?php foreach(getSinglePosts() as $res) {?>
            <h1><?= $res['title']?></h1>
            <br>
            <?php $tags = explode(',', $res['tags']) ?>
                <h5> 
                    <?php foreach($tags as $tag){?>
                        <a  class="badge bg-warning" style="text-decoration: none"><?= $tag ?></a>
                    <?php } ?>
                </h5>
            <br>
            <h5 style="text-align: justify"><?= $res['body']?></h5>
            <br>
            <br>
            <br>
            <h5>Author <?= strtoupper($res['first_name'] . " " . $res['last_name'])?></h5>
            <h6>Date Published: <?= $res['date_created']?></h6>
            <br>
            <?php } ?>
        </div>
    </div>
    <div>
        <h4>Comments</h4>
    </div>
    <?php if(isset($_SESSION['id'])  && $_SESSION['is_active'] == 1){ ?>
        <form action="" method="post">
        <textarea type="text" rows="2"></textarea>
        <br>
        <button type="submit" name="btn_comment" class="mt-3 btn btn-warning">Add Comment</button>
        </form>
    <?php } ?>
        
</div>
<?php include('components/footer.php'); ?>

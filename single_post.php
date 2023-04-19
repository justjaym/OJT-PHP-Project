<?php include('components/header.php'); ?>

<div class="container mt-5 ">
<div class="row m-1 p-1 text-center ">
        <div class="col">
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
    <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    </div>
    <?php if(isset($_SESSION['id'])  && $_SESSION['is_active'] == 1){ ?>
    <?= (isset($_POST['btn_comment'])) ? blogComment($_POST) : ''; ?>
        <form method="POST">
        <textarea name="comment" type="text" rows="2" cols="50"> 
        </textarea>
        <br>
        <button type="submit" name="btn_comment" class=" btn btn-warning">Add Comment</button>
        </form>
    <?php } ?>
    <?php foreach(getComments() as $res) {?>
    <div class="card border-dark p-2 mt-2">
        <p><b> <?= strtoupper($res['fullname'] )?> :  </b> <?= $res['comment']?></p>
        <p>Date commented: <?= $res['date_created']?></p>
    </div>
    <?php } ?>
</div>
<?php include('components/footer.php'); ?>

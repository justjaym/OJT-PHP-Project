<?php include('components/header.php'); ?>
<?php foreach(getSinglePosts() as $res) {?>
<?php } ?>
<div class="container mb-5">
</div>
<div class="container mt-5">
    <div class="text-center">
        <h1>Edit <?= $res['title']?></h1>
    </div>

    <form method="POST">
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <?= (isset($_POST['btn_edit_post'])) ? editPost($_POST) : ''; ?>
    <?= (isset($_POST['btn_delete_post'])) ? deletePost() : ''; ?>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Blog Title</label>
                    <input type="text" value="<?= $res['title']?>" name="title" class="mt-2 form-control" autocomplete="off" placeholder="Enter blog Title">
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Blog Tag/s (comma separated)</label>
                    <input type="text" value="<?= $res['tags']?>" name="tags" class="mt-2 form-control" autocomplete="off" placeholder="Enter tags">
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Blog Contents</label>
                    <textarea type="text" rows="5" name="body" class="mt-2 form-control" autocomplete="off" placeholder="Enter blog content" required>
                    <?= $res['body']?>
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-3">
                <button type="submit" name="btn_edit_post" class="mt-3 btn btn-primary">Edit blog</button>
            </div>
            <div class="col-1">
                <button type="submit" name="btn_delete_post" class="mt-3 btn btn-danger">Delete</button>
            </div>
        </div>

    </form>
</div>

<?php include('components/footer.php'); ?>


<?php include('components/footer.php'); ?>

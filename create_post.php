<?php include('components/header.php'); ?>

<div class="container mb-5">
</div>
<div class="container mt-5">
    <div class="text-center">
        <h1>Create Blog</h1>
    </div>
    <form method="POST">
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <?= (isset($_POST['btn_create_post'])) ? createPost($_POST) : ''; ?>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Blog Title</label>
                    <input type="text" name="title" class="mt-2 form-control" autocomplete="off" placeholder="Enter blog Title">
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Blog Tag/s (comma separated)</label>
                    <input type="text" name="tags" class="mt-2 form-control" autocomplete="off" placeholder="Enter tags">
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Blog Contents</label>
                    <textarea type="text" name="body" class="mt-2 form-control" autocomplete="off" placeholder="Enter blog content" required>
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-2">
                <button type="submit" name="btn_create_post" class="mt-3 btn btn-primary">Create blog</button>
            </div>
        </div>

    </form>
</div>

<?php include('components/footer.php'); ?>


<?php include('components/footer.php'); ?>

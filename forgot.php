<?php include('components/header.php'); ?>

<div class="container mt-5">
    <div class="text-center">
        <h1>Forgot Password</h1>
    </div>
    <form method="POST">
    <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <?= (isset($_POST['btn_forgot'])) ? forgotPass($_POST) : ''; ?>
    <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email"  class="mt-2 form-control" autocomplete="off" placeholder="Enter your email">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <button type="submit" name="btn_forgot" class="mt-3 btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php include('components/footer.php'); ?>
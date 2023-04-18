<?php include('components/header.php'); ?>

<div class="container mt-5">
    <div class="text-center">
        <h1>Reset Password</h1>
    </div>
    <form method="POST">
    <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <?= (isset($_POST['btn_reset'])) ? resetPass($_POST) : ''; ?>
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
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" name="password" class="mt-2 form-control" autocomplete="off" placeholder="Enter your new password">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Confirm New Password</label>
                    <input type="password" name="cpassword" class="mt-2 form-control" autocomplete="off" placeholder="Confirm your new password">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <button type="submit" name="btn_reset" class="mt-3 btn btn-primary">Update Password</button>
            </div>
        </div>
    </form>
</div>

<?php include('components/footer.php'); ?>
<?php include('components/header.php'); ?>

<div class="container mt-5">
    <div class="text-center">
        <h1>Login User</h1>
    </div>
    <form method="POST">
    <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <?= (isset($_POST['btn_login'])) ? loginUser($_POST) : ''; ?>
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
                    <label for="">Password</label>
                    <input type="password" name="password" class="mt-2 form-control" autocomplete="off" placeholder="Enter your password">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
            </div>
            <div class="col-1">
                <button type="submit" name="btn_login" class="mt-3 btn btn-primary">Login</button>
            </div>
        </div>
    </form>
</div>

<?php include('components/footer.php'); ?>
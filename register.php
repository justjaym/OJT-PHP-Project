<?php include('components/header.php'); ?>
<div class="container mb-5">
</div>
<div class="container mt-5">
    <div class="text-center">
        <h1>Register User</h1>
    </div>
    <form method="POST">
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
        <?= (isset($_POST['btn_reg'])) ? registerUser($_POST) : ''; ?>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" value="" class="mt-2 form-control" autocomplete="off" placeholder="Enter your first name">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Middle Name</label>
                    <input type="text" name="middle_name" value="" class="mt-2 form-control" autocomplete="off" placeholder="Enter your middle name">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" value="" class="mt-2 form-control" autocomplete="off" placeholder="Enter your last name">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" value="" class="mt-2 form-control" autocomplete="off" placeholder="Enter your email">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" value="" class="mt-2 form-control" autocomplete="off" placeholder="Enter your password">
                    <p>*Must contain atleast one capital letter, number, and symbol.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="cpassword" value="" class="mt-2 form-control" autocomplete="off" placeholder="Confirm Password">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-2">
                <div class="icheck-primary">
                    <input type="checkbox" name="privacy_policy" value="agree">
                    <label for="">
                        <br>
                        I agree to <a href="privacy_policy.php">Privacy Policy</a>
                    </label>
                </div>
            </div>
            <div class="col-1">
                <button type="submit" name="btn_reg" class="mt-3 btn btn-primary">Register</button>
            </div>
        </div>

    </form>
</div>

<?php include('components/footer.php'); ?>
<?php include('components/header.php'); ?>
<div class="container mt-5">
<?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <?= (isset($_POST['submit'])) ? profileUpload(array_merge($_POST, $_FILES)) : ''; ?>
    <form method="POST" enctype="multipart/form-data">
    <h3>Profile Page</h3>
    <img src="images/<?= $_SESSION['image']?>" width="100" height="100">
    <h5>First Name: <?= $_SESSION['first_name']?></h5>
    <h5>Middle Name: <?= $_SESSION['middle_name']?></h5>
    <h5>Last Name: <?= $_SESSION['last_name']?></h5>
    <h5>Email: <?= $_SESSION['email']?></h5>
    Upload Photo: <input type="file" name="image">
    <br>
    <br>
    <input type="submit" value="Submit" class="btn btn-dark" name="submit">
    </form>
</div>
<?php include('components/footer.php'); ?>

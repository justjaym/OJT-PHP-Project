<?php include('components/header.php'); ?>

<div class="container mt-1">
    <h2>Welcome <?= $_SESSION['first_name']?></h2>
    <br>
    <br>
    <h3>Manage Accounts</h3>
    <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <?= (isset($_POST['btn_reg'])) ? registerUser($_POST) : ''; ?>
    <?= (isset($_POST['deactivate'])) ? deactivateAccount($_POST) : ''; ?>
    <?= (isset($_POST['activate'])) ? activateAccount($_POST) : ''; ?>
    <br>
    <table class="table">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th class="col-4">Name</th>
            <th class="col-4">Email</th>
            <th class="col-4">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach(getAllUser() as $res) {?>
    <tr>
        <th scope="row"><?= $res['id']?></th>
        <td><?= $res['first_name'] . ' ' . $res['last_name']?></td>
        <td><?= $res['email']?></td>
        <td>
        <?php if ((int)$res['is_active'] == 1) { ?>
            <form method="post"><button type="submit" name="deactivate" class="btn btn-danger" value="<?= $res['id']?>">Deactive</button></form>
        <?php }elseif ((int)$res['is_active'] == 0) {  ?>
            <form method="post"><button type="submit" name="activate" class="btn btn-success" value="<?= $res['id']?>">Activate</button></form>
        <?php }  ?>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>

<?php include('components/footer.php'); ?>

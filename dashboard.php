<?php include('components/header.php'); ?>

<div class="container mt-1">
<?php if($_SESSION['is_admin'] == 1){ ?>
    <h2>Welcome <?= $_SESSION['first_name']?></h2>
    <br>
    <br>
    <h3>Manage Accounts</h3>
    <br>
    <table class="table">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th class="col-4">Name</th>
            <th class="col-4">Blogs</th>
            <th class="col-4">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach(getAllUser() as $res) {?>
    <tr>
        <th scope="row"><?= $res['id']?></th>
        <td><?= $res['first_name'] . ' ' . $res['last_name']?></td>
        <td><?= $res['post']?></td>
        <td><a class="btn btn-success" href=".php?id=<?= $res['id']?>">Activate</a></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>

<?php }else{ ?>
    <h2>Welcome <?= $_SESSION['first_name']?></h2>
    <a class="btn btn-outline-warning" href="create_post.php">Create Blog</a>
    <br>
    <br>
    <h3>Manage Posts</h3>
    <?= (isset($_POST['btn_delete_post'])) ? deletePost() : ''; ?>
    <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset($_SESSION['msg']);}else{ echo ' '; } ?>
    <br>
    <table class="table">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th class="col-4">Title</th>
            <th class="col-4">Tags</th>
            <th class="col-4">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach(getPosts() as $res) {?>
    <tr>
        <th scope="row"><?= $res['bid']?></th>
        <td><?= $res['title']?></td>
        <td><?= $res['tags']?></td>
        <td><a class="btn btn-primary" href="edit_post.php?id=<?= $res['bid']?>">Edit</a> </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <br>
<?php } ?>
</div>

<?php include('components/footer.php'); ?>

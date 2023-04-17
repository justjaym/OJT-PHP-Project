<?php require('includes/functions.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Site</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://codeigniter.com/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://codeigniter.com/favicons/favicon-16x16.png">
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="index.php"><img src="https://imgs.search.brave.com/WjJNHelOfQ40OW4ROv_bBbpV2ZWlGi220t-Hm8Qrwu0/rs:fit:1200:1200:1/g:ce/aHR0cHM6Ly93d3cu/bG9nb2x5bnguY29t/L2ltYWdlcy9sb2dv/bHlueC8yYy8yYzg5/NGFmN2QzMGE0YmQ1/NTUyMDVjYzE1MzM4/Mjc1My5wbmc" height='50px' width='50px'></a>
            <a class="navbar-brand mx-2" href="index.php">Blog Post</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="all_posts.php">Posts <span class="sr-only"></span></a>
                    </li>
                    <?php if(isset($_SESSION['id']) && $_SESSION['is_admin'] == 1){ ?>
                        <li class="nav-item">
                        <a class="nav-link " href="logout.php" tabindex="-1" aria-disabled="true">Log out </a>
                    </li>
                    <?php }elseif(isset($_SESSION['id'])){ ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Manage Posts <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="profile.php" tabindex="-1" aria-disabled="true">View Profile </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="logout.php" tabindex="-1" aria-disabled="true">Log out </a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="register.php">Register <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="login.php" tabindex="-1" aria-disabled="true">Log in </a>
                    </li>
                    <?php } ?>

                </ul>
                <form class="d-flex" method="post" action="/search">
                    <input class="form-control me-sm-2 " type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-warning my-2 my-sm-0 " type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>
<?php
require('db_conn.php');

$_SESSION['conn'] = $conn;

function registerUser($data){
    extract($data);
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>All fields are required!</div></div>";
        $_SESSION['msg'] = $msg;
        return header('Location:register.php');
    }elseif(!preg_match("/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{6,20}$/", $password)){
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Invalid Password Format</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:register.php');
    }elseif($password != $cpassword){
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Password does not Match</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:register.php');
    }elseif(empty($privacy_policy)){
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Agreeing to the Privacy Policy is Required!</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:register.php');
    }else{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $is_admin = 0;
        $is_active = 1;
        $q = "INSERT INTO users (first_name, middle_name, last_name, email, password, privacy_policy, is_admin, is_active) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 'ssssssii', $first_name, $middle_name, $last_name, $email, $hashed_password, $privacy_policy, $is_admin, $is_active);
        mysqli_stmt_execute($stmt);
        mysqli_close($_SESSION['conn']);
        $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>User Registered Succesfully</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:login.php');
    }
}

function loginUser($data){
    extract($data);
    if (empty($email) || empty($password)) {
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>All fields are required!</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:login.php');
    }else{
        $q = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(!password_verify($password, $row['password'])){
            $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Invalid Password</div></div>";
            $_SESSION['msg'] = $msg;
            header('Location:login.php');
        }else{
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['id'] = $row['id'];
            header('Location:dashboard.php');
        }
    }
}

function createPost($data){
    extract($data);
    if (empty($title) || empty($tags) || empty($body)) {
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>All fields are required!</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:create_post.php');
    }else{
        $author_id = $_SESSION['id'];
        $q = "INSERT INTO blogs (author_id, title, tags, body, date_created) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 'issss', $author_id, $title, $tags, $body, date("Y-m-d H:i:s"));
        mysqli_stmt_execute($stmt);
        mysqli_close($_SESSION['conn']);
        $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Blog Created Succesfully</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:dashboard.php');
    }
}

function getPosts(){
    $id = $_SESSION['id'];
    $q = "SELECT b.id as `bid`, b.author_id, b.title, b.body, b.tags, b.date_created, u.id, u.first_name, u.last_name  FROM blogs b INNER JOIN users u ON b.author_id = u.id WHERE author_id = $id";
    $result = mysqli_query($_SESSION['conn'], $q);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
}

function getAllPosts(){
    $q = "SELECT b.id as `bid`, b.author_id, b.title, b.body, b.tags, b.date_created, u.id, u.first_name, u.last_name  FROM blogs b INNER JOIN users u ON b.author_id = u.id";
    $result = mysqli_query($_SESSION['conn'], $q);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
}

function getSinglePosts(){
    $id = $_GET['id'];
    $q = "SELECT b.id as `bid`, b.author_id, b.title, b.body, b.tags, b.date_created, u.id, u.first_name, u.last_name  FROM blogs b INNER JOIN users u ON b.author_id = u.id WHERE b.id = $id";
    $result = mysqli_query($_SESSION['conn'], $q);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
}
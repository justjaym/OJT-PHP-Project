<?php
require('db_conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$_SESSION['conn'] = $conn;
function forgotPass($data){
    extract($data);
    if(empty($email)){
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>All fields are required!</div></div>";
        $_SESSION['msg'] = $msg;
        return header('Location:forgot.php');
    }else{
        $q = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 's',$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(!$row > 0){
            $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Email does not exist!</div></div>";
            $_SESSION['msg'] = $msg;
            return header('Location:forgot.php');
        }else{
            $mail = new PHPMailer(true);
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'ponzejbg@gmail.com';                     //SMTP username
            $mail->Password   = 'dtqmvptbqybpvbjn';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('ponzejbg@gmail.com', 'Mailer');
            $mail->addAddress($email);     //Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Blog Site: Password Reset';
            $mail->Body    = '<a href="http://localhost/phpict/reset.php">Reset Password</a>';
            $mail->AltBody = '<a href="http://localhost/phpict/reset.php">Reset Password</a>';

            $mail->send();
            $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Check email for the reset password link</div></div>";
            $_SESSION['msg'] = $msg;
            return header('Location:forgot.php');
        }
    }    
}

function resetPass($data){
    extract($data);
    if(empty($email) || empty($password) || empty($cpassword)){
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>All fields are required!</div></div>";
        $_SESSION['msg'] = $msg;
        return header('Location:reset.php');
    }else{
        $q = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(!$row > 0){
            $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Email does not exist!</div></div>";
            $_SESSION['msg'] = $msg;
            return header('Location:reset.php');
        }elseif(!preg_match("/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{6,20}$/", $password)){
            $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Invalid Password Format</div></div>";
            $_SESSION['msg'] = $msg;
            header('Location:reset.php');
        }elseif($password != $cpassword){
            $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>Password does not Match</div></div>";
            $_SESSION['msg'] = $msg;
            header('Location:reset.php');
        }else{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $q = "UPDATE users SET password=? WHERE email=?";
            $stmt = mysqli_prepare($_SESSION['conn'], $q);
            mysqli_stmt_bind_param($stmt, 'ss', $hashed_password, $email);
            $result = mysqli_stmt_execute($stmt);
            $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Password Updated Successfully</div></div>";
            $_SESSION['msg'] = $msg;
            return header('Location:reset.php');
        }
    }
}



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
        $image = "images/default.png";
        $q = "INSERT INTO users (first_name, middle_name, last_name, email, password, privacy_policy, is_admin, is_active, image) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 'ssssssiis', $first_name, $middle_name, $last_name, $email, $hashed_password, $privacy_policy, $is_admin, $is_active, $image);
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
            $_SESSION['image'] = $row['image'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['middle_name'] = $row['middle_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['is_active'] = $row['is_active'];
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
    $q = "SELECT b.id as `bid`, b.author_id, b.title, b.body, b.tags, b.date_created, u.id, u.first_name, u.middle_name, u.last_name, u.email, u.image  FROM blogs b INNER JOIN users u ON b.author_id = u.id WHERE author_id = $id";
    $result = mysqli_query($_SESSION['conn'], $q);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
}

function getAllPosts(){
    if(isset($_GET['tag'])){
        $tag = $_GET['tag'];
        $q = "SELECT b.id as `bid`, b.author_id, b.title, b.body, b.tags, b.date_created, u.id, u.first_name, u.last_name  FROM blogs b INNER JOIN users u ON b.author_id = u.id WHERE tags LIKE '%$tag%' ORDER BY bid DESC";
        $result = mysqli_query($_SESSION['conn'], $q);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
        return $temp;
    }else{
        $q = "SELECT b.id as `bid`, b.author_id, b.title, b.body, b.tags, b.date_created, u.id, u.first_name, u.last_name  FROM blogs b INNER JOIN users u ON b.author_id = u.id ORDER BY bid DESC";
        $result = mysqli_query($_SESSION['conn'], $q);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
        return $temp;
    }
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

function editPost($data){
    extract($data);
    if (empty($title) || empty($tags) || empty($body)) {
        $msg = "<div class='row justify-content-center text-center' style='color: red'><div class='col-4'>All fields are required!</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:edit_post.php');
    }else{
        $id = $_GET['id'];
        $q = "UPDATE blogs SET title = ?, tags = ?, body = ? WHERE id = ?";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 'sssi', $title, $tags, $body, $id);
        mysqli_stmt_execute($stmt);
        mysqli_close($_SESSION['conn']);
        $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Blog Edited Succesfully</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:edit_post.php?id='.$_GET['id']);
    }
}

function deletePost(){
    $id = $_GET['id'];
    $q = "DELETE FROM blogs WHERE id = ?";
    $stmt = mysqli_prepare($_SESSION['conn'], $q);
    mysqli_stmt_bind_param($stmt, 'i',  $id);
    mysqli_stmt_execute($stmt);
    mysqli_close($_SESSION['conn']);
    $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Blog Deleted Succesfully</div></div>";
    $_SESSION['msg'] = $msg;
    header('Location:dashboard.php');
}

function profileUpload($data){
    extract($data);
    $file_name = "default.png";
    if (isset($image) && !empty($image['name'])) {
        $ext = explode(".", $image["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image['tmp_name'], "images/" . $file_name);
        $file_name = "$file_name";

    }
    $id = $_SESSION['id'];
    $q = "UPDATE users SET image = ? WHERE id = $id";
    $stmt = mysqli_prepare($_SESSION['conn'], $q);
    mysqli_stmt_bind_param($stmt, 's', $file_name);
    mysqli_stmt_execute($stmt);
    mysqli_close($_SESSION['conn']);
    $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Profile Uploaded Succesfully <br> *Changes in profile will activate on next log in*</div></div>";
    $_SESSION['msg'] = $msg;
    header('Location:profile.php');
}

function getUserStat(){
    $q = "SELECT u.id as `uid`, u.first_name, u.last_name, u.is_active, COUNT(b.author_id) as `post` FROM users u INNER JOIN blogs b on u.id = b.author_id GROUP BY b.author_id";
    // $q = "SELECT * FROM users";
    $result = mysqli_query($_SESSION['conn'], $q);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
}

function getAllUser(){
    $q = "SELECT * FROM users WHERE NOT is_admin=1";
    // $q = "SELECT * FROM users";
    $result = mysqli_query($_SESSION['conn'], $q);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
}

function deactivateAccount($data){
    extract($data);
    $q = "UPDATE users SET is_active = 0 where id = $deactivate";
    $result = mysqli_query($_SESSION['conn'], $q);
    $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Acoount Deactivated</div></div>";
    $_SESSION['msg'] = $msg;
    header('Location:admin_users.php');
}

function activateAccount($data){
    extract($data);
    $q = "UPDATE users SET is_active = 1 where id = $activate";
    $result = mysqli_query($_SESSION['conn'], $q);
    $msg = "<div class='row justify-content-center text-center' style='color: green'><div class='col-4'>Acoount Activated</div></div>";
    $_SESSION['msg'] = $msg;
    header('Location:admin_users.php');
}

function blogComment($data){
    extract($data);
    if (strlen(trim($comment)) == 0) {
        echo "hhihihh";
        $msg = "<div class='row ' style='color: red'><div class='col-4'>Comment can not be empty!</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:single_post.php?id='.$_GET['id']);
    }else{
        $id = $_GET['id'];
        $author_id = $_SESSION['id'];
        $q = "INSERT INTO comments (blog_id, user_id, comment, date_created) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($_SESSION['conn'], $q);
        mysqli_stmt_bind_param($stmt, 'iiss', $id, $author_id, $comment, date("Y-m-d H:i:s"));
        mysqli_stmt_execute($stmt);
        mysqli_close($_SESSION['conn']);
        $msg = "<div class='row ' style='color: green'><div class='col-4'>Comment Submitted</div></div>";
        $_SESSION['msg'] = $msg;
        header('Location:single_post.php?id='.$_GET['id']);
    }
}

function getComments(){
    $id = $_GET['id'];
    $q = "SELECT CONCAT(u.first_name, ' ', u.last_name) as `fullname`, c.comment, c.date_created FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.blog_id = $id ORDER BY c.id DESC";
    $result = mysqli_query($_SESSION['conn'], $q);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
}

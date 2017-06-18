<?php
include('../system/connection.php');
include('../system/functions.php');
session_start();
//fetching customer name with id;
$password      = $_POST['u_pass'];
$user_id       = $_SESSION['user_id'];

$query_update_pass = "UPDATE `users` SET `password` = $password WHERE `id` = $user_id";
$pass_update_result = mysqli_query($connection,$query_update_pass);

if(!$pass_update_result){
    $_SESSION['alert_type'] = 'error';$_SESSION['alert_title'] = 'Password update failed ! contact support 03244799127';$_SESSION['alert_msg'] = ' ';
    header("Location: ../update_settings.php");
}else{
    $_SESSION['auth_err'] = "Password Changed Please Login Again";
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    header("Location: ../index.php");
}

?>
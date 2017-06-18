<?php
session_start();
include('../system/connection.php');
include('../system/functions.php');
$user_phone = $_POST['nuke_phone'];
if(isset($_SESSION['username'])){
    
    $query_del = "DELETE FROM `customers` WHERE `phone` = \"$user_phone\"";
    $result_del = mysqli_query($connection, $query_del);
    if (!$result_del) {
        $_SESSION['alert_type'] = 'error';$_SESSION['alert_title'] = 'Error Deleting Customer !';$_SESSION['alert_msg'] = ' ';
        header("Location: ../reporting_customers.php");
    }else{
        $_SESSION['alert_type'] = 'success';$_SESSION['alert_title'] = 'Customer Archived Successfully !';$_SESSION['alert_msg'] = ' ';
    }

    header("Location: ../reporting_customers.php");
    
}else{
    echo "Access Denied";
}









?>
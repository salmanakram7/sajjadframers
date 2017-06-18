<?php
session_start();
include('../system/connection.php');

//Geting variables
$_user =  $_POST['c_name'];
$_phone = $_POST['c_phone'];

//Building username
$username =   substr($_phone,3,7).rand(100,256);

//getting username ready to store
$name   = ucwords($_POST['c_name']);
$phone  = $_POST['c_phone'];

//Checking for already existing phone no
echo $query_check_existing = "SELECT * FROM customers WHERE phone = \"$phone\"";
$contained = mysqli_query($connection,$query_check_existing);
echo $rowcount  = mysqli_num_rows($contained);
if($rowcount > 0){
    //phone no is already registered
    $_SESSION['alert_type'] = 'error';$_SESSION['alert_title'] = "A User Already Exists with this phone - $phone update failed ";$_SESSION['alert_msg'] = ' ';
    header("Location: ../reporting_customers.php");
}else{
    //phone is new to database
    $query = "INSERT INTO customers (`username`,`name`,`phone`) VALUES (\"$username\",\"$name\",\"$phone\")";
    $result = mysqli_query($connection,$query);
    $_SESSION['alert_type'] = 'success';$_SESSION['alert_title'] = 'Customer Added Successfully';$_SESSION['alert_msg'] = ' ';
}
header("Location: ../reporting_customers.php");
?>

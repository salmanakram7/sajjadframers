<?php
session_start();
include('../system/connection.php');

//Getting variables if edit mode
if(isset($_POST['c_edit_update']) == 1) {
    $_user =  $_POST['c_edit_name'];
    $_phone = $_POST['c_edit_phone'];
    $name   = ucwords($_POST['c_edit_phone']);
    $phone  = $_POST['c_edit_phone'];
}else{
    //Getting variables if new customer is added
    $_user =  $_POST['c_name'];
    $_phone = $_POST['c_phone'];
//getting username ready  for storing
    $name   = ucwords($_POST['c_name']);
    $phone  = $_POST['c_phone'];
}

//Building username
$username =   substr($_phone,3,7).rand(100,256);

/////////////////////////////////////////////
//Checking for already existing phone no
/////////////////////////////////////////////
$query_check_existing = "SELECT * FROM customers WHERE phone = \"$phone\"";
$contained = mysqli_query($connection,$query_check_existing);
$rowcount  = mysqli_num_rows($contained);
if($rowcount > 0){
    // Error phone no is already registered
    $_SESSION['alert_type'] = 'error';$_SESSION['alert_title'] = "A User Already Exists with this phone - $phone update failed ";$_SESSION['alert_msg'] = ' ';
    header("Location: ../reporting_customers.php");
}else{
    // Success new phone no
    //Checking if update / Store
    if(isset($_POST['c_edit_update']) == 1){
        $query = "UPDATE `customers` SET `username`= \"$username\", `name`= \"$name\", `phone`= \"$phone\" WHERE `phone`= \"$phone\" ";
        $result = mysqli_query($connection,$query);
        echo 'updated'.$result;
        $_SESSION['alert_type'] = 'success'; $_SESSION['alert_title'] = 'Customer Updated Successfully'; $_SESSION['alert_msg'] = ' ';
    } else {
        $query = "INSERT INTO customers (`username`,`name`,`phone`) VALUES (\"$username\",\"$name\",\"$phone\")";
        $result = mysqli_query($connection, $query);
        echo 'Added'.$result;
        $_SESSION['alert_type'] = 'success'; $_SESSION['alert_title'] = 'Customer Added Successfully'; $_SESSION['alert_msg'] = ' ';
    }
}
header("Location: ../reporting_customers.php");

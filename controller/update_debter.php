<?php
session_start();
include('../system/connection.php');

if(isset($_POST['s_customer_username'])){

    $_SESSION['selected_debter_username'] =  $_POST['s_customer_username'];
//    echo   $_SESSION['selected_debter_username']; die();
    $gotDebter = $_POST['s_customer_username'];

    //Getting name of selected customer
    $fetchName = mysqli_query($connection, "SELECT `name` FROM `customers` WHERE  `username` = $gotDebter ");
    $fetchedName = mysqli_fetch_assoc($fetchName);
    $_SESSION['selected_debter_name'] = $fetchedName['name'];

// Fetching Total Debt of the customer
    $query_list = "SELECT * FROM `sale` WHERE `username` = \"$gotDebter\" && `credit` = 1 ";
    $result_list  = mysqli_query($connection,$query_list);
    $_SESSION['pending_dept_single_person'] = 0;
    while($row = mysqli_fetch_assoc($result_list)){
    $_SESSION['pending_dept_single_person'] +=   $row['amount'];
    }
    header("Location: ../reporting_cash.php");
}

?>
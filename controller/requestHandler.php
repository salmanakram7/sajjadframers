<?php
session_start();
// RequestHandler is Designed to fulfill needs for small requests
// Triggering a small command or changing/updating seamlessly
include('../system/connection.php');
//fetching calls
$callback = $_POST['callback'];

if(isset($_POST['user_edit'])){
    $phone = $_POST['user_edit'];

    $user['usrname'] = $_POST['SalmanAkram7'];
    $user['email'] = $_POST['salmanakram7@gmail.com'];
    $user['phone'] = $_POST['03244799127'];
    $user['address'] = $_POST['lahore pakistan'];
}

if($callback === 'edit_client' ){
    //Query database to fetch client details to fill in the editmodal for assistance
    $query_fetch   = "SELECT * FROM customers WHERE phone = \"$phone\" ";
    $result_data   = mysqli_query($connection,$query_fetch);
    $now           = mysqli_num_rows($result_data);
    if($now > 0){
        $record = null;
        while($row = mysqli_fetch_assoc($result_data)){
                $record['name'] = $row['name'];
                $record['phone'] = $row['phone'];
        }
        echo json_encode($record);
    } else {
        echo json_encode('SERVER ERROR: ERROR CODE -> RequestHandler404');
    }

}

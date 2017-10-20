<?php
session_start();
include('../system/connection.php');
//fetching calls
$callback = $_POST['callback'];
if(isset($_POST['user_edit'])){
    $phone = $_POST['user_edit'];
}

if($callback === 'edit_client' ){
    //Quering database to fetch client details to fill in the editmodal for assistance
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
        echo 'Server Error: record not found ';
    }

}

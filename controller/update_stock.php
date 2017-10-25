<?php
session_start();
include('../system/connection.php');

// Request Action [Processing Request]
$requestAction         = $_POST['form_request_action'];

//======================================================================================================================
//                                            New Model Insert Request
//======================================================================================================================

if ($requestAction === 'addNewModel') {

    //Getting Variables ready [for: New Model Insertions]
    $author = $_SESSION['user_id'];
    $model = strtoupper($_POST['s_pid']);
    $no_length = $_POST['s_no_length'];
    $rate_feet = $_POST['s_rate_feet'];
    $rate_length = $_POST['s_rate_length'];
    $width = $_POST['s_width'];
    $wastage = $width * 8;
    $instockp_value = $no_length;
    $invent_datetime = date("Y-m-d H:i:s");
    $last_updated = date("Y-m-d H:i:s");

    // Generating Unique Identifier from ModelID   /// NOTE: this will never change even product name has been changes
    $modelUUID = substr($model, 3, 7) . rand(100, 256);

    // Running Insert Query
    echo $query_insert = "INSERT INTO stock (
    `pid`,`author`,`no_of_length`,`size`,`rate_in_feet`,`rate_of_length`,`width`,`instockp`,`wastage`,`invent_datetime`, `last_updated`) 
    VALUES (
    \"$model\",\"$author\",\"$no_length\",\"$size\" ,\"$rate_feet\",\"$rate_length\",\"$width\",\"$instockp_value\",\"$wastage\",\"$$invent_datetime\", \"$last_updated\")";

    //Error Occurred while Insertion
    $new_insertion = mysqli_query($connection, $query_insert);
    if (!$new_insertion) {
        echo "Error in query while inserting new model </br>";
    }
    //TODO: Introduce Bug Tracker for crash report


//======================================================================================================================
//                                           Update Store Keeping Value Only
//======================================================================================================================
} else if ($requestAction === 'updateSingleModel') {

    //Getting Variables ready [for: Quantity Update]
    echo     $model_id = strtoupper($_POST['model_id']).' ';
    echo     $model_quantity = $_POST['model_quantity'].' ';
    echo     $model_quantity = $_POST['model_inStock'].' ';
    echo     $instockp_value = $model_quantity * 12; // Converted in Inch;
    echo     $last_updated = date("Y-m-d H:i:s");
    die();


        // Getting Existing Model related values [ready to update]
        $rowfetch = mysqli_fetch_assoc($contained);
        $new_no_of_length = $rowfetch['no_of_length'] + $no_length; //Adding new values
        $new_instockp = $rowfetch['instockp'] + $instockp_value; //Adding new values

        //Running [Update Query]
        echo $query_update = "UPDATE stock SET  
        `author` = $author,  
        `no_of_length` = $new_no_of_length , 
        `size` = $size , 
        `rate_in_feet` = $rate_feet, 
        `rate_of_length`=$rate_length , 
        `instockp` = $new_instockp,
        `invent_datetime` = \"$invent_datetime\"  
        `last_updated` = \"$last_updated\"  
        
        WHERE `pid` = \"$model\"";

        //Error Occurred while updating
        $update_old = mysqli_query($connection, $query_update);
        if (!$update_old) {
            echo "Error in occurred while updating old model " . "</br>";
        }
        //TODO: Introduce Bug Tracker for crash report

} // Both Operations Ended

//======================================================================================================================
//                                                  Cleaning Up and Redirecting
//======================================================================================================================
mysqli_close($connection);
$_SESSION['alert_type'] = 'success';
$_SESSION['alert_title'] = 'Model Updated Successfully !';
$_SESSION['alert_msg'] = ' ';
header("Location: ../reporting_stock.php");

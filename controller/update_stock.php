<?php
session_start();
include('../system/connection.php');

// Request Action [Processing Request]
$requestAction         = $_POST['form_request_action'];

//======================================================================================================================
//                                            REQUEST => New Model Insertion
//======================================================================================================================

if ($requestAction === 'addNewModel') {

    // Getting Variables ready [for: New Model Insertions]
    $author             = $_SESSION['user_id'];
    $model              = strtoupper($_POST['s_pid']);
    $no_length          = $_POST['s_no_length'];
    $length_size        = $_POST['s_size']; // inch
    $rate_feet          = $_POST['s_rate_feet'];
    $rate_length        = $_POST['s_rate_length'];
    $width              = $_POST['s_width'];
    $wastage            = $width * 8; // TODO: confirm auto-calculated wastage

    $current_instockp_value     = $no_length * $length_size;
    $invent_datetime            = date("Y-m-d H:i:s");
    $last_updated               = date("Y-m-d H:i:s");

    // Generating Unique Identifier [ FIXED ] of model
    $modelUUID = substr($model, 3, 7) . rand(100, 256);

    // Running Insert Query
    echo $query_new_model_insert = "INSERT INTO `stock` (
    `pid`, `author`, `no_of_length`, `size`, `rate_in_feet`, `rate_of_length`, `width`, `instockp`,`wastage`,
    `invent_datetime`, `last_updated`) 
    VALUES (
    \"$model\", \"$author\", \"$no_length\", \"$length_size\", \"$rate_feet\", \"$rate_length\", \"$width\",
    \"$current_instockp_value\", \"$wastage\", \"$invent_datetime\", \"$last_updated\")";

    // Error Occurred while Insertion
    $new_model_insertion_Error = mysqli_query($connection, $query_new_model_insert);
    if (!$new_model_insertion_Error) {
        echo "Error in query while inserting new model </br>";
    }
    //TODO: Introduce Bug Tracker for crash report


//======================================================================================================================
//                                           REQUEST => Update Quantity Value Only
//======================================================================================================================
} else if ($requestAction === 'updateSingleModel') {

    // Getting Variables ready [for: Quantity Update]
    $model_id = strtoupper($_POST['model_id']);
    $current_model_quantity = $_POST['model_quantity'];
    $current_instockp_value = $_POST['model_inStock']; // Preferred storage unit is Inch;
    $last_updated = date("Y-m-d H:i:s");

    // Add Existing Stock with and prepare data for insertion

    // fetching old values
    $query_obtain = "SELECT * FROM stock where pid = \"$model_id\" ";
    // Error Occurred while fetching old record
    $new_model_insertion_Error = mysqli_query($connection, $query_obtain);
    if (!$new_model_insertion_Error) {echo "Error Occurred while fetching old record of model </br>";}
    $get_obtain = mysqli_query($connection, $query_obtain);
    $row = mysqli_fetch_assoc($get_obtain);

    // ready insertion data
    $new_model_quantity = $current_model_quantity + (int) $row['no_of_length'];
    $new_inStock_value = $new_model_quantity * (int) $row['size'];
    $new_inStock_value = (int) $row['instockp'] + $new_inStock_value;

    // Running [Update Query]
        $query_stock_value_update =
        "UPDATE `stock` SET 
        `no_of_length`  = \"$new_model_quantity\", 
        `instockp`      = \"$new_inStock_value\",
        `last_updated`  = \"$last_updated\"
        WHERE
        `pid`           = \"$model_id\"";

    // Error Occurred while updating
    $update_stock_value_Error = mysqli_query($connection, $query_stock_value_update);
    if (!$update_stock_value_Error) {
        die("Error occurred while updating old model " . "</br>".mysqli_error($connection) . "</br>" . var_dump(mysqli_error_list($connection)));
    }
    // TODO: Introduce Bug Tracker for crash report

} // Both Operations Ended

//======================================================================================================================
//                                                  Cleaning Up and Redirecting
//======================================================================================================================
mysqli_close($connection);
$_SESSION['alert_type'] = 'success';
$_SESSION['alert_title'] = 'Model Updated Successfully !';
$_SESSION['alert_msg'] = ' ';
header("Location: ../reporting_stock.php");

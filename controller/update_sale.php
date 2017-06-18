<?php
include('../system/connection.php');
include('../system/functions.php');
session_start();

//fetching customer  and username via id;
$cust_id = $_POST['s_customer_id'];
$query_obtain_id = mysqli_query($connection, "SELECT * FROM `customers` WHERE `id` = $cust_id");;
$row_obtain_info = mysqli_fetch_assoc($query_obtain_id);
$customer_name = $row_obtain_info['name'];
$customer_username = $row_obtain_info['username'];

//Fetching product information
$model = $_POST['s_model'];
$query_obtain = "SELECT * FROM stock where pid = \"$model\" ";
$get_obtain = mysqli_query($connection, $query_obtain);
$row = mysqli_fetch_assoc($get_obtain);
$wastage = $row['wastage'];
$remaining_size = $row["no_of_length"];
$cost_per_inch = $row["rate_in_feet"];
$rate_length = $row["rate_of_length"];

//Getting ready form inputs
$type = $_POST['s_type'];
$quantity = $_POST['s_quantity'];

//Converting values to inches  // Setting credit bool & DateTime
$length_size_inch = $row['size'] * $quantity * 12; //e.g 144 inch will used in stock check
$rate_inch = $row["rate_in_feet"] / 12;
$credit = null;
if (isset($_POST["s_credit"])) {$credit = 1; } else {$credit = 0;}
$datetime = date("Y-m-d H:i:s");

//-------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------
//                                                          Product === Frame
// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

if ($type == 'frame') {
    $frame_size_width = strbefore($_POST['s_framesize'], 'X');
    $frame_size_height = strafter($_POST['s_framesize'], 'X');
    $frame_size = $frame_size_width + $frame_size_height;
    $frame_size = $frame_size * 2;
    $frame_size = $frame_size + $wastage; //  in inches
    // stock check
    if ($frame_size > $remaining_size) {
        $_SESSION['alert_type'] = 'error';
        $_SESSION['alert_title'] = 'Stock is Low !';
        $_SESSION['alert_msg'] = " <a style=\"margin-left: 15px;\" href=\"reporting_stock.php\"  class=\"btn btn-info btn-sm\">Update </a>";
        header('location: ../do_sale.php');
    } else {
        //Calculating and converting Cost
        $overall_cost_frame = $rate_inch * $frame_size;
        $overall_cost_frame = round($overall_cost_frame, 1);
        if ($_POST['s_manualCash'] !== '' ) {
            $overall_cost_frame = $_POST['s_manualCash'];
        };
        //Updating Database Records
        $query_sale = "INSERT INTO sale (`name`,`username`,`pid`,`frame_size`,`ptype`,`quantity`,`amount`,`credit`,`datetime`) 
        VALUES (\"$customer_name\",\"$customer_username\",\"$model\",\"$frame_size\",\"$type\" ,\"$quantity\",\"$overall_cost_frame\",\"$credit\",\"$datetime\")";
        $result_sale = mysqli_query($connection, $query_sale);
        if (!$result_sale) {
            echo "<h4 class='alert alert-danger alert-dismissible'>Error in query while updating sale</h4>>" . "</br>";
        }
        $query_minus = "UPDATE `stock` SET  `no_of_length`=$remaining_size-$frame_size WHERE `pid` = \"$model\"";
        $result_stock_minus = mysqli_query($connection, $query_minus);
        if (!$result_stock_minus) {
            echo "Error in query while stock minus " . "</br>";
        }
        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_title'] = 'Frame Sold Successfully!';
        $_SESSION['alert_msg'] = ' ';

        //returning stored values


    }
} else {

//-------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------
//                                                          Product === Length
// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

    //Stock Check`
    if ($length_size_inch > $remaining_size) {
        $_SESSION['alert_type'] = 'error';
        $_SESSION['alert_title'] = 'Stock is Low !';
        $_SESSION['alert_msg'] = " <a style=\"margin-left: 15px;\" href=\"reporting_stock.php\"  class=\"btn btn-info btn-sm\">Update </a>";
        header('location: ../do_sale.php');
    } else {
        //Calculating and converting Cost
        $overall_cost_length = $rate_length * $quantity;
        $overall_cost_length = round($overall_cost_length, 1);
//        var_dump($_POST['s_manualCash']); die();
        if ($_POST['s_manualCash'] !== '' ) {
            $overall_cost_length = $_POST['s_manualCash'];
        };
        //Updating Database Records
        $query_sale = "INSERT INTO sale (`name`,`username`,`pid`,`frame_size`,`ptype`,`quantity`,`amount`,`credit`,`datetime`)
              VALUES (\"$customer_name\",\"$customer_username\",\"$model\",'n/a',\"$type\" ,\"$quantity\",\"$overall_cost_length\",\"$credit\",\"$datetime\")";
        $result_sale = mysqli_query($connection, $query_sale);
        if (!$result_sale) {
            echo "Error in query while updating sale" . "</br>";
        }
        $query_minus = "UPDATE `stock` SET  `no_of_length`=$remaining_size-$length_size_inch WHERE `pid` = \"$model\"";
        $result_stock_minus = mysqli_query($connection, $query_minus);
        if (!$result_stock_minus) {
            echo "Error in query while stock minus " . "</br>";
        }
        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_title'] = 'Length Sold Successfully !';
        $_SESSION['alert_msg'] = ' ';
    }
}
header("Location: ../do_sale.php");
?>
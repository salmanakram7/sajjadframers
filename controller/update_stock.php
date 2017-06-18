<?php
session_start();
include('../system/connection.php');

    
//Getting Variables ready
$author            = $_SESSION['user_id'];
$model             = strtolower($_POST['s_pid']);
$size                  = $_POST['s_size'];
$no_length     = $_POST['s_no_length'] * $size * 12; //Converting in Inch
$rate_feet       = $_POST['s_rate_feet'];
$rate_length  = $_POST['s_rate_length'];
$width              = $_POST['s_width'];
$wastage         = $width * 8;
$instockp         = $no_length;
$datetime = date("Y-m-d H:i:s");

//Checking for already existing same model
$query_check_existing = "SELECT * FROM stock WHERE pid = \"$model\"";
$contained = mysqli_query($connection,$query_check_existing);
$rowcount  = mysqli_num_rows($contained);

if($rowcount > 0){
 
//Found a model now updating new values there
$rowfetch           = mysqli_fetch_assoc($contained);
$new_no_of_length   = $rowfetch['no_of_length']+$no_length; //Adding new values
$new_instockp       = $rowfetch['instockp']+$instockp; //Adding new values

//Running Update Query
echo $query_update = "UPDATE stock SET  `author` = $author,  `no_of_length` = $new_no_of_length , `size` = $size , `rate_in_feet` = $rate_feet, 
`rate_of_length`=$rate_length , `instockp` = $new_instockp,`datetime` =,\"$datetime\"  WHERE `pid` = \"$model\"";
$update_old = mysqli_query($connection,$query_update);
//Error Checking
if(!$update_old){ echo "Error in occurred while updating old model "."</br>";}

    
}else{
    
    
//No Existing Model found for $model  
//Running New model Insert Query    
echo $query_insert = "INSERT INTO stock (`pid`,`author`,`no_of_length`,`size`,`rate_in_feet`,`rate_of_length`,`width`,`instockp`,`wastage`,`datetime`) 
VALUES (\"$model\",\"$author\",\"$no_length\",\"$size\" ,\"$rate_feet\",\"$rate_length\",\"$width\",\"$instockp\",\"$wastage\",\"$datetime\")";
//Error Checking  
$new_insertion = mysqli_query($connection,$query_insert);
if(!$new_insertion){ echo "Error in query while inserting new model </br>";}
  


    
}
//Closing Open Mysql connections and redirecting
mysqli_close($connection);
$_SESSION['alert_type'] = 'success';$_SESSION['alert_title'] = 'Model Updated Successfully !';$_SESSION['alert_msg'] = ' ';
header("Location: ../reporting_stock.php");


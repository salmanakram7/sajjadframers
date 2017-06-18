<?php
session_start();
include('../system/connection.php');
$username  = strtolower( $_POST['username'] );
$password  = $_POST['password'];

//Checking for credentials
$query_auth   = "SELECT * FROM users WHERE username = \"$username\" && password = \"$password\"";
$result_auth  = mysqli_query($connection,$query_auth);
$now          = mysqli_num_rows($result_auth);
$details      = mysqli_fetch_assoc($result_auth);

if($now > 0){

   $_SESSION['username'] = $username;
   $_SESSION['user_id'] = $details['id'];

   header("Location: ../dashboard.php");
    
}else{

   $_SESSION['auth_err'] = 'Incorrect Username / Password';
   header("Location: ../index.php");
    
}

?>
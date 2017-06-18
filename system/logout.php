<?php
session_start();

if(isset($_SESSION['username'])){
    
    unset($_SESSION['username']);
    header("Location: ../index.php");
    $_SESSION['auth_err'] = "Have a Nice Day ... ";
}



?>
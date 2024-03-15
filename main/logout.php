<?php
    session_start();
    if($_SESSION['email']){
        unset($_SESSION['email']);
    }
    
    header('Location:customer_login.php');
    
?>


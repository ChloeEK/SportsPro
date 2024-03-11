<?php
    session_start();
    include('admin_db.php');
    include('database.php');
?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="main.ccs"/>
    </head>
    <body>
        <h1>Admin Login</h1>
        <form action="admin_menu.php" method="post">
            <label>Username: </label>
            <input type='text' name='username'>
            <label>Password: </label>
            <input type="text" name="password">
            <input type='submit' value='Login' name='login'>
        </form>
        
       
    </body>
    
            
</html>

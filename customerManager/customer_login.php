<?php  
    session_start();    
    include('database.php');
    session_start();
    if (isset($_SESSION['email'])){
        header('Location:register_product.php');
    }
    
    
?>
<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Customer Login</title>
        <link rel="stylesheet" href="main.ccs"/>
    </head>
    <body>
        <h1>Customer Login</h1>
        <h5>You must login before you can register a product.</h5>
        <form action="register_product.php" method="post">
            <label>Email:</label>
            <input type='text' name='email'>
            <input type='submit' value='Login' name='login'>
        </form>
       
    </body>
    
            
</html>

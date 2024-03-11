<?php  
    session_start();    
    include('database.php');
    session_start();
    if (isset($_SESSION['email'])){
        header('Location:select_incident_update.php');
    }
    
    
?>
<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Technician Login</title>
        <link rel="stylesheet" href="main.ccs"/>
    </head>
    <body>
        <h1>Technician Login</h1>
        <h5>You must login before you can update an incident.</h5>
        <form action="select_incident_update.php" method="post">
            <label>Email:</label>
            <input type='text' name='email'>
            <input type='submit' value='Login' name='login'>
        </form>
       
    </body>
    
            
</html>


<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Get Customer</title>
        <<link rel="stylesheet" href="main.ccs"/>
    </head>
    <body>
        <h1>Get Customer</h1>
        <h5>You must enter the customer's email address to select the customer.</h5>
        
        <form action='create_incident.php' method='post'>
            <label>Email:</label>
            <input type='text' name='email'>
            <input type='submit' value='Get Customer'>
        </form>
        
    </body>
    
            
</html>


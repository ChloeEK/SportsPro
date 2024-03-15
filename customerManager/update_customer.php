<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Update Customer</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>Update Customer</h1>
        <?php
            $cid = filter_input(INPUT_POST, 'customerID');
            try {
                include ('database.php');
                $customerQuery = "SELECT * FROM customers WHERE customerID ='".$cid."'";
                $statements = $db->prepare($customerQuery);
                $statements->execute();
                $names = $statements->fetchAll();
                $statements->closeCursor();
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
            
            foreach ($names as $name) {
                echo "<form action='update_customer.php' method='post'>";
                echo "<label>First Name:</label>";
                echo "<input type='text' name='firstName' value='".$name['firstName']."'>";
                echo "</br>";
                echo "<label>Last Name:</label>";
                echo "<input type='text' value='".$name['lastName']."'>";
                echo "</br>";
                echo "<label>Address:</label>";
                echo "<input type='text' value='".$name['address']."'>";
                echo "</br>";
                echo "<label>City:</label>";
                echo "<input type='text' value='".$name['city']."'>";
                echo "</br>";
                echo "<label>State:</label>";
                echo "<input type='text' value='".$name['state']."'>";
                echo "</br>";
                echo "<label>Postal Code:</label>";
                echo "<input type='text' value='".$name['postalCode']."'>";
                echo "</br>";
                echo "<label>Country:</label>";
                echo "<input type='text' value='".$name['countryCode']."'>";
                echo "</br>";
                echo "<label>Phone:</label>";
                echo "<input type='text' value='".$name['phone']."'>";
                echo "</br>";
                echo "<label>Email:</label>";
                echo "<input type='text' value='".$name['email']."'>";
                echo "</br>";
                echo "<label>Password:</label>";
                echo "<input type='text' value='".$name['password']."'>";
                echo "</br>";
                echo "<label>&nbsp;</label>";
                echo "<input type='submit' value='Update Customer'>";
                echo "</form>";
            }
        ?>
        
        <?php
            $firstName = filter_input(INPUT_POST, 'firstName');
            try {
                include ('database.php');
                $updateQuery = "UPDATE customers SET firstName='".$firstName."' WHERE customerID='".$cid."'";
                $statement = $db->prepare($updateQuery);
                $statement->execute();
                $success = $statement->fetchAll();
                $statement->closeCursor();
                
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
        ?>
        
       
        
    </body>
</html>

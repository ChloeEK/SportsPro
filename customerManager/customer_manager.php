<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Customer Search</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
            <h1>Customer Search</h1>
            <label>Last Name</label>
            <form action="customer_manager.php" method="post">
                <input type="text" name="lastName"
                       value="<?php echo htmlspecialchars($lastName) ?>">
                <br>
                
                <label>&nbsp;</label>
                <input type="submit" value="Search">
                <br>
            </form>
            
            <table>
            <?php
                $lastName = filter_input(INPUT_POST, 'lastName');
                try {
                    include ('database.php');
                    $searchQuery = "SELECT * FROM customers WHERE lastName= '".$lastName."'";
                    $statements = $db->prepare($searchQuery);
                    $statements->execute();
                    $names = $statements->fetchAll();
                    $statements->closeCursor();
                } catch (PDOException $e){
                    $error_message = $e->getMessage();
                    include('database_error.php');
                    exit();
                }
                
                
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Email Address</th>";
                echo "<th>City</th>";
                echo "</tr>";
                
                foreach($names as $name) {
                    echo "<tr>";
                    echo "<form action='update_customer.php' method='post'><input type='hidden' name='customerID' value='".$name['customerID']."'>";
                    echo "<td>".$name['firstName']." ".$name['lastName']."</td><td>".$name['email']."</td><td>".$name['city']."</td><td><button type='submit' name='btnSelect'>Select</button></td>";
                    echo "</form>";
                    echo "</tr>";
                    
                }
            ?>
             
            </table>
           
        
        <a href="add_customer.php">Add Customer</a>
    </body>
</html>

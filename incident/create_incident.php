<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Create Incident</title>
        <link rel="stylesheet" href="main.css"/>
    </head>
    <body>
        <h1>Create Incident</h1>
        <?php
            $customerEmail = filter_input(INPUT_POST, 'email');
            try {
                include('database.php');
                $customerQuery = "SELECT * FROM customers WHERE email ='".$customerEmail."'";
                $statements = $db->prepare($customerQuery);
                $statements->execute();
                $names = $statements->fetchAll();
                $statements->closeCursor();
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
            
            echo "<form action='incident_created.php' method='post'>";
            foreach ($names as $name) {
                echo "Customer: ".$name['firstName']." ".$name['lastName']."";
                echo "</br>";
                echo "Product: ";
                echo "<input type='hidden' name='code' value='".$name['customerID']."'>";
                
            }
          
            
            try {
               include('database.php');
                $productsQuery = "SELECT name FROM products";
                $statement = $db->prepare($productsQuery);
                $statement->execute();
                $products = $statement->fetchAll();
                $statement->closeCursor();
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
           
                echo "<select name='name' value=''>Product:</option> ";
                foreach($products as $product) {
                    echo "<option value='".$product['name']."' name='product'>".$product['name']."</option>"; 
                }

                
                echo "<input type='hidden' name='idk'>";
                echo "</br>";
                echo "<label>Title:</label>";
                echo "<input type='text' name='title'>";
                echo "</br>";
                echo "<label>Description:</label>";
                echo "<input type='text' name='description'>";
                echo "</br>";
                echo "<input type='submit' value='Create Incident'>";
            echo "</form>";
            
        ?>
        
    </body>
</html>

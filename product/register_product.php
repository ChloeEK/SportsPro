<?php
    session_start();
    if (!isset($_SESSION['email'])){
        $customerEmail = filter_input(INPUT_POST, 'email');
        $_SESSION['email'] = $customerEmail;
    }
?>
<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Register Product</title>
        <link rel="stylesheet" href="main.css"/>
    </head>
    <body>
        <h1>Register Product</h1>
        <?php
            include('database.php');
            
            try {
                $customerQuery = "SELECT * FROM customers WHERE email ='".$_SESSION['email']."'";
                $statements = $db->prepare($customerQuery);
                $statements->execute();
                $names = $statements->fetchAll();
                $statements->closeCursor();
            } catch (PDOException $e){
               $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }   
            
            
        
            
            echo "<form action='product_registered.php' method='post'>";
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

                echo "</br>";
                echo "<input type='submit' value='Register Product'>";
                echo "</br>";
                echo "You are logged in as ". $_SESSION['email'];
                echo"</br>";
                echo "<a href='logout.php'>Logout</a>";
            echo "</form>";
            
        ?>
        
    </body>
</html>

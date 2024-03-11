<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Product Registered</title>
        <link rel="stylesheet" href="main.css"/>
    </head>
    <body>
        <h1>Register Product</h1>
        <?php
            $product = filter_input(INPUT_POST, 'name');
            $code = filter_input(INPUT_POST, 'code');
            $curdate = date("Y-m-d");
            
            try {
               include('database.php');
                $productsQuery = "SELECT * FROM products WHERE name='".$product."'";
                $statement = $db->prepare($productsQuery);
                $statement->execute();
                $products = $statement->fetchAll();
                $statement->closeCursor();
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
            
            foreach ($products as $product) {
                $productCode = $product['productCode'];
            }
            
            try {
               include('database.php');
                $insert = "INSERT INTO registrations (customerID, productCode, registrationDate) VALUES ('$code','$productCode', '$curdate')";
                $statements = $db->prepare($insert);
                $statements->execute();
                $success = $statements->fetchAll();
                $statements->closeCursor();
                echo "Product (".$productCode.") was registered successfully.";
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
            
            
        ?>
    </body>
</html>


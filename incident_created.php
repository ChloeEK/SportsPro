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
            $product = filter_input(INPUT_POST, 'name');
            $code = filter_input(INPUT_POST, 'code');
            $curdate = date("Y-m-d");
            $title = filter_input(INPUT_POST, 'title');
            $description = filter_input(INPUT_POST, 'description');
            
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
                $insert = "INSERT INTO incidents (customerID, productCode, dateOpened, title, description) VALUES ('$code', '$productCode', '$curdate', '$title', '$description')";
                $statements = $db->prepare($insert);
                $statements->execute();
                $success = $statements->fetchAll();
                $statements->closeCursor();
                echo "This incident was added to our database";
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
            
            
        ?>
    </body>
</html>

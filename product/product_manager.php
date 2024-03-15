<?php
    require_once ('database.php');
    
    try {
        $query = 'SELECT * FROM products';
        $statement =$db->prepare($query);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
    }catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }

?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Product Manager</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
            <h1>Product List</h1>
            <table>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Version</th>
                    <th>Release Date</th>
                </tr>
               <?php
                    foreach($products as $product) {
                    echo "<tr>";
                    echo "<form action='product_manager.php' method='post'><input type='hidden' name='pid' value='".$product['productCode']."'>";
                    echo "<td>".$product['productCode']."</td><td>".$product['name']."</td><td>".$product['version']."</td><td>".$product['releaseDate']."</td><td><button type='submit' name='btnDelete'>Delete</button></td>";
                    echo "</form>";
                    echo "</tr>";
                    
                    }
                ?>


            </table>
            
            <?php
                $delete = filter_input(INPUT_POST, 'btnDelete');
                
                if(isset($delete)) {
                    $pid = filter_input(INPUT_POST, 'pid');
                    try {
                        include('database.php');
                        $deleteQuery = "DELETE FROM products WHERE productCode ='".$pid."'";
                        $statement = $db->prepare($deleteQuery);
                        $statement->execute();
                        $products = $statement->fetchAll();
                        $statement->closeCursor();
                        header("Refresh:0");
                        
                    }catch (PDOException $e){
                        $error_message = $e->getMessage();
                        include('database_error.php');
                        exit();      
                    }
                }
                
            ?>
        
        <a href="add_product.php">Add Product</a>
    </body>
</html>


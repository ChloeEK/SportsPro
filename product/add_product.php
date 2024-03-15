lol<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Add Product</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>Add Product</h1>
        <br>
        <form action="add_product.php" method="post">
            <label>Code:</label>
            <input type="text" name="code" value="<?php echo htmlspecialchars($code); ?>">
            <br>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <br>

            <label>Version:</label>
            <input type="text" name="version" value="<?php echo htmlspecialchars($version); ?>">
            <br>

            <label>Release Date:</label>
            <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add Product">
            <br>
        </form>
        
        <?php
            $code = filter_input(INPUT_POST, 'code');
            $name = filter_input(INPUT_POST, 'name');
            $version = filter_input(INPUT_POST, 'version');
            $date = filter_input(INPUT_POST, 'date');
            
            if (isset($code) && isset($name) && isset($version) && isset($date)) {
                try {
                    include('database.php');
                    $addQuery = "INSERT INTO products (productCode, name, version, releaseDate) VALUES ('$code', '$name', '$version', '$date')";
                    $statement = $db->prepare($addQuery);
                    $statement->execute();
                    $success = $statement->fetchAll();
                    $statement->closeCursor();
                    header("Location:http://localhost/sportsPro/product_manager.php");
                }catch (PDOException $e) {
                    $error_message = $e->getMessage();
                    include('database_error.php');
                    exit();
                }
            } 
              
        ?>
        
        <a href="product_manager.php">View Product List</a>
        
    </body>
        
</html>

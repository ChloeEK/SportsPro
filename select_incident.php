<?php
    require_once ('database.php');
    
    try {
        $query = 'SELECT customers.firstName, customers.lastName, incidents.incidentID, incidents.productCode, incidents.dateOpened, incidents.title, incidents.description FROM incidents INNER JOIN customers ON incidents.customerID=customers.customerID WHERE techID IS NULL';
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
        <title>Select Incident</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
            <h1>Select Incident</h1>
            <table>
                <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Date Opened</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
               <?php
                    foreach($products as $product) {
                    echo "<tr>";
                    echo "<form action='select_technician.php' method='post'><input type='hidden' name='incidentId' value='".$product['incidentID']."'>"
                            . "<input type='hidden' name='customerName' value='".$product['firstName']." ".$product['lastName']."'>"
                            . "<input type='hidden' name='product' value='".$product['productCode']."'>";
                    echo "<td>".$product['firstName']." ".$product['lastName']."</td><td>".$product['productCode']."</td><td>".$product['dateOpened']."</td><td>".$product['tite']."</td><td>".$product['description']."</td><td><button type='submit' name='btnSelect'>Select</button></td>";
                    echo "</form>";
                    echo "</tr>";
                    
                    }
                ?>
            </table>
            

        
    </body>
</html>



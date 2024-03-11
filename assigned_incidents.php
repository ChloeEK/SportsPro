<?php
    require_once ('database.php');
    
    try {
        $query = "SELECT customers.firstName, customers.lastName, products.name, incidents.incidentID, incidents.dateOpened, incidents.title, incidents.description, incidents.techID FROM incidents INNER JOIN customers ON customers.customerID=incidents.customerID INNER JOIN products ON products.productCode=incidents.productCode WHERE techID IS NOT NULL";
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
        <title>Unassigned Incidents</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
            <h1>Unassigned Incidents</h1>
            <a href="assigned_incidents.php">View Assigned Incidents</a>
            <table>
                <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Technician</th>
                    <th>Incident</th>
                </tr>
               <?php
                    foreach($products as $product) {
                    echo "<tr>";
                    echo "<td>".$product['firstName']." ".$product['lastName']."</td><td>".$product['name']."</td><td>".$product['techID']."</td><td>ID:".$product['incidentID']."</br> Opened: ".$product['dateOpened']."</br> Title: ".['title']."</br> Description: ".$product['description']."</td>";
                    echo "</tr>";
                    
                    }
                ?>


            </table>

    </body>
</html>


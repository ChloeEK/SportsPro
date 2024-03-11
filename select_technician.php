<?php
    session_start();
    $select = filter_input(INPUT_POST, 'btnSelect');
    if (isset($select)){
        $customer = filter_input(INPUT_POST, 'customerName');
        $incidentID = filter_input(INPUT_POST, 'incidentId');
        $product = filter_input(INPUT_POST, 'product');
        $_SESSION['incidentID'] = $incidentID;
        $_SESSION['customerName'] = $customer;
        $_SESSION['product'] = $product;
    }
?>

<?php
    require_once ('database.php');
    
    try {
        $query = 'SELECT technicians.firstName, technicians.lastName, technicians.techID, COUNT(incidents.techID) FROM technicians LEFT JOIN incidents ON incidents.techID=technicians.techID GROUP BY technicians.firstName';
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
                    <th>Name</th>
                    <th>Open Incidents</th>
                </tr>
               <?php
                    foreach($products as $product) {
                    echo "<tr>";
                    echo "<form action='assign_incident.php' method='post'><input type='hidden' name='techId' value='".$product['techID']."'>"
                            . "<input type='hidden' name='techName' value='".$product['firstName']." ".$product['lastName']."'>";
                    echo "<td>".$product['firstName']." ".$product['lastName']."</td><td>".$product['COUNT(incidents.techID)']."</td><td><button type='submit' name='btnSelect'>Select</button></td>";
                    echo "</form>";
                    echo "</tr>";
                    
                    }
                ?>
            </table>
            

        
    </body>
</html>


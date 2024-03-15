<?php
    session_start();
    $techEmail = filter_input(INPUT_POST, 'email');
    $_SESSION['techEmail'] = $techEmail;
?>

        <?php
            require_once ('database.php');
    
            try {
                $query = "SELECT customers.firstName, customers.lastName, incidents.incidentID, incidents.productCode, incidents.dateOpened, incidents.title, incidents.description FROM incidents INNER JOIN customers ON customers.customerID=incidents.customerID INNER JOIN technicians ON technicians.techID=incidents.techID WHERE technicians.email='".$techEmail."'";
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
                    echo "<form action='update_incident.php' method='post'><input type='hidden' name='incidentID' value='".$product['incidentID']."'>";
                    echo "<td>".$product['firstName']." ".$product['lastName']."</td><td>".$product['productCode']."</td><td>".$product['dateOpened']."</td><td>".$product['title']."</td><td>".$product['description']."</td><td><button type='submit' name='btnSelect'>Select</button></td>";
                    echo "</form>";
                    echo "</tr>";
                    
                    }
                ?>
            </table>
            
            
            <h5>You are logged in as <?php echo $_SESSION['techEmail']; ?></h5>
            <a href="technician_logout.php">Logout</a>

        
    </body>
</html>


        
       

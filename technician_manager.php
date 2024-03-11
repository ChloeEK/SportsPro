<?php
    require_once ('database.php');
    try {
        $query = 'SELECT * FROM technicians';
        $statement =$db->prepare($query);
        $statement->execute();
        $technicians = $statement->fetchAll();
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
            <h1>Technician List</h1>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password</th>
                </tr>
               <?php
                    foreach($technicians as $technician) {
                    echo "<tr>";
                    echo "<form action='technician_manager.php' method='post'><input type='hidden' name='id' value='".$technician['techID']."'>";
                    echo "<td>".$technician['firstName']."</td><td>".$technician['lastName']."</td><td>".$technician['email']."</td><td>".$technician['phone']."</td><td>".$technician['password']."</td><td><button type='submit' name='btnDelete'>Delete</button></td>";
                    echo "</form>";
                    echo "</tr>";
                    
                    }
                ?>


            </table>
            
            <?php
                $delete = filter_input(INPUT_POST, 'btnDelete');
                
                if(isset($delete)) {
                    $id = filter_input(INPUT_POST, 'id');
                    try {
                        include('database.php');
                        $deleteQuery = "DELETE FROM technicians WHERE techID ='".$id."'";
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
        
        <a href="add_technician.php">Add Technician</a>
    </body>
</html>


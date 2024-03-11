<?php
    session_start();
    $select = filter_input(INPUT_POST, 'btnSelect');
    if (isset($select)) {
        $incidentID = filter_input(INPUT_POST, 'incidentID');
        $_SESSION['incidentID'] = $incidentID;
    }
?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Update Incident</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>Update Incident</h1>
        <?php
            try {
                include ('database.php');
                $incidentQuery = "SELECT * FROM incidents WHERE incidentID ='".$incidentID."'";
                $statements = $db->prepare($incidentQuery);
                $statements->execute();
                $names = $statements->fetchAll();
                $statements->closeCursor();
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
            
            foreach ($names as $name) {
                echo "<form action='incident_updated.php' method='post'>";
                echo "<label>Incident ID: ".$name['incidentID']."</label>";
                echo "</br>";
                echo "<label>Product Code: ".$name['productCode']."</label>";
                echo "</br>";
                echo "<label>Date Opened: ".$name['dateOpened']."</label>";
                echo "</br>";
                echo "<label>Date Closed:</label>";
                echo "<input type='text' name='dateClosed'>";
                echo "</br>";
                echo "<label>Title: ".$name['title']."</label>";
                echo "</br>";
                echo "<label>Description:</label>";
                echo "<input type='text' name='description' value='".$name['description']."'>";
                echo "</br>";
                echo "<label>&nbsp;</label>";
                echo "<input type='submit' value='Update Incident'>";
                echo "</form>";
            }
            
            echo "You are logged in as ".$_SESSION['techEmail']."";
            echo "<a href='technician_logout.php'>Logout</a>";
        ?>
        

        
       
        
    </body>
</html>
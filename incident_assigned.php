<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Assign Incident</title>
        <link rel="stylesheet" href="main.css">
    </head>
<?php
    session_start();
    $assign = filter_input(INPUT_POST, 'assignBtn');
    if (isset($assign)) {
        try {
            include('database.php');
            $updateQuery = "UPDATE incidents SET techID=".$_SESSION['techId']." WHERE incidentID=".$_SESSION['incidentID']."";
            $statement = $db->prepare($updateQuery);
            $statement->execute();
            $success = $statement->fetchAll();
            $statement->closeCursor();
            
                    
            }catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
    }
    
    echo "<h3>Assign Incident</h3>";
    echo "<h5>This incident was assigned to a technician.</h5>";
    echo "<a href='select_incident.php'>Select Another Incident</a>";
?>

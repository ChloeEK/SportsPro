<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Update Incident</title>
        <link rel="stylesheet" href="main.css">
    </head>
<?php
    session_start();
    $description = filter_input(INPUT_POST, 'description');
    try {
        include('database.php');
        $updateQuery = "UPDATE incidents SET description='".$description."' WHERE incidentID=".$_SESSION['incidentID']."";
        $statement = $db->prepare($updateQuery);
        $statement->execute();
        $success = $statement->fetchAll();
        $statement->closeCursor();
    }catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
    
    
    echo "<h3>Update Incident</h3>";
    echo "<h5>This incident was updated.</h5>";
    echo "<a href='select_incident_update.php'>Select Another Incident</a>";
?>
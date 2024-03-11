<?php
    session_start();
    $select = filter_input(INPUT_POST, 'btnSelect');
    if (isset($select)){
        $techId = filter_input(INPUT_POST, 'techId');
        $techName = filter_input(INPUT_POST, 'techName');
        $_SESSION['techId'] = $techId;
        $_SESSION['techName'] = $techName;
    }
?>

<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Assign Incident</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>Assign Incident</h1>
        <?php
            echo "<form action='incident_assigned.php' method='post'>";
            echo "<label>Customer: </label>";
            echo $_SESSION['customerName'];
            echo "</br>";
            echo "<label>Product: </label>";
            echo $_SESSION['product'];
            echo "</br>";
            echo "<label>Technician: </label>";
            echo $_SESSION['techName'];
            echo "</br>";
            echo "<button type='submit' name='assignBtn'>Assign Incident</button>";
            echo "</form>";
        ?>
            
    </body>
</html>
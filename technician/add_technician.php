<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Add Technician</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>Add Technician</h1>
        <br>
        <form action="add_technician.php" method="post">
            <label>First Name:</label>
            <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
            <br>

            <label>Last Name:</label>
            <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
            <br>

            <label>Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <br>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <br>
            
            <label>Password:</label>
            <input type="text" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add Technician">
            <br>
        </form>
        
        <?php
            $firstName = filter_input(INPUT_POST, 'firstName');
            $lastName = filter_input(INPUT_POST, 'lastName');
            $email = filter_input(INPUT_POST, 'email');
            $phone = filter_input(INPUT_POST, 'phone');
            $password = filter_input(INPUT_POST, 'password');
            
            if (isset($firstName) && isset($lastName) && isset($email) && isset($phone) && isset($password)) {
                try {
                    include('database.php');
                    $addQuery = "INSERT INTO technicians (firstName, lastName, email, phone, password) VALUES ('$firstName', '$lastName', '$email', '$phone', '$password')";
                    $statement = $db->prepare($addQuery);
                    $statement->execute();
                    $success = $statement->fetchAll();
                    $statement->closeCursor();
                    header("Location:http://localhost/sportsPro/technician_manager.php");
                }catch (PDOException $e) {
                    $error_message = $e->getMessage();
                    include('database_error.php');
                    exit();
                }
            }
        ?>
        
        <a href="technician_manager.php">View Technician List</a>
        
    </body>
        
</html>


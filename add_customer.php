<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <head>
        <title>Add Customer</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>Add Customer</h1>
        <br>
        <form action="add_customer.php" method="post">
            <label>First Name:</label>
            <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
            <br>

            <label>Last Name:</label>
            <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
            <br>

            <label>Address:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
            <br>

            <label>City:</label>
            <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>">
            <br>
            
            <label>State:</label>
            <input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>">
            <br>
            
            <label>Postal Code:</label>
            <input type="text" name="postalCode" value="<?php echo htmlspecialchars($postalCode); ?>">
            <br>
            
            <label>Country:</label>
            <input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>">
            <br>
            
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <br>
            
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <br>
            
            <label>Password:</label>
            <input type="text" name="password" value="<?php echo htmlspecialchars($state); ?>">
            <br>
            <label>&nbsp;</label>
            <input type="submit" value="Add Customer">
        </form>
        
        <?php
            $firstName = filter_input(INPUT_POST, 'firstName');
            $lastName = filter_input(INPUT_POST, 'lastName');
            $address = filter_input(INPUT_POST, 'address');
            $city = filter_input(INPUT_POST, 'city');
            $state = filter_input(INPUT_POST, 'state');
            $postalCode = filter_input(INPUT_POST, 'postalCode');
            $country = filter_input(INPUT_POST, 'country');
            $phone = filter_input(INPUT_POST, 'phone');
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            
            if (isset($firstName) && isset($lastName) && isset($email) && isset($phone) && isset($password)) {
                try {
                    include('database.php');
                    $addQuery = "INSERT INTO customers (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password) VALUES ('$firstName', '$lastName', '$address', '$city', '$state', '$postalCode', '$country', '$phone', '$email', '$password')";
                    $statement = $db->prepare($addQuery);
                    $statement->execute();
                    $success = $statement->fetchAll();
                    $statement->closeCursor();
                    header("Location:http://localhost/sportsPro/customer_manager.php");
                }catch (PDOException $e) {
                    $error_message = $e->getMessage();
                    include('database_error.php');
                    exit();
                }
            }
        ?>
        
        <a href="customer_manager.php">Search Customer</a>
        
    </body>
        
</html>

<?php
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            echo $password;
            echo $username;
                    
            if (is_valid_admin_login($username, $password)) {
                echo 'yay';
            }else {
                echo 'nay';
            }
        ?>






<!--
<head>
    <link rel="stylesheet" href="main.css">
</head>
<main>
    <nav>
        
    <h2>Admin Menu</h2>
    <ul>
        <li><a href="product_manager.php">Manage Products</a></li>
        <li><a href="technician_manager.php">Manage Technicians</a></li>
        <li><a href="customer_manager.php">Manage Customers</a></li>
        <li><a href="get_customer.php">Create Incident</a></li>
        <li><a href="assign_incident.php">Assign Incident</a></li>
        <li><a href="display_incidents.php">Display Incident</a></li>
    </ul>
    </nav>
</section>-->

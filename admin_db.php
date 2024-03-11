<?php
    include ('database.php');
    function is_valid_admin_login($username, $password) {
        include ('database.php');
        $query = "SELECT username FROM administrators WHERE username='".$username."' AND password='".$password."'";
        $statements = $db->prepare($query);
        $statements->execute();
        $valid = ($statements->rowCount() ==1);
        $statements->closeCursor();
        return $valid;
        
       
    }
?>
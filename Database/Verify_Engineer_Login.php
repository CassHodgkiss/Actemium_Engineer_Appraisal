<?php

    //Returns TRUE when the username and password match one in the database, else FALSE
    function ValidateEngineerLogin()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineers WHERE engineer_username = :username AND password = :password";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_POST["username"], SQLITE3_TEXT);
        $stmt->bindValue(':password', $_POST["password"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        if($result != NULL)
        {
            return TRUE;
        }

        else 
        {
            return FALSE;
        }
    }

?>
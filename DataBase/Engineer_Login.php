<?php

    function ValidateEngineerLogin(){

        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineers WHERE engineer_username = :username AND password = :password";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_POST["username"], SQLITE3_TEXT);
        $stmt->bindValue(':password', $_POST["password"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();

        print_r($result);
            
        if($result != NULL){
            return TRUE;
        }
        else {
            return FALSE;
        }

    }

?>
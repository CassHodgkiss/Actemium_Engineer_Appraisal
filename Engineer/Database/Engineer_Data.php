<?php

    //Returns Engineer Data
    function GetEngineerData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineers WHERE engineer_username = :username";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_SESSION["Username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        return $result;
    }

?>
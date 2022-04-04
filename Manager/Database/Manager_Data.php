<?php

    //Returns Manager Data
    function GetManagerData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Managers WHERE manager_username = :username";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_SESSION["Username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        return $result;
    }

?>
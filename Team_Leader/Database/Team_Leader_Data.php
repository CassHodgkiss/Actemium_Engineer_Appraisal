<?php

    //Returns Team_Leader Data
    function GetTeamLeaderData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leaders WHERE team_leader_username = :username";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_SESSION["Username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        return $result;
    }

?>
<?php 

    function GetTeamMembers()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineers
        WHERE team_leader_username = :team_leader_username";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':team_leader_username', $_SESSION["Username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {        
            $results[]=$row;

        }

        return $results;
    }

?>
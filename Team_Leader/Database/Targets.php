<?php 

    function GetTargets()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Targets t
        INNER JOIN Engineers e
        WHERE e.team_leader_username = :team_leader_username";

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
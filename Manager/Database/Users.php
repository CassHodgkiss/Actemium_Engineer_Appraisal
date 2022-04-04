<?php 

    function GetEngineers()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineers";

        $stmt = $db->prepare($sql);
    
        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {        
            $results[]=$row;

        }

        return $results;
    }

    function GetTeamLeaders()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leaders";

        $stmt = $db->prepare($sql);
    
        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {        
            $results[]=$row;

        }

        return $results;
    }

?>
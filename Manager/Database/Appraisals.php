<?php

    function GetEngineerAppraisalsData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineer_Appraisals ea
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id  
        GROUP BY a.appraisal_id";

        $stmt = $db->prepare($sql);
    
        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {        
            $results[]=$row;

        }

        return $results;
    }

    function GetTeamLeaderAppraisalsData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leader_Appraisals tla
        INNER JOIN Appraisals a ON a.appraisal_id = tla.appraisal_id  
        GROUP BY a.appraisal_id";

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
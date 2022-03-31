<?php

    //Returns Required Data for the Appraisal Questions Page
    function GetAppraisalsData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leader_Appraisals ea
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id  
        WHERE ea.team_leader_username = :team_leader_username";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':team_leader_username', $_SESSION["Username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        date_default_timezone_set("Europe/London");
        $current_date = new DateTime("now");

        $results = [];
        while ($row=$result->fetchArray())
        {
            $start_date = new DateTime($row["date_start"]);

            if($start_date < $current_date){            
                $results[]=$row;
            }

        }

        return $results;

    }

    function GetAppraisalsAnswersData($team_leader_appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leader_Appraisals ea 
        INNER JOIN Team_Leaders_Appraisal_Answers eaa ON ea.team_leader_appraisal_id = eaa.team_leader_appraisal_id 
        INNER JOIN Answers an ON an.answer_id = eaa.answer_id 
        WHERE ea.team_leader_username = :team_leader_username 
        AND ea.team_leader_appraisal_id = :team_leader_appraisal_id";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':team_leader_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':team_leader_appraisal_id', $team_leader_appraisal_id, SQLITE3_TEXT);
    
        $result = $stmt->execute();
            
        $results = [];
        while ($row=$result->fetchArray())
        {
            $results[] = $row;
        }
        
        return count($results);
    }

    function GetTeamAppraisalsData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT a.*, ea.*  FROM Engineer_Appraisals ea
        INNER JOIN Engineers e ON e.engineer_username = ea.engineer_username
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id  
        WHERE e.team_leader_username = :team_leader_username
        GROUP BY a.appraisal_id";

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
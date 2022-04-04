<?php

    function GetAppraisalData($appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT a.* FROM Team_Leader_Appraisals ea
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id
        WHERE ea.appraisal_id = :appraisal_id";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();
        
        return $result->fetchArray();
    }
    
    function GetTeamLeadersAppraisalAnswers($appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT e.team_leader_username, aq.question_num, ea.team_leader_appraisal_id FROM Team_Leader_Appraisals ea
        INNER JOIN Team_Leaders e ON e.team_leader_username = ea.team_leader_username
        INNER JOIN Team_Leaders_Appraisal_Answers eaa ON ea.team_leader_appraisal_id = eaa.team_leader_appraisal_id
        INNER JOIN Answers an ON an.answer_id = eaa.answer_id 
        INNER JOIN Questions q ON q.question_id = an.question_id 
        INNER JOIN Appraisals_Questions aq ON aq.question_id = q.question_id 
        AND ea.appraisal_id = :appraisal_id 
        AND ea.appraisal_id = aq.appraisal_id  
        ORDER BY aq.question_num";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {
            $results[] = $row;
        }

            
        return $results;
    }

    function GetTeamLeaderAppraisal($appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT team_leader_username, team_leader_appraisal_id FROM Team_Leader_Appraisals WHERE appraisal_id = :appraisal_id";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {
            $results[] = $row;
        }
        
        return $results;
    }

?>
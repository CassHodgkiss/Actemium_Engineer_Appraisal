<?php

    function GetAppraisalData($appraisal_id, $appraisal_question)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Appraisals a 
        INNER JOIN Appraisals_Questions aq ON a.appraisal_id = aq.appraisal_id 
        INNER JOIN Questions q ON aq.question_id = q.question_id 
        WHERE a.appraisal_id = :appraisal_id 
        AND aq.question_num = :appraisal_question";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':appraisal_id', $appraisal_id , SQLITE3_INTEGER);
        $stmt->bindValue(':appraisal_question', $appraisal_question, SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        return $result;
    }

    function GetEngineerAppraisalAnswerData($appraisal_id, $appraisal_question)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineers e
        INNER JOIN Engineer_Appraisals ea ON e.engineer_username = ea.engineer_username
        INNER JOIN Engineers_Appraisal_Answers eaa ON ea.engineer_appraisal_id = eaa.engineer_appraisal_id
        INNER JOIN Answers an ON eaa.answer_id = an.answer_id 
        INNER JOIN Questions q ON an.question_id = q.question_id 
        INNER JOIN Appraisals_Questions aq ON q.question_id = aq.question_id AND aq.appraisal_id = :appraisal_id
        WHERE ea.appraisal_id = :appraisal_id 
        AND aq.question_num = :appraisal_question";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);
        $stmt->bindValue(':appraisal_question', $appraisal_question, SQLITE3_INTEGER);
    
        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {     
            $results[] = $row;
        }
            
        return $results;
    }
 
    function GetTeamLeaderAppraisalAnswerData($appraisal_id, $appraisal_question)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leaders e
        INNER JOIN Team_Leader_Appraisals ea ON e.team_leader_username = ea.team_leader_username
        INNER JOIN Team_Leaders_Appraisal_Answers eaa ON ea.team_leader_appraisal_id = eaa.team_leader_appraisal_id
        INNER JOIN Answers an ON eaa.answer_id = an.answer_id 
        INNER JOIN Questions q ON an.question_id = q.question_id 
        INNER JOIN Appraisals_Questions aq ON q.question_id = aq.question_id AND aq.appraisal_id = :appraisal_id
        WHERE ea.appraisal_id = :appraisal_id 
        AND aq.question_num = :appraisal_question";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);
        $stmt->bindValue(':appraisal_question', $appraisal_question, SQLITE3_INTEGER);
    
        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {     
            $results[] = $row;
        }
            
        return $results;
    }
?>
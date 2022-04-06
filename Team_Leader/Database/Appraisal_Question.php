<?php

    function GetAppraisalData($team_leader_appraisal_id, $appraisal_question)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leader_Appraisals ea
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id
        INNER JOIN Appraisals_Questions aq ON a.appraisal_id = aq.appraisal_id
        INNER JOIN Questions q ON aq.question_id = q.question_id
        WHERE ea.team_leader_appraisal_id = :team_leader_appraisal_id
        AND aq.question_num = :appraisal_question
        AND ea.team_leader_username = :team_leader_username";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':team_leader_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':team_leader_appraisal_id', $team_leader_appraisal_id , SQLITE3_INTEGER);
        $stmt->bindValue(':appraisal_question', $appraisal_question, SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();

        date_default_timezone_set("Europe/London");
        $current_date = new DateTime("now");

        $start_date = new DateTime($result["date_start"]); 

        if($start_date < $current_date){ 
            return $result;
        }

        return NULL;

    }

    function GetAppraisalAnswerData($team_leader_appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leader_Appraisals ea 
        INNER JOIN Team_Leaders_Appraisal_Answers eaa ON ea.team_leader_appraisal_id = eaa.team_leader_appraisal_id
        INNER JOIN Answers an ON an.answer_id = eaa.answer_id 
        INNER JOIN Questions q ON q.question_id = an.question_id 
        INNER JOIN Appraisals_Questions aq ON aq.question_id = q.question_id 
        WHERE ea.team_leader_username = :team_leader_username 
        AND ea.team_leader_appraisal_id = :team_leader_appraisal_id 
        AND ea.appraisal_id = aq.appraisal_id  
        ORDER BY aq.question_num";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':team_leader_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':team_leader_appraisal_id', $team_leader_appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {     
            $results[] = $row;
        }
            
        return $results;
    }

?>
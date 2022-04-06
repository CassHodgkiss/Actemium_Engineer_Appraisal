<?php

    function GetAppraisalData($engineer_appraisal_id, $appraisal_question)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineer_Appraisals ea
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id
        INNER JOIN Appraisals_Questions aq ON a.appraisal_id = aq.appraisal_id
        INNER JOIN Questions q ON aq.question_id = q.question_id
        WHERE ea.engineer_appraisal_id = :engineer_appraisal_id
        AND aq.question_num = :appraisal_question
        AND ea.engineer_username = :engineer_username";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':engineer_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':engineer_appraisal_id', $engineer_appraisal_id , SQLITE3_INTEGER);
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

    function GetAppraisalAnswerData($engineer_appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineer_Appraisals ea 
        INNER JOIN Engineers_Appraisal_Answers eaa ON ea.engineer_appraisal_id = eaa.engineer_appraisal_id
        INNER JOIN Answers an ON an.answer_id = eaa.answer_id 
        INNER JOIN Questions q ON q.question_id = an.question_id 
        INNER JOIN Appraisals_Questions aq ON aq.question_id = q.question_id 
        WHERE ea.engineer_username = :engineer_username 
        AND ea.engineer_appraisal_id = :engineer_appraisal_id 
        AND ea.appraisal_id = aq.appraisal_id  
        ORDER BY aq.question_num";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':engineer_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':engineer_appraisal_id', $engineer_appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {     
            $results[] = $row;
        }
            
        return $results;
    }

?>
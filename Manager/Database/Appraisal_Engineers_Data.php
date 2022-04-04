<?php

    function GetEngineerAppraisalData($appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT a.* FROM Engineer_Appraisals ea
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id
        WHERE ea.appraisal_id = :appraisal_id";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();
        
        return $result->fetchArray();
    }
    
    function GetEngineersAppraisalAnswers($appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT e.engineer_username, aq.question_num, ea.engineer_appraisal_id FROM Engineer_Appraisals ea
        INNER JOIN Engineers e ON e.engineer_username = ea.engineer_username
        INNER JOIN Engineers_Appraisal_Answers eaa ON ea.engineer_appraisal_id = eaa.engineer_appraisal_id
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

    function GetEngineerAppraisal($appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT engineer_username, engineer_appraisal_id FROM Engineer_Appraisals WHERE appraisal_id = :appraisal_id";

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
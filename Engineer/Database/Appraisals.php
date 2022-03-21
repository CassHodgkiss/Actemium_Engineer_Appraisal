<?php

    //Returns Required Data for the Appraisal Questions Page
    function GetAppraisalsData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineer_Appraisals ea
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id  
        AND ea.engineer_username = :engineer_username";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':engineer_username', $_SESSION["Username"], SQLITE3_TEXT);
    
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

    function GetAppraisalsAnswersData($engineer_appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineer_Appraisals ea 
        INNER JOIN Engineers_Appraisal_Answers eaa ON ea.engineer_appraisal_id = eaa.engineer_appraisal_id 
        INNER JOIN Answers an ON an.answer_id = eaa.answer_id 
        WHERE ea.engineer_username = :engineer_username 
        AND ea.engineer_appraisal_id = :engineer_appraisal_id";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':engineer_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':engineer_appraisal_id', $engineer_appraisal_id, SQLITE3_TEXT);
    
        $result = $stmt->execute();
            
        $results = [];
        while ($row=$result->fetchArray())
        {
            $results[] = $row;
        }
        
        return count($results);
    }

?>
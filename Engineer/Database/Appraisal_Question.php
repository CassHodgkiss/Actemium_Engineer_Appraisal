<?php

    //Returns Required Data for the Appraisal Questions Page
    function GetAppraisalData($engineer_appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineer_Appraisals ea 
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id
        WHERE ea.engineer_appraisal_id = :engineer_appraisal_id 
        AND ea.engineer_username = :engineer_username";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':engineer_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':engineer_appraisal_id', $engineer_appraisal_id , SQLITE3_INTEGER);
    
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

    //Returns Required Data for the Appraisal Questions Page
    function GetAppraisalQuestionData($engineer_appraisal_id , $appraisal_question)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineer_Appraisals ea  
        INNER JOIN Appraisals a ON a.appraisal_id = ea.appraisal_id
        INNER JOIN Appraisals_Questions aq ON a.appraisal_id = aq.appraisal_id 
        INNER JOIN Questions q ON aq.question_id = q.question_id 
        WHERE ea.engineer_appraisal_id = :engineer_appraisal_id 
        AND aq.question_num = :appraisal_question 
        AND ea.engineer_username = :engineer_username 
        ORDER BY aq.question_num";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':engineer_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':engineer_appraisal_id', $engineer_appraisal_id , SQLITE3_INTEGER);
        $stmt->bindValue(':appraisal_question', $appraisal_question, SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();

        $question_type = $result["question_type"];

        switch($question_type)
        {
            case "Writen":

                $sql = "SELECT * FROM Writen WHERE question_id = :question_id";

                break;
                
            case "Slider":

                $sql = "SELECT * FROM Slider WHERE question_id = :question_id";

                break;
                
            case "Multi-Choice":

                $sql = "SELECT * FROM Multi_Choice WHERE question_id = :question_id";

                break;
                
            case "Multi-Writen":

                $sql = "SELECT * FROM Multi_Writen WHERE question_id = :question_id";

                break;

        }

        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':question_id', $result["question_id"], SQLITE3_INTEGER);
    
        $result2 = $stmt->execute();
        
        $result2 = $result2->fetchArray();

        $results = array_merge($result, $result2);
            
        return $results;
    }

    //Returns Answer Data for the Appraisal Questions Page
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
            $answer_id = $row["answer_id"];
            $question_type = $row["question_type"];

            switch($question_type)
            {
                case "Writen":

                    $sql = "SELECT * FROM Writen_Answers WHERE answer_id = :answer_id";

                    break;

                case "Slider":

                    $sql = "SELECT * FROM Slider_Answers WHERE answer_id = :answer_id";

                    break;

                case "Multi-Choice":

                    $sql = "SELECT * FROM Multi_Choice_Answers WHERE answer_id = :answer_id";
                    
                    break;

                case "Multi-Writen":

                    $sql = "SELECT * FROM Multi_Writen_Answers WHERE answer_id = :answer_id";

                    break;

            }

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);

            $result2 = $stmt->execute();
            
            $result2 = $result2->fetchArray();

            $results[$row["question_num"]]=array_merge($row, $result2);

        }
            
        return $results;
    }

?>
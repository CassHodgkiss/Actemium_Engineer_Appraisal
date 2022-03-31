<?php

    //Returns Required Data for the Appraisal Questions Page
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
        }

        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':question_id', $result["question_id"], SQLITE3_INTEGER);
    
        $result2 = $stmt->execute();
        
        $result2 = $result2->fetchArray();

        $results = array_merge($result, $result2);
            
        return $results;
    }

    //Returns Answer Data for the Appraisal Questions Page
    function GetAppraisalAnswerData($appraisal_id, $appraisal_question)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Engineers e
        INNER JOIN Engineer_Appraisals ea ON e.engineer_username = ea.engineer_username
        INNER JOIN Engineers_Appraisal_Answers eaa ON ea.engineer_appraisal_id = eaa.engineer_appraisal_id
        INNER JOIN Answers an ON eaa.answer_id = an.answer_id 
        INNER JOIN Questions q ON an.question_id = q.question_id 
        INNER JOIN Appraisals_Questions aq ON q.question_id = aq.question_id AND aq.appraisal_id = :appraisal_id
        WHERE ea.appraisal_id = :appraisal_id 
        AND e.team_leader_username = :team_leader_username  
        AND aq.question_num = :appraisal_question";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':team_leader_username', $_SESSION["Username"], SQLITE3_TEXT);
        $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);
        $stmt->bindValue(':appraisal_question', $appraisal_question, SQLITE3_INTEGER);

    
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
            }

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);

            $result2 = $stmt->execute();
            
            $result2 = $result2->fetchArray();

            $results[]=array_merge($row, $result2);

        }
            
        return $results;
    }

?>
<?php 

    function CreateAppraisal($details, $question_count)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Appraisals(name, date_start, date_due, question_count) VALUES (:name, :start_date, :end_date, :question_count)";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':name', $details["name"], SQLITE3_TEXT);
        $stmt->bindValue(':start_date', $details["start_date"], SQLITE3_TEXT);
        $stmt->bindValue(':end_date', $details["end_date"], SQLITE3_TEXT);
        $stmt->bindValue(':question_count', $question_count, SQLITE3_TEXT);
    
        $stmt->execute();
        
        $sql = "SELECT last_insert_rowid() AS id";
        $stmt = $db->prepare($sql);
        $result = ($stmt->execute())->fetchArray();
        $result = $result["id"];

        return $result;
    }

    function SetEngineers($engineers, $appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Engineer_Appraisals(appraisal_id, engineer_username) VALUES (:appraisal_id, :engineer_username)";

        $stmt = $db->prepare($sql);
    
        foreach($engineers as $engineer)
        {
            $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);
            $stmt->bindValue(':engineer_username', $engineer, SQLITE3_TEXT);
    
            $stmt->execute();
        }
    }

    function SetTeamLeaders($team_leaders, $appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Team_Leader_Appraisals(appraisal_id, team_leader_username) VALUES (:appraisal_id, :team_leader_username)";

        $stmt = $db->prepare($sql);
    
        foreach($team_leaders as $team_leader)
        {
            $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);
            $stmt->bindValue(':team_leader_username', $team_leader, SQLITE3_TEXT);
    
            $stmt->execute();
        }       
    }
    
    function CreateQuestions($questions, $appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Questions(question_data, question_type) VALUES (:question_data, :question_type)";

        $stmtq = $db->prepare($sql);
    
        for($i = 0; $i < count($questions); $i++)
        {
            $question = $questions[$i];
            
            $stmtq->bindValue(':question_type', $question["type"], SQLITE3_TEXT);

            switch($question["type"])
            {
                case 0:
                    
                    $question_data = $question["question"];

                    break;
                case 1:

                    $question_data = $question["question"] . "|" . $question["min"] . "|" . $question["max"];

                    break;
                case 2:

                    $question_data = $question["question"];

                    foreach($question["choices"] as $choice)
                    {
                        $question_data .= "|" . $choice;
                    }
                    
                    break;
            }

            $stmtq->bindValue(':question_data', $question_data, SQLITE3_TEXT);
            
            $stmtq->execute();
            
            $sql = "SELECT last_insert_rowid() AS id";
            $stmt = $db->prepare($sql);
            $result = ($stmt->execute())->fetchArray();
            $question_id = $result["id"];
            
            $sql = "INSERT INTO Appraisals_Questions(appraisal_id, question_id, question_num) VALUES (:appraisal_id, :question_id, :question_num)";
            
            $stmt = $db->prepare($sql);
            
            $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);
            $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
            $stmt->bindValue(':question_num', $i, SQLITE3_INTEGER);
            
            $stmt->execute();
        }
    }

?>
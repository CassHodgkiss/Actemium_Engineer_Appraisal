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
        
        $sql = "SELECT seq FROM sqlite_sequence WHERE name = :seq";
        $stmt = $db->prepare($sql);

        $seq = "Appraisals";
        $stmt->bindValue(':seq', $seq, SQLITE3_TEXT);

        $result = $stmt->execute();
        
        $result = $result->fetchArray();

        return $result["seq"];
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
    
    function CreateQuestions($questions, $appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Questions(question_id, question_type) VALUES (:question_id, :question_type)";

        $stmtq = $db->prepare($sql);
    
        for($i = 0; $i < count($questions); $i++)
        {
            $question = $questions[$i];
            print_r($question);
            $stmtq->bindValue(':question_type', $question["type"], SQLITE3_TEXT);
    
            $stmtq->execute();

            $sql = "SELECT seq FROM sqlite_sequence WHERE name = :seq";

            $stmt = $db->prepare($sql);

            $seq = "Questions";
            $stmt->bindValue(':seq', $seq, SQLITE3_TEXT);

            $result = $stmt->execute();
            
            $result = $result->fetchArray();

            $question_id = $result["seq"];

            $sql = "INSERT INTO Appraisals_Questions(appraisal_id, question_id, question_num) VALUES (:appraisal_id, :question_id, :question_num)";
            
            $stmt = $db->prepare($sql);
            
            $stmt->bindValue(':appraisal_id', $appraisal_id, SQLITE3_INTEGER);
            $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
            $stmt->bindValue(':question_num', $i, SQLITE3_INTEGER);
    
            $stmt->execute();

            print_r($question_id);

            switch($question["type"])
            {
                case "writen":

                    print_r("w");

                    $sql = "INSERT INTO Writen(question_id, question) VALUES (:question_id, :question)";
                    
                    $stmt = $db->prepare($sql);

                    $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
                    $stmt->bindValue(':question', $question["question"], SQLITE3_TEXT);
    
                    $stmt->execute();

                    break;

                case "slider":

                    print_r("s");

                    $sql = "INSERT INTO Slider(question_id, question, lower_value, upper_value) VALUES (:question_id, :question, :lower_value, :upper_value)";
                    
                    $stmt = $db->prepare($sql);

                    $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
                    $stmt->bindValue(':question', $question["question"], SQLITE3_TEXT);
                    $stmt->bindValue(':lower_value', $question["min"], SQLITE3_INTEGER);
                    $stmt->bindValue(':upper_value', $question["max"], SQLITE3_INTEGER);
    
                    $stmt->execute();
                    
                    break;

                case "multi-choice":

                    print_r("m");

                    $sql = "INSERT INTO Multi_Choice(question_id, question, choices) VALUES (:question_id, :question, :choices)";
                    
                    $stmt = $db->prepare($sql);

                    $choices = implode("|", $question["choices"]);

                    $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
                    $stmt->bindValue(':question', $question["question"], SQLITE3_TEXT);
                    $stmt->bindValue(':choices', $choices, SQLITE3_TEXT);

                    $stmt->execute();
                    
                    break;
            }

        }
    }

?>
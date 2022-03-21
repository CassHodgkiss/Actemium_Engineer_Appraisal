<?php

    //Adds new Answer to database
    function SaveAnswer($engineer_appraisal_id, $question_id, $question_type)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Answers(question_id) VALUES (:question_id)";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
    
        $result = $stmt->execute();
        

        $sql = "SELECT seq FROM sqlite_sequence WHERE name = :answers";
        $stmt = $db->prepare($sql);

        $answers = "Answers";
        $stmt->bindValue(':answers', $answers, SQLITE3_TEXT);

        $result = $stmt->execute();
        $result = $result->fetchArray();

        $answer_id = $result[0];


        $sql = "INSERT INTO Engineers_Appraisal_Answers(engineer_appraisal_id, answer_id) VALUES (:engineer_appraisal_id, :answer_id)";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':engineer_appraisal_id', $engineer_appraisal_id, SQLITE3_TEXT);

        $result = $stmt->execute();

        switch($question_type)
        {
            case "Writen":

                $sql = "INSERT INTO Writen_Answers (answer_id, answer) VALUES (:answer_id, :answer)";

                break;

            case "Slider":
                break;
            case "Multi-Choice":
                break;
            case "Multi-Writen":
                break;
        }

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':answer', $_POST["answer"], SQLITE3_TEXT);

        $result = $stmt->execute();

    }

    //Updates Answer info
    function UpdateAnswer($question_id, $question_type, $engineer_appraisal_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT a.answer_id FROM Answers a 
        INNER JOIN Engineers_Appraisal_Answers ea ON ea.answer_id = a.answer_id 
        WHERE a.question_id = :question_id 
        AND ea.engineer_appraisal_id = :engineer_appraisal_id";

        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
        $stmt->bindValue(':engineer_appraisal_id', $engineer_appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $result = $result->fetchArray();

        $answer_id = $result[0];

        switch($question_type)
        {
            case "Writen":

                $sql = "UPDATE Writen_Answers SET answer = :answer WHERE answer_id = :answer_id";

                break;

            case "Slider":
                break;
            case "Multi-Choice":
                break;
            case "Multi-Writen":
                break;
        }

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':answer', $_POST["answer"], SQLITE3_TEXT);

        $result = $stmt->execute();

    }

?>
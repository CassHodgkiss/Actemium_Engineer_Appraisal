<?php

    //Adds new Answer to database
    function SaveAnswer($team_leader_appraisal_id, $question_id, $question_type, $answer)
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


        $sql = "INSERT INTO Team_Leaders_Appraisal_Answers(team_leader_appraisal_id, answer_id) VALUES (:team_leader_appraisal_id, :answer_id)";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':team_leader_appraisal_id', $team_leader_appraisal_id, SQLITE3_TEXT);

        $result = $stmt->execute();

        switch($question_type)
        {
            case "Writen":

                $sql = "INSERT INTO Writen_Answers (answer_id, answer) VALUES (:answer_id, :answer)";

                break;

            case "Slider":

                $sql = "INSERT INTO Slider_Answers (answer_id, answer) VALUES (:answer_id, :answer)";

                break;
                
            case "Multi-Choice":

                //$answer = 

                $sql = "INSERT INTO Multi_Choice_Answers (answer_id, answer) VALUES (:answer_id, :answer)";

                break;
        }

        $stmt = $db->prepare($sql); 

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':answer', $answer, SQLITE3_TEXT);

        $result = $stmt->execute();

    }

    //Updates Answer info
    function UpdateAnswer($question_id, $question_type, $team_leader_appraisal_id, $answer)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT a.answer_id FROM Answers a 
        INNER JOIN Team_Leaders_Appraisal_Answers ea ON ea.answer_id = a.answer_id 
        WHERE a.question_id = :question_id 
        AND ea.team_leader_appraisal_id = :team_leader_appraisal_id";

        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
        $stmt->bindValue(':team_leader_appraisal_id', $team_leader_appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $result = $result->fetchArray();

        $answer_id = $result[0];

        switch($question_type)
        {
            case "Writen":

                $sql = "UPDATE Writen_Answers SET answer = :answer WHERE answer_id = :answer_id";

                break;

            case "Slider":

                $sql = "UPDATE Slider_Answers SET answer = :answer WHERE answer_id = :answer_id";

                break;

            case "Multi-Choice":

                $sql = "UPDATE Multi_Choice_Answers SET answer = :answer WHERE answer_id = :answer_id";

                break;
        }

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':answer', $answer, SQLITE3_TEXT);

        $result = $stmt->execute();

    }

?>
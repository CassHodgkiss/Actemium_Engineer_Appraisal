<?php

    //Adds new Answer to database
    function SaveAnswer($team_leader_appraisal_id, $question_id, $question_type, $answer)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Answers(question_id, answer_data) VALUES (:question_id, :answer_data)";

        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':answer_data', $answer, SQLITE3_TEXT);
        $stmt->bindValue(':question_id', $question_id, SQLITE3_INTEGER);
        
        $result = $stmt->execute();

        $sql = "SELECT last_insert_rowid() AS id";
        $stmt = $db->prepare($sql);
        $result = ($stmt->execute())->fetchArray();
        $answer_id = $result["id"];

        $sql = "INSERT INTO Team_Leaders_Appraisal_Answers(team_leader_appraisal_id, answer_id) VALUES (:team_leader_appraisal_id, :answer_id)";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':team_leader_appraisal_id', $team_leader_appraisal_id, SQLITE3_INTEGER);

        $result = $stmt->execute();
    }

    //Updates Answer info
    function UpdateAnswer($team_leader_appraisal_id, $question_id, $question_type, $answer)
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

        $sql = "UPDATE Answers SET answer_data = :answer_data WHERE answer_id = :answer_id";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':answer_id', $answer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':answer_data', $answer, SQLITE3_TEXT);

        $result = $stmt->execute();

    }

?>
<?php 

    function CreateTarget($engineer_username, $target_data, $target_type, $appraisal_question_id, $date_due)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Targets(target_data, date_due, progress, target_type, engineer_username, appraisal_question_id) VALUES (:target_data, :date_due, :progress, :target_type, :engineer_username, :appraisal_question_id)";

        $stmt = $db->prepare($sql);

        $progress = 0;
    
        $stmt->bindValue(':target_data', $target_data, SQLITE3_TEXT);
        $stmt->bindValue(':target_type', $target_type, SQLITE3_INTEGER);
        $stmt->bindValue(':engineer_username', $engineer_username, SQLITE3_TEXT);
        $stmt->bindValue(':appraisal_question_id', $appraisal_question_id, SQLITE3_INTEGER);
        $stmt->bindValue(':date_due', $date_due, SQLITE3_TEXT);
        $stmt->bindValue(':progress', $progress, SQLITE3_INTEGER);
    
        $stmt->execute();
    }

?>
<?php 

    function CreateObjective($engineer_username, $todo_data, $todo_type, $date_due)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Todo_List(todo_data, date_due, progress, todo_type, engineer_username) VALUES (:todo_data, :date_due, :progress, :todo_type, :engineer_username)";

        $stmt = $db->prepare($sql);

        $progress = 0;
    
        $stmt->bindValue(':todo_data', $todo_data, SQLITE3_TEXT);
        $stmt->bindValue(':todo_type', $todo_type, SQLITE3_INTEGER);
        $stmt->bindValue(':engineer_username', $engineer_username, SQLITE3_TEXT);
        $stmt->bindValue(':date_due', $date_due, SQLITE3_TEXT);
        $stmt->bindValue(':progress', $progress, SQLITE3_INTEGER);
    
        $stmt->execute();
    }

?>
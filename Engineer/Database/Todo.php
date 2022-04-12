<?php 

    function GetToDo()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Todo_List
        WHERE engineer_username = :engineer_username";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':engineer_username', $_SESSION["Username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {        
            $results[]=$row;

        }

        return $results;
    }

    function SetToDoComplete($todo_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "UPDATE Todo_List SET progress = :value
        WHERE todo_id = :todo_id";

        $stmt = $db->prepare($sql);

        $value = 1;
    
        $stmt->bindValue(':todo_id', $todo_id, SQLITE3_TEXT);
        $stmt->bindValue(':value', $value, SQLITE3_INTEGER);
    
        $stmt->execute();
    }

    function UpdateToDoProgress($todo_id, $progress)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "UPDATE Todo_List SET progress = :value
        WHERE todo_id = :todo_id";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':todo_id', $todo_id, SQLITE3_TEXT);
        $stmt->bindValue(':value', $progress, SQLITE3_INTEGER);
    
        $stmt->execute();
    }

?>
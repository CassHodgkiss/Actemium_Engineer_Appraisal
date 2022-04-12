<?php 

    function GetTargets()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Targets
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

    function SetTargetComplete($target_id)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "UPDATE Targets SET progress = :value
        WHERE target_id = :target_id";

        $stmt = $db->prepare($sql);

        $value = 1;
    
        $stmt->bindValue(':target_id', $target_id, SQLITE3_TEXT);
        $stmt->bindValue(':value', $value, SQLITE3_INTEGER);
    
        $stmt->execute();
    }

    function UpdateTargetProgress($target_id, $progress)
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "UPDATE Targets SET progress = :value
        WHERE target_id = :target_id";

        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':target_id', $target_id, SQLITE3_TEXT);
        $stmt->bindValue(':value', $progress, SQLITE3_INTEGER);
    
        $stmt->execute();
    }

?>
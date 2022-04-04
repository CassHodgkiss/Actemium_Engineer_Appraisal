<?php 

    function AddEngineer()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Users(username, password, user_type) VALUES (:username, :password, :user_type)";
        
        $stmt = $db->prepare($sql);
        
        $usertype = "0";

        $stmt->bindValue(':user_type', $usertype, SQLITE3_INTEGER);
        $stmt->bindValue(':username', $_POST["username"], SQLITE3_TEXT);
        $stmt->bindValue(':password', $_POST["password"], SQLITE3_TEXT);
    
        $stmt->execute();

        $sql = "INSERT INTO Engineers(engineer_username, first_name, last_name, team_leader_username) VALUES (:engineer_username, :first_name, :last_name, :team_leader_username)";
        
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':first_name', $_POST["first_name"], SQLITE3_TEXT);
        $stmt->bindValue(':last_name', $_POST["last_name"], SQLITE3_TEXT);
        $stmt->bindValue(':team_leader_username', $_POST["tl_username"], SQLITE3_TEXT);
        $stmt->bindValue(':engineer_username', $_POST["username"], SQLITE3_TEXT);
    
        $stmt->execute();


    }

    function CheckUsername()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Users WHERE username = :username";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_POST["username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        if($result == NULL)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function CheckTeamLeaderUsername()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Team_Leaders WHERE team_leader_username = :username";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_POST["tl_username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        if($result != NULL)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

?>
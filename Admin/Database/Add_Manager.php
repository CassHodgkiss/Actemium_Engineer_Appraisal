<?php 

    function AddManager()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "INSERT INTO Users(username, password, user_type) VALUES (:username, :password, :user_type)";
        
        $stmt = $db->prepare($sql);
        
        $usertype = "2";

        $stmt->bindValue(':user_type', $usertype, SQLITE3_INTEGER);
        $stmt->bindValue(':username', $_POST["username"], SQLITE3_TEXT);
        $stmt->bindValue(':password', $_POST["password"], SQLITE3_TEXT);
    
        $stmt->execute();

        $sql = "INSERT INTO Managers(manager_username, first_name, last_name) VALUES (:manager_username, :first_name, :last_name)";
        
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':first_name', $_POST["first_name"], SQLITE3_TEXT);
        $stmt->bindValue(':last_name', $_POST["last_name"], SQLITE3_TEXT);
        $stmt->bindValue(':manager_username', $_POST["username"], SQLITE3_TEXT);
    
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

?>
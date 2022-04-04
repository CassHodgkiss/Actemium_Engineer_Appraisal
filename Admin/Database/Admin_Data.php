 <?php

    //Returns Admin Data
    function GetAdminData()
    {
        $db = new SQLITE3('C:/xampp/data/actemium.db');

        $sql = "SELECT * FROM Admins WHERE admin_username = :username";
        
        $stmt = $db->prepare($sql);
    
        $stmt->bindValue(':username', $_SESSION["Username"], SQLITE3_TEXT);
    
        $result = $stmt->execute();

        $result = $result->fetchArray();
            
        return $result;
    }

?>
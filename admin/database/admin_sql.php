<?php

function getAdminData ($username){

    $db = new SQLITE3('C:\xampp\data\auction_site.db');
    $sql = "SELECT * FROM Admins WHERE admin_username = :username";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':username', $username, SQLITE3_TEXT);

    $result = $stmt->execute();
        
    return $result->fetchArray();
}
?> 
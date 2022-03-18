<?php

function getPenalty ($username){

    $db = new SQLITE3('C:/xampp/data/auction_site.db');

    $sql = "SELECT customer_penalty FROM Customers WHERE customer_username = :username";
    
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':username', $username, SQLITE3_TEXT);

    $result = $stmt->execute();
        
    return $result->fetchArray();
}

?> 
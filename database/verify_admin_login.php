<?php

function verifyAdmin () {

    $db = new SQLite3('C:\xampp\Data\auction_site.db');

    $stmt = $db->prepare('SELECT admin_username FROM Admins WHERE admin_username=:username AND admin_password=:password');

    $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

    $result = $stmt->execute();

    return $result->fetchArray();

}


?>
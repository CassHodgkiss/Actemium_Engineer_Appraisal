<?php

function verifySeller () {

        $db = new SQLite3('C:\xampp\Data\auction_site.db');

        $stmt = $db->prepare('SELECT seller_username, seller_status FROM Sellers WHERE seller_username=:username AND seller_password=:password');

        $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
        $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

        $result = $stmt->execute();

        return $result->fetchArray();

    }


?>
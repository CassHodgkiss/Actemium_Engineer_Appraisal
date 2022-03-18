<?php

function verifyCustomer () {

        $db = new SQLite3('C:\xampp\Data\auction_site.db');

        $stmt = $db->prepare('SELECT customer_username, customer_status FROM Customers WHERE customer_username=:username AND customer_password=:password');

        $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
        $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

        $result = $stmt->execute();

        return $result->fetchArray();

    }


?>
<?php

    function getAuctionData($auction_id) {

        $db = new SQLite3('C:\xampp\Data\auction_site.db');

        $stmt = $db->prepare('SELECT a.*, MAX(b.bid_amount) AS bid_amount FROM Auctions a LEFT OUTER JOIN Bids b ON a.auction_id = b.auction_id WHERE a.auction_id = :id GROUP BY a.auction_id');

        $stmt->bindParam(':id', $auction_id, SQLITE3_INTEGER); 

        $result = $stmt->execute();

        return $result->fetchArray();
    }

    function getAuctionBids($auction_id) {

        $db = new SQLite3('C:\xampp\Data\auction_site.db');

        $stmt = $db->prepare('SELECT * FROM Bids WHERE auction_id=:id');

        $stmt->bindParam(':id', $auction_id, SQLITE3_INTEGER); 

        $result = $stmt->execute();

        $results = [];
        while ($row=$result->fetchArray())
        {
            $results[] = $row;
        }

        return $results;
    }

?>




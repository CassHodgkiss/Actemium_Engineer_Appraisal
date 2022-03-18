<?php

    function getAuctions() {

        $db = new SQLite3('C:\xampp\Data\auction_site.db');

        date_default_timezone_set("Europe/London");

        //gets all auctions, adds on the top bid if there is any, only when no one has won the auction
        $stmt = $db->prepare('SELECT a.auction_id, a.auction_name, a.auction_start_price, MAX(b.bid_amount) AS bid_amount, a.auction_end_date FROM Auctions a LEFT OUTER JOIN Bids b ON a.auction_id = b.auction_id WHERE a.customer_cleared_payment IS NULL GROUP BY a.auction_id');

        $result = $stmt->execute();

        $current_date = new DateTime("now");
        $current_date = new DateTime($current_date->format("d-m-Y"));

        $results = [];
        while ($row=$result->fetchArray())
        {
            $end_date = new DateTime($row["auction_end_date"]); 
            $end_date = new DateTime($end_date->format("d-m-Y"));

            if($end_date > $current_date){ 
                $results[]=$row;
            }

        }

        return $results;

    }

?>
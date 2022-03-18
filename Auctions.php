<?php

    session_start();

    $title = "Auctions | Auction Site";
    
    include("database\auctions_data.php");

    $auctions = getAuctions();

    if(!isset($_SESSION['userType'])){

        $title = "Auction Site";
        require("Header.php"); 

    }
    else{

        $username = $_SESSION['username'];
        $userType = $_SESSION['userType'];

        if (!isset($username)){
                session_unset();
                session_destroy();
                header("Location:".$path);//return to the login page
        }

        include("session/session.php");

        switch($userType){

            case "admin":
 
                $path = "AdminLogin.php"; //this path is to pass to checkSession function from session.php 

                checkSession ($path); //calling the function from session.php

                include("admin/AdminHeader.php");

                break;

            case "seller":

 
                $path = "SellerLogin.php"; //this path is to pass to checkSession function from session.php 

                checkSession ($path); //calling the function from session.php

                include("seller/SellerHeader.php");

                break;

            case "customer":

 
                $path = "CustomerLogin.php"; //this path is to pass to checkSession function from session.php 

                checkSession ($path); //calling the function from session.php

                include("customer/CustomerHeader.php");

                break;

        }
    }

?>

    <div>

        <main role="main">

			<h1>Active Auctions</h1>


            <div class="auction_grid">

                <?php

                foreach($auctions as $auction){

                    if ($auction["bid_amount"] == NULL) { $price = $auction["auction_start_price"]; } //when the bid amount is null that means there arent any bids so the inital start price is used
                    else { $price = $auction["bid_amount"]; }

                    echo "<div class='auction'>";
                        echo "<img class='resize_img' src='database/auction_images.php?id=" . $auction["auction_id"] . "' alt='Item 1'>";
                        echo "<div class='auction_info'>";
                            echo "<div class='auction_data'>";
                                echo "<p class='auction_text'>" . $auction["auction_name"] . "</p>";
                                echo "<p class='auction_text'>£" . $price . "</p>";
                            echo "</div>";
                            echo "<a href=AuctionDetails.php?id=". $auction["auction_id"] ." class='auction_view_button'> <button class='fill_button'";
                            if(!isset($_SESSION['userType'])) { echo "disabled"; }
                            echo ">View</button> </a>";
                        echo "</div>";
                    echo "</div>";
                }
                              
                ?>

            </div>
			

		</main>

	</div>

<?php

    if(!isset($_SESSION["userType"])){

        require("Footer.php"); 

    }
    else{

        switch($userType){

            case "admin":

                include("admin/AdminFooter.php");

                break;

            case "seller":

                include("seller/SellerFooter.php");

                break;

            case "customer":

                include("customer/CustomerFooter.php");

                break;

        }
    }

?>
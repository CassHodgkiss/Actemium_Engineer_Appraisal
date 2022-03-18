<?php

    session_start();

    $path = "Auctions.php";

    if(!isset($_SESSION['username']) || !isset($_GET["id"]) || !isset($_SESSION['userType'])) { header("Location:".$path); } //return to the auctions page

    $userType = $_SESSION['userType'];

    $id = $_GET["id"];

    include("database\auction_data.php");

    $auction = getAuctionData($id);
    $bids = getAuctionBids($id);


    if($auction == null) { header("Location:".$path); } //if the auction doesnt exist, goes back to auction page
    if($auction["customer_cleared_payment"] != NULL) { header("Location:".$path); } //auction has already been won so shouldnt be viewable

    if($auction["bid_amount"] != NULL){
        $price = $auction["bid_amount"];
    }
    else{
        $price = $auction["auction_start_price"];
    }

    $time_left = "1 Day 23 Hours";

    $title = "". $auction["auction_name"] ." | Auction Site";
    
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

    if (isset($_POST['submit'])) {

        if($_SESSION["userType"] == "customer"){

            echo $_POST["bid_amount"];

        }
    }
    
?>

    <div>

        <main role="main">

			<?php echo "<h1>". $auction["auction_name"] ."</h1>"; ?>

            <div class="auctionpage">
                <div class="auctionpage_data">

                <?php echo "<img class='resize_img auctionpage_img' src='database/auction_images.php?id=" . $auction["auction_id"] . "' alt='Item 1'>"; ?>

                <div class="auctionpage_info">
                    <?php echo "<h2 class='auctionpage_text'> £" . $price . " </h2>"; ?>
                    <?php echo "<p class='auctionpage_text'> " . $time_left . " Left  </p>"; ?>

                    <div class="form-group input-group-lg auctionpage_bid">

                        <form method="post" class="auctionpage_form">
                            
                            <input type="number" min="1" step="any" class="auctionpage_bid_amount" placeholder="Amount" name="bid_amount" required>                            
                            <?php 
                            echo "<input type='submit' class='auctionpage_bid_button' value='Bid' name='submit'";
                            if($_SESSION["userType"] != "customer") { echo "disabled "; }
                            echo ">"; 
                            ?>
                            
                        </form>

                    </div>
                </div>

            </div>

            <div class="auctionpage_info">
                <h3>Description</h3>
                <p class="description">
                    <?php echo $auction["auction_description"]?>
                </p>

                
                
            </div>
            </div>
          
		</main>

	</div>

<?php

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
    
?>
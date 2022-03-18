<?php 
    
    include("../session/session.php");
 
    $path = "../CustomerLogin.php"; //this path is to pass to checkSession function from session.php 
     
    session_start(); //must start a session in order to use session in this page.
    if (!isset($_SESSION['username'])){
        session_unset();
        session_destroy();
        header("Location:".$path);//return to the login page
    }
    $username = $_SESSION['username']; //this value is obtained from the login page when the user is verified
    checkSession ($path); //calling the function from session.php

    require_once("database/customer_sql.php");

    $customer = getPenalty($username);

    //total amount of unique auctions which the current customer has bid on any amount of times above 0
    $active_bids = 0;
    
    //total number of bids with the current customers username on it
    $total_bids = 0;

    //total number of auctions with the current customers username on it
    $won_auctions = 0;

    //auctions which have ended with the current customer having the highest bid but the aucton customer_username is null
    $pending_auctions = 0;

    $penalty = $customer["customer_penalty"];

    $title = "Customer DashBoard | Auction Site";
    include("CustomerHeader.php");
?>

	<div class="container">
        <main role="main">

            <h1>DashBoard</h1>

            <?php echo "<h2>Welcome " . $_SESSION['username'] . "</h2>"; ?>

            <div class="dashboard">

                <div class="dashboard_row">

                    <a href="ActiveBids.php" class="dashboard_box">
                
                        <button class="fill_button">
                            <h3>Active Bids</h3>
                
                            <?php echo "<p>You currently have " . $active_bids . " Active Bid(s)</p>" ?>
                        </button>
                
                    </a>
                
                    <a href="BidsHistory.php" class="dashboard_box">
                
                        <button class="fill_button">
                            <h3>Bid History</h3>
                
                            <?php echo "<p>You currently have " . $total_bids . " Bid(s) and " . $won_auctions . " Won Auction(s)"?>
                        </button>
                
                    </a> 

                </div> 

                <div class="dashboard_row">

                    <a href="WonAuctions.php" class="dashboard_box">
                
                        <button class="fill_button">
                            <h3>Won Auctions</h3>
                
                            <?php echo "<p>You currently have " . $pending_auctions . " Won Auction(s)</p>" ?>
                        </button>
                
                    </a>
                
                    <div class="dashboard_box">
                
                        <h3>Penalty Points</h3>
                
                        <?php echo "<p>You currently have " . $penalty . "/3 Penalty Points</p>" ?>
                
                    </div >
                </div>

            </div>
		
		</main>
	</div>

<?php require("CustomerFooter.php");?>
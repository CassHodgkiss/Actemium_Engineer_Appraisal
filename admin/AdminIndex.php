<?php 
    
    include("../session/session.php");
 
    $path = "../AdminLogin.php"; //this path is to pass to checkSession function from session.php 
     
    session_start(); //must start a session in order to use session in this page.
    if (!isset($_SESSION['username'])){
        session_unset();
        session_destroy();
        header("Location:".$path);//return to the login page
    }
    $username = $_SESSION['username']; //this value is obtained from the login page when the user is verified
    checkSession ($path); //calling the function from session.php

    require_once("database/admin_sql.php");

    //amount of customers with a status of pending
    $pending_applications_customers = 0;

    //amount of seller with a status of pending 
    $pending_applications_sellers = 0;

    //amount of auctions with any amount of reports
    $pending_reports = 0;

    //amount of reactivation requests
    $pending_reactivation_requests = 0;

    $title = "Admin DashBoard | Auction Site";
    include("AdminHeader.php");

?>

	<div class="container">
        <main role="main">

            <h1>DashBoard</h1>

            <?php echo "<h2>Welcome " . $_SESSION['username'] . "</h2>"; ?>

            <div class="dashboard">

                <div class="dashboard_row">
                    <div class="dashboard_box">
                
                        <h3>Customers</h3>
                
                        <p>View the list of all Customer Accounts</p>
                
                    </div>
                
                    <div class="dashboard_box">
                
                        <h3>Sellers</h3>
                
                        <p>View the list of all Seller Accounts</p>
                
                    </div> 
                </div> 
                <div class="dashboard_row">
                    <div class="dashboard_box">
                
                        <h3>Pending Customer Application</h3>
                
                        <?php echo "<p>There are currently " . $pending_applications_customers . " Pending Application(s)" ?>
                
                    </div>
                
                    <div class="dashboard_box">
                
                        <h3>Pending Seller Applications</h3>
                
                        <?php echo "<p>There are currently " . $pending_applications_sellers . " Pending Application(s)" ?>
                
                    </div>
                </div>

                <div class="dashboard_row">
                    <div class="dashboard_box">
                
                        <h3>Pending Reports</h3>
                
                        <?php echo "<p>There are currently " . $pending_reports . " Pending Report(s)" ?>
                
                    </div>
                
                    <div class="dashboard_box">
                
                        <h3>Pending Reactivation Requests</h3>
                
                        <?php echo "<p>There are currently " . $pending_reactivation_requests . " Pending Request(s)" ?>
                
                    </div>
                </div>

            </div>
		
		</main>
	</div>

<?php require("AdminFooter.php");?>
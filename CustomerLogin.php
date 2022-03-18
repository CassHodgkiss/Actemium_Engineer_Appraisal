<?php 

$title = "Customer Login | Auction Site";
require("Header.php");  

require_once("database/verify_customer_login.php");

if (isset($_POST['submit'])) {

    
     $customer = verifyCustomer();

        if($customer != null){

            if($customer["customer_status"] =="pending") {

                echo "account is pending";

            } 

            elseif($customer["customer_status"] =="deactivated") {

                echo "account is deactivated";

            } 

            elseif($customer["customer_status"] =="active") {

                session_start();
                $_SESSION['userType'] = "customer";
                $_SESSION['username'] = $customer['customer_username'];
               
                header("Location: customer/CustomerIndex.php"); 
                exit();

            }
        }
        else{

            echo "username or password were incorrect";

        }
    
}


?>

<div class="container">

    <main role="main">

        <h1>Customer Login</h1>

        <div class="application_box">

            <h2>Login to your Customer Account</h2>

            <form method="post">

                <div class="form-group input-group-lg">

                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>

                    <input class="btn btn-primary" type="submit" value="Login" name="submit">

                </div>

            </form>

        </div>

    </main>

</div>

<?php require("Footer.php"); ?>
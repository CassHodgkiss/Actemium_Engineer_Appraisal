<?php 

$title = "Customer Application | Auction Site";
require("Header.php"); 

include_once("database/customer_application.php");

if (isset($_POST['submit'])) {

    $createCustomer = createCustomer();
    header('Location: CustomerApplicationSummary.php?createCustomer='.$createCustomer);
    
}


?>

<div class="container">

    <main role="main">

        <h1>Customer Account Application</h1>

        <div class="application_box">

            <h2>Apply</h2>

            <form method="post">

            <div class="form-group input-group-lg">

                <form>

                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="First Name" name="firstname" required>
                        <input type="text" class="form-control" placeholder="Last Name" name="lastname" required>
                    </div>

                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>

                    <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                    <input type="tel" class="form-control" placeholder="Phone Number" name="phone" required>
                    <input type="text" class="form-control" placeholder="Address Line 1" name="address1" required>
                    <input type="text" class="form-control" placeholder="Address Line 2" name="address2" >

                    <input class="btn btn-primary" type="submit" value="Send Application" name ="submit">

                </form>

            </div>

        </div>

    </main>

</div>

<?php require("Footer.php"); ?>
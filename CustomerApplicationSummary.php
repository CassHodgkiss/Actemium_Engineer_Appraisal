<?php

$path = "Index.php";

if(!isset($_GET['createCustomer'])){
    header("Location:".$path);//return to the login page
}

$result = $_GET['createCustomer']; 

$title = "Customer Application Summary | Auction Site";
require("Header.php"); 

?> 


<div class="container"> 

    <main role="main"> 

        <div>

            <?php 

                if($result == 1){ 

                    echo "<h2>Customer Account Successfully Created</h2>";
                    echo "<h3>Admins will verify your account shortly and you will receive an email or text</h3>";

                } 

                else{ 

                    echo "<h2>Customer Account Creation Failed</h2>";
                    echo "<h3>Please try again later</h3>";

                } 

            ?> 

            <a href="Index.php" class="back" >
                <button class="fill_button">Back</button>
            </a>

        </div> 

    </main>

</div> 

 

<?php include("Footer.php");?> 
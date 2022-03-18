<?php 

$title = "Admin Login | Auction Site";
require("Header.php");  

require_once("database/verify_admin_login.php");

if (isset($_POST['submit'])) {

    if($_POST['username'] != null && $_POST["password"] !=null)
    {
        $admin = verifyAdmin();

        if($admin != null){

            session_start();
            $_SESSION['userType'] = "admin";
            $_SESSION['username'] = $admin['admin_username'];
               
            header("Location: admin/AdminIndex.php"); 
            exit();
            
        }
        else{

            echo "username or password were incorrect";

        }
    }
}


?>

<div class="container">

    <main role="main">

        <h1>Admin Login</h1>

        <div class="application_box">

            <h2>Login to your Admin Account</h2>

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
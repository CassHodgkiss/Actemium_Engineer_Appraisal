<?php

    $title = "Team Leader Login | Actemium";
    include("Header.php");

    include("DataBase/Verify_Team_Leader_Login.php");

    $error_msg = "";

    if (isset($_POST['submit']))
    {
        $valid = ValidateTeam_LeaderLogin();

        if($valid)
        {
            session_start();
            $_SESSION['UserType'] = "Team_Leader";
            $_SESSION['Username'] = $_POST["username"];
           
            header("Location: Team_Leader/Team_Leader_Index.php"); 
            exit();
        }

        else
        {
            $error_msg = "Username or Password were Incorrect";
        }
    }

?>


    <div class="container">

        <main role="main" class="text-center py-5">

            <h1 class="py-4">Team Leader Login</h1>

            <section class="login-box bg-blue text-white container ms-auto w-lg-50">

                <h2 class="py-3">Login to your <br> Team Leader Account</h2>

                <form method="post">

                    <div class="input-group-lg mx-2 mt-4">

                        <input type="text" class="form-control my-3" placeholder="Username" name="username" required>
                        <input type="password" class="form-control my-3" placeholder="Password" name="password" required>

                        <p class="my-3"><?php echo $error_msg; ?></p>
                        <input class="btn btn-green mb-3" type="submit" value="Login" name="submit">

                    </div>

                </form>

            </section>

        </main>

    </div>


<?php include("Footer.php"); ?>
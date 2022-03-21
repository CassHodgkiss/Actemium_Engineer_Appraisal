<?php

    $title = "Manager Login | Actemium";
    include("Header.php");

    include("DataBase/Verify_Manager_Login.php");

    $error_msg = "";

    if (isset($_POST['submit']))
    {
        $valid = ValidateManagerLogin();

        if($valid)
        {
            session_start();
            $_SESSION['UserType'] = "Manager";
            $_SESSION['Username'] = $_POST["username"];
           
            header("Location: Manager/Manager_Index.php"); 
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

        <h1 class="py-4">Manager Login</h1>

        <section class="login-box bg-blue text-white container ms-auto w-lg-50 rounded">

            <h2 class="pb-3 pt-4">Login to your<br>Manager Account</h2>

            <form method="post" class="d-flex">

                <div class="input-group-lg mx-2 w-100">

                    <div class="form-floating text-black">
                        <input type="text" class="form-control my-3" id="floatingUsername" placeholder="Username"
                            name="username" required>
                        <label for="floatingUsername">Username</label>
                    </div>

                    <div class="form-floating text-black">
                        <input type="password" class="form-control my-3" id="floatingPassword" placeholder="Password"
                            name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>

                    <?php if($error_msg != ""): ?>
                    <p class="my-3 text-white"><?php echo $error_msg; ?></p>
                    <?php endif; ?>

                    <button class="btn btn-green-border mt-3 mb-4 mx-auto" type="submit" name="submit">Login</button>

                </div>

            </form>

        </section>

    </main>

</div>


<?php include("Footer.php"); ?>
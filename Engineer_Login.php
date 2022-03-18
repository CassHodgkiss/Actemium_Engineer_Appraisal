<?php
    $title = "Engineer Login | Actemium";
    include("Header.php");

    include("DataBase/Engineer_Login.php");

    $error_msg = "";

    if (isset($_POST['submit']))
    {
        $valid = ValidateEngineerLogin();

        if($valid){
            //session
            echo "sss";
        }
        else{
            $error_msg = "Username or Password is Incorrect";
            echo "hhh";
        }
    }
?>

<div class="container">

    <main role="main">

        <h1>Engineer Login</h1>

        <div class="login_box">

            <h2>Login to your <br> Engineer Account</h2>

            <form method="post">

                <div class="form-group input-group-lg">

                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <p> <?php echo $error_msg; ?></p>
                    <input class="btn" type="submit" value="Login" name="submit">

                </div>

            </form>

        </div>

    </main>

</div>

<?php include("Footer.php"); ?>
<?php
    $title = "Manager Login | Actemium";
    include("Header.php"); 
?>

<div class="container">

    <main role="main">

        <h1>Manager Login</h1>

        <div class="login_box">

            <h2>Login to your <br> Manager Account</h2>

            <form method="post">

                <div class="form-group input-group-lg">

                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>

                    <input class="btn" type="submit" value="Login" name="submit">

                </div>

            </form>

        </div>

    </main>

</div>

<?php include("Footer.php"); ?>
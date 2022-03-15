<?php
    $title = "Team Leader Login | Actemium";
    include("Header.php"); 
?>

<div class="container">

    <main role="main">

        <h1>Team Leader Login</h1>

        <div class="login_box">

            <h2>Login to your <br> Team Leader Account</h2>

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
<?php

    $title = "Admin Dashboard | Actemium";
    include("Header.php");

    include("../Session/Admin_Session.php");

    include("Database/Add_Manager.php");

    $error_msg = "";

    if(isset($_POST["submit"]))
    {
        if(CheckUsername())
        {
            AddManager();
            $path = "Admin_Index.php"; 
            header("Location:".$path);
            exit;
        }
        else
        {
            $error_msg = "Username is already taken";
        }
    }

?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto" style="max-width: 576px;">

        <div class="bg-blue text-white container ms-auto w-lg-50 rounded d-flex flex-column mt-5">

            <h2 class="pb-4 pt-4 m-0">Add Manager Account</h2>

            <div class="container mt-3">

                <form method="post" class="d-flex">

                    <div class="input-group-lg mx-2 w-100">

                        <div class="form-floating text-black">
                            <input type="text" class="form-control my-3" id="floatingUsername" placeholder="Username"
                                name="username" required>
                            <label for="floatingUsername">Username</label>
                        </div>

                        <div class="form-floating text-black">
                            <input type="text" class="form-control my-3" id="floatingFirstName" placeholder="First Name"
                                name="first_name" required>
                            <label for="floatingFirstName">First Name</label>
                        </div>

                        <div class="form-floating text-black">
                            <input type="text" class="form-control my-3" id="floatingLastName" placeholder="Last Name"
                                name="last_name" required>
                            <label for="floatingLastName">Last Name</label>
                        </div>

                        <div class="form-floating text-black">
                            <input type="text" class="form-control my-3" id="floatingPassword" placeholder="Password"
                                name="password" required>
                            <label for="floatingPassword">Password</label>
                        </div>

                        <p class="my-3 text-white"><?php echo $error_msg; ?></p>

                        <button class="btn btn-green-border mt-4 mb-4 mx-auto w-75" type="submit"
                            name="submit">Submit</button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<?php include("Footer.php"); ?>
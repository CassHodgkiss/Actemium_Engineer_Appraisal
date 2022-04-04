<?php

    $title = "Admin Dashboard | Actemium";
    include("Header.php");

    include("../Session/Admin_Session.php");

    include("Database/Admin_Data.php");

    $admin = GetAdminData();

?>

<div class="container">

    <main role="main" class="text-center py-5">

        <div class="row row-cols-1 row-cols-lg-2">

            <div class="col row-cols-1">

                <section class="col mb-4">

                    <div class="card">

                        <div class="row g-0">

                            <div class="col-lg-4 p-3">
                                <img class='img-fluid rounded-circle'
                                    src="<?php echo "Database/Admin_Pfp.php?id=" . $username ?>" alt="Your Pfp Picture">
                            </div>

                            <div class="col-lg-8">

                                <div class="card-body p-0">

                                    <div class="card-header bg-white border-0">
                                        <h3 class="m-1 p-1 text-white bg-blue rounded">
                                            <?php echo $admin["first_name"] . " " . $admin["last_name"]; ?></h3>
                                    </div>

                                    <div class=" m-1">

                                        <div class="d-flex">

                                            <p class="m-0 w-50 p-2">Username</p>
                                            <p class="m-0 w-50 p-2"><?php echo $username; ?></p>

                                        </div>

                                        <hr class="m-1 mx-4">

                                        <div class="d-flex">

                                            <p class="m-0 w-50 p-2">Occupation</p>
                                            <p class="m-0 w-50 p-2">Admin</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>


            </div>


            <div class="col row-cols-1 mt-4 mt-lg-0">


            </div>

        </div>

    </main>

</div>

<?php include("Footer.php"); ?>
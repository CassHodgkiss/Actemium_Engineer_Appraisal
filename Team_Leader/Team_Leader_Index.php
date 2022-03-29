<?php

    $title = "Team Leader Dashboard | Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    include("Database/Team_Leader_Data.php");

    $team_leader = GetTeamLeaderData();

    include("../Functions/time_left.php");

    date_default_timezone_set("Europe/London");
    $current_date = new DateTime("now");

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
                                    src="<?php echo "Database/Team_Leader_Pfp.php?id=" . $username ?>"
                                    alt="Your Pfp Picture">
                            </div>

                            <div class="col-lg-8">

                                <div class="card-body p-0">

                                    <div class="card-header bg-white border-0">
                                        <h3 class="m-1 p-1 text-white bg-blue rounded">
                                            <?php echo $team_leader["first_name"] . " " . $team_leader["last_name"]; ?>
                                        </h3>
                                    </div>

                                    <div class=" m-1">

                                        <div class="d-flex">

                                            <p class="m-0 w-50 p-2">Username</p>
                                            <p class="m-0 w-50 p-2"><?php echo $username; ?></p>

                                        </div>

                                        <hr class="m-1 mx-4">

                                        <div class="d-flex">

                                            <p class="m-0 w-50 p-2">Occupation</p>
                                            <p class="m-0 w-50 p-2">Team Leader</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="col my-4">


                </section>

                <section class="col mt-4">


                </section>

            </div>


            <div class="col row-cols-1 mt-4 mt-lg-0">

                <section class="col mb-4">

                </section>


                <section class="col my-4">

                </section>


                <section class="col mt-4">

                </section>

            </div>

        </div>

    </main>

</div>

<?php include("Footer.php"); ?>
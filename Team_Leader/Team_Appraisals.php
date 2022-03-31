<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    include("Database/Appraisals.php");

    include("../Functions/time_left.php");

    $pending_appraisals = GetTeamAppraisalsData();

?>


<div class="container">

    <main role="main" class="text-center py-5">

        <div class="border w-100">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-start">Team Appraisals</h3>

            </div>

            <div class="container">

                <div class="row row-cols-1 m-2">

                    <?php if(count($pending_appraisals) == 0): ?>

                    <p>Your Team Currently have no Pending Appraisals</p>

                    <?php else: ?>

                    <?php foreach($pending_appraisals as $pending_appraisal): ?>


                    <?php $time_left = GetTimeLeft(new DateTime($pending_appraisal["date_due"])); ?>

                    <?php  

                    date_default_timezone_set("Europe/London");
                    $current_date = new DateTime("now");
                    $end_date = new DateTime($pending_appraisal["date_due"]);

                    if($current_date < $end_date) 
                    { 
                        $is_past = FALSE; 
                    } 
                    else 
                    { 
                        $is_past = TRUE; 
                    }

                    ?>

                    <a href="Appraisal_Data.php?id=<?php echo $pending_appraisal["appraisal_id"]; ?>"
                        class="col border my-2 p-0 text-decoration-none text-black">

                        <div class="d-md-flex justify-content-between m-2 text-center text-md-start">

                            <div class="m-2">

                                <h2 class="h3"><?php echo $pending_appraisal["name"]; ?></h2>

                                <p class="my-2 ms-1">
                                    <?php echo $time_left; if($is_past) { echo " Ago"; } else { echo " Left"; } ?>
                                </p>

                            </div>

                            <div class="mx-auto m-md-1 mt-3 mt-md-1 text-center" style="width: 250px">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">Start Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $pending_appraisal["date_start"]?></p>

                                </div>

                                <hr class="m-1">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">End Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $pending_appraisal["date_due"]; ?></p>

                                </div>

                            </div>

                        </div>

                        <!-- slider here -->
                    </a>

                    <?php endforeach; ?>

                    <?php endif; ?>

                </div>

            </div>


        </div>

    </main>

</div>


<?php include("Footer.php"); ?>
<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

    include("Database/Appraisals.php");

    include("Database/time_left.php");

    $appraisals_data = GetAppraisalsData();

?>


<div class="container">

    <main role="main" class="text-center py-5">

        <div class="border w-100">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-start">Pending Appraisals</h3>

            </div>

            <div class="container">

                <div class="row row-cols-1 m-2">

                    <?php foreach($appraisals_data as $appraisal_data): ?>
                    <?php $appraisal_questions_done = GetAppraisalsAnswersData($appraisal_data["engineer_appraisal_id"]); ?>

                    <a href="Appraisal_Questions.php?id=<?php echo $appraisal_data["engineer_appraisal_id"]; ?>"
                        class="col border my-2 p-0 text-decoration-none text-black">

                        <div class="d-md-flex justify-content-between m-2 text-center text-md-start">

                            <div class="m-2">

                                <h2 class="h3"><?php echo $appraisal_data["name"]; ?></h2>

                                <?php $time_left = GetTimeLeft(new DateTime($appraisal_data["date_due"])); ?>

                                <?php  

                                date_default_timezone_set("Europe/London");
                                $current_date = new DateTime("now");
                                $end_date = new DateTime($appraisal_data["date_due"]);

                                if( $current_date < $end_date) { $overdue = FALSE; } else { $overdue = TRUE; }

                                ?>

                                <p class="my-2 ms-1">
                                    <?php echo $time_left; if($overdue) { echo " Ago"; } else { echo " Left"; } ?>
                                </p>

                            </div>

                            <div class="mx-auto m-md-1 mt-3 mt-md-1 text-center" style="width: 250px">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">Start Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $appraisal_data["date_start"]?></p>

                                </div>

                                <hr class="m-1">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">End Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $appraisal_data["date_due"]; ?></p>

                                </div>

                            </div>

                        </div>

                        <?php $percentage = ($appraisal_questions_done / $appraisal_data["question_count"]) * 100 ?>

                        <div class="progress mt-2 m-1" style="height: 20px;">
                            <div class="progress-bar <?php if($overdue) { echo "bg-danger"; } ?>" role="progressbar"
                                style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>"
                                aria-valuemin="0" aria-valuemax="<?php echo $appraisal_data["question_count"]; ?>">
                                <?php echo $appraisal_questions_done; ?>/<?php echo $appraisal_data["question_count"]; ?>
                            </div>
                        </div>

                    </a>

                    <?php endforeach; ?>

                </div>

            </div>


        </div>

    </main>

</div>


<?php include("Footer.php"); ?>
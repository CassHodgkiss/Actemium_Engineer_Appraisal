<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

    include("Database/Appraisals.php");

    include("../Functions/time_left.php");

    $appraisals_data = GetAppraisalsData();

    date_default_timezone_set("Europe/London");

?>


<div class="container">

    <main role="main" class="text-center py-5">

        <div class="border w-100">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-start">Appraisals</h3>

                <div class="my-auto mx-3">
                    <div class="input-group flex-end flex-row">
                        <select class="btn btn-green-border text-center px-2 py-2 w-100" id="option_select">
                            <option value="pending_appraisal" class="bg-white text-black text-start">Pending</option>
                            <option value="past_appraisal" class="bg-white text-black text-start">Finished</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="container">

                <div class="row row-cols-1 m-2">

                    <?php 

                    $pending_appraisals = []; 
                    
                    foreach($appraisals_data as $appraisal_data)
                    {
                            
                        $current_date = new DateTime("now");
                        $end_date = new DateTime($appraisal_data["date_due"]);
    
                        $appraisal_questions_done = GetAppraisalsAnswersData($appraisal_data["engineer_appraisal_id"]);

                        $appraisal_data["appraisal_questions_done"] = $appraisal_questions_done;
                        
                        $appraisal_data["has_past"] = FALSE;
                        $appraisal_data["overdue"] = FALSE;
                        
                        if($current_date > $end_date)
                        {
                            if($appraisal_questions_done == $appraisal_data["question_count"])
                            {
                                $appraisal_data["has_past"] = TRUE;
                            }
                            else
                            {
                                $appraisal_data["overdue"] = TRUE;
                            }
                        }

                        $pending_appraisals[] = $appraisal_data;

                    }
                                        
                    ?>

                    <?php if(count($pending_appraisals) == 0): ?>

                    <p class="m-3">You Currently have no Pending Appraisals</p>

                    <?php else: ?>

                    <?php foreach($pending_appraisals as $pending_appraisal): ?>

                    <?php $time_left = GetTimeLeft(new DateTime($pending_appraisal["date_due"])); ?>

                    <a href="Appraisal_Questions.php?id=<?php echo $pending_appraisal["engineer_appraisal_id"]; ?>"
                        class="col border my-2 p-0 text-decoration-none text-black <?php if($pending_appraisal["has_past"]) { echo "past_appraisal d-none"; } else { echo "pending_appraisal"; } ?>">

                        <div class="d-md-flex justify-content-between m-2 text-center text-md-start">

                            <div class="m-2">

                                <h2 class="h3"><?php echo $pending_appraisal["name"]; ?></h2>

                                <p class="my-2 ms-1">
                                    <?php echo $time_left; if($pending_appraisal["overdue"] || $pending_appraisal["has_past"]) { echo " Ago"; } else { echo " Left"; } ?>
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

                        <?php $percentage = ($pending_appraisal["appraisal_questions_done"]  / $pending_appraisal["question_count"]) * 100 ?>

                        <div class="progress mt-2 m-1" style="height: 20px;">
                            <div class="progress-bar <?php if($pending_appraisal["overdue"] && !$pending_appraisal["has_past"]) { echo "bg-danger"; } ?>"
                                role="progressbar" style="width: <?php echo $percentage; ?>%"
                                aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0"
                                aria-valuemax="<?php echo $pending_appraisal["question_count"]; ?>">
                                <?php echo $pending_appraisal["appraisal_questions_done"] ; ?>/<?php echo $pending_appraisal["question_count"]; ?>
                            </div>
                        </div>

                    </a>

                    <?php endforeach; ?>

                    <?php endif; ?>

                </div>

            </div>


        </div>

    </main>

</div>

<script>
document.getElementById('option_select').addEventListener('change', function() {

    var value = this.value;

    var pending_appraisals = document.getElementsByClassName("pending_appraisal");

    for (i = 0; i < pending_appraisals.length; i++) {
        pending_appraisals[i].classList.add("d-none");
    }

    var past_appraisals = document.getElementsByClassName("past_appraisal");

    for (i = 0; i < past_appraisals.length; i++) {
        past_appraisals[i].classList.add("d-none");
    }



    switch (value) {
        case "pending_appraisal":

            for (i = 0; i < pending_appraisals.length; i++) {
                pending_appraisals[i].classList.remove("d-none");
            }

            break;

        case "past_appraisal":

            for (i = 0; i < past_appraisals.length; i++) {
                past_appraisals[i].classList.remove("d-none");
            }

            break;
    }
});
</script>


<?php include("Footer.php"); ?>
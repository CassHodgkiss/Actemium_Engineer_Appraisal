<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Manager_Session.php");

    include("Database/Appraisals.php");

    include("../Functions/time_left.php");

    $pending_appraisals = GetTeamLeaderAppraisalsData();

    //https://www.geeksforgeeks.org/sort-a-multidimensional-array-by-date-element-in-php/
    
    function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1['date_due']);
        $datetime2 = strtotime($element2['date_due']);
        return $datetime1 - $datetime2;
    } 
    
    usort($pending_appraisals, 'date_compare');

?>


<div class="container">

    <main role="main" class="text-center py-5">

        <div class="border w-100">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-start">Team Leader Appraisals</h3>

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

                    <a href="Appraisal_Team_Leaders_Data.php?id=<?php echo $pending_appraisal["appraisal_id"]; ?>"
                        class="col border my-2 p-0 text-decoration-none text-black <?php if($is_past) { echo "past_appraisal d-none"; } else { echo "pending_appraisal"; } ?>">

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

                    </a>

                    <?php endforeach; ?>

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
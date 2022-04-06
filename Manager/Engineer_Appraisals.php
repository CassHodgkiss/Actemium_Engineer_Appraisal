<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Manager_Session.php");

    include("Database/Appraisals.php");

    include("../Functions/time_left.php");

    date_default_timezone_set("Europe/London");
    $current_date = new DateTime("now");

    $current_appraisals = [];
    $past_appraisals = [];
    foreach(GetEngineerAppraisalsData() as $appraisal)
    {
        $end_date = new DateTime($appraisal["date_due"]);
    
        if($end_date > $current_date) { $current_appraisals[] = $appraisal; }
        else { $past_appraisals[] = $appraisal; }
    }


    //https://www.geeksforgeeks.org/sort-a-multidimensional-array-by-date-element-in-php/
    
    function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1['date_due']);
        $datetime2 = strtotime($element2['date_due']);
        return $datetime1 - $datetime2;
    } 
    
    usort($current_appraisals, 'date_compare');
    usort($past_appraisals, 'date_compare');

?>


<div class="container">

    <main role="main" class="text-center py-5">

        <div class="border w-100">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-start">Engineer Appraisals</h3>

                <div class="my-auto mx-3">
                    <div class="input-group flex-end flex-row">
                        <select class="btn btn-green-border text-center px-2 py-2 w-100" id="option_select">
                            <option value="current_appraisal" class="bg-white text-black text-start">Pending</option>
                            <option value="past_appraisal" class="bg-white text-black text-start">Finished</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="container">

                <?php if(count($current_appraisals) == 0): ?>

                <div class="border m-2 p-2">There are Currently no Engineer Appraisals</div>

                <?php else: ?>

                <div class="row row-cols-1 m-2">

                    <?php foreach($current_appraisals as $current_appraisal): ?>
                    <?php $time_left = GetTimeLeft(new DateTime($current_appraisal["date_due"])); ?>

                    <a href="Appraisal_Engineers_Data.php?id=<?php echo $current_appraisal["appraisal_id"]; ?>"
                        class="col border my-2 p-0 text-decoration-none text-black current_appraisal">

                        <div class="d-md-flex justify-content-between m-2 text-center text-md-start">

                            <div class="m-2">

                                <h2 class="h3"><?php echo $current_appraisal["name"]; ?></h2>

                                <p class="my-2 ms-1">
                                    <?php echo $time_left . "Left"; ?>
                                </p>

                            </div>

                            <div class="mx-auto m-md-1 mt-3 mt-md-1 text-center" style="width: 250px">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">Start Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $current_appraisal["date_start"]?></p>

                                </div>

                                <hr class="m-1">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">End Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $current_appraisal["date_due"]; ?></p>

                                </div>

                            </div>

                        </div>

                    </a>

                    <?php endforeach; ?>

                    <?php foreach($past_appraisals as $past_appraisal): ?>


                    <a href="Appraisal_Engineers_Data.php?id=<?php echo $past_appraisal["appraisal_id"]; ?>"
                        class="col border my-2 p-0 text-decoration-none text-black past_appraisal d-none">

                        <div class="d-md-flex justify-content-between m-2 text-center text-md-start">

                            <div class="m-2">

                                <h2 class="h3"><?php echo $past_appraisal["name"]; ?></h2>

                                <p class="my-2 ms-1">
                                    <?php echo $time_left . " Ago"; ?>
                                </p>

                            </div>

                            <div class="mx-auto m-md-1 mt-3 mt-md-1 text-center" style="width: 250px">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">Start Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $past_appraisal["date_start"]?></p>

                                </div>

                                <hr class="m-1">

                                <div class="d-flex">

                                    <p class="m-0 w-50 p-2">End Date</p>
                                    <p class="m-0 w-50 p-2"><?php echo $past_appraisal["date_due"]; ?></p>

                                </div>

                            </div>

                        </div>

                    </a>

                    <?php endforeach; ?>

                </div>

                <?php endif; ?>

            </div>

        </div>

    </main>

</div>

<script>
document.getElementById('option_select').addEventListener('change', function() {

    var value = this.value;

    var current_appraisals = document.getElementsByClassName("current_appraisal");

    for (i = 0; i < current_appraisals.length; i++) {
        current_appraisals[i].classList.add("d-none");
    }

    var past_appraisals = document.getElementsByClassName("past_appraisal");

    for (i = 0; i < past_appraisals.length; i++) {
        past_appraisals[i].classList.add("d-none");
    }



    switch (value) {
        case "current_appraisal":

            for (i = 0; i < current_appraisals.length; i++) {
                current_appraisals[i].classList.remove("d-none");
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
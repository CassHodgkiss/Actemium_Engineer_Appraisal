<?php

    $title = "Team Leader Dashboard | Actemium";
    include("Header.php");

    include("../Session/Manager_Session.php");

    include("Database/Manager_Data.php");

    $manager = GetManagerData();

    include("Database/Appraisals.php");

    include("../Functions/time_left.php");

    $e_appraisals = GetEngineerAppraisalsData();
    $tl_appraisals = GetTeamLeaderAppraisalsData();

    date_default_timezone_set("Europe/London");
    $current_date = new DateTime("now");

    $engineer_appraisals = [];
    foreach($e_appraisals as $e_appraisal)
    {
        $end_date = new DateTime($e_appraisal["date_due"]);
        
        if($end_date < $current_date) { continue; }

        $engineer_appraisals[] = $e_appraisal;
    }

    $team_leader_appraisals = [];
    foreach($tl_appraisals as $tl_appraisal)
    {
        $end_date = new DateTime($tl_appraisal["date_due"]);
        
        if($end_date < $current_date) { continue; }

        $team_leader_appraisals[] = $tl_appraisal;
    }

    function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1['date_due']);
        $datetime2 = strtotime($element2['date_due']);
        return $datetime1 - $datetime2;
    } 
    
    usort($engineer_appraisals, 'date_compare');
    usort($team_leader_appraisals, 'date_compare');

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
                                    src="<?php echo "Database/Manager_Pfp.php?id=" . $username ?>"
                                    alt="Your Pfp Picture">
                            </div>

                            <div class="col-lg-8">

                                <div class="card-body p-0">

                                    <div class="card-header bg-white border-0">
                                        <h3 class="m-1 p-1 text-white bg-blue rounded">
                                            <?php echo $manager["first_name"] . " " . $manager["last_name"]; ?>
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
                                            <p class="m-0 w-50 p-2">Manager</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="col my-4">

                    <div class="row row-cols-1 row-cols-lg-2 g-2 text-start">

                        <div class="col">

                            <div class="container border">

                                <div class="p-3 row align-items-center">

                                    <div class="col-1 col-lg-2 p-0">
                                        <img src="../bootstrap-icons\exclamation-circle.svg" aria-hidden="true"
                                            class="img-fluid w-100 p-1">
                                    </div>

                                    <p class="m-0 h5 col-9 col-lg-8">Engineer Apraisals</p>

                                    <span
                                        class="badge bg-secondary col-2 p-2 rounded-pill"><?php echo count($engineer_appraisals); ?></span>

                                </div>

                            </div>

                        </div>

                        <div class="col">

                            <div class="container border">

                                <div class="p-3 row align-items-center">

                                    <div class="col-1 col-lg-2 p-0">
                                        <img src="../bootstrap-icons\exclamation-triangle-fill.svg" aria-hidden="true"
                                            class="img-fluid w-100 p-1">
                                    </div>

                                    <p class="m-0 h5 col-9 col-lg-8">Team Leader Appraisals</p>

                                    <span
                                        class="badge bg-secondary col-2 p-2 rounded-pill"><?php echo count($team_leader_appraisals); ?></span>

                                </div>
                            </div>

                        </div>

                    </div>

                </section>

                <section class="col mb-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">Pending Team Leader Appraisals</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 mb-0 pending_overflow_items overflow-auto"
                            id="teamAppraisals">

                            <?php foreach($team_leader_appraisals as $team_leader_appraisal): ?>

                            <?php  
                            date_default_timezone_set("Europe/London");
                            $current_date = new DateTime("now");
                            $end_date = new DateTime($team_leader_appraisal["date_due"]);
                            
                            if($end_date < $current_date) { continue; }
                            ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header"
                                    id="teamHeading<?php echo $team_leader_appraisal["appraisal_id"]; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#teamAppraisals<?php echo $team_leader_appraisal["appraisal_id"]; ?>"
                                        aria-expanded="false"
                                        aria-controls="teamAppraisals<?php echo $team_leader_appraisal["appraisal_id"]; ?>">

                                        <img src="../bootstrap-icons\chat-square-dots.svg"
                                            class="img-fluid icon_svg me-2">
                                        Appraisal Set for

                                        <?php echo (new DateTime($team_leader_appraisal["date_due"]))->format('d M Y');?>

                                    </button>

                                </h2>
                                <div id="teamAppraisals<?php echo $team_leader_appraisal["appraisal_id"]; ?>"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="teamHeading<?php echo $team_leader_appraisal["appraisal_id"]; ?>">

                                    <div class="accordion-body">

                                        <h4><?php echo $team_leader_appraisal["name"]; ?></h4>

                                        <p class="m-1 mt-3">Set on
                                            <?php echo (new DateTime($team_leader_appraisal["date_start"]))->format('d M Y'); ?>
                                        </p>
                                        <p class="m-1 mt-1">Due for
                                            <?php echo (new DateTime($team_leader_appraisal["date_due"]))->format('d M Y'); ?>
                                        </p>

                                        <a href="Appraisal_Team_Leaders_Data.php?id=<?php echo $team_leader_appraisal["appraisal_id"]; ?>"
                                            class="btn m-auto mt-3 w-75 d-block">View Appraisal</a>

                                    </div>

                                </div>

                            </div>

                            <?php endforeach; ?>

                        </div>

                        <a href="Team_Leader_Appraisals.php" class="btn btn-lg m-3 w-50 mx-auto">View All Appraisals</a>

                    </div>

                </section>

            </div>


            <div class="col row-cols-1 mt-4 mt-lg-0">

                <section class="col mb-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">Pending Engineer Appraisals</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 mb-0 pending_overflow_items overflow-auto"
                            id="engineerAppraisals">

                            <?php foreach($engineer_appraisals as $engineer_appraisal): ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header"
                                    id="engineerHeading<?php echo $engineer_appraisal["appraisal_id"]; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#engineerAppraisals<?php echo $engineer_appraisal["appraisal_id"]; ?>"
                                        aria-expanded="false"
                                        aria-controls="engineerAppraisals<?php echo $engineer_appraisal["appraisal_id"]; ?>">

                                        <img src="../bootstrap-icons\chat-square-dots.svg"
                                            class="img-fluid icon_svg me-2">
                                        Appraisal Set for

                                        <?php echo (new DateTime($engineer_appraisal["date_due"]))->format('d M Y');?>

                                    </button>

                                </h2>
                                <div id="engineerAppraisals<?php echo $engineer_appraisal["appraisal_id"]; ?>"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="engineerHeading<?php echo $engineer_appraisal["appraisal_id"]; ?>">

                                    <div class="accordion-body">

                                        <h4><?php echo $engineer_appraisal["name"]; ?></h4>

                                        <p class="m-1 mt-3">Set on
                                            <?php echo (new DateTime($engineer_appraisal["date_start"]))->format('d M Y'); ?>
                                        </p>
                                        <p class="m-1 mt-1">Due for
                                            <?php echo (new DateTime($engineer_appraisal["date_due"]))->format('d M Y'); ?>
                                        </p>

                                        <a href="Appraisal_Engineers_Data.php?id=<?php echo $engineer_appraisal["appraisal_id"]; ?>"
                                            class="btn m-auto mt-3 w-75 d-block ">View Appraisal</a>

                                    </div>

                                </div>

                            </div>

                            <?php endforeach; ?>

                        </div>

                        <a href="Engineer_Appraisals.php" class="btn btn-lg m-3 w-50 mx-auto">View All Appraisals</a>

                    </div>

                </section>

            </div>

        </div>

    </main>

</div>

<?php include("Footer.php"); ?>
<?php

    $title = "Engineer Dashboard | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

    include("Database/Engineer_Data.php");

    $engineer = GetEngineerData();
    
    include("Database/Appraisals.php");

    include("Database/time_left.php");

    $appraisals_data = GetAppraisalsData();

    date_default_timezone_set("Europe/London");
    $current_date = new DateTime("now");

    $appraisals_count = 0;
    $overdue_count = 0;

    foreach($appraisals_data as $appraisal_data){
        $start_date = new DateTime($appraisal_data["date_start"]);
        $end_date = new DateTime($appraisal_data["date_due"]);

        $has_completed = FALSE;
        if(GetAppraisalsAnswersData($appraisal_data["engineer_appraisal_id"]) == $appraisal_data["question_count"]) { $has_completed = TRUE; }
        
        if($current_date > $start_date && $current_date < $end_date & !$has_completed) { $appraisals_count++; }
        if($current_date > $start_date && $current_date > $end_date & !$has_completed) { $overdue_count++; }
    }

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
                                    src="<?php echo "Database/Engineer_Pfp.php?id=" . $username ?>"
                                    alt="Your Pfp Picture">
                            </div>

                            <div class="col-lg-8">

                                <div class="card-body p-0">

                                    <div class="card-header bg-white border-0">
                                        <h3 class="m-1 p-1 text-white bg-blue rounded">
                                            <?php echo $engineer["first_name"] . " " . $engineer["last_name"]; ?></h3>
                                    </div>

                                    <div class=" m-1">

                                        <div class="d-flex">

                                            <p class="m-0 w-50 p-2">Username</p>
                                            <p class="m-0 w-50 p-2"><?php echo $username; ?></p>

                                        </div>

                                        <hr class="m-1 mx-4">

                                        <div class="d-flex">

                                            <p class="m-0 w-50 p-2">Occupation</p>
                                            <p class="m-0 w-50 p-2">Engineer</p>

                                        </div>

                                        <hr class="m-1 mx-4">

                                        <div class="d-flex">

                                            <p class="m-0 w-50 p-2">Team Leader</p>
                                            <p class="m-0 w-50 p-2"><?php echo $engineer["team_leader_username"]; ?></p>

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

                                    <p class="m-0 h5 col-9 col-lg-8">Pending Apraisals</p>

                                    <span
                                        class="badge bg-secondary col-2 p-2 rounded-pill"><?php echo $appraisals_count; ?></span>

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

                                    <p class="m-0 h5 col-9 col-lg-8">Overdue Appraisals</p>

                                    <span
                                        class="badge bg-secondary col-2 p-2 rounded-pill"><?php echo $overdue_count; ?></span>

                                </div>
                            </div>

                        </div>


                        <div class="col">

                            <div class="container border">

                                <div class="p-3 row align-items-center">

                                    <div class="col-1 col-lg-2 p-0">

                                        <img src="../bootstrap-icons\chat-square-dots.svg" aria-hidden="true"
                                            class="img-fluid w-100 p-1">

                                    </div>

                                    <p class="m-0 h5 col-9 col-lg-8">Team Targets</p>

                                    <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

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

                                    <p class="m-0 h5 col-9 col-lg-8">Overdue Team Targets</p>

                                    <span class="badge bg-secondary col-2 p-2 rounded-pill">1</span>

                                </div>

                            </div>

                        </div>


                        <div class="col">

                            <div class="container border">

                                <div class="p-3 row align-items-center">

                                    <div class="col-1 col-lg-2 p-0">

                                        <img src="../bootstrap-icons\question-circle.svg" aria-hidden="true"
                                            class="img-fluid w-100 p-1">

                                    </div>

                                    <p class="m-0 h5 col-9 col-lg-8">Additional Questions</p>

                                    <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

                                </div>

                            </div>

                        </div>

                        <div class="col">

                            <div class="container border">

                                <div class="p-3 row align-items-center">

                                    <div class="col-1 col-lg-2 p-0">

                                        <img src="../bootstrap-icons\list-ul.svg" aria-hidden="true"
                                            class="img-fluid w-100 p-1">

                                    </div>

                                    <p class="m-0 h5 col-9 col-lg-8">To-Do</p>

                                    <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="col mt-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">Additional Questions</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 pending_overflow_items overflow-auto"
                            id="additionalQuestions">

                            <?php for($i = 0; $i < 10; $i++): ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header" id="additionalQuestionsHeading<?php echo $i; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#additionalQuestionsCollapse<?php echo $i; ?>"
                                        aria-expanded="false"
                                        aria-controls="additionalQuestionsCollapse<?php echo $i; ?>">
                                        <img src="../bootstrap-icons\exclamation-circle.svg" alt="Warning Overdue"
                                            class="img-fluid icon_svg me-2">
                                        Additional Question From Caj2
                                    </button>

                                </h2>
                                <div id="additionalQuestionsCollapse<?php echo $i; ?>"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="additionalQuestionsHeading<?php echo $i; ?>">

                                    <div class="accordion-body">

                                        <form>
                                            <label for="answer<?php echo $i; ?>" class="form-label">Lorem ipsum dolor
                                                sit amet consectetur adipisicing elit. Sunt?</label>
                                            <textarea class="form-control mt-2" id="answer<?php echo $i; ?>"
                                                rows="2"></textarea>
                                            <button type="submit" name="additional_questions"
                                                id="answer<?php echo $i; ?>"
                                                class="btn mt-3 w-75 mx-auto d-block">Submit</button>
                                        </form>

                                    </div>

                                </div>

                            </div>

                            <?php endfor; ?>

                        </div>

                    </div>

                </section>

            </div>


            <div class="col row-cols-1 mt-4 mt-lg-0">

                <section class="col mb-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">Pending Appraisals</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 mb-0 pending_overflow_items overflow-auto"
                            id="pendingAppraisals">

                            <?php 
                            foreach($appraisals_data as $appraisal_data): 
                            $appraisal_questions_done = GetAppraisalsAnswersData($appraisal_data["engineer_appraisal_id"]); 
                            $percentage = ($appraisal_questions_done / $appraisal_data["question_count"]) * 100 
                            ?>

                            <?php  
                            date_default_timezone_set("Europe/London");
                            $current_date = new DateTime("now");
                            $end_date = new DateTime($appraisal_data["date_due"]);

                            if( $current_date < $end_date) 
                            { 
                                $overdue = FALSE; 
                            } 
                            else 
                            { 
                                if($appraisal_questions_done == $appraisal_data["question_count"])
                                {
                                    continue;
                                }

                                $overdue = TRUE; 
                            }
                            ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header"
                                    id="appraisalsHeading<?php echo $appraisal_data["engineer_appraisal_id"]; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#appraisalsCollapse<?php echo $appraisal_data["engineer_appraisal_id"]; ?>"
                                        aria-expanded="false"
                                        aria-controls="appraisalsCollapse<?php echo $appraisal_data["engineer_appraisal_id"]; ?>">

                                        <img src="../bootstrap-icons\<?php 
                                        
                                        if($appraisal_questions_done == $appraisal_data["question_count"])
                                        {
                                            echo "check-circle.svg"; 
                                        }
                                        else
                                        {
                                            if($overdue) 
                                            { 
                                                echo "exclamation-triangle-fill.svg"; 
                                            } 
                                            else 
                                            { 
                                                echo "exclamation-circle.svg"; 
                                            } 
                                        }
                                        ?>" alt="Warning Overdue" class="img-fluid icon_svg me-2">
                                        Appraisal <?php if($overdue) { echo "Overdue"; } else { echo "Due"; } ?> for

                                        <?php echo (new DateTime($appraisal_data["date_due"]))->format('d M Y');?>

                                    </button>

                                </h2>
                                <div id="appraisalsCollapse<?php echo $appraisal_data["engineer_appraisal_id"]; ?>"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="appraisalsHeading<?php echo $appraisal_data["engineer_appraisal_id"]; ?>">

                                    <div class="accordion-body">

                                        <h4><?php echo $appraisal_data["name"]; ?></h4>

                                        <p class="m-1 mt-3">Set on
                                            <?php echo (new DateTime($appraisal_data["date_start"]))->format('d M Y'); ?>
                                        </p>
                                        <p class="m-1 mt-1">Due for
                                            <?php echo (new DateTime($appraisal_data["date_due"]))->format('d M Y'); ?>
                                        </p>

                                        <div class="progress mt-2 m-1" style="height: 20px;">
                                            <div class="progress-bar <?php if($overdue) { echo "bg-danger"; } ?>"
                                                role="progressbar" style="width: <?php echo $percentage; ?>%"
                                                aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0"
                                                aria-valuemax="<?php echo $appraisal_data["question_count"]; ?>">
                                                <?php echo $appraisal_questions_done; ?>/<?php echo $appraisal_data["question_count"]; ?>
                                            </div>
                                        </div>

                                        <a href="Appraisal_Questions.php?id=<?php echo $appraisal_data["engineer_appraisal_id"]; ?>"
                                            class="btn  btn m-auto mt-3 w-75 d-block ">View Appraisal</a>

                                    </div>

                                </div>

                            </div>

                            <?php endforeach; ?>

                        </div>

                        <a href="Appraisals.php" class="btn  btn-lg m-3 w-50 mx-auto ">View All Appraisals</a>

                    </div>

                </section>


                <section class="col my-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">Team Targets</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 pending_overflow_items overflow-auto"
                            id="teamTargets">

                            <?php for($i = 0; $i < 10; $i++): ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header" id="teamTargetsHeading<?php echo $i; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#teamTargetsCollapse<?php echo $i; ?>" aria-expanded="false"
                                        aria-controls="teamTargetsCollapseCollapse<?php echo $i; ?>">
                                        <img src="../bootstrap-icons\exclamation-triangle-fill.svg"
                                            alt="Warning Overdue" class="img-fluid icon_svg me-2">
                                        Team Target Overdue for 01 January 2022
                                    </button>

                                </h2>
                                <div id="teamTargetsCollapse<?php echo $i; ?>" class="accordion-collapse collapse"
                                    aria-labelledby="teamTargetsHeading<?php echo $i; ?>">

                                    <div class="accordion-body">

                                        <h4>7 Weeks of Training in HTML</h4>

                                        <p class="m-1 mt-3">Set on 01 January 2022</p>
                                        <p class="m-1 mt-1">Due for 01 March 2022</p>

                                        <p class="m-1 mt-3 text-center" id="slider<?php $i; ?>">0</p>

                                        <!-- https://mdbootstrap.com/snippets/jquery/mdbootstrap/921605#html-tab-view -->

                                        <form class="range-field slidercontainer w-100 mx-auto mt-1">

                                            <div class="d-flex justify-content-evenly">
                                                <span class="font-weight-bold indigo-text m-0 h5">0</span>
                                                <input class="border-0 w-75 slider m-2" type="range" value="0" min="0"
                                                    max="7"
                                                    oninput="document.getElementById('slider<?php $i; ?>').innerHTML = this.value">
                                                <span class="font-weight-bold indigo-text m-0 h5">7</span>
                                            </div>

                                            <button class="btn  btn m-auto mt-3 w-75  d-block">Update Progress</button>
                                        </form>

                                    </div>

                                </div>

                            </div>

                            <?php endfor; ?>

                        </div>

                    </div>

                </section>


                <section class="col mt-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">To-Do List</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 pending_overflow_items overflow-auto"
                            id="pendingAppraisals">

                            <?php for($i = 0; $i < 10; $i++): ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header" id="todoHeading<?php echo $i; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#todoCollapse<?php echo $i; ?>" aria-expanded="false"
                                        aria-controls="todoCollapse<?php echo $i; ?>">
                                        <img src="../bootstrap-icons\exclamation-triangle-fill.svg"
                                            alt="Warning Overdue" class="img-fluid icon_svg me-2">
                                        Goal Made 01 January 2022
                                    </button>

                                </h2>
                                <div id="todoCollapse<?php echo $i; ?>" class="accordion-collapse collapse"
                                    aria-labelledby="todoHeading<?php echo $i; ?>">

                                    <div class="accordion-body">

                                        <h4>Do Appraisals Today</h4>

                                        <p class="m-1 mt-3">Set on 01 January 2022</p>

                                        <form>
                                            <button type="submit" name="todo" id="todo<?php echo $i; ?>"
                                                class="btn  mt-3 w-75 mx-auto  d-block">Set Complete</button>
                                        </form>

                                    </div>

                                </div>

                            </div>

                            <?php endfor; ?>

                        </div>

                    </div>

                </section>

            </div>

        </div>

    </main>

</div>

<?php include("Footer.php"); ?>
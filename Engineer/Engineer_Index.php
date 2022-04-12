<?php

    $title = "Engineer Dashboard | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

    include("Database/Engineer_Data.php");

    $engineer = GetEngineerData();
    
    include("Database/Appraisals.php");

    include("../Functions/time_left.php");

    $path = "Engineer_Index.php";

    include("Database/Targets.php");
    include("Database/Todo.php");
    
    if(isset($_POST["targetbasic"]))
    {
        $target_id = $_POST["targetbasic"];

        SetTargetComplete($target_id);

    }

    if(isset($_POST["targetslider"]))
    {
        $target_id = $_POST["targetslider"];
        $progress = $_POST["slider"];

        UpdateTargetProgress($target_id, $progress);

        unset($_POST["targetslider"]);
    }

    if(isset($_POST["todobasic"]))
    {
        $todo_id = $_POST["todobasic"];

        SetToDoComplete($todo_id);

    }

    if(isset($_POST["todoslider"]))
    {
        $todo_id = $_POST["todoslider"];
        $progress = $_POST["slider"];

        UpdateToDoProgress($todo_id, $progress);

        unset($_POST["todoslider"]);
    }

    $appraisals_data = GetAppraisalsData();

    date_default_timezone_set("Europe/London");
    $current_date = new DateTime("now");

    $overdue_count = 0;

    foreach($appraisals_data as $appraisal_data){
        $start_date = new DateTime($appraisal_data["date_start"]);
        $end_date = new DateTime($appraisal_data["date_due"]);

        $has_completed = FALSE;
        if(GetAppraisalsAnswersData($appraisal_data["engineer_appraisal_id"]) == $appraisal_data["question_count"]) { $has_completed = TRUE; }
        
        if($has_completed && $current_date > $end_date) { continue; }

        if($current_date > $start_date && $current_date > $end_date & !$has_completed) { $overdue_count++; }
    }

    $targets = GetTargets();

    $pending_targets = []; 
    $overdue_targets = [];        
    foreach($targets as $target)
    {
        $end_date = new DateTime($target["date_due"]);

        switch($target["target_type"])
        {
            case 0:

                if(!$target["progress"])
                {
                    if($current_date > $end_date) { $overdue_targets[] = $target; }
                    else { $pending_targets[] = $target; }
                }

                break;
            case 1:

                $target_data = explode("|", $target["target_data"]);

                if($target["progress"] < $target_data[2])
                {
                    if($current_date > $end_date) { $overdue_targets[] = $target; }
                    else { $pending_targets[] = $target; }
                }
                
                break;
        }
    }

    $todos = GetToDo();

    $pending_todos = []; 
    $overdue_todos = [];        
    foreach($todos as $todo)
    {
        $end_date = new DateTime($todo["date_due"]);

        switch($todo["todo_type"])
        {
            case 0:

                if(!$todo["progress"])
                {
                    if($current_date > $end_date) { $overdue_todos[] = $todo; }
                    else { $pending_todos[] = $todo; }
                }

                break;
            case 1:

                $todo_data = explode("|", $todo["todo_data"]);

                if($todo["progress"] < $todo_data[2])
                {
                    if($current_date > $end_date) { $overdue_todos[] = $todo; }
                    else { $pending_todos[] = $todo; }
                }
                
                break;
        }
    }

    function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1['date_due']);
        $datetime2 = strtotime($element2['date_due']);
        return $datetime1 - $datetime2;
    } 
    
    usort($appraisals_data, 'date_compare');
    usort($pending_targets, 'date_compare');
    usort($overdue_targets, 'date_compare');
    usort($pending_todos, 'date_compare');
    usort($overdue_todos, 'date_compare');

?>

<div class="container">

    <main role="main" class="text-center py-5">

        <div class="row row-cols-1 row-cols-lg-2">

            <div class="col row-cols-1">

                <section class="col mb-4">

                    <div class="card">

                        <div class="row g-0">

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

                                    <p class="m-0 h5 col-9 col-lg-8">Apraisals</p>

                                    <span
                                        class="badge bg-secondary col-2 p-2 rounded-pill"><?php echo count($appraisals_data); ?></span>

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

                                    <span
                                        class="badge bg-secondary col-2 p-2 rounded-pill"><?php echo count($pending_targets); ?></span>

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

                                    <span
                                        class="badge bg-secondary col-2 p-2 rounded-pill"><?php echo count($overdue_targets); ?></span>

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

                        <div class="col">

                            <div class="container border">

                                <div class="p-3 row align-items-center">

                                    <div class="col-1 col-lg-2 p-0">

                                        <img src="../bootstrap-icons\list-ul.svg" aria-hidden="true"
                                            class="img-fluid w-100 p-1">

                                    </div>

                                    <p class="m-0 h5 col-9 col-lg-8">Overdue To-Do</p>

                                    <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="col my-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">To-Do List</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 pending_overflow_items overflow-auto"
                            id="Todos">

                            <?php for($i = 0; $i < count($overdue_todos); $i++): ?>

                            <?php $overdue_todo = $overdue_todos[$i]; ?>

                            <?php 
                            
                            switch($overdue_todo["todo_type"])
                            {
                                case 0:
                                    $todo = $overdue_todo["todo_data"];
                                    break;
                                case 1:
                                    $todo_data = explode("|", $overdue_todo["todo_data"]);
                                    $todo = $todo_data[0];
                                    break;
                            }

                            ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header" id="overdueTodosHeading<?php echo $i; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#overdueTodosCollapse<?php echo $i; ?>" aria-expanded="false"
                                        aria-controls="overdueTodosCollapse<?php echo $i; ?>">
                                        <img src="../bootstrap-icons\exclamation-triangle-fill.svg"
                                            alt="Warning Overdue" class="img-fluid icon_svg me-2">
                                        Objective set for
                                        <?php echo (new DateTime($overdue_todo["date_due"]))->format('d M Y'); ?>
                                    </button>

                                </h2>
                                <div id="overdueTodosCollapse<?php echo $i; ?>" class="accordion-collapse collapse"
                                    aria-labelledby="overdueTodosHeading<?php echo $i; ?>">

                                    <div class="accordion-body">

                                        <h4><?php echo $todo; ?></h4>

                                        <p class="m-1 mt-1">Due for
                                            <?php echo (new DateTime($overdue_todo["date_due"]))->format('d M Y'); ?>
                                        </p>

                                        <?php 
                                        switch($overdue_todo["todo_type"]):
                                        case 0: 
                                        ?>

                                        <form method="post" class="mx-auto mt-1">

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit" name="todobasic"
                                                value="<?php echo $overdue_todo["todo_id"]; ?>">Set
                                                Complete</button>

                                        </form>

                                        <?php break; ?>
                                        <?php case 1: ?>

                                        <form method="post" class="range-field slidercontainer w-100 mx-auto mt-1">

                                            <p class="m-1 mt-3 text-center" id="overduetodoslider<?php echo $i; ?>">
                                                <?php echo $overdue_todo["progress"]; ?>
                                            </p>

                                            <div class="d-flex justify-content-evenly">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $todo_data[1]; ?></span>
                                                <input class="border-0 w-75 slider m-2" type="range" name="slider"
                                                    value="<?php echo $overdue_todo["progress"]; ?>"
                                                    min="<?php echo $todo_data[1]; ?>"
                                                    max="<?php echo $todo_data[2]; ?>"
                                                    oninput="document.getElementById('overduetodoslider<?php echo $i; ?>').innerHTML = this.value">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $todo_data[2]; ?></span>
                                            </div>

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit" name="todoslider"
                                                value="<?php echo $overdue_todo["todo_id"]; ?>">Update
                                                Progress</button>

                                        </form>

                                        <?php break; ?>

                                        <?php endswitch; ?>

                                    </div>

                                </div>

                            </div>

                            <?php endfor; ?>


                            <?php for($i = 0; $i < count($pending_todos); $i++): ?>

                            <?php $pending_todo = $pending_todos[$i]; ?>

                            <?php 
                            
                            switch($pending_todo["todo_type"])
                            {
                                case 0:
                                    $todo = $pending_todo["todo_data"];
                                    break;
                                case 1:
                                    $todo_data = explode("|", $pending_todo["todo_data"]);
                                    $todo = $todo_data[0];
                                    break;
                            }

                            ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header" id="TodosHeading<?php echo $i; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#TodosCollapse<?php echo $i; ?>" aria-expanded="false"
                                        aria-controls="TodosCollapse<?php echo $i; ?>">
                                        <img src="../bootstrap-icons\chat-square-dots.svg" alt="Warning Overdue"
                                            class="img-fluid icon_svg me-2">
                                        Objective set for
                                        <?php echo (new DateTime($pending_todo["date_due"]))->format('d M Y'); ?>
                                    </button>

                                </h2>
                                <div id="TodosCollapse<?php echo $i; ?>" class="accordion-collapse collapse"
                                    aria-labelledby="TodosHeading<?php echo $i; ?>">

                                    <div class="accordion-body">

                                        <h4><?php echo $todo; ?></h4>

                                        <p class="m-1 mt-1">
                                            Set for <?php echo $pending_todo["engineer_username"]; ?>
                                        </p>

                                        <p class="m-1 mt-1">Due for
                                            <?php echo (new DateTime($pending_todo["date_due"]))->format('d M Y'); ?>
                                        </p>

                                        <?php 
                                        switch($pending_todo["todo_type"]):
                                        case 0: 
                                        ?>

                                        <form method="post" class="mx-auto mt-1">

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit" name="todobasic"
                                                value="<?php echo $pending_todo["todo_id"]; ?>">Set
                                                Complete</button>

                                        </form>

                                        <?php break; ?>
                                        <?php case 1: ?>

                                        <form method="post" class="range-field slidercontainer w-100 mx-auto mt-1">

                                            <p class="m-1 mt-3 text-center" id="pendingtodoslider<?php echo $i; ?>">
                                                <?php echo $pending_todo["progress"]; ?>
                                            </p>

                                            <div class="d-flex justify-content-evenly">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $todo_data[1]; ?></span>
                                                <input class="border-0 w-75 slider m-2" type="range" name="slider"
                                                    value="<?php echo $pending_todo["progress"]; ?>"
                                                    min="<?php echo $todo_data[1]; ?>"
                                                    max="<?php echo $todo_data[2]; ?>"
                                                    oninput="document.getElementById('pendingtodoslider<?php echo $i; ?>').innerHTML = this.value">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $todo_data[2]; ?></span>
                                            </div>

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit" name="todoslider"
                                                value="<?php echo $pending_todo["todo_id"]; ?>">Update
                                                Progress</button>

                                        </form>

                                        <?php break; ?>

                                        <?php endswitch; ?>

                                    </div>

                                </div>

                            </div>

                            <?php endfor; ?>

                        </div>

                        <a href="Set_Objective.php" class="btn m-3 w-50 mx-auto ">Add Objective</a>

                    </div>

                </section>

            </div>


            <div class="col row-cols-1 mt-4 mt-lg-0">

                <section class="col mb-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">Appraisals</h3>

                        </div>

                        <?php if(count($appraisals_data) == 0): ?>

                        <div class="border m-2 p-2">There are Currently no Pending Appraisals</div>

                        <?php else: ?>

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
                                            class="btn m-auto mt-3 w-75 d-block">View Appraisal</a>

                                    </div>

                                </div>

                            </div>

                            <?php endforeach; ?>

                        </div>

                        <?php endif; ?>

                        <a href="Appraisals.php" class="btn m-3 w-50 mx-auto ">View All Appraisals</a>

                    </div>

                </section>

                <section class="col my-4">

                    <div class="card text-black">

                        <div class="card-header bg-white border-0">

                            <h3 class="m-1 p-1 text-white bg-blue rounded">Targets</h3>

                        </div>

                        <div class="accordion accordion-flush border text-start m-3 pending_overflow_items overflow-auto"
                            id="teamTargets">

                            <?php for($i = 0; $i < count($overdue_targets); $i++): ?>

                            <?php $overdue_target = $overdue_targets[$i]; ?>

                            <?php 

                            switch($overdue_target["target_type"])
                            {
                                case 0:
                                    $target = $overdue_target["target_data"];
                                    break;
                                case 1:
                                    $target_data = explode("|", $overdue_target["target_data"]);
                                    $target = $target_data[0];
                                    break;
                            }

                            ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header" id="overdueteamTargetsHeading<?php echo $i; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#overdueteamTargetsCollapse<?php echo $i; ?>"
                                        aria-expanded="false"
                                        aria-controls="overdueteamTargetsCollapse<?php echo $i; ?>">
                                        <img src="../bootstrap-icons\exclamation-triangle-fill.svg"
                                            alt="Warning Overdue" class="img-fluid icon_svg me-2">
                                        Target set for
                                        <?php echo (new DateTime($overdue_target["date_due"]))->format('d M Y'); ?>
                                    </button>

                                </h2>
                                <div id="overdueteamTargetsCollapse<?php echo $i; ?>"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="overdueteamTargetsHeading<?php echo $i; ?>">

                                    <div class="accordion-body">

                                        <h4><?php echo $target; ?></h4>

                                        <p class="m-1 mt-1">Due for
                                            <?php echo (new DateTime($overdue_target["date_due"]))->format('d M Y'); ?>
                                        </p>

                                        <?php 
                                        switch($overdue_target["target_type"]):
                                        case 0: 
                                        ?>

                                        <form method="post" class="mx-auto mt-1">

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit"
                                                name="targetbasic"
                                                value="<?php echo $overdue_target["target_id"]; ?>">Set
                                                Complete</button>

                                        </form>

                                        <?php break; ?>
                                        <?php case 1: ?>

                                        <form method="post" class="range-field slidercontainer w-100 mx-auto mt-1">

                                            <p class="m-1 mt-3 text-center" id="overduetargetslider<?php echo $i; ?>">
                                                <?php echo $overdue_target["progress"]; ?>
                                            </p>

                                            <div class="d-flex justify-content-evenly">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $target_data[1]; ?></span>
                                                <input class="border-0 w-75 slider m-2" type="range" name="slider"
                                                    value="<?php echo $overdue_target["progress"]; ?>"
                                                    min="<?php echo $target_data[1]; ?>"
                                                    max="<?php echo $target_data[2]; ?>"
                                                    oninput="document.getElementById('overduetargetslider<?php echo $i; ?>').innerHTML = this.value">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $target_data[2]; ?></span>
                                            </div>

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit"
                                                name="targetslider"
                                                value="<?php echo $overdue_target["target_id"]; ?>">Update
                                                Progress</button>

                                        </form>

                                        <?php break; ?>

                                        <?php endswitch; ?>

                                    </div>

                                </div>

                            </div>

                            <?php endfor; ?>


                            <?php for($i = 0; $i < count($pending_targets); $i++): ?>

                            <?php $pending_target = $pending_targets[$i]; ?>

                            <?php 
                            
                            switch($pending_target["target_type"])
                            {
                                case 0:
                                    $target = $pending_target["target_data"];
                                    break;
                                case 1:
                                    $target_data = explode("|", $pending_target["target_data"]);
                                    $target = $target_data[0];
                                    break;
                            }

                            ?>

                            <div class="accordion-item border m-2">

                                <h2 class="accordion-header" id="teamTargetsHeading<?php echo $i; ?>">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#teamTargetsCollapse<?php echo $i; ?>" aria-expanded="false"
                                        aria-controls="teamTargetsCollapse<?php echo $i; ?>">
                                        <img src="../bootstrap-icons\chat-square-dots.svg" alt="Warning Overdue"
                                            class="img-fluid icon_svg me-2">
                                        Target set for
                                        <?php echo (new DateTime($pending_target["date_due"]))->format('d M Y'); ?>
                                    </button>

                                </h2>
                                <div id="teamTargetsCollapse<?php echo $i; ?>" class="accordion-collapse collapse"
                                    aria-labelledby="teamTargetsHeading<?php echo $i; ?>">

                                    <div class="accordion-body">

                                        <h4><?php echo $target; ?></h4>

                                        <p class="m-1 mt-1">
                                            Set for <?php echo $pending_target["engineer_username"]; ?>
                                        </p>

                                        <p class="m-1 mt-1">Due for
                                            <?php echo (new DateTime($pending_target["date_due"]))->format('d M Y'); ?>
                                        </p>

                                        <?php 
                                        switch($pending_target["target_type"]):
                                        case 0: 
                                        ?>

                                        <form method="post" class="mx-auto mt-1">

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit"
                                                name="targetbasic"
                                                value="<?php echo $pending_target["target_id"]; ?>">Set
                                                Complete</button>

                                        </form>

                                        <?php break; ?>
                                        <?php case 1: ?>

                                        <form method="post" class="range-field slidercontainer w-100 mx-auto mt-1">

                                            <p class="m-1 mt-3 text-center" id="pendingtargetslider<?php echo $i; ?>">
                                                <?php echo $pending_target["progress"]; ?>
                                            </p>

                                            <div class="d-flex justify-content-evenly">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $target_data[1]; ?></span>
                                                <input class="border-0 w-75 slider m-2" type="range" name="slider"
                                                    value="<?php echo $pending_target["progress"]; ?>"
                                                    min="<?php echo $target_data[1]; ?>"
                                                    max="<?php echo $target_data[2]; ?>"
                                                    oninput="document.getElementById('pendingtargetslider<?php echo $i; ?>').innerHTML = this.value">
                                                <span
                                                    class="font-weight-bold indigo-text m-0 h5"><?php echo $target_data[2]; ?></span>
                                            </div>

                                            <button class="btn m-auto mt-3 w-75 d-block" type="submit"
                                                name="targetslider"
                                                value="<?php echo $pending_target["target_id"]; ?>">Update
                                                Progress</button>

                                        </form>

                                        <?php break; ?>

                                        <?php endswitch; ?>

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
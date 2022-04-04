<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Team_leader_Session.php");

    //Check $_Get inputs are set

    if(!isset($_GET["id"]))
    {
        $path = "Appraisals.php";
        header("Location:".$path);
        exit;
    }

    if(!isset($_GET["num"]))
    {
        $appraisal_question = 0;
    }
    else 
    { 
        $appraisal_question = $_GET["num"];
    }

    $team_leader_appraisal_id = $_GET["id"];

    //Inport DB Data

    include("Database/Appraisal_Question.php");
    include("Database/Appraisal_Answers.php");

    $appraisal_data = GetAppraisalData($team_leader_appraisal_id);

    //Checks if the data is empty
    
    if($appraisal_data == NULL){
        $path = "Appraisals.php";
        header("Location:".$path);
        exit;
    }

    if($appraisal_question < 0) { header("Location:Appraisal_Questions.php?id=". $team_leader_appraisal_id ."&num=0"); exit;}
    if($appraisal_question > $appraisal_data["question_count"] - 1) { header("Location:Appraisal_Questions.php?id=". $team_leader_appraisal_id ."&num=". $appraisal_data['question_count'] - 1); exit;}


    $appraisal_question_data = GetAppraisalQuestionData($team_leader_appraisal_id, $appraisal_question);

    $appraisal_answer_data = GetAppraisalAnswerData($team_leader_appraisal_id);

    //Checks if the current question has been answered or not
    $answered_current = FALSE;
    if(isset($appraisal_answer_data[$appraisal_question])) { $answered_current = TRUE; }

    //Used for questions colour block array as look-up table | FALSE == Unanswered | TRUE == Answered

    $answered_table = [];

    for($i = 0; $i < $appraisal_question_data["question_count"]; $i++)
    {
        $answered_table[$i] = FALSE;
    }
    
    foreach($appraisal_answer_data as $answers)
    {
        $answered_table[$answers["question_num"]] = TRUE;
    }

    //User Input

    $error_msg = "";

    if(isset($_POST["submit"])) 
    {
        $has_error = FALSE;
        switch($appraisal_question_data["question_type"])
        {
            case "writen":

                $answer = trim($_POST["answer"]);

                if($answer == "") { $error_msg = "Cannot Accept an Empty Answer Box"; $has_error = TRUE; }

                if($answered_current && $appraisal_answer_data[$appraisal_question]["answer"] == $answer) 
                { 
                    $error_msg = "Given Answer is the Same as Current Answer";  
                    $has_error = TRUE; 
                }

                break;
                
            case "slider":

                $answer = $_POST["answer"];

                if($answered_current && $appraisal_answer_data[$appraisal_question]["answer"] == $answer) 
                { 
                    $error_msg = "Given Answer is the Same as Current Answer";  
                    $has_error = TRUE; 
                }

                break;

            case "multi-choice":

                if(!isset($_POST["checkboxes"]))
                {
                    $error_msg = "There Needs to be 1 or More Ticked";
                    $has_error = TRUE;
                }
                else
                {
                    $checkboxes = $_POST["checkboxes"];
                                    
                    $answer = [];
                    foreach(explode("|", $appraisal_question_data["choices"]) as $choice)
                    {
                        $answer[] = 0;
                    }
                
                    foreach($checkboxes as $checkbox)
                    {
                        $answer[$checkbox] = 1;
                    }
                
                    $answer = implode("|", $answer);
                }

                if($answered_current && $appraisal_answer_data[$appraisal_question]["answer"] == $answer) 
                { 
                    $error_msg = "Given Answer is the Same as Current Answer";  
                    $has_error = TRUE; 
                }

                break;
        }
        if(!$has_error){

            if($answered_current){
                UpdateAnswer($appraisal_question_data["question_id"], $appraisal_question_data["question_type"], $appraisal_data["team_leader_appraisal_id"], $answer);
            }
            else{
                SaveAnswer($appraisal_data["team_leader_appraisal_id"], $appraisal_question_data["question_id"], $appraisal_question_data["question_type"], $answer);
            }

            header("Location:Appraisal_Questions.php?id=". $team_leader_appraisal_id ."&num=". $appraisal_question); 
            exit;

        }

    }

?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto question_box">

        <div class="border my-2">

            <div class="container">
                <h2 class="mt-4">Question <?php echo $appraisal_question + 1; ?></h2>

                <h3 class="mt-4 m-2 text-start">
                    <?php echo $appraisal_question_data["question"]; ?>
                </h3>

                <?php 
                switch($appraisal_question_data["question_type"]):
                case "writen": 
                ?>

                <!-- Writen Question -->

                <form method="post" class="mt-5">

                    <div class="m-1 m-md-3">
                        <textarea class="form-control my-3 p-2" rows="5" name="answer"
                            placeholder="Type your Answer Here"
                            required><?php if($answered_current) { echo $appraisal_answer_data[$appraisal_question]["answer"]; } ?></textarea>
                    </div>

                    <span class="text-danger"><?php echo $error_msg; ?></span>

                    <button type="submit" name="submit"
                        class="btn my-4 w-50 mx-auto d-block"><?php if($answered_current) { echo "Update"; } else { echo "Save"; }?></button>


                </form>

                <?php break; ?>

                <?php case "slider": ?>

                <!-- Slider Question -->

                <form method="post" class="mt-5 range-field slidercontainer w-100 mt-1">

                    <?php
                        
                    $lower = $appraisal_question_data["lower_value"];
                    $upper = $appraisal_question_data["upper_value"];
                    if($answered_current) { $answer = $appraisal_answer_data[$appraisal_question]["answer"]; }

                    ?>

                    <p class="m-1 mt-3 text-center" id="slidervalue">
                        <?php if($answered_current) { echo $answer; } else { echo $lower; } ?>
                    </p>

                    <div class="d-flex justify-content-evenly">

                        <span class="font-weight-bold indigo-text m-0 h5"><?php echo $lower; ?></span>

                        <input class="border-0 w-75 slider m-2" name="answer" type="range"
                            value="<?php if($answered_current) { echo $answer; } else { echo $lower; } ?>"
                            min="<?php echo $lower; ?>" max="<?php echo $upper; ?>"
                            oninput="document.getElementById('slidervalue').innerHTML = this.value">

                        <span class="font-weight-bold indigo-text m-0 h5"><?php echo $upper; ?></span>

                    </div>

                    <span class="text-danger"><?php echo $error_msg; ?></span>

                    <button type="submit" name="submit"
                        class="btn my-4 w-50 mx-auto d-block"><?php if($answered_current) { echo "Update"; } else { echo "Save"; }?></button>

                </form>

                <?php break; ?>

                <?php case "multi-choice": ?>

                <!-- Multi-Choice Question -->

                <form method="post" class="mt-5">

                    <?php if($answered_current) { $answers = explode("|", $appraisal_answer_data[$appraisal_question]["answer"]); } ?>
                    <?php $choices = explode("|", $appraisal_question_data["choices"]); ?>

                    <div class="mb-3">
                        <?php for($i = 0; $i < count($choices); $i++): ?>

                        <?php $choice = $choices[$i]; ?>
                        <?php if($answered_current) { $answer = $answers[$i]; } ?>

                        <div class="d-flex justify-content-between border my-1 mx-1 mx-md-4 text-start">

                            <label class="my-2 mx-3"><?php echo $choice; ?></label>

                            <input class="form-check-input my-auto mx-3" type="checkbox" value="<?php echo $i; ?>"
                                name="checkboxes[]" <?php if($answered_current && $answer) { echo "checked"; } ?>>

                        </div>

                        <?php endfor; ?>

                    </div>

                    <span class="text-danger"><?php echo $error_msg; ?></span>

                    <button type="submit" name="submit"
                        class="btn my-4 w-50 mx-auto d-block"><?php if($answered_current) { echo "Update"; } else { echo "Save"; }?></button>

                </form>

                <?php endswitch; ?>

            </div>
        </div>

        <!-- Arrows -->

        <div class="my-4 container overflow-hidden">

            <div class="row mx-2" style="height: 60px;">

                <div class="col-4 d-flex justify-content-start p-0">

                    <?php if($appraisal_question > 0): ?>

                    <a href="Appraisal_Questions.php?id=<?php echo $team_leader_appraisal_id; ?>&num=<?php echo $appraisal_question - 1; ?>"
                        class="btn border-0">
                        <img src="../bootstrap-icons\arrow-left.svg" alt="Back" class="svg_arrow">
                    </a>

                    <?php endif; ?>

                </div>

                <div class="col-4 d-flex justify-content-center">

                    <p class="border px-3 py-2 my-auto h3">
                        <?php echo $appraisal_question + 1 . "/" . $appraisal_question_data["question_count"]; ?>
                    </p>

                </div>

                <div class="col-4 d-flex justify-content-end p-0">

                    <?php if($appraisal_question < $appraisal_question_data["question_count"] - 1): ?>

                    <a href="Appraisal_Questions.php?id=<?php echo $team_leader_appraisal_id; ?>&num=<?php echo $appraisal_question + 1; ?>"
                        class="btn border-0">
                        <img src="../bootstrap-icons\arrow-right.svg" alt="Next" class="svg_arrow">
                    </a>

                    <?php else: ?>

                    <a href="Appraisals.php" class="btn border-0">
                        Finish
                    </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>


        <div class="my-5">

            <div class="container">

                <div class="row">

                    <?php 
                    $question_count = $appraisal_question_data["question_count"]; 
                    $width = (1/$question_count) * 100;

                    for($i = 0; $i < $question_count; $i++): 
                    ?>

                    <a href="Appraisal_Questions.php?id=<?php echo $team_leader_appraisal_id; ?>&num=<?php echo $i; ?>"
                        class="col-2 col-md-1 text-decoration-none text-white" style="padding: 2px; height: 30px;"
                        aria-label="Completed">

                        <div class="<?php if($answered_table[$i]) { if($appraisal_question == $i) { echo "bg-primary "; $type = "Y"; } else { echo "bg-success "; $type = "Y"; } } 
                            else { if($appraisal_question == $i) { echo "bg-primary "; $type = "N"; } else { echo "bg-secondary "; $type = "N"; } } ?>
                            w-100 h-100">
                            <?php echo $type; ?>
                        </div>

                    </a>

                    <?php endfor; ?>

                </div>

            </div>

        </div>


    </main>

</div>


<?php include("Footer.php"); ?>
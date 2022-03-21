<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

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

    $engineer_appraisal_id = $_GET["id"];

    //Inport DB Data

    include("Database/Appraisal_Question.php");
    include("Database/Appraisal_Answers.php");

    $appraisal_data = GetAppraisalData($engineer_appraisal_id);

    //Checks if the data is empty
    
    if($appraisal_data == NULL){
        $path = "Appraisals.php";
        //header("Location:".$path);
        exit;
    }

    if($appraisal_question < 0) { header("Location:Appraisal_Questions.php?id=". $engineer_appraisal_id ."&num=0"); exit;}
    if($appraisal_question > $appraisal_data["question_count"] - 1) { header("Location:Appraisal_Questions.php?id=". $engineer_appraisal_id ."&num=". $appraisal_data['question_count'] - 1); exit;}


    $appraisal_question_data = GetAppraisalQuestionData($engineer_appraisal_id, $appraisal_question);

    $appraisal_answer_data = GetAppraisalAnswerData($engineer_appraisal_id);

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

    if(isset($_POST["submit"])) 
    {
        if($answered_current){
            UpdateAnswer($appraisal_question_data["question_id"], $appraisal_question_data["question_type"], $appraisal_data["engineer_appraisal_id"]);
        }
        else{
            SaveAnswer($appraisal_data["engineer_appraisal_id"], $appraisal_question_data["question_id"], $appraisal_question_data["question_type"]);
        }
        
        header("Location:Appraisal_Questions.php?id=". $engineer_appraisal_id ."&num=". $appraisal_question); 
        exit;
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

                <form method="post" class="mt-5">

                    <?php 
                    switch($appraisal_question_data["question_type"]):
                        case "Writen": ?>

                    <!-- Writen Question -->
                    <div class="m-1 m-md-3">
                        <textarea class="form-control my-3 p-2" rows="5" name="answer"
                            placeholder="Type your Answer Here"
                            required><?php if($answered_current) { echo $appraisal_answer_data[$appraisal_question]["answer"]; } ?></textarea>
                    </div>

                    <button type="submit" name="submit"
                        class="btn my-4 w-50 mx-auto d-block"><?php if($answered_current) { echo "Update"; } else { echo "Save"; }?></button>


                    <?php endswitch; ?>


                </form>
            </div>
        </div>

        <div class="my-4 container overflow-hidden">

            <div class="row gx-5">

                <div class="col-4 d-flex justify-content-start">

                    <?php if($appraisal_question > 0): ?>

                    <a href="Appraisal_Questions.php?id=<?php echo $engineer_appraisal_id; ?>&num=<?php echo $appraisal_question - 1; ?>"
                        class="btn border-0 p-2 m-1">
                        <img src="../bootstrap-icons\arrow-left.svg" alt="Back" class="svg_arrow m-1">
                    </a>

                    <?php else: ?>

                    <?php //just to keep the other elements from moving this is just a place holder and has no function ?>

                    <div class="p-2 border-0 opacity-0 m-1">
                        <div class="svg_arrow"></div>
                    </div>

                    <?php endif; ?>

                </div>

                <div class="col-4 d-flex justify-content-center">

                    <p class="border px-3 py-2 my-auto h3">
                        <?php echo $appraisal_question + 1 . "/" . $appraisal_question_data["question_count"]; ?>
                    </p>

                </div>

                <div class="col-4 d-flex justify-content-end">

                    <?php if($appraisal_question < $appraisal_question_data["question_count"] - 1): ?>

                    <a href="Appraisal_Questions.php?id=<?php echo $engineer_appraisal_id; ?>&num=<?php echo $appraisal_question + 1; ?>"
                        class="btn border-0 p-2 m-1">
                        <img src="../bootstrap-icons\arrow-right.svg" alt="Next" class="svg_arrow m-1">
                    </a>

                    <?php else: ?>

                    <a href="Appraisals.php" class="btn border-0 m-1">
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

                    <a href="Appraisal_Questions.php?id=<?php echo $engineer_appraisal_id; ?>&num=<?php echo $i; ?>"
                        class="col-2 col-md-1" style="padding: 2px; height: 30px;" aria-label="Completed">

                        <div class="
                            <?php 
                            if($answered_table[$i]) { if($appraisal_question == $i) { echo "bg-primary "; } else { echo "bg-success "; } } 
                            else { if($appraisal_question == $i) { echo "bg-warning "; } else { echo "bg-danger "; } } 
                            ?>
                            w-100 h-100">
                        </div>

                    </a>

                    <?php endfor; ?>

                </div>

            </div>

        </div>


    </main>

</div>


<?php include("Footer.php"); ?>
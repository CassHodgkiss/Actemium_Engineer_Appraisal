<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    include("Database/chart.php");  

    //Check $_Get inputs are set

    if(!isset($_GET["id"]))
    {
        $path = "Appraisal_Data.php"; 
        header("Location:".$path);
        exit;
    }
    else
    {
        $appraisal_id = $_GET["id"];
    }

    if(!isset($_GET["engineer"]))
    {
        $path = "Appraisal_Data.php"; 
        header("Location:".$path);
        exit;
    }
    else
    {
        $engineer_username = $_GET["engineer"];
    }
    
    if(!isset($_GET["num"]))
    {
        $appraisal_question = 0;
    }
    else 
    { 
        $appraisal_question = $_GET["num"];
    }

    include("Database/Appraisal_Question_Data.php");
    include("Database/Set_Target.php");

    $appraisal_data = GetAppraisalData($appraisal_id, $appraisal_question);
    $appraisal_answer_data = GetEngineerAppraisalAnswerData($appraisal_id, $appraisal_question, $engineer_username);

    if(isset($_POST["basic"]))
    {
        $target_data = $_POST["question"];
        $target_type = 0;
        
        CreateTarget($engineer_username, $target_data, $target_type, $appraisal_data["appraisal_question_id"], $_POST["date_due"]);

        $path = "Target_Set_Confirmation.php?id=" . $appraisal_id . "&num=" . $appraisal_question;
        header("Location:".$path);
        exit;
    }

    if(isset($_POST["slider"]))
    {
        $target_data = $_POST["question"] . "|" . $_POST["min"] . "|" . $_POST["max"];
        $target_type = 1;
        
        CreateTarget($engineer_username, $target_data, $target_type, $appraisal_data["appraisal_question_id"], $_POST["date_due"]);

        $path = "Target_Set_Confirmation.php?id=" . $appraisal_id . "&num=" . $appraisal_question;
        header("Location:".$path);
        exit;
    }

?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto question_box">

        <!-- Question Data -->

        <?php 
        switch($appraisal_data["question_type"]):
        case "0": 
        ?>

        <!-- Writen Question -->

        <div class="border my-2 m-2">

            <div class="container my-3">

                <h2 class="mt-4">Writen Question <?php echo $appraisal_question + 1; ?></h2>

                <h3 class="mt-4 m-2 text-start">
                    <?php echo $appraisal_data["question_data"]; ?>
                </h3>

            </div>

            <div class="m-2 my-3 border">
                <div class="overflow-auto">

                    <table class="table m-0">
                        <thead>
                            <tr>

                                <th scope="col" style="width: 20%;">
                                    <p class="m-1 p-1">Engineers</p>
                                </th>

                                <th scope="col" style="width: 80%;">
                                    <p class="m-1 p-1">Answers</p>
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <th scope="row"><?php echo $appraisal_answer_data["engineer_username"]; ?></th>

                                <td class="p-0">
                                    <p class="m-1 p-1 text-start">
                                        <?php echo $appraisal_answer_data["answer_data"]; ?>
                                    </p>
                                </td>


                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>


        <?php break; ?>

        <?php case "1": ?>

        <!-- Slider Question -->

        <?php 
        $question_data = explode("|", $appraisal_data["question_data"]);
        
        $question = $question_data[0];
        $lower_value = $question_data[1];
        $upper_value = $question_data[2];
        ?>

        <div class="border my-2 m-2">

            <div class="container">

                <h2 class="mt-4">Slider Question <?php echo $appraisal_question + 1; ?></h2>

                <h3 class="my-4 m-2 text-start">
                    <?php echo $question; ?>
                </h3>

                <div class="d-flex justify-content-evenly mb-4 m-1">
                    <span class="font-weight-bold indigo-text m-0 h5"><?php echo $lower_value; ?></span>

                    <div class="border-0 w-75 slider m-2"></div>

                    <span class="font-weight-bold indigo-text m-0 h5"><?php echo $upper_value; ?></span>
                </div>


            </div>

            <div class="m-2 my-3 border">

                <?php 
                    
                    $values = [];

                    if(isset($values[$appraisal_answer_data["answer_data"]]))
                    {
                        $values[$appraisal_answer_data["answer_data"]]++;
                    }
                    else
                    {
                        $values[$appraisal_answer_data["answer_data"]] = 1;
                    }
                    
                    ?>

                <div class="m-2 my-3">
                    <div class="overflow-auto">

                        <table class="table m-0">
                            <thead>
                                <tr>

                                    <th scope="col" style="width: 20%;">
                                        <p class="m-1 p-1">Engineers</p>
                                    </th>

                                    <th scope="col" style="width: 80%;">
                                        <p class="m-1 p-1">Answers</p>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>

                                    <th scope="row" class="align-middle p-0">
                                        <?php echo $appraisal_answer_data["engineer_username"]; ?>
                                    </th>

                                    <td class="p-0">

                                        <div class="my-2">
                                            <p class="m-0 text-center">
                                                <?php echo $appraisal_answer_data["answer_data"]; ?>
                                            </p>

                                            <input class="border-0 w-75 slider mt-2" type="range"
                                                value="<?php echo $appraisal_answer_data["answer_data"]; ?>"
                                                min="<?php echo $lower_value ?>" max="<?php echo $upper_value ?>"
                                                aria-label="readonly input example" disabled>
                                        </div>

                                    </td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>


        <?php break; ?>

        <?php case "2": ?>

        <!-- Multi-Choice Question -->

        <?php 
        $question_data = explode("|", $appraisal_data["question_data"]);

        $question = $question_data[0];
        
        $choices = [];
        for($i = 1; $i < count($question_data); $i++)
        {
            $choices[] = $question_data[$i];
        }
        ?>

        <div class="border my-2 m-2">

            <div class="container">

                <h2 class="mt-4">Multi-Choice Question <?php echo $appraisal_question + 1; ?></h2>

                <h3 class="my-4 m-2 text-start">
                    <?php echo $question; ?>
                </h3>

            </div>

            <div class="m-2 my-3 border">

                <div class="m-2 my-3">
                    <div class="overflow-auto">

                        <table class="table m-0">
                            <thead>
                                <tr>

                                    <th scope="col" style="width: 20%;">
                                        <p class="m-1 p-1">Engineers</p>
                                    </th>

                                    <?php foreach($choices as $choice): ?>

                                    <th scope="col" style="width: <?php echo 80 / count($choices) ?>%;">
                                        <p class="m-1 p-1"><?php echo $choice; ?></p>
                                    </th>

                                    <?php endforeach; ?>

                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                
                                    $answers = $appraisal_answer_data["answer_data"];
                                        
                                    $answers = explode("|", $answers);
                                        
                                    ?>

                                <tr>

                                    <th scope="row" class="align-middle">
                                        <?php echo $appraisal_answer_data["engineer_username"]; ?>
                                    </th>

                                    <?php foreach($answers as $answer): ?>

                                    <?php if($answer): ?>

                                    <td class="p-0">
                                        <p class="text-white bg-success m-1 p-1 rounded">Y</p>
                                    </td>

                                    <?php else: ?>

                                    <td class="p-0">
                                        <p class="text-white bg-secondary m-1 p-1 rounded">N</p>
                                    </td>

                                    <?php endif; ?>

                                    <?php endforeach; ?>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

        <?php endswitch; ?>


        <!-- Targets -->

        <div class="border mx-2 mt-4">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-center">Set Target</h3>

                <?php ?>

                <div class="my-auto mx-3">
                    <div class="input-group flex-end flex-row">
                        <select class="btn btn-green-border text-center px-2 py-2 w-100" id="option_select">
                            <option value="basic" class="bg-white text-black text-start">Basic</option>
                            <option value="slider" class="bg-white text-black text-start">Slider</option>
                        </select>
                    </div>
                </div>

            </div>

            <div id="basic">

                <div class="mx-2 mt-4">

                    <form method="post" class="d-flex">

                        <div class="input-group-lg mx-2 w-100">

                            <div class="form-floating m-1 m-md-3">
                                <textarea class="form-control" id="floatingQuestion" style="height: 100px"
                                    name="question" placeholder="Type Question Here" required></textarea>
                                <label for="floatingQuestion">Target</label>
                            </div>

                            <div class="form-floating m-1 m-md-3">
                                <input type="date" class="form-control my-3" id="floatingEndDate" placeholder="End Date"
                                    name="date_due"
                                    value="<?php if($details_made) { echo $details_data["end_date"]; } ?>" required>
                                <label for="floatingEndDate">End Date</label>
                            </div>

                            <button type="submit" name="basic" class="btn my-4 mx-auto d-block">Save</button>

                        </div>

                    </form>

                </div>

            </div>

            <div id="slider" class="d-none">

                <div class="mx-2 mt-4">

                    <form method="post" class="d-flex">

                        <div class="input-group-lg mx-2 w-100">

                            <div class="form-floating m-1 m-md-3">
                                <textarea class="form-control" id="floatingQuestion" style="height: 100px"
                                    name="question" placeholder="Type Question Here" required></textarea>
                                <label for="floatingQuestion">Target</label>
                            </div>

                            <div class="d-flex flex-row m-1 m-md-3 justify-content-between">

                                <div class="form-floating text-black w-50 me-4">
                                    <input type="number" class="form-control" id="floatingMin" placeholder="Min"
                                        name="min" required>
                                    <label for="floatingMin">Min</label>
                                </div>

                                <div class="form-floating text-black w-50 ms-4">
                                    <input type="number" class="form-control" id="floatingMax" placeholder="Max"
                                        name="max" required>
                                    <label for="floatingName">Max</label>
                                </div>

                            </div>

                            <div class="form-floating m-1 m-md-3">
                                <input type="date" class="form-control my-3" id="floatingEndDate" placeholder="End Date"
                                    name="date_due"
                                    value="<?php if($details_made) { echo $details_data["end_date"]; } ?>" required>
                                <label for="floatingEndDate">End Date</label>
                            </div>

                            <button type="submit" name="slider" class="btn my-4 mx-auto d-block">Save</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <!-- Arrows -->

        <div class="my-4 container overflow-hidden">

            <div class="row mx-2" style="height: 60px;">

                <div class="col-4 d-flex justify-content-start p-0">

                    <?php if($appraisal_question > 0): ?>

                    <a href="Set_Targets.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question - 1; ?>&engineer=<?php echo $appraisal_answer_data["engineer_username"]; ?>"
                        class="btn border-0">
                        <img src="../bootstrap-icons\arrow-left.svg" alt="Back" class="svg_arrow h-100">
                    </a>

                    <?php endif; ?>

                </div>

                <div class="col-4 d-flex justify-content-center">

                    <p class="border px-3 py-2 my-auto h3">
                        <?php echo $appraisal_question + 1 . "/" . $appraisal_data["question_count"]; ?>
                    </p>

                </div>

                <div class="col-4 d-flex justify-content-end p-0">

                    <?php if($appraisal_question < $appraisal_data["question_count"] - 1): ?>

                    <a href="Set_Targets.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question + 1; ?>&engineer=<?php echo $appraisal_answer_data["engineer_username"]; ?>"
                        class="btn border-0">
                        <img src="../bootstrap-icons\arrow-right.svg" alt="Next" class="svg_arrow h-100">
                    </a>

                    <?php else: ?>

                    <a href="Appraisal_Question_Data.php?id=<?php echo $appraisal_id; ?>" class="btn border-0">
                        Finish
                    </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </main>

</div>

<script>
document.getElementById('option_select').addEventListener('change', function() {

    var value = this.value;

    var basic = document.getElementById("basic");
    basic.classList.add("d-none");

    var slider = document.getElementById("slider");
    slider.classList.add("d-none");

    switch (value) {
        case "basic":

            basic.classList.remove("d-none");
            break;

        case "slider":

            slider.classList.remove("d-none");
            break;
    }
});
</script>


<?php include("Footer.php") ?>
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

    if(!isset($_GET["num"]))
    {
        $appraisal_question = 0;
    }
    else 
    { 
        $appraisal_question = $_GET["num"];
    }

    include("Database/Appraisal_Question_Data.php");

    $appraisal_data = GetAppraisalData($appraisal_id, $appraisal_question);
    $appraisal_answers_data = GetEngineerAppraisalsAnswerData($appraisal_id, $appraisal_question);

    $has_answers = FALSE;
    if($appraisal_answers_data != NULL)
    {
        $has_answers = TRUE;
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

        <div>
            <div class="border my-2 m-2">

                <div class="container my-3">

                    <h2 class="mt-4">Writen Question <?php echo $appraisal_question + 1; ?></h2>

                    <h3 class="mt-4 m-2 text-start">
                        <?php echo $appraisal_data["question_data"]; ?>
                    </h3>

                </div>

            </div>

            <div class="border mx-2 mt-4">

                <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                    <h3 class="m-3 text-center">Engineer Answers</h3>

                </div>

                <?php if($has_answers): ?>

                <div class="m-2 my-3">
                    <div class="overflow-auto">

                        <table class="table m-0">
                            <thead>
                                <tr>

                                    <th scope="col" style="width: 20%;">
                                        <p class="m-1 p-1">Engineers</p>
                                    </th>

                                    <th scope="col" style="width: 65%;">
                                        <p class="m-1 p-1">Answers</p>
                                    </th>

                                    <th scope="col" style="width: 15%;">
                                        <p class="m-1 p-1">Actions</p>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($appraisal_answers_data as $appraisal_answer_data): ?>

                                <tr>

                                    <th scope="row"><?php echo $appraisal_answer_data["engineer_username"]; ?></th>

                                    <td class="p-0">
                                        <p class="m-1 p-1 text-start">
                                            <?php echo $appraisal_answer_data["answer_data"]; ?>
                                        </p>
                                    </td>

                                    <td class="p-0">
                                        <a href="Set_Targets.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question; ?>&engineer=<?php echo $appraisal_answer_data["engineer_username"]; ?>"
                                            class="text-decoration-none">
                                            <p class="m-1 p-1 text-black">Set Target</p>
                                        </a>
                                    </td>

                                </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

                <?php else: ?>

                <div class="m-2 my-3">

                    <h4>There are currently no Answers</h4>

                </div>

                <?php endif; ?>
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

        <div>
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

            </div>

            <div class="border mx-2 mt-4">

                <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                    <h3 class="m-3 text-center">Engineer Answers</h3>

                    <div class="my-auto mx-3">
                        <div class="input-group flex-end flex-row">
                            <select class="btn btn-green-border text-center px-2 py-2 w-100" id="option_select">
                                <option value="pie_chart" class="bg-white text-black text-start">Pie Chart</option>
                                <option value="bar_chart" class="bg-white text-black text-start">Bar Chart</option>
                                <option value="answers" class="bg-white text-black text-start">Answers</option>
                            </select>
                        </div>
                    </div>

                </div>

                <?php if($has_answers): ?>

                <div>

                    <?php 
    
                    //https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
                    
                    $answer = array_column($appraisal_answers_data, 'answer_data');
                    
                    array_multisort($answer, SORT_ASC, $appraisal_answers_data);
                    
                    
                    $values = [];
                    
                    foreach($appraisal_answers_data as $appraisal_answer_data)
                    {
                        if(isset($values[$appraisal_answer_data["answer_data"]]))
                        {
                            $values[$appraisal_answer_data["answer_data"]]++;
                        }
                        else
                        {
                            $values[$appraisal_answer_data["answer_data"]] = 1;
                        }
                    }
                
                    ?>

                    <!-- Pie Chart -->

                    <div class="my-3" id="pie_chart">
                        <?php GeneratePieChart($values); ?>
                    </div>

                    <!-- Bar Chart -->

                    <div class="my-3 d-none" id="bar_chart">
                        <?php 
                        
                        $max = 0;
                    
                        foreach($values as $value)
                        {
                            if($value > $max) { $max = $value; }
                        }
                    
                        ?>

                        <?php GenerateBarChart($values, $max); ?>

                    </div>

                    <!-- Answers -->

                    <div class="d-none" id="answers">

                        <div class="m-2 my-3">
                            <div class="overflow-auto">

                                <table class="table m-0">
                                    <thead>
                                        <tr>

                                            <th scope="col" style="width: 20%;">
                                                <p class="m-1 p-1">Engineers</p>
                                            </th>

                                            <th scope="col" style="width: 65%;">
                                                <p class="m-1 p-1">Answers</p>
                                            </th>

                                            <th scope="col" style="width: 15%;">
                                                <p class="m-1 p-1">Actions</p>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach($appraisal_answers_data as $appraisal_answer_data): ?>

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
                                                        min="<?php echo $lower_value ?>"
                                                        max="<?php echo $upper_value ?>"
                                                        aria-label="readonly input example" disabled>
                                                </div>

                                            </td>

                                            <td scope="row" class="align-middle p-0">
                                                <a href="Set_Targets.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question; ?>&engineer=<?php echo $appraisal_answer_data["engineer_username"]; ?>"
                                                    class="text-decoration-none">
                                                    <p class="m-1 p-1 text-black align-middle">Set Target</p>
                                                </a>
                                            </td>

                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

                <?php else: ?>

                <div class="m-2 my-3">

                    <h4>There are currently no Answers</h4>

                </div>

                <?php endif; ?>

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

        <div>
            <div class="border my-2 m-2">

                <div class="container">

                    <h2 class="mt-4">Multi-Choice Question <?php echo $appraisal_question + 1; ?></h2>

                    <h3 class="my-4 m-2 text-start">
                        <?php echo $question; ?>
                    </h3>

                </div>

            </div>

            <div class="border mx-2 mt-4">

                <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                    <h3 class="m-3 text-center">Engineer Answers</h3>

                    <div class="my-auto mx-3">
                        <div class="input-group flex-end flex-row">
                            <select class="btn btn-green-border text-center px-2 py-2 w-100" id="option_select">
                                <option value="pie_chart" class="bg-white text-black text-start">Pie Chart</option>
                                <option value="bar_chart" class="bg-white text-black text-start">Bar Chart</option>
                                <option value="answers" class="bg-white text-black text-start">Answers</option>
                            </select>
                        </div>
                    </div>

                </div>

                <?php if($has_answers): ?>

                <div>
                    <?php 

                    $values = [];
                    foreach($choices as $choice)
                    {
                        $values[$choice] = 0;
                    }
                
                    foreach($appraisal_answers_data as $appraisal_answer_data)
                    {
                        $answer = $appraisal_answer_data["answer_data"];
                    
                        $answer = explode("|", $answer);
                    
                        for($i = 0; $i < count($choices); $i++)
                        {
                            $values[$choices[$i]] += $answer[$i];
                        }
                    
                    }
                
                    ?>

                    <!-- Pie Chart -->

                    <div class="my-3" id="pie_chart">
                        <?php GeneratePieChart($values); ?>
                    </div>

                    <!-- Bar Chart -->

                    <div class="my-3 d-none" id="bar_chart">

                        <?php 
                        $max = 0;
                    
                        foreach($values as $value)
                        {
                            if($value > $max) { $max = $value; }
                        }
                        ?>

                        <?php GenerateBarChart($values, $max); ?>

                    </div>

                    <!-- Answers -->

                    <div class="d-none" id="answers">

                        <div class="m-2 my-3">
                            <div class="overflow-auto">

                                <table class="table m-0">
                                    <thead>
                                        <tr>

                                            <th scope="col" style="width: 20%;">
                                                <p class="m-1 p-1">Engineers</p>
                                            </th>

                                            <?php foreach($choices as $choice): ?>

                                            <th scope="col" style="width: <?php echo 65 / count($choices) ?>%;">
                                                <p class="m-1 p-1"><?php echo $choice; ?></p>
                                            </th>

                                            <?php endforeach; ?>

                                            <th scope="col" style="width: 15%;">
                                                <p class="m-1 p-1">Actions</p>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach($appraisal_answers_data as $appraisal_answer_data): ?>

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

                                            <td scope="row" class="align-middle p-0">
                                                <a href="Set_Targets.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question; ?>&engineer=<?php echo $appraisal_answer_data["engineer_username"]; ?>"
                                                    class="text-decoration-none">
                                                    <p class="m-1 p-1 text-black align-middle">Set Target</p>
                                                </a>
                                            </td>

                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

                <?php else: ?>

                <div class="m-2 my-3">

                    <h4>There are currently no Answers</h4>

                </div>

                <?php endif; ?>

            </div>
        </div>

        <?php endswitch; ?>

        <!-- Arrows -->

        <div class="my-4 container overflow-hidden">

            <div class="row mx-2" style="height: 60px;">

                <div class="col-4 d-flex justify-content-start p-0">

                    <?php if($appraisal_question > 0): ?>

                    <a href="Appraisal_Question_Data.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question - 1; ?>"
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

                    <a href="Appraisal_Question_Data.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question + 1; ?>"
                        class="btn border-0">
                        <img src="../bootstrap-icons\arrow-right.svg" alt="Next" class="svg_arrow h-100">
                    </a>

                    <?php else: ?>

                    <a href="Appraisal_Data.php?id=<?php echo $appraisal_id; ?>" class="btn border-0">
                        Finish
                    </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </main>

</div>

<?php if($appraisal_data["question_type"] != "0" && $has_answers): ?>

<script>
document.getElementById('option_select').addEventListener('change', function() {

    var value = this.value;

    var bar_chart = document.getElementById("bar_chart");
    bar_chart.classList.add("d-none");

    var pie_chart = document.getElementById("pie_chart");
    pie_chart.classList.add("d-none");

    var answers = document.getElementById("answers");
    answers.classList.add("d-none");

    switch (value) {
        case "pie_chart":

            pie_chart.classList.remove("d-none");
            break;

        case "bar_chart":

            bar_chart.classList.remove("d-none");
            break;

        case "answers":

            answers.classList.remove("d-none");
            break;
    }
});
</script>

<?php endif ?>

<?php include("Footer.php") ?>
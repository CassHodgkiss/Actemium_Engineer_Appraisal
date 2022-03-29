<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    if(isset($_GET["id"]))
    {
        $appraisal_id = $_GET["id"];
    }
    else
    {
        header("Location: Team_Appraisals.php"); 
        exit();
    }

    include("Database/Appraisal_Data.php");

    $appraisal_data = GetAppraisalData($appraisal_id);

    if($appraisal_data == NULL)
    {
        header("Location: Team_Appraisals.php"); 
        exit();
    }

    $engineer_appraisal_answers = GetEngineersAppraisalAnswers($appraisal_id);

    $engineer_appraisals = GetEngineerAppraisal($appraisal_id);

    $question_count = $appraisal_data["question_count"];

    $engineer_count = count($engineer_appraisals);

    $questions = [];
    for($i = 0; $i < $question_count; $i++)
    {
        for($j = 0; $j < $engineer_count; $j++)
        {
            $questions[$i][$engineer_appraisals[$j]["engineer_appraisal_id"]] = FALSE;
        }
    }
    foreach($engineer_appraisal_answers as $engineer_appraisal_answer)
    {
        $questions[$engineer_appraisal_answer["question_num"]][$engineer_appraisal_answer["engineer_appraisal_id"]] = TRUE;
    }
?>


<div class="container">

    <main role="main" class="text-center py-5">

        <div class="border w-100">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-start"><?php echo $appraisal_data["name"]; ?></h3>

            </div>

            <div class="container overflow-auto">

                <table class="table border m-1 my-3">
                    <thead>
                        <tr>

                            <th scope="col" style="width: 10%;">
                                <p class="m-1 p-1">Question</p>
                            </th>

                            <?php foreach($engineer_appraisals as $engineer_appraisal): ?>

                            <th scope="col" style="width: <?php echo 80/$engineer_count; ?>%;">
                                <p class="m-1 p-1"><?php echo $engineer_appraisal["engineer_username"]; ?></p>
                            </th>

                            <?php endforeach; ?>

                            <th scope="col" style="width: 10%;">
                                <p class="m-1 p-1">Actions</p>
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php for($i = 0; $i < $question_count; $i++): ?>

                        <tr>

                            <th scope="row"><?php echo $i + 1; ?></th>

                            <?php foreach($questions[$i] as $question): ?>
                            <?php if($question): ?>

                            <td class="p-0">
                                <p class="text-white bg-success m-1 p-1 rounded">Y</p>
                            </td>

                            <?php else: ?>

                            <td class="p-0">
                                <p class="text-white bg-secondary m-1 p-1 rounded">N</p>
                            </td>

                            <?php endif; ?>
                            <?php endforeach; ?>

                            <td class="p-0">
                                <a href="" class="text-decoration-none">
                                    <p class="m-1 p-1 text-black">View</p>
                                </a>
                            </td>

                        </tr>

                        <?php endfor; ?>

                    </tbody>
                </table>

            </div>
        </div>
    </main>
</div>


<?php include("Footer.php"); ?>
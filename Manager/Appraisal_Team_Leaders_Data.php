<?php

    $title = "Actemium";
    include("Header.php");

    include("../Session/Manager_Session.php");

    if(isset($_GET["id"]))
    {
        $appraisal_id = $_GET["id"];
    }
    else
    {
        header("Location: Team_Appraisals.php"); 
        exit();
    }

    include("Database/Appraisal_Team_Leaders_Data.php");

    $appraisal_data = GetAppraisalData($appraisal_id);

    if($appraisal_data == NULL)
    {
        header("Location: Team_Appraisals.php"); 
        exit();
    }

    $team_leader_appraisal_answers = GetTeamLeadersAppraisalAnswers($appraisal_id);

    $team_leader_appraisals = GetTeamLeaderAppraisal($appraisal_id);

    $question_count = $appraisal_data["question_count"];

    $team_leader_count = count($team_leader_appraisals);

    $questions = [];
    for($i = 0; $i < $question_count; $i++)
    {
        for($j = 0; $j < $team_leader_count; $j++)
        {
            $questions[$i][$team_leader_appraisals[$j]["team_leader_appraisal_id"]] = FALSE;
        }
    }
    foreach($team_leader_appraisal_answers as $team_leader_appraisal_answer)
    {
        $questions[$team_leader_appraisal_answer["question_num"]][$team_leader_appraisal_answer["team_leader_appraisal_id"]] = TRUE;
    }
?>


<div class="container">

    <main role="main" class="text-center py-5">

        <div class="border w-100">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-start"><?php echo $appraisal_data["name"]; ?></h3>

            </div>

            <div class="overflow-auto border mx-2 my-4">

                <table class="table m-0">
                    <thead>
                        <tr>

                            <th scope="col" style="width: 10%;">
                                <p class="m-1 p-1">Question</p>
                            </th>

                            <?php foreach($team_leader_appraisals as $team_leader_appraisal): ?>

                            <th scope="col" style="width: <?php echo 80/$team_leader_count; ?>%;">
                                <p class="m-1 p-1"><?php echo $team_leader_appraisal["team_leader_username"]; ?></p>
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
                                <a href="Appraisal_Team_Leader_Question_Data.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $i; ?>"
                                    class="text-decoration-none">
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
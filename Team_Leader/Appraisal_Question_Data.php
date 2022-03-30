<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    //Check $_Get inputs are set

    if(!isset($_GET["id"]))
    {
        $path = "Appraisals.php"; 
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
    $appraisal_answers_data = GetAppraisalAnswerData($appraisal_id, $appraisal_question);

    //print_r($appraisal_data); echo "<br><br>";
    //
    //foreach($appraisal_answers_data as $appraisal_answer_data)
    //{
    //    print_r($appraisal_answer_data); echo "<br><br>";
    //}

?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto question_box">

        <!-- Question Data -->

        <div class="border my-2">

            <div class="container">

                <h2 class="mt-4">Question <?php echo $appraisal_question + 1; ?></h2>

                <h3 class="mt-4 m-2 text-start">
                    <?php echo $appraisal_data["question"]; ?>
                </h3>

                <?php 
                switch($appraisal_data["question_type"]):
                case "Writen": 
                ?>

                <!-- Writen Question -->

                <div class="overflow-auto border mx-2 my-4">

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

                            <?php foreach($appraisal_answers_data as $appraisal_answer_data): ?>

                            <tr>

                                <th scope="row"><?php echo $appraisal_answer_data["engineer_username"]; ?></th>

                                <td class="p-0">
                                    <p class="m-1 p-1 text-start"><?php echo $appraisal_answer_data["answer"]; ?></p>
                                </td>

                            </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

                <?php break; ?>

                <?php case "Slider": ?>

                <!-- Slider Question -->

                <?php include("Database/pie_chart.php"); ?>

                <?php 
                
                $values = [];
            
                foreach($appraisal_answers_data as $appraisal_answer_data)
                {
                    if(isset($values[$appraisal_answer_data["answer"]]))
                    {
                        $values[$appraisal_answer_data["answer"]]++;
                    }
                    else
                    {
                        $values[$appraisal_answer_data["answer"]] = 1;
                    }
                }
                
                GeneratePieChart($values); 

                ?>

                <?php break; ?>

                <?php case "Multi-Choice": ?>

                <!-- Multi-Choice Question -->



                <?php endswitch; ?>

            </div>

        </div>

        <!-- Arrows -->

        <div class="my-4 container overflow-hidden">

            <div class="row gx-5">

                <div class="col-4 d-flex justify-content-start">



                </div>

                <div class="col-4 d-flex justify-content-center">


                </div>

                <div class="col-4 d-flex justify-content-end">



                </div>

            </div>

        </div>

        <!-- Question Navigation -->

        <div class="my-5">

            <div class="container">

                <div class="row">


                </div>

            </div>

        </div>


    </main>

</div>


<?php include("Footer.php") ?>
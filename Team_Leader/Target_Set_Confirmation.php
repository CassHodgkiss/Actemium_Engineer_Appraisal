<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    $appraisal_id = $_GET["id"];

    $appraisal_question = $_GET["num"];
    

?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto" style="max-width: 576px;">

        <div class="bg-blue text-white container ms-auto w-lg-50 rounded d-flex flex-column mt-5">

            <h2 class="pb-4 pt-4 m-0">Target Created</h2>

            <div class="container mt-3">

                <a href="Appraisal_Question_Data.php?id=<?php echo $appraisal_id; ?>&num=<?php echo $appraisal_question; ?>"
                    class="btn btn-green-border mt-4 mb-4 mx-auto w-75">Go Back</a>

            </div>

        </div>

    </main>

</div>


<?php include("Footer.php"); ?>
<?php

    $title = "Actemium";
    include("Header.php");

    include("../Session/Manager_Session.php");

    include("Database/Create_Appraisal.php");

    $error_msg = "";

    if(!isset($_SESSION["appraisal"]))
    {
        $_SESSION["appraisal"] = [];
    }
    if(!isset($_SESSION["appraisal"]["questions"]))
    {
        $_SESSION["appraisal"]["questions"] = [];
    }
    if(!isset($_SESSION["appraisal"]["engineers"]))
    {
        $_SESSION["appraisal"]["engineers"] = [];
    }
    if(!isset($_SESSION["appraisal"]["team_leaders"]))
    {
        $_SESSION["appraisal"]["team_leaders"] = [];
    }

    if(isset($_POST["submit"]))
    {
        $_SESSION["appraisal"]["details"] = array
        (
            "name" => $_POST["name"], 
            "start_date" => $_POST["start_date"], 
            "end_date" => $_POST["end_date"]
        );

        if($_SESSION["appraisal"]["details"]["start_date"] > $_SESSION["appraisal"]["details"]["end_date"])
        {
            $error_msg = "End Date must be After than the Start Data";
        }
        else
        {
            if(count($_SESSION["appraisal"]["questions"]) >= 1)
            {
                if(count($_SESSION["appraisal"]["engineers"]) >= 1 || count($_SESSION["appraisal"]["team_leaders"]) >= 1)
                {
                    $details = $_SESSION["appraisal"]["details"];
                    $questions = $_SESSION["appraisal"]["questions"];
                    $engineers = $_SESSION["appraisal"]["engineers"];
                    $team_leaders = $_SESSION["appraisal"]["team_leaders"];
                
                    $appraisal_id = CreateAppraisal($details, count($questions));
                
                    SetEngineers($engineers, $appraisal_id);

                    SetTeamLeaders($team_leaders, $appraisal_id);
                
                    CreateQuestions($questions, $appraisal_id);
                
                    unset($_SESSION["appraisal"]);
                
                    $path = "Appraisal_Creation_Confirmation.php";
                    header("Location:".$path);
                    exit;
                }
                else
                {
                    $error_msg = "No Users are Set";
                }
            }
            else
            {
                $error_msg = "No Questions are Set";
            }        
        }
    }

    $details_made = FALSE;

    if(isset($_SESSION["appraisal"]["details"]))
    {
        $details_made = TRUE;
        
        $details_data = $_SESSION["appraisal"]["details"];
    }
    

    if(isset($_POST["add_questions"]))
    {
        $_SESSION["appraisal"]["details"] = array
        (
            "name" => $_POST["name"], 
            "start_date" => $_POST["start_date"], 
            "end_date" => $_POST["end_date"]
        );

        $path = "Create_Appraisals_Questions.php";
        
        $question_count = count($_SESSION["appraisal"]["questions"]);
        $path = "Create_Appraisals_Questions.php?id=" . $question_count - 1;

        header("Location:".$path);
        exit;
    }
    
    if(isset($_POST["add_engineers"]))
    {
        $_SESSION["appraisal"]["details"] = array
        (
            "name" => $_POST["name"], 
            "start_date" => $_POST["start_date"], 
            "end_date" => $_POST["end_date"]
        );

        $path = "Create_Appraisals_Engineers.php";

        header("Location:".$path);
        exit;
    }

    if(isset($_POST["add_team_leaders"]))
    {
        $_SESSION["appraisal"]["details"] = array
        (
            "name" => $_POST["name"], 
            "start_date" => $_POST["start_date"], 
            "end_date" => $_POST["end_date"]
        );

        $path = "Create_Appraisals_Team_Leaders.php";

        header("Location:".$path);
        exit;
    }

?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto" style="max-width: 576px;">

        <div class="bg-blue text-white container ms-auto w-lg-50 rounded d-flex flex-column mt-5">

            <h2 class="pb-4 pt-4 m-0">Create Appraisal</h2>

            <div class="container mt-3">

                <form method="post" class="d-flex">

                    <div class="input-group-lg mx-2 w-100">

                        <div class="form-floating text-black">
                            <input type="text" class="form-control my-3" id="floatingName" placeholder="End Date"
                                name="name" value="<?php if($details_made) { echo $details_data["name"]; } ?>" required>
                            <label for="floatingName">Appraisal Name</label>
                        </div>

                        <div class="form-floating text-black">
                            <input type="date" class="form-control my-3" id="floatingStartDate" placeholder="Start Date"
                                name="start_date"
                                value="<?php if($details_made) { echo $details_data["start_date"]; } ?>" required>
                            <label for="floatingStartDate">Start Date</label>
                        </div>

                        <div class="form-floating text-black">
                            <input type="date" class="form-control my-3" id="floatingEndDate" placeholder="End Date"
                                name="end_date" value="<?php if($details_made) { echo $details_data["end_date"]; } ?>"
                                required>
                            <label for="floatingEndDate">End Date</label>
                        </div>


                        <div class="text-black mt-4">

                            <button type="submit" name="add_questions" class="btn btn-green-border w-100">
                                Add Questions
                            </button>

                        </div>

                        <div class="text-black d-flex flex-row mt-3 mb-4 justify-content-between">

                            <button type="submit" name="add_engineers" class="btn btn-green-border w-50 me-1">
                                Add Engineers
                            </button>

                            <button type="submit" name="add_team_leaders" class="btn btn-green-border w-50 ms-1">
                                Add Team Leaders
                            </button>

                        </div>


                        <?php if($error_msg != ""): ?>
                        <p class="my-3 text-white"><?php echo $error_msg; ?></p>
                        <?php endif; ?>

                        <button class="btn btn-green-border mt-4 mb-4 mx-auto w-75" type="submit"
                            name="submit">Submit</button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>


<?php include("Footer.php"); ?>
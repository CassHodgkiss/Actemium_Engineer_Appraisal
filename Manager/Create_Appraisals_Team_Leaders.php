<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Manager_Session.php");

    include("Database/Users.php");

    $team_leaders = GetTeamLeaders();

    $path = "Create_Appraisal.php";

    if(isset($_SESSION["appraisal"]))
    {
        if(!isset($_SESSION["appraisal"]["details"]))
        {
            header("Location:".$path);
            exit;
        }

    }
    else
    {
        header("Location:".$path);
        exit;
    }

    if(isset($_POST["submit"]))
    {
        $_SESSION["appraisal"]["team_leaders"] = array_keys($_POST["team_leaders"]);

        header("Location:".$path);
        exit;
    }

    if(isset($_SESSION["appraisal"]["team_leaders"]))
    {
        $team_leader_data = $_SESSION["appraisal"]["team_leaders"];
    }
    
?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto" style="max-width: 576px;">

        <div class="bg-blue text-white container ms-auto w-lg-50 rounded d-flex flex-column mt-5">

            <h2 class="pb-4 pt-4 m-0">Team Leaders</h2>

            <div class="container mt-3">

                <form method="post" class="mt-3">

                    <?php foreach($team_leaders as $team_leader): ?>

                    <div class="d-flex bg-white text-black 
                        justify-content-between border my-1 mx-1 mx-md-4 text-start">

                        <label class="my-2 mx-3"><?php echo $team_leader["team_leader_username"]; ?></label>

                        <input class="form-check-input my-auto mx-3 checkboxes" type="checkbox"
                            name="team_leaders[<?php echo $team_leader["team_leader_username"]; ?>]"
                            <?php if(isset($team_leader_data)) { if(in_array($team_leader["team_leader_username"], $team_leader_data)) { echo "checked"; } } ?>>

                    </div>

                    <?php endforeach; ?>


                    <div class="d-flex bg-white text-black 
                        justify-content-between border my-1 mx-1 mx-md-4 text-start">

                        <label class="my-2 mx-3">Include All</label>

                        <input class="form-check-input my-auto mx-3" id="include_all" type="checkbox">

                    </div>

                    <button type="submit" name="submit" class="btn btn-green-border my-4 mx-auto d-block">Save</button>

                </form>

            </div>

        </div>

    </main>

</div>

<script>
document.getElementById('include_all').addEventListener('click', function() {

    var check = this.checked;

    var checkboxes = document.getElementsByClassName("checkboxes");

    if (check) {
        for (i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    } else {
        for (i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    }

});
</script>


<?php include("Footer.php"); ?>
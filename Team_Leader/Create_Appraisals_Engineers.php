<?php

    $title = "Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    include("Database/Engineers.php");

    $engineers = GetTeamMembers();

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
        if(isset($_POST["engineers"]))
        {
            $_SESSION["appraisal"]["engineers"] = array_keys($_POST["engineers"]);
        }
        else
        {
            $_SESSION["appraisal"]["engineers"] = [];
        }

        header("Location:".$path);
        exit;
    }

    if(isset($_SESSION["appraisal"]["engineers"]))
    {
        $engineer_data = $_SESSION["appraisal"]["engineers"];
    }
    
?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto" style="max-width: 576px;">

        <div class="bg-blue text-white container ms-auto w-lg-50 rounded d-flex flex-column mt-5">

            <h2 class="pb-4 pt-4 m-0">Team Members</h2>

            <div class="container mt-3">

                <form method="post" class="mt-3">

                    <?php foreach($engineers as $engineer): ?>

                    <div class="d-flex bg-white text-black 
                        justify-content-between border my-1 mx-1 mx-md-4 text-start">

                        <label class="my-2 mx-3"><?php echo $engineer["engineer_username"]; ?></label>

                        <input class="form-check-input my-auto mx-3 checkboxes" type="checkbox"
                            name="engineers[<?php echo $engineer["engineer_username"]; ?>]"
                            <?php if(isset($engineer_data)) { if(in_array($engineer["engineer_username"], $engineer_data)) { echo "checked"; } } ?>>

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
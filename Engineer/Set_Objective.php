<?php

    $title = "Set Objective | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

    include("Database/Set_Objective.php");

    $path = "Engineer_Index.php";

    if(isset($_POST["basic"]))
    {
        $objective_data = $_POST["question"];
        $objective_type = 0;
        
        CreateObjective($_SESSION["Username"], $objective_data, $objective_type, $_POST["date_due"]);
        
        header("Location:".$path);
        exit;
    }

    if(isset($_POST["slider"]))
    {
        $objective_data = $_POST["question"] . "|" . $_POST["min"] . "|" . $_POST["max"];
        $objective_type = 1;
        
        CreateObjective($_SESSION["Username"], $objective_data, $objective_type, $_POST["date_due"]);

        header("Location:".$path);
        exit;
    }

?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto question_box">

        <div class="border mx-2 mt-4">

            <div class="m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-center">Set Objective</h3>

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
                                <label for="floatingQuestion">Objective</label>
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
                                <label for="floatingQuestion">Objective</label>
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
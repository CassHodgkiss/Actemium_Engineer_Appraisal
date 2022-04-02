<?php

    $title = "Appraisals | Actemium";
    include("Header.php");

    include("../Session/Team_Leader_Session.php");

    date_default_timezone_set("Europe/London");

    $path = "Create_Appraisal.php";

    $error_msg = "";

    if(!isset($_GET["id"]))
    {
        $question_num = 0;
    }
    else
    {
        $question_num = $_GET["id"];
    }

    if(isset($_POST["writen"]))
    {
        $_SESSION["create_auction"]["questions"][$question_num] = array 
        (
            "type" => "writen",
            "question" => $_POST["question"]
        );
    }

    if(isset($_POST["slider"]))
    {
        $_SESSION["create_auction"]["questions"][$question_num] = array 
        (
            "type" => "slider",
            "question" => $_POST["question"],
            "min" => $_POST["min"],
            "max" => $_POST["max"]
        );
    }

    if(isset($_POST["multi-choice"]))
    {
        $_SESSION["create_auction"]["questions"][$question_num] = array 
        (
            "type" => "multi-choice",
            "question" => $_POST["question"],
            "choices" => $_POST["choices"]
        );
    }

    $question_data = [];

    if(isset($_SESSION["create_auction"]))
    {
        if(!isset($_SESSION["create_auction"]["details"]))
        {
            header("Location:".$path);
            exit;
        }

        $question_made = FALSE;

        if(isset($_SESSION["create_auction"]["questions"][$question_num]))
        {
            $question_made = TRUE;
            
            $question_data = $_SESSION["create_auction"]["questions"][$question_num];
        }

    }
    else
    {
        header("Location:".$path);
        exit;
    }

    $question_count = 0;

    if(isset($_SESSION["create_auction"]["questions"]))
    {
        $question_count = count($_SESSION["create_auction"]["questions"]);
    }
    
?>


<div class="container">

    <main role="main" class="text-center py-5 mx-auto question_box">

        <!-- Question Data -->

        <div class="border my-2" id="question_data">

            <div class=" m-1 text-white bg-blue rounded d-flex justify-content-between">

                <h3 class="m-3 text-center">Question <?php echo $question_num + 1; ?></h3>

                <div class="my-auto mx-3">
                    <div class="input-group flex-end flex-row">
                        <select class="btn btn-green-border w-100 text-center px-2 py-2 w-100" id="option_select">

                            <option value="writen" class="bg-white text-black text-start"
                                <?php if($question_made) { if($question_data["type"] == "writen") { echo "selected"; } } ?>>
                                Writen
                            </option>

                            <option value="slider" class="bg-white text-black text-start"
                                <?php if($question_made) { if($question_data["type"] == "slider") { echo "selected"; } } ?>>
                                Slider
                            </option>

                            <option value="multi-choice" class="bg-white text-black text-start"
                                <?php if($question_made) { if($question_data["type"] == "multi-choice") { echo "selected"; } } ?>>
                                Multi-Choice
                            </option>

                        </select>
                    </div>
                </div>

            </div>

            <div class="mt-4">

                <!-- Writen Question -->

                <?php $made = FALSE; if($question_made) { if($question_data["type"] == "writen") { $made = TRUE; } } ?>

                <div id="writen" class="d-none">

                    <form method="post" class="d-flex">

                        <div class="input-group-lg mx-2 w-100">

                            <div class="form-floating m-1 m-md-3">
                                <textarea class="form-control" id="floatingQuestion" style="height: 100px"
                                    name="question" placeholder="Type Question Here"
                                    required><?php if($made) { echo $question_data["question"]; } ?></textarea>
                                <label for="floatingQuestion">Question</label>
                            </div>

                            <span class="text-danger"><?php echo $error_msg; ?></span>

                            <button type="submit" name="writen"
                                class="btn mt-4 mb-3 mx-auto d-block"><?php if($made) { echo "Update"; } else { echo "Save"; }?></button>

                        </div>

                    </form>

                </div>


                <!-- Slider Question -->

                <?php $made = FALSE; if($question_made) { if($question_data["type"] == "slider") { $made = TRUE; } } ?>

                <div id="slider" class="d-none">

                    <form method="post" class="d-flex">

                        <div class="input-group-lg mx-2 w-100">

                            <div class="form-floating m-1 m-md-3">
                                <textarea class="form-control" id="floatingQuestion" style="height: 100px"
                                    name="question" placeholder="Type Question Here"
                                    required><?php if($made) { echo $question_data["question"]; } ?></textarea>
                                <label for="floatingQuestion">Question</label>
                            </div>

                            <div class="d-flex flex-row m-1 m-md-3 justify-content-between">

                                <div class="form-floating text-black w-50 me-4">
                                    <input type="number" class="form-control" id="floatingMin" placeholder="Min"
                                        name="min" value="<?php if($made) { echo $question_data["min"]; } ?>" required>
                                    <label for="floatingMin">Min</label>
                                </div>

                                <div class="form-floating text-black w-50 ms-4">
                                    <input type="number" class="form-control" id="floatingMax" placeholder="Max"
                                        name="max" value="<?php if($made) { echo $question_data["max"]; } ?>" required>
                                    <label for="floatingName">Max</label>
                                </div>

                            </div>

                            <span class="text-danger"><?php echo $error_msg; ?></span>

                            <button type="submit" name="slider"
                                class="btn my-5 mx-auto d-block"><?php if($made) { echo "Update"; } else { echo "Save"; }?></button>

                        </div>

                    </form>

                </div>


                <!-- Multi-Choice Question -->

                <?php $made = FALSE; if($question_made) { if($question_data["type"] == "multi-choice") { $made = TRUE; } } ?>

                <div id="multi-choice" class="d-none">

                    <form method="post" class="d-flex">

                        <div class="input-group-lg mx-2 w-100">

                            <div class="form-floating m-1 m-md-3">
                                <textarea class="form-control" id="floatingQuestion" style="height: 100px"
                                    name="question" placeholder="Type Question Here"
                                    required><?php if($made) { echo $question_data["question"]; } ?></textarea>
                                <label for="floatingQuestion">Question</label>
                            </div>

                            <div class="m-1 m-md-3" id="choices">

                                <?php if($made): ?>

                                <?php for($i = 0; $i < count($question_data["choices"]); $i++): ?>

                                <div class="form-floating text-black my-1">
                                    <input type="text" class="form-control" id="floatingChoice<?php echo $i + 1; ?>"
                                        placeholder="Choice <?php echo $i + 1; ?>" name="choices[]"
                                        value="<?php echo $question_data["choices"][$i]; ?>" required>
                                    <label for="floatingChoice<?php echo $i + 1; ?>">Choice
                                        <?php echo $i + 1; ?></label>
                                </div>

                                <?php endfor; ?>

                                <?php else: ?>

                                <div class="form-floating text-black my-1">
                                    <input type="text" class="form-control" id="floatingChoice1" placeholder="Choice1"
                                        name="choices[]" required>
                                    <label for="floatingChoice1">Choice 1</label>
                                </div>

                                <div class="form-floating text-black my-1">
                                    <input type="text" class="form-control" id="floatingChoice2" placeholder="Choice2"
                                        name="choices[]" required>
                                    <label for="floatingChoice2">Choice 2</label>
                                </div>

                                <?php endif; ?>

                            </div>

                            <div class="d-flex flex-row m-3 justify-content-between">
                                <button type="button" id="remove_choices" class="btn w-50 mx-auto d-block me-1">
                                    - Remove Choice
                                </button>
                                <button type="button" id="add_choices" class="btn w-50 mx-auto d-block ms-1">
                                    + Add Choice
                                </button>
                            </div>

                            <span class="text-danger"><?php echo $error_msg; ?></span>

                            <button type="submit" name="multi-choice"
                                class="btn my-5 mx-auto d-block"><?php if($made) { echo "Update"; } else { echo "Save"; }?></button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <!-- Arrows -->

        <div class="my-4 container">

            <div class="row">

                <div class="col-4 d-flex justify-content-start p-0">

                    <?php if($question_num > 0): ?>

                    <a href="Create_Appraisals_Questions.php?id=<?php echo $question_num - 1; ?>"
                        class="btn border-0 pe-2">
                        <img src="../bootstrap-icons\arrow-left.svg" alt="Back" class="svg_arrow m-1">
                    </a>

                    <?php else: ?>

                    <?php //just to keep the other elements from moving this is just a place holder and has no function ?>

                    <div class="p-2 border-0 opacity-0 m-1">
                        <div class="svg_arrow"></div>
                    </div>

                    <?php endif; ?>

                </div>

                <div class="col-4 d-flex justify-content-center">

                    <p class="border px-3 py-2 my-auto h3">
                        <?php echo $question_num + 1 . "/" . $question_count; ?>
                    </p>

                </div>

                <div class="col-4 d-flex justify-content-end p-0">

                    <?php if($question_num < $question_count - 1): ?>

                    <a href="Create_Appraisals_Questions.php?id=<?php echo $question_num + 1; ?>"
                        class="btn border-0 ps-2">
                        <img src="../bootstrap-icons\arrow-right.svg" alt="Next" class="svg_arrow m-1">
                    </a>

                    <?php else: ?>

                    <?php if($question_made): ?>

                    <a href="Create_Appraisals_Questions.php?id=<?php echo $question_num + 1; ?>" class="btn border-0">
                        + Add Question
                    </a>

                    <?php endif; ?>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <a href="Create_Appraisal.php" class="btn border-0 m-1 p-2 mt-5 mx-auto">
            Finish
        </a>


    </main>

</div>

<script>
document.getElementById('add_choices').addEventListener('click', function() {

    var choice_count = document.getElementById("choices").childElementCount + 1;

    //https://stackoverflow.com/questions/3103962/converting-html-string-into-dom-elements

    var wrapper = document.createElement('div');

    wrapper.innerHTML =
        '<div class="form-floating text-black my-1"><input type = "text" class = "form-control" id = "floatingChoice' +
        choice_count +
        '" placeholder = "Choice' +
        choice_count +
        '" name = "choices[]" required><label if = "" for = "floatingChoice' +
        choice_count + '">Choice ' +
        choice_count + '</label></div>';

    var div = wrapper.firstChild;

    document.getElementById("choices").appendChild(div);

});

document.getElementById('remove_choices').addEventListener('click', function() {

    var choice_count = document.getElementById("choices").childElementCount;

    if (choice_count > 2) {
        var remove = document.getElementById("choices");
        remove.removeChild(remove.children[choice_count - 1]);
    }

});

document.getElementById('option_select').addEventListener('change', updateTypes);

document.getElementById('question_data').onload = updateTypes();

function updateTypes() {
    console.log("h")
    var value = document.getElementById('option_select').value;

    var writen = document.getElementById("writen");
    writen.classList.add("d-none");

    var slider = document.getElementById("slider");
    slider.classList.add("d-none");

    var multi_choice = document.getElementById("multi-choice");
    multi_choice.classList.add("d-none");

    switch (value) {
        case "writen":

            writen.classList.remove("d-none");
            break;
        case "slider":

            slider.classList.remove("d-none");
            break;

        case "multi-choice":

            multi_choice.classList.remove("d-none");
            break;
    }
};
</script>


<?php include("Footer.php"); ?>
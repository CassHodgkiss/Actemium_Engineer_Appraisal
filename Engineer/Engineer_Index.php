<?php

    $title = "Engineer Dashboard | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

    include("Database/Engineer_Data.php");

    $engineer = GetEngineerData();

?>
    

    <div class="container">

        <main role="main" class="text-center py-5">

            <div class="row row-cols-1 row-cols-lg-2 m-4">

                <section class="col g-3 engineer_info">
                    
                    <div class="card">

                        <div class="row g-0">

                            <div class="col-lg-4 p-3">
                                <img class='img-fluid rounded-circle' src="<?php echo "Database/Engineer_Pfp.php?id=" . $username ?>" alt=""> 
                            </div>

                            <div class="col-lg-8">

                                <div class="card-body p-0">

                                    <div class="card-header bg-white border-0">
                                        <h3 class="m-1 p-1 text-white bg-blue rounded"><?php echo $engineer["first_name"] . " " . $engineer["last_name"]; ?></h3>
                                    </div>

                                    <div class="container m-0">
                                        <div class="row ms-auto">
                                            <p class="col m-0 p-2">Occupation</p>
                                            <p class="col m-0 p-2">Engineer</p>
                                        </div>

                                        <hr class="m-1 mx-4">

                                        <div class="row ms-auto">
                                            <p class="col m-0 p-2">Team Leader</p>
                                            <p class="col m-0 p-2"><?php echo $engineer["team_leader_username"]; ?></p>
                                        </div>
                                    </div>
                                                                  
                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="col g-3 pending_appraisals">

                    <div class="card">
                        <div class="card-header bg-white border-0">
                            <h3 class="m-1 p-1 text-white bg-blue rounded">Current Tasks</h3>
                        </div>

                        <div class="border mt-2 m-4">

                            <ul class="list-group m-2 overflow-auto pending_appraisals_items text-start">

                                <li class="list-group-item m-1 border">
                                    <img src="../bootstrap-icons\exclamation-square-fill.svg" alt="Exclaimation Icon" class="img-fluid me-2">
                                    Appraisal Due on 06 May 2022
                                </li>

                                <li class="list-group-item m-1 border">
                                    <img src="../bootstrap-icons\exclamation-square-fill.svg" alt="Exclaimation Icon" class="img-fluid me-2">
                                    Appraisal Due on 22 June 2022
                                </li>

                                <li class="list-group-item m-1 border">
                                    <img src="../bootstrap-icons\exclamation-square-fill.svg" alt="Exclaimation Icon" class="img-fluid me-2">
                                    Appraisal Due on 03 April 2022
                                </li>

                                <li class="list-group-item m-1 border">
                                    <img src="../bootstrap-icons\exclamation-square-fill.svg" alt="Exclaimation Icon" class="img-fluid me-2">
                                    Team Target Due on 11 Augest 2022
                                </li>

                                <li class="list-group-item m-1 border">
                                    <img src="../bootstrap-icons\exclamation-square-fill.svg" alt="Exclaimation Icon" class="img-fluid me-2">
                                    Goal Due on 23 September 2022
                                </li>

                            </ul>

                            <a href="" class="btn btn-green btn-lg text-black m-3 w-50">Show All</a>

                        </div>
                    </div>

                </section>

                <section class="col g-3 appraisal_data">Column</section>
                <section class="col g-3 team_targets">Column</section>
                <section class="col g-3 additional_questions">Column</section>
                <section class="col g-3 to_do_list">Column</section>
            </div>

        </main>

    </div>


<?php include("Footer.php"); ?>
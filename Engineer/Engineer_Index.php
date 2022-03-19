<?php

    $title = "Engineer Dashboard | Actemium";
    include("Header.php");

    include("../Session/Engineer_Session.php");

    include("Database/Engineer_Data.php");

    $engineer = GetEngineerData();

?>
    

    <div class="container">

        <main role="main" class="text-center py-5">
  
            <div class="row row-cols-1 row-cols-lg-2 g-3" data-masonry='{"percentPosition": true }'>
 
                <section class="col engineer_info">
                        
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

                                    <div class="container">

                                        <div class="row">

                                            <p class="col m-0 p-2">Username</p>
                                            <p class="col m-0 p-2"><?php echo $username; ?></p>
                                            
                                        </div>

                                        <hr class="m-1 mx-4">

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

            
                <section class="col pending_appraisals">

                    <div class="card text-black">
            
                        <div class="card-header bg-white border-0">
            
                            <h3 class="m-1 p-1 text-white bg-blue rounded">Pending Appraisals</h3>
            
                        </div>

                        <div class="container"> 

                            <div class="row row-cols-1 g-2 text-start">

                                <div class="col">

                                    <div class="container border pending_overflow_items overflow-auto">

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-triangle-fill.svg" alt="Warning Overdue" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Appraisal Overdue for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Appraisal Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Appraisal Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Appraisal Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Appraisal Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\check-circle.svg" alt="Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Appraisal Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <a href="" class="btn btn-green btn-lg m-3 w-50 mx-auto text-black">Show All</a>      
        
                    </div>                 
               
                </section>

            
                <section class="col data my-2">

                    <div class="container"> 

                        <div class="row row-cols-1 row-cols-xl-2 g-2 text-start">

                            <div class="col">

                                <div class="container border">

                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">
                                            <img src="../bootstrap-icons\exclamation-circle.svg" aria-hidden="true" class="img-fluid w-100 p-1">
                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">Pending Apraisals</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">4</span>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="container border">
                                        
                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">
                                            <img src="../bootstrap-icons\exclamation-triangle-fill.svg" aria-hidden="true" class="img-fluid w-100 p-1">
                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">Overdue Appraisals</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">1</span>

                                    </div>
                                </div>

                            </div>

                            <div class="col">

                                <div class="container border">

                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">

                                            <img src="../bootstrap-icons\check-circle.svg" aria-hidden="true" class="img-fluid w-100 p-1">

                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">Completed Appraisals</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

                                    </div>

                                </div>

                            </div>


                            <div class="col">

                                <div class="container border">

                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">

                                            <img src="../bootstrap-icons\chat-square-dots.svg" aria-hidden="true" class="img-fluid w-100 p-1">

                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">Team Targets</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="container border">

                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">

                                            <img src="../bootstrap-icons\exclamation-triangle-fill.svg" aria-hidden="true" class="img-fluid w-100 p-1">

                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">Overdue Team Targets</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">1</span>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="container border">

                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">

                                            <img src="../bootstrap-icons\check-circle.svg" aria-hidden="true" class="img-fluid w-100 p-1">

                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">Completed Team Targets</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">1</span>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="container border">

                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">

                                            <img src="../bootstrap-icons\question-circle.svg" aria-hidden="true" class="img-fluid w-100 p-1">

                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">Additional Questions</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="container border">

                                    <div class="p-3 row align-items-center">

                                        <div class="col-1 col-lg-2 p-0">

                                            <img src="../bootstrap-icons\list-ul.svg" aria-hidden="true" class="img-fluid w-100 p-1">

                                        </div>

                                        <p class="m-0 h5 col-9 col-lg-8">To-Do</p>

                                        <span class="badge bg-secondary col-2 p-2 rounded-pill">9</span>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
            
                </section>

            
                <section class="col team_targets">
            
                    <div class="card text-black">
            
                        <div class="card-header bg-white border-0">
            
                            <h3 class="m-1 p-1 text-white bg-blue rounded">Team Targets</h3>
            
                        </div>
            
                        <div class="container"> 

                            <div class="row row-cols-1 g-2 text-start">

                                <div class="col">

                                    <div class="container border pending_overflow_items overflow-auto my-3">

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-triangle-fill.svg" alt="Warning Overdue" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Team Target Overdue for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Team Target Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Team Target Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Team Target Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Team Target Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\check-circle.svg" alt="Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Team Target Due for 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
    
                    </div> 
            
                </section>

            
                <section class="col additional_questions">

                    <div class="card text-black">
            
                        <div class="card-header bg-white border-0">
            
                            <h3 class="m-1 p-1 text-white bg-blue rounded">Additional Questions</h3>
            
                        </div>

                        <div class="container"> 

                            <div class="row row-cols-1 g-2 text-start">

                                <div class="col">

                                    <div class="container border pending_overflow_items overflow-auto my-3">

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Additional Question From Caj2</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>                                   

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Additional Question From Caj2</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Additional Question From Caj2</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>
                                    
                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Additional Question From Caj2</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Additional Question From Caj2</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>
                                        
                                    </div>
                                                                        
                                </div>                              

                            </div>

                        </div>

                    </div>

                </section>


                <section class="col to_do_list">

                    <div class="card text-black">
            
                        <div class="card-header bg-white border-0">
            
                            <h3 class="m-1 p-1 text-white bg-blue rounded">To-Do List</h3>
            
                        </div>

                        <div class="container"> 

                            <div class="row row-cols-1 g-2 text-start">

                                <div class="col">

                                    <div class="container border pending_overflow_items overflow-auto my-3">                                

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Goal Made 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>

                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Goal Made 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>
                                    
                                        <div class="p-2 row align-items-center border m-1">

                                            <div class="col-0 col-sm-1 p-0 d-none d-sm-block">
                                                <img src="../bootstrap-icons\exclamation-circle.svg" alt="Not Completed" class="img-fluid w-100 p-1">
                                            </div>

                                            <p class="col-12 col-sm-8 m-0 text-sm-start text-center">Goal Made 01 January 2022</p>
        
                                            <button class="col-4 col-sm-3 mx-auto btn btn-green info_btn ms-auto text-black ">Show Info</button>
        
                                        </div>
                                        
                                    </div>
                                                                        
                                </div>                              

                            </div>

                        </div>

                    </div>

                </section>

            
            </div>

        </main>

    </div>


<?php include("Footer.php"); ?>
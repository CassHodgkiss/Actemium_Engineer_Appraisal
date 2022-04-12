<?php

    //Session Logic for Team_Leader

    $path = "../Index.php"; 
     
    session_start();

    //Check if the current user is actualy logged in
    if (!isset($_SESSION['Username']) || $_SESSION['UserType'] != "Team_Leader")
    {
        print_r($_SESSION);
        //session_unset();
        //session_destroy();
        //header("Location:".$path);
    } 

    include("session.php");
    checkSession ($path); 
    
    $username = $_SESSION['Username'];

?>
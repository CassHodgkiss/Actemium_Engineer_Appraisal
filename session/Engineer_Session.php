<?php

    //Session Logic for Engineer

    $path = "../Engineer_Login.php"; 
     
    session_start();

    //Check if the current user is actualy logged in
    if (!isset($_SESSION['Username']) || $_SESSION['UserType'] != "Engineer")
    {
        session_unset();
        session_destroy();
        header("Location:".$path);
    } 

    include("session.php");
    checkSession ($path); 
    
    $username = $_SESSION['Username'];

?>
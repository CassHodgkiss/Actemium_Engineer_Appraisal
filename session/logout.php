<?php 

    $path = "../index.php";
    session_start();
    session_destroy();
    header('Location: ' .$path );
    exit;
    
?>


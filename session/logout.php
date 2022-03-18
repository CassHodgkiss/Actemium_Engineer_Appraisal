<?php 

    $path = "../Index.php";
    session_start();
    session_destroy();
    header('Location: ' .$path );
    exit;
    
?>


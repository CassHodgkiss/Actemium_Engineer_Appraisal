<?php

    $image = NULL;

    $file = 'C:/xampp/data/actemium/manager_pfp/manager_' . $_GET['id'];

    if(file_exists($file . ".jpg"))
    {
        $file .= ".jpg";

        header('Content-Type: image/jpg');
    
        header('Content-Length: ' . filesize($file));
    
        header('Content-Disposition: attachment; filename="ManagerPfp.jpg"'); 
    
        readfile($file);
        exit;
    }

    elseif(file_exists($file . ".png"))
    {
        $file .= ".png";

        header('Content-Type: image/png');
    
        header('Content-Length: ' . filesize($file));
    
        header('Content-Disposition: attachment; filename="ManagerPfp.png"'); 
    
        readfile($file);
        exit;
    }
    
    else 
    { 
        $file = 'C:/xampp/data/actemium/default.png';
        header('Content-Disposition: attachment; filename="default.png"'); 
        readfile($file);
        exit;
    }

?>
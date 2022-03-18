<?php

$file = 'C:/xampp/data/auction_images/auction_id_' . $_GET['id'] . '.jpg';

if (file_exists($file)) {

    header('Content-Type: image/jpeg');

    header('Content-Length: ' . filesize($file));

    header('Content-Disposition: attachment; filename="studentPic.jpg"'); 

    readfile($file);
    exit;
}
else {

    $file = 'C:/xampp/data/auction_images/default.jpg';
    header('Content-Disposition: attachment; filename="default.jpg"'); 
    readfile($file);
    exit;
}

?>
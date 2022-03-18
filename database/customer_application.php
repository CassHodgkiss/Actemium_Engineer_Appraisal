<?php

function createCustomer(){

    $created = false;//this variable is used to indicate the creation is successfull or not
    $db = new SQLite3('C:\xampp\data\auction_site.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = 'INSERT INTO 
    Customers(customer_username, customer_firstname, customer_lastname, customer_password, customer_email, customer_phone, customer_address_1, customer_address_2, customer_penalty, customer_status) 
    VALUES (:username, :firstname, :lastname, :password, :email, :phone, :address1, :address2, :penalty, :status)';
    $stmt = $db->prepare($sql); //prepare the sql statement

    $initial_penalty = 0;
    $status = "pending";

    //give the values for the parameters
    $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT); //we use SQLITE3_TEXT for text/varchar. You can use SQLITE3_INTEGER or SQLITE3_REAL for numerical values
    $stmt->bindParam(':firstname', $_POST['firstname'], SQLITE3_TEXT); 
    $stmt->bindParam(':lastname', $_POST['lastname'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':phone', $_POST['phone'], SQLITE3_TEXT);
    $stmt->bindParam(':address1', $_POST['address1'], SQLITE3_TEXT);
    $stmt->bindParam(':address2', $_POST['address2'], SQLITE3_TEXT);
    $stmt->bindParam(':penalty', $initial_penalty, SQLITE3_INTEGER);
    $stmt->bindParam(':status', $status, SQLITE3_TEXT);

    //execute the sql statement
    $stmt->execute();

    //the logic
    if($stmt){
        $created = true;
    }

    return $created;
}

?>
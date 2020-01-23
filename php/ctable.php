<?php

/* Attempt MySQL server connection. Assuming you are running MySQL

server with default setting (user 'root' with no password) */

$link = mysqli_connect("localhost", "root", "", "demo");

 

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}

 

// Attempt create table query execution

$sql = "CREATE TABLE users (

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,

    username VARCHAR(50) NOT NULL UNIQUE,

    password  VARCHAR(250) NOT NULL

)";

if(mysqli_query($link, $sql)){

    echo "Table created successfully.";

} else {

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

}

 

// Close connection

mysqli_close($link);




/*********************
// Step 1: Creating the Database Table

$sql="CREATE TABLE users (

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,

    username VARCHAR(50) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP

)";

******************************/

?>







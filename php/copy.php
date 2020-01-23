<?php

//Database credentials. Assuming you are running MySQL

//server with default setting (user 'root' with no password) 

define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'root');

define('DB_PASSWORD', '');

define('DB_NAME', 'demo');

 

/* Attempt to connect to MySQL database */

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 

// Check connection

if($link === false)
      {

    die("ERROR: Could not connect. " . mysqli_connect_error());

      }
      
      
      if(isset($_POST['username'])&&!empty($_POST['username'])
      && isset($_POST['password'])&&!empty($_POST['password']) )
      {
      $username=mysqli_escape_string($_POST['username']);
      
      $password=mysqli_escape_string($_POST['password']);
      
      $sql="SELECT username,password, active FROM admin WHERE username=.$username. AND password =.$password. AND active='1' "; 
      
      $search =mysqli_query($sql) or die(mysqli_error());
      
      $match =myqli_num_rows($search);
      
      if($match >0){
            
            $msg ="Login successful";
            
            }
            else
            {
                  $msg="Login failed";
            }
    
      }

?>















































































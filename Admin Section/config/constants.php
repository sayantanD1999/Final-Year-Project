<?php 
//start session
session_start();

    
    //create constants to store non-repeating values
    define('SITEURL','http://localhost/project-finalyear/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','project-finalyear');
$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//connect our database using cradentials localhost,username='root'(here by default),password=''(here by default)

$db_select =mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database ;here databsename is food-order


?>
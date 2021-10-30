<?php
    $hostname = 'localhost';
    $username = 'tubes';
    $password = 'Tubes123';
    $dbname = 'u302659246_db_tubes';

    $conn = mysqli_connect($hostname, $username,$password, $dbname);

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
?>
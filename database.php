<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "agriculturesupplychain";
    $conn = "";

    try{
        $conn = mysqli_connect($db_server,
                            $db_user,
                            $db_pass,
                            $db_name,
                            $conn);
    }

    catch(mysqli_sql_exception){
        echo"Could not connect";
    }

    if($conn){
        echo"You are connected";
    }
?>
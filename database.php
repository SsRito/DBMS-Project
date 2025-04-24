<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "agriculturesupplychain";
    $conn = "";

    $conn = mysqli_connect($db_server,
                            $db_user,
                            $db_pass,
                            $db_name,
                            $conn);
    if($conn){
        echo"You are connected";
    }
    else{
        echo"Could not connect";
    }
?>
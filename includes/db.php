<?php 
    $connection = mysqli_connect("localhost", "root", "", "cms");

    if(!$connection){
        die("NO db connection");
        return;
    }
?>
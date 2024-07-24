<?php 
    $connection = mysqli_connect("localhost", "root", "", "cms");

    if(!$connection){
        die("No db connection");
        return;
    }
?>
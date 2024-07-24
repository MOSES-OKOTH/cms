<?php
    session_start();
    
    include "../includes/db.php";

    if(isset($_POST['name'])){
        $id = "CMS".date("YmdHis");
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $added_on = date("Y-m-d H:m:s");

        if(isset($_SESSION['userId'])){
            $reg_no = $_SESSION['userId'];
        } else{
            $reg_no = "";
        }

        $sql = "INSERT INTO complaints(id, name, contact, subject, message, status, added_on, reg_no) VALUES ('$id', '$name', '$contact', '$subject', '$message', '0', '$added_on', '$reg_no')";

        $res = mysqli_query($connection, $sql);

        if($res){
            echo $id;
        } else{
            echo "error";
        }
    }
?>
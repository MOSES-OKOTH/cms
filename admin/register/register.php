<?php
    session_start();

    include "../db.php";


    if(isset($_POST['name'])){
        $name = htmlspecialchars(strtoupper($_POST['name']));
        $reg = htmlspecialchars(strtoupper($_POST['reg']));
        $dpt = htmlspecialchars($_POST['dpt']);
        $phone = htmlspecialchars($_POST['phone']);
        $gender = htmlspecialchars($_POST['gender']);
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $added_on = date("Y-m-d H:ma");

        $preResults = mysqli_query($connection, "SELECT * FROM students WHERE reg_no = '$reg'");

        if(mysqli_num_rows($preResults)==1){
            echo "exist";
        } else{
            $registerQuery = "INSERT INTO students(reg_no, name, gender, email, phone_no, department, password, added_on) VALUES ('$reg', '$name', '$gender', '$email', '$phone', '$dpt', '$password', '$added_on');";

            $results = mysqli_query($connection, $registerQuery);

            if($results){
                echo "success";
            } else{
                echo "error";
                return ;
            }
        }    
    }
?>
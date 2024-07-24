<?php
    session_start();

    include "../includes/db.php";
    include "../includes/alt-links.php";

    if(isset($_SESSION['userId'])){
        $sql = "SELECT * FROM students WHERE reg_no = '".$_SESSION['userId']."'";

        // echo $sql;

        $res = mysqli_query($connection, $sql);

        if($res){
            if(mysqli_num_rows($res) > 0){
                $data = mysqli_fetch_assoc($res);

                // var_dump($data);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../index.css">    
    <script src="../index.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Complaint | CMS -Technical University of Mombasa</title>
</head>
<body>
    <?php
        include '../includes/header.php';
    ?>

    <div class="complaint">
        <div>
            <h1>Submit Complaints</h1>
            <p>Fill in the form below with the appropriate details to submit a complaint.</p>
            <p>*For anonymous complaints you can leave the name field blank</p>
            <p id='success'>Success Message</p>
        </div>

        <div>
            <form action="">
               <input type="text" name="" id="name" value='<?php if(isset($data)){ echo $data['name']; } ?>' placeholder="Full Names">

               <input type="text" id="contact" value='<?php if(isset($data)){ echo $data['email']." - ".$data['phone_no']; } ?>' placeholder="Contact Details">

               <input type="text" name="" id="subject" placeholder="Subject">

               <textarea name="" id="message" placeholder="Type your complaint here"></textarea>

               <button id="btn">Submit Complaint <i class="fa-solid fa-long-arrow-right"></i></button>
            </form>
        </div>
    </div>

    <script>
        /*CHECKING FOR BLANK FIELDS*/
        let btn = document.getElementById("btn");

        btn.style.pointerEvents = "none";

        let subject = document.getElementById("subject");
        let message = document.getElementById("message");
        let contact = document.getElementById("contact");

        contact.addEventListener('input', function(){
            if(contact.value.length >= 10 && subject.value.length >= 5 && message.value.length >= 10){
                btn.style.pointerEvents = "all";
            } else{
                btn.style.pointerEvents = "none";
            }
        });

        subject.addEventListener('input', function(){
            if(contact.value.length >= 10 && subject.value.length >= 5 && message.value.length >= 10){
                btn.style.pointerEvents = "all";
            } else{
                btn.style.pointerEvents = "none";
            }
        });

        message.addEventListener('input', function(){
            if(contact.value.length >= 10 && subject.value.length >= 5 && message.value.length >= 10){
                btn.style.pointerEvents = "all";
            } else{
                btn.style.pointerEvents = "none";
            }
        });


        
        /*CAPITALIZING INPUTS*/
        document.getElementById("name").addEventListener("input", function(){
            document.getElementById("name").value = document.getElementById("name").value.toUpperCase();
        })

        document.getElementById("subject").addEventListener("input", function(){
            document.getElementById("subject").value = document.getElementById("subject").value.toUpperCase();
        })


        /*AJAX REQUEST*/
        $(document).ready(
            function(){
                $("#btn").click(                    
                    function(e){
                        e.preventDefault();

                        $("#btn").html("<img src='../assets/loading.gif'> Loading...");

                        $.ajax({
                            method: "POST",
                            url: "./add.php",
                            data: {
                                name: $("#name").val(),
                                contact: $("#contact").val(),
                                subject: $("#subject").val(),
                                message: $("#message").val()
                            },
                            success: function(res){
                                if(res != "error"){
                                    $("#btn").html("<i class='fa-solid fa-check'></i>Submitted Successfully");

                                    $("#btn").css({
                                        pointerEvents: "none"
                                    });

                                    $("#success").html("<i class='fa-solid fa-check'></i> &nbsp;Complaint Sent Successfully. ID: "+res);

                                    $("#success").css({
                                        display: "block"
                                    });

                                } else{
                                    alert("An error occured while submitting your complaint");
                                }
                            }
                        })
                    }
                )
            }
        )
    </script>
</body>
</html>
<?php
    session_start();

    include "../alt-links.php";

    if(!isset($_SESSION['adminId'])){
        header("Location: ../");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Registration | eService: West Pokot County</title>
    <style>
        body{
            display: flex;
            height: 100vh;
            width: 100vw;
        }        

        .signup-container{
            height: 100vh;
            width: 100%;
            overflow-y: scroll;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5vh;
        }

        .signup{
            padding: 2vw;
            display: flex;
            flex-direction: column;
        }

        .signup-header{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-header h2{
            color: var(--primary);
            font-size: 1.45vw;
            font-weight: 600;
        }

        .signup-header p{
            font-size: 1vw;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.65)
        }

        .signup-main{
            display: flex;
            flex-direction: column;
        }

        .signup-main .names{
            display: flex;
            flex-direction: row;
            gap: 2vw;
        }

        .signup-main .names input{
            width: 32vw;
            padding: 1vh 2vw;
            height: 2rem;
        }

        .signup-main .names select{
            width: 36vw;
            padding: 1vh 2vw;
            height: 3.2rem;
        }

        .signup-main p{
            color: var(--primary);
            font-size: 1.05vw;
            font-weight: 500;
            margin-top: 1.5vh;
        }

        .signup-main input, select{
            border: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 6px;
            padding: 1vh 2vw;
            height: 3vw;
            outline: none;
            text-overflow: ellipsis;
            font-weight: 500;
            font-size: 1vw;
        }


        .signup-main input::placeholder, select::placeholder{
            font-size: 1vw;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.35);
            text-overflow: ellipsis;
        }


        .signup-main form button{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            font-size: 1.15vw;
            font-weight: 600;
            color: white;
            background: var(--primary);
            width: 100%;
            border: none;
            border-radius: 8px;
            padding: 1vh;
            margin-top: 5vh;
            border: 2px solid var(--primary);
        }

        .signup-main form button img{
            height: 1.15vw;
            margin-right: 8px;
        }

        .signup-main form button i{
            margin-left: 4px;
        }

        .signup-main form button:hover{
            cursor: pointer;
            color: var(--primary);
            background: none;
            border: 2px solid var(--primary);
            transition: 250ms;
        }

        .signup-error{
            margin-bottom: 4vh;
            border: 2px solid rgba(255, 0, 10, 0.9);
            background: rgba(255, 0, 0, 0.05);
            border-radius: 2px;
            padding: 1vh 1vw;
            font-size: 1vw;
            font-weight: 500;
            display: none;
            flex-direction: row;
            align-items: center;
            color: black;
        }

        .signup-error i{
            color: white;
            height: 1.3vw;
            width: 1.3vw;
            border: 2px solid rgba(255, 0, 0, 0.95);
            border-radius: 50%;
            background: rgba(255, 0, 0, 0.55);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bolder;
            margin-right: 8px;
        }

        .signup-success{
            margin-bottom: 4vh;
            border: 2px solid green;
            background: rgba(0, 255, 0, 0.05);
            border-radius: 2px;
            padding: 1vh 1vw;
            font-size: 1vw;
            font-weight: 500;
            display: none;
            flex-direction: row;
            align-items: center;
            color: black;
        }

        .signup-success i{
            color: white;
            height: 1.3vw;
            width: 1.3vw;
            padding: 0.2vw;
            border: 2px solid rgba(0, 255, 0, 0.95);
            border-radius: 50%;
            background: rgba(0, 255, 0, 0.55);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bolder;
            margin-right: 8px;
        }

        hr{
            margin-top: 4vh;
            color: var(--primary);
        }
    </style>
</head>
<body>
    <?php include "../side.php"; ?>

    <div class="signup-container">
        <section class='signup'>
            <?php
                if(!empty($regError)){
                    echo "";
                }

                if(!empty($regSuccess)){
                    echo "";
                }
            ?>
            <p class='signup-error'><i class='fa-solid fa-exclamation'></i> The student already has an active account.</p>

            <p class='signup-success'><i class='fa-solid fa-check'></i> The Student is Registered Successfully.</p>

            <div class='signup-header'>
                <h2>Student Registration Form</h2>
                <p>Fill in the form with accurate information as documented in the students's admission form.</p>
            </div>
            <hr>

            <div class="signup-main">
                <form action="" method='post' id='regForm'>
                    <div class="names">
                        <div class="signup-input-group">
                            <p>Full Name</p>
                            <input type="text" name='name' id="name" placeholder="Enter Students's Full Name" required tabindex="1">
                        </div>

                        <div class="signup-input-group">
                            <p>Registration Number</p>
                            <input type="text" name='reg' id="reg" placeholder="Enter Student's Registration Number" required tabindex="2">
                        </div>
                    </div>

                    <div class="names">
                        <div class="signup-input-group">
                            <p>Gender</p>
                            <select name="gender" id="gender" tabindex="3">
                                <option value="">-- Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="signup-input-group">
                            <p>Department</p>
                            <input type="text" name='dpt' id="dpt" required='required' tabindex="4" placeholder="Student's Department">
                        </div>
                    </div>
                
                    <div class="names">
                        <div class="signup-input-group">
                            <p>Email</p>
                            <input type="text" name='email' id="email" placeholder='Email Address' required tabindex="5">
                        </div>

                        <div class="signup-input-group">
                            <p>Phone Number</p>
                            <input type="text" name='phoneNumber' id="phone" placeholder='Enter Phone Number e.g 07xxxxxxxx or 01xxxxxxx' required tabindex="6">
                        </div>
                    </div>

                    <div class="names">
                        <div class="signup-input-group">
                            <p>Create Password</p>
                            <input type="password" name='password' id='pass1' placeholder='Set Password' oninput="passChecker()" required tabindex="7">
                            <p id="pass-warn-length" style="color: var(--red); font-size: 0.6rem; font-weight: 600; margin-left: 4px;"></p>
                        </div>

                        <div class="signup-input-group">
                            <p>Confirm Password</p>
                            <input type="password" id='pass2' placeholder='Confirm Password' oninput="passChecker()" required tabindex="8">
                            <p id="pass-match-msg" style="color: var(--red); font-size: 0.6rem; font-weight: 600; margin-left: 4px;"></p>
                        </div>
                    </div>

                    <button type='submit' id='register-btn' tabindex="9">Register <i class="fa-solid fa-long-arrow-right"></i></button>
                </form>
            </div>
        </section>
    </div>


    <script>
        /*AJAX CALL*/
        $(document).ready(
            $("#register-btn").click(
                function(e){
                    e.preventDefault();

                    if($("#name").val() == '' ||  $("#reg").val() == '' || $("#email").val() == '' || $("#phone").val() == '' || $("#pass1").val() == '' || $("#gender").val() == '' || $("#dpt").val() == ''){
                        alert("Error: ERR_BLANK_FORM\nFill in the form completely to register a student");

                        return;
                    } else{
                        $("#register-btn").html("<img src='../assets/loading.gif'> Submitting Details...");
                    }

                    /*Ajax Request*/
                    $.ajax({
                        method: "POST",
                        url: "./register.php",
                        data: {
                            reg: $("#reg").val(),
                            name: $("#name").val(),
                            dpt: $("#dpt").val(),
                            gender: $("#gender").val(),
                            email: $("#email").val(),
                            phone: $("#phone").val(),
                            pass: $("#pass1").val()
                        },
                        success: function(res){
                            if(res == "success"){ 
                                $(".signup-success").css({
                                    'display': "flex"
                                });

                                $(".signup-error").css({
                                    'display': "none"
                                });

                                let putInt = setInterval(function(){
                                    $("#register-btn").html("Register <i class='fa-solid fa-long-arrow-right'></i>");
                                }, 2500);

                                setTimeout(function(){
                                    clearInterval(putInt);
                                }, 2500);

                                document.getElementById("regForm").reset();
                            } else if(res == "exist"){
                                $(".signup-error").css({
                                    'display': "flex"
                                });

                                $(".signup-success").css({
                                    'display': "none"
                                });

                                let putInt = setInterval(function(){
                                    $("#register-btn").html("Register <i class='fa-solid fa-long-arrow-right'></i>");
                                }, 2500);

                                setTimeout(function(){
                                    clearInterval(putInt);
                                }, 2500);
                            } else{
                                alert("Unexpected error occured while processind your request\n"+res);
                            }
                        }
                    })
                }
            )
        )

        /*PASSWORD CHECKER IN SIGNUP PAGE*/
        function passChecker(){
            let pass1 = document.getElementById('pass1');
            let passWarningLength = document.getElementById('pass-warn-length');
            

            let pass2 = document.getElementById('pass2');
            let passMatchMessage = document.getElementById('pass-match-msg');

            let regBtn = document.getElementById('register-btn');
            regBtn.style = "pointer-events: none";

            pass1.addEventListener('input', ()=>{
                if(pass1.value.length >= 8){
                    passWarningLength.textContent = "";
                } else{
                    passWarningLength.textContent = "* Password should be at least 8 characters long.";
                    regBtn.style = "pointer-events: none;";
                }
            });

            pass2.addEventListener('input', ()=>{
                if(pass2.value.length >= pass1.value.length){
                    if(pass1.value != pass2.value){
                        passMatchMessage.textContent = "* Passwords do not match";
                        regBtn.style = "pointer-events: none;";
                    } else{
                        passMatchMessage.textContent = "";
                        regBtn.style = "pointer-events: auto;";
                    }
                }
            });
            
        }

        /*CAPITALIZING NAMES*/
        let name = document.getElementById('name');
        let reg = document.getElementById('reg');

        name.addEventListener('input', function(){
            name.value = name.value.toUpperCase();
        });

        reg.addEventListener('input', function(){
            reg.value = reg.value.toUpperCase();
        });

    </script>
</body>
</html>
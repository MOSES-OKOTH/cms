<?php
    session_start();

    include "./includes/alt-links.php";
    include "./includes/db.php";

    if(isset($_POST['id']) && isset($_POST['pass'])){
        $id = $_POST['id'];
        $pass = $_POST['pass'];

        $sql = "SELECT * FROM students WHERE reg_no= '".$id."' AND password = '".$pass."'";

        $res = mysqli_query($connection, $sql);

        if($res){
            if(mysqli_num_rows($res) > 0){
                $data = mysqli_fetch_assoc($res);
                $_SESSION['userId'] = $data['reg_no'];

                // echo $_SESSION['userId'];
                header("Location: ./");
                exit();
            } else{
                $loginError = "Invalid Student Credentials!";
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Login | CMS - Technical University of Mombasa</title>
    <style>
        .login-container{
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login{
            width: max-content;
            box-shadow: 0px 0px 5px black;
            border-radius: 8px;
            padding: 40px 50px;
        }

        .login-header{
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-weight: 500;
            color: var(--primary);
            font-size: 1vw;
            margin-bottom: 1vh;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
        }

        .login-header img{
            height: 5.5vw;
            margin-bottom: 1vh;
        }

        .login form{
            display: flex;
            flex-direction: column;
        }

        .login form div{
            display: flex;
            flex-direction: column;
        }

        .login form div:last-child{
            display: flex;
            flex-direction: column;
            gap: 1.5vh;
            margin-top: 5vh;
        }

        .login form p{
            margin-top: 2.5vh;
            font-weight: 600;
            color: var(--primary);
            font-size: 1vw;
        }

        .login form input{
            outline: none;
            min-width: 25vw;
            height: 2vw;
            padding: 4px 1rem;
            border: 2px solid rgba(0, 0, 0, 0.45);
            border-radius: 4px;
        }

        .login form input::placeholder{
            font-size: 0.95vw;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.25);
        }

        .login form button{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 8px;
            font-size: 1vw;
            font-weight: 500;
            padding: 1vh 0;
            color: var(--primary);
            border: 2px solid var(--primary);
            background: none;
        }

        .login form button:hover{
            cursor: pointer;
            transition: 250ms;
            color: white;
            background: var(--primary);
        }

        .login form a{
            text-decoration: none;
            color: var(--primary);
            font-size: 1vw;
        }

        .login form a:hover{
            text-decoration: underline;
        }

        .login-error{
            font-size: 1vw;
            font-weight: 500;
            padding: 4px 1vw;
            border: 2px solid red;
            background: rgba(255, 0, 0, 0.05);
        }

    </style>
</head>

<body onload="removePreloader()">
    <section class='preloader'>
        <div class='loader'></div>
    </section>

    <section class="login-container">
        <div class="login">
            <div class="login-header">
                <img src="./assets/logo1.png" alt="">
                <h1>Student Login</h1>
            </div>

            <form action="" method="post">
                <?php 
                    if(!empty($loginError)){
                        echo "
                        <div class='login-error'>
                           ".$loginError."
                        </div>";    
                    }
                ?>
                <div>
                    <p>Registration Number</p>
                    <input type="text" name="id" id="id" placeholder="Enter Your Registration Number" required>
                </div>

                <div>
                    <p>Password</p>
                    <input type="password" name="pass" id="pass" placeholder="Enter Your Password" required>
                </div>

                <div>
                    <button type="submit" id='adm-btn'>Login <i class="fa-solid fa-long-arrow-right"></i></button>
                    <br>
                    <a href="./admin" style="display: flex; justify-content: center;">Admin Login</a>
                </div>
            </form>
        </div>
    </section>
    
    
    <script src="../index.js"></script>
    <script>        
        let btn = document.getElementById("adm-btn");
        let id = document.getElementById('id');
        let pass = document.getElementById('pass');

        btn.addEventListener('click', function(){
            if(pass.value.length != 0 && id.value.length != 0){
                document.querySelector(".preloader").style.display = "flex"; 
            }
        });
    </script>
</body>
</html>
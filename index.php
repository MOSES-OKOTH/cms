<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="index.css">    
    <script src="index.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CMS | Technical University of Mombasa</title>
</head>
<body>
    <?php
    include './includes/header.php';
    ?>


    <section class="home">
        <div>
            <img src="./assets/img.jpg" alt="">
        </div>

        <div>
            <div>
                <h2>Welcome to Technical University of Mombasa Complaint Management System</h2>
                <p>Have a burning issue? Kindly reach up to us anonymously or as a known affiliate of the TUM community. <br>We are glad and privileged to solve your grievances!</p>
            </div>

            <div>
                <?php if(!isset($_SESSION['userId'])): ?>
                    <a href="./complaint/">
                        Complain Anonymously
                    </a>

                    <a href="./login.php">
                    Login to Complain
                </a>
                <?php endif; ?>

                <?php if(isset($_SESSION['userId'])): ?>
                    <a href="./complaint">
                        File a Complaint &nbsp; <i class="fa-solid fa-long-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>
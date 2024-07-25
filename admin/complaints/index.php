<?php
    session_start();

    include "../alt-links.php";

    if(!isset($_SESSION['adminId'])){
        header("Location: ../");
        exit();
    }

    include "../db.php";

    $sql = "SELECT * FROM complaints WHERE message != '' ORDER BY added_on ASC";

    $res = mysqli_query($connection, $sql);

    if($res){
        $data = mysqli_fetch_all($res);
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
    <title>Complaints | CMS - technical University of Mombasa</title>
    <style>
        body{
            display: flex;
            flex-direction: row;
            overflow: hidden;
        }

        .feedback{
            padding: 8vh 5vw;
            width: 100%;
            height: calc(100vh - 100px);
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            background: rgba(0, 0, 0, 0.015);
        }

        .feedback-header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
        }

        .feedback-header h1{
            font-size: 1.5vw;
            font-weight: 600;
            color: var(--primary);
        }

        .feedback-header input{
            width: 30vw;
            height: 2vw;
            border: 2px solid rgba(0, 0, 0, 0.45);
            border-radius: 8px;
            padding: 1vh 2vw;
            outline: none;
            font-weight: 500;
            font-size: 1vw;
        }

        input::placeholder{
            font-weight: 500;
            font-size: 0.9vw;
            color: rgba(0, 0, 0, 0.35);
        }

        .filters{
            margin-top: 1vh;
            display: flex;
            flex-direction: column;
            padding-bottom: 2.5vh;
        }

        .filters h5{
            font-size: 0.8vw;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.35);
        }

        .filters div:last-child{
            display: flex;
            flex-direction: row;
            gap: 1vw;
        }

        .filters div:last-child button{
            margin-top: 0.5vh;
            padding: 1vh 2vw;
            font-size: 0.8vw;
            font-weight: 500;
            background: none;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.25);
            outline: none;
        }

        .filters div:last-child button:hover{
            background: rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: 150ms;
        }

        .feedback-results{
            max-height: 95vh;
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
            padding: 1vh 1vw 1vh 0;
        }

        .feedback-message{
            padding: 2vh 2vw;
            background: white;
            border-radius: 8px;
            margin-bottom: 1.5vh;
        }

        .feedback-message h1{
            font-weight: 600;
            font-size: 1.05vw;
            color: var(--primary);
            padding-bottom: 2px;
        }

        .feedback-message h2{
            font-weight: 600;
            font-size: 0.85vw;
            color: rgba(0, 0, 0, 0.35);
            padding-bottom: 2px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feedback-message p{
            font-size: 1vw;
            color: black;
            margin: 1vh 0;
        }

        .feedback-message div:last-child{
            padding-top: 6px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .feedback-message div:last-child p{
            color: rgba(0, 0, 0, 0.35);
            font-size: 0.8vw;
        }

        .feedback-message div:last-child button{
            background: none;
            padding: 4px 1.2vw;
            border: 2px solid var(--primary);
            color: var(--primary);
            font-size: 0.9vw;
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .feedback-message div:last-child button img{
            height: 1vw;
            margin-right: 8px;
        }

        .feedback-message div:last-child button i{
            margin-right: 8px;
        }

        .feedback-message div:last-child button:hover{
            cursor: pointer;
            background: rgba(0, 255, 0, 0.05);
        }

        .loading{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
        }

        .loading img{
            height: 4vw;
            width: auto;
            aspect-ratio: 1/1;
        }

        .loading p{
            font-weight: 500;
            font-size: 1vw;
            color: rgba(0, 0, 0, 0.5);
        }

        #resolved{
            background: rgba(0, 0, 0, 0.15);
            pointer-events: none;
            font-weight: 500;
        }

        .no-feedback{
            width: 100%;
            min-height: 50vh;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style>
</head>

<body>
    <?php include "../side.php"; ?>


    <section class="feedback">
        <div class="feedback-header">
            <h1>Feedbacks & Complaints</h1>
            <input type="text" id="search" placeholder="Type here to search..." tabindex="1">
        </div>

        <div class="filters">
            <div>
                <h5>Filter incoming feedbacks & complaints</h5>
            </div>

            <div>
                <button id="filter" value="daily">Today's Feedbacks</button>
                <button id="filter" value="monthly">This Month's Feedbacks</button>
                <button id="filter" value="annual">This Year's Feedbacks</button>
                <button id="filter" value="resolved">Resolved</button>
                <button id="filter" value="pending">Pending</button>
                <button id="filter" value="all">All</button>
            </div>
        </div>

        <div class="feedback-results">
            <?php foreach($data as $record): ?>
                <div class="feedback-message">
                    <div>
                        <h1><?=$record[3]; ?></h1>
                    </div>

                    <div>
                        <h2>By <?=$record[1]; ?> &nbsp; &nbsp; | &nbsp; &nbsp; Contacts: <?php if(empty($record[2])){ echo "NULL"; }else{echo $record[2]; } ?></h2>
                    </div>

                    <div>
                        <p><?=$record[4]; ?></p>
                    </div>
                    
                    <div>
                        <p>Sent on <?=$record[6]; ?></p>
                        <div id="btns">
                            <?php
                                if($record[5] == '0'){
                                    echo "<button id='resolve' value='".$record[0]."'>Add to Resolved</button>";
                                } else{
                                    echo "<button id='resolved'><i class='fa-solid fa-check'></i> Resolved</button>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script src="../index.js"></script>
    <script>
        //Adding Resolved Feedbacks
        $(document).ready(
            function(){
               let resolveBtn = document.querySelectorAll("#resolve");
               
               resolveBtn.forEach((btn)=>{
                    btn.addEventListener('click', function(){
                        btn.innerHTML = "<img src='../assets/loading.gif'> Processing...";

                        $.ajax({
                            method: "GET",
                            url: "./feed.php",
                            data: {
                                id: this.value
                            },
                            success: function(r){
                                if(r == 'success'){
                                    btn.innerHTML = "<i class='fa-solid fa-check'></i> Resolved";
                                    btn.style = "background: rgba(0,0,0,0.05); pointer-events: none;";
                                } else{
                                    btn.innerHTML = "Add to Resolved";
                                }
                            }
                        })
                    })
               })
            

                //Searching Feedbacks
                let search = document.getElementById("search");

                search.addEventListener('input', function(){
                    $(".feedback-results").html("<div class='loading'><img src='../assets/loading.gif'><br>Loading... Please wait a moment </div>");

                    $.ajax({
                        method: "GET",
                        url: "./search.php",
                        data: {
                            q: search.value
                        },
                        success: function(res){
                            $(".feedback-results").html(res);
                        }
                    })
                });

                //Adding Filters
                let filterBtns = document.querySelectorAll("#filter");

                filterBtns.forEach((filter)=>{
                    filter.addEventListener('click', function(){
                        $(".feedback-results").html("<div class='loading'><img src='../assets/loading.gif'><br>Loading... Please wait a moment </div>");

                        $.ajax({
                            method: "GET",
                            url: "./search.php",
                            data: {
                                q: this.value
                            },
                            success: function(response){
                                $(".feedback-results").html(response);
                            }
                        })
                    })
                })
            }
        )
    </script>
</body>
</html>
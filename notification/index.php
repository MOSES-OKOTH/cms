<?php
    session_start();

    include "../includes/alt-links.php";
    include "../includes/db.php";
    
    function formatDate($date){
        $dateArray = explode("-", $date);
        $year = $dateArray[0];
        $month = $dateArray[1];
        $day = $dateArray[2];

        // formatting month
        if($month == "01")
            $month = "January";
        else if($month == "02")
            $month = "February";
        else if($month == "03")
            $month = "March";
        else if($month == "04")
            $month = "April";
        else if($month == "05")
            $month = "May";
        else if($month == "06")
            $month = "June";
        else if($month == "07")
            $month = "July";
        else if($month == "08")
            $month = "August";
        else if($month == "09")
            $month = "September";
        else if($month == "10")
            $month = "October";
        else if($month == "11")
            $month = "November";
        else if($month == "12")
            $month = "December";
        else
            $month = "N/A";

        //formatting date
        if($day == "01" || $day == "21" || $day == "31")
            $day = $day."st";
        else if($day == "02" || $day == "22")
            $day = $day."nd";
        else if($day == "03" || $day == "23")
            $day = $day."rd";
        else
            $day = $day."th";


        return $day." ".$month." ".$year;
    }

    if(isset($_SESSION['userId'])){
        if(isset($_GET['search'])){
            $sql = "SELECT * FROM notifications WHERE reg_no = 'all' AND subject LIKE '%".$_GET['search']."%' OR reg_no = '".$_SESSION['userId']."' AND message LIKE '%".$_GET['search']."%' ORDER BY added_on DESC"; 
        } else{
            $sql = "SELECT * FROM notifications WHERE reg_no = 'all' OR reg_no = '".$_SESSION['userId']."' ORDER BY added_on DESC";
        }

        $res = mysqli_query($connection, $sql);

        if($res){
            $data = mysqli_fetch_all($res);
        } else{
            echo "An error occured";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Notifications | CMS - Technical University of Mombasa</title>
    <style>
        @media screen and (min-width: 800px){
            .messages{
                padding: 5vh 5vw;
                display: flex;
                flex-direction: column;
                background: rgba(0,0,0,0.025);
            }

            .messages-header{
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2.5vh;
                padding-bottom: 2vh;
                border-bottom: 2px solid rgba(0,0,0,0.15);
            }

            .messages-header div{
                display: flex;
                flex-direction: row;
                align-items: center;
            }

            .messages-header h1{
                font-weight: 500;
                font-size: 1.5rem;
            }

            .messages-header input{
                outline: none;
                height: 3rem;
                border-radius: 1rem;
                border: 2px solid rgba(0,0,0,0.25);
                padding: 4px 2.5vw;
                width: 50vw;
                text-overflow: ellipsis;
            }

            .messages-header input::placeholder{
                font-size: 1rem;
            }

            .messages-header button{
                z-index: 2;
                position: absolute;
                right: 6vw;
                border: none;
                background: none;
                font-size: 1.5rem;
                color: rgba(0,0,0,0.15);
            }

            .messages-header button:hover{
                color: rgba(0,0,0,0.45);
                cursor: pointer;
            }

            .messages-main{
                padding: 2vh 1vw;
                max-height: 80vh;
                overflow-y: scroll;
            }

            .loading{
                padding: 15vh 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 2.5vh;
            }

            .loading p{
                font-size: 1rem;
                color: rgba(0,0,0,0.75);
            }

            .loading img{
                height: 60px;
                aspect-ratio: 1/1;
            }

            .no-results{
                padding: 15vh 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 2.5vh;
            }

            .no-results p{
                font-size: 1.05rem;
                font-weight: 500;
                color: rgba(0,0,0,0.75);
            }

            .no-results img{
                height: 100px;
                aspect-ratio: 1/1;
            }

            .no-messages{
                min-height: 50vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: rgba(0,0,0,0.45);
                font-weight: 500;
            }
            .message{
                background: white;
                padding: 2vh 2vw;
                margin-top: 2vh;
                border-radius: 4px;
            }

            .message:first-child{
                border-radius: 24px 24px 0px 0px;
                padding: 3vh 2vw
            }

            .message:last-child{
                border-radius: 0px 0px 24px 24px;
            }

            .message:only-child{
                border-radius: 4px;
            }

            .message h2{
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                color: var(--primary);
                font-weight: 600;
                font-size: 1.25rem;
                border-bottom: 1px solid rgba(0,0,0,0.15);
            }

            .message h2 span{
                color: rgba(0,0,0,0.15);
                font-size: 1rem;
                font-weight: 500;
            }

            .message p{
                font-size: 1.05rem;
                margin-top: 1vh;
            }

            .message p:last-child{
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                margin-top: 1rem;
                /* border-top: 1px solid rgba(0,0,0,0.15); */
                font-size: 1rem;
            }

            .message p:last-child span{
                color: rgba(0,0,0,0.5);
            }

            .message #allBtn{
                font-size: 1rem;
                font-weight: 500;
                padding: 0.5rem 1rem;
                border: none;
                border-radius: 4px;
                background: rgba(0,0,0,0.25);
                color: green;
            }

            .message #markRead{
                font-size: 1rem;
                font-weight: 500;
                padding: 0.5rem 1rem;
                border: 2px solid var(--primary);
                border-radius: 4px;
                background: none;
                color: var(--primary);
            }

            .message #markRead:hover{
                cursor: pointer;
                background: rgba(0,0,0,0.15)
            }

            .message #markRead img{
                height: 1rem;
                margin-right: 8px;
            }

            .message #alreadyRead{
                font-size: 1rem;
                font-weight: 500;
                padding: 0.5rem 1.5rem;
                border: none;
                border-radius: 4px;
                background: rgba(0,0,0,0.25);
                color: green;
            }
        }

        /*MOBILE VIEW*/
        @media screen and (max-width: 800px){
            .messages{
                padding: 5vh 5vw;
                display: flex;
                flex-direction: column;
                background: var(--bg1);
            }

            .messages-header{
                display: flex;
                flex-direction: column;
                gap: 1vh;
                margin-bottom: 2.5vh;
                padding-bottom: 2vh;
                border-bottom: 2px solid rgba(0,0,0,0.15);
            }

            .messages-header div{
                display: flex;
                flex-direction: row;
                align-items: center;
            }

            .messages-header h1{
                font-weight: 500;
                font-size: 18px;
            }

            .messages-header input{
                outline: none;
                height: 40px;
                border-radius: 4px;
                border: 2px solid rgba(0,0,0,0.25);
                padding: 1vh 2vw;
                width: 100vw;
                text-overflow: ellipsis;
            }

            .messages-header input::placeholder{
                font-size: 14px;
            }

            .messages-header button{
                display: none;
                z-index: 2;
                position: absolute;
                right: 10vw;
                border: none;
                background: none;
                font-size: 14px;
                color: rgba(0,0,0,0.15);
            }

            .messages-header button:hover{
                color: rgba(0,0,0,0.45);
                cursor: pointer;
            }

            .messages-main{
                padding: 2vh 0;
                min-height: 80vh;
                max-height: 100vh;
                overflow-y: scroll;
            }

            .loading{
                padding: 15vh 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 2.5vh;
            }

            .loading p{
                font-size: 15px;
                color: rgba(0,0,0,0.75);
            }

            .loading img{
                height: 50px;
                aspect-ratio: 1/1;
            }

            .no-messages{
                min-height: 50vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: rgba(0,0,0,0.45);
                font-weight: 500;
                font-size: 14px;
                text-align: center;
            }

            .no-results{
                padding: 15vh 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 2.5vh;
            }

            .no-results p{
                text-align: center;
                font-size: 14px;
                font-weight: 500;
                color: rgba(0,0,0,0.75);
            }

            .no-results img{
                height: 80px;
                aspect-ratio: 1/1;
            }

            .message{
                background: white;
                padding: 2vh 2vw;
                margin-top: 2vh;
                border-radius: 4px;
            }

            .message:first-child{
                border-radius: 10px 10px 0px 0px;
                padding: 2vh 2vw
            }

            .message:last-child{
                border-radius: 0px 0px 10px 10px;
                padding: 2vh 2vw;
            }

            .message:only-child{
                border-radius: 2px;
            }

            .message h2{
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                gap: 2vw;
                color: var(--primary);
                font-weight: 600;
                font-size: 16px;
                border-bottom: 1px solid rgba(0,0,0,0.15);
            }

            .message h2 span{
                color: rgba(0,0,0,0.15);
                font-size: 12px;
                font-weight: 500;
            }

            .message p{
                font-size: 14px;
                margin-top: 1vh;
            }

            .message p:last-child{
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                margin-top: 1vh;
                /* border-top: 1px solid rgba(0,0,0,0.15); */
                font-size: 12px;
            }

            .message p:last-child span{
                color: rgba(0,0,0,0.5);
            }

            .message #allBtn{
                font-size: 13px;
                font-weight: 500;
                padding: 0.5vh 1.5vw;
                border: none;
                border-radius: 2px;
                background: rgba(0,0,0,0.25);
                color: green;
            }

            .message #markRead{
                font-size: 13px;
                font-weight: 500;
                padding: 0.3vh 1vw;
                border: 2px solid var(--primary);
                border-radius: 2px;
                background: none;
                color: var(--primary);
            }

            .message #markRead:hover{
                cursor: pointer;
                background: rgba(0,0,0,0.15)
            }

            .message #markRead img{
                height: 13px;
                margin-right: 8px;
            }

            .message #alreadyRead{
                font-size: 12px;
                font-weight: 500;
                padding: 0.5vh 1.85vw;
                border: none;
                border-radius: 2px;
                background: rgba(0,0,0,0.25);
                color: green;
            }
        }
    </style>
</head>

<body>
    <?php include "../includes/header.php"; ?>

    <section class="messages">
        <div class="messages-header">
            <div>
                <h1>Notifications & Messages</h1>
            </div>    

            <div>
                <input type="text" name="search" id="search" placeholder="Search for Messages and Notifications...">
                <button id='search-btn'><i class="fa-solid fa-search"></i></button>
            </div>
        </div>

        <div class="messages-main">
            <?php if(empty($data)): ?>
                <div class="no-messages">
                    <p>There are no messages for you at the moment.</p>
                </div>
            <?php endif; ?>

            <?php foreach($data as $record): ?>
                <div class='message'>
                    <h2>
                        <?=strtoupper($record[2]); ?>
                        <span>by System</span>
                    </h2>
                    <p><?=$record[3]; ?></p>
                    <p>
                        <?php 
                            echo "<span>Received on: ".formatDate(explode(" ", $record[5])[0])."</span>";

                            if($record[7]=='all'){
                                echo "<button id='allBtn'>General Update</button>";
                            } else{
                                if($record[4] == 'unread'){
                                    echo "<button id='markRead'  value='".$record[0]."'>Mark as Read</button>";
                                } else{
                                    echo "<button id='alreadyRead'>Already Read</button>";
                                }
                            }
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <script>       
        $(document).ready(
            function(){
                /*Searching messages asynchronously using ajax*/
                $("#search").on('input',
                    function(){
                        $(".messages-main").html("<div class='loading'><img src='../Assets/loading.gif' > <p>Loading...Please wait.</p></div>");

                        $.ajax(
                            {
                                method: "POST",
                                url: "./messages.php",
                                data: {
                                    search: $("#search").val()
                                },
                                success: function(res){
                                    if(res==''){
                                        $(".messages-main").html(`<div class='no-results'><img src='../Assets/doc-error.png'><p>No Messages or notifications found matching the phrase '${$("#search").val()}'</p> </div>`);
                                    } else{
                                        $(".messages-main").html(res);
                                    }
                                }
                            }
                        );
                    }
                );

                /*Marking a message as read*/
                $(".messages-main").on('click', '#markRead',
                    function(){
                        let id = $(this).val();
                        let btn = $(this);

                        btn.html("<img src='../Assets/loading.gif'> Updating...");

                        $.ajax(
                            {
                                method: "POST",
                                url: "./markRead.php",
                                data: {
                                    id: id
                                },
                                success: function(res){
                                    if(res == 'success'){
                                        btn.html("Already Read");
                                        btn.attr('id', 'alreadyRead');
                                    }
                                }
                            }
                        );
                    }
                );
            }
        )
    </script>
</body>
</html>
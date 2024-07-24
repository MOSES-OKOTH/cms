<?php
    session_start();

    include "../includes/alt-links.php";
    include "../includes/db.php";

    if(isset($_SESSION['userId'])){
        $sql = "SELECT * FROM complaints WHERE reg_no = '".$_SESSION['userId']."'";

        $res = mysqli_query($connection, $sql);

        if($res){
            if(mysqli_num_rows($res) > 0){
                $data = mysqli_fetch_all($res);
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
    <title>Follow Up | CMS -Technical University of Mombasa</title>
</head>
<body>
    <?php
        include '../includes/header.php';
    ?>

    <div class="follow">
        <div class="follow-header">
            <p>Follow Up on Your Complaints</p>
            <input type="text" name="" id="id" tabindex="1" placeholder="Enter Complaint ID to search...">
        </div>

        <div class="follow-main">
            <table>
                <?php if(isset($data)): ?>
                    <tr>
                        <td>Complaint ID</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>Status</td>
                    </tr>

                
                    <?php foreach($data as $record): ?>
                        <tr>
                            <td><?=$record[0]; ?></td>
                            <td><?=$record[3]; ?></td>
                            <td><?=$record[4]; ?></td>
                            <td><?php if($record[5] == 0){ echo "Pending"; } else{ echo "Solved"; } ?></td>
                        </tr>
                    <?php endforeach; ?>
                

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Complaints</td>
                        <td><?=count($data); ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <script>
        /*CAPITALIZE INPUTS*/
        document.getElementById("id").addEventListener('input', function(){
            document.getElementById("id").value = document.getElementById("id").value.toUpperCase();
        });

        /*Ajax Request*/
        $(document).ready(
            function(){
                $("#id").on('input', ()=>{
                    if($("#id").val().length > 7){
                        $(".follow-main").html("<img src='../assets/loading.gif' style='margin-top: 20vh'><br><p>Loading...Please Wait</p>");

                        $.ajax({
                            method: "GET",
                            url: "./search.php",
                            data: {
                                id: $("#id").val()
                            },
                            success: function(res){
                                $(".follow-main").html(res)
                            }
                        })
                    }
                })
            }
        )
    </script>
</body>
</html>
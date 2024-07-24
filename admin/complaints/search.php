<?php
    include "../db.php";

    if(isset($_GET['q'])){
        $q = $_GET['q'];

        if($q == "daily"){
            $sql = "SELECT * FROM complaints WHERE message != '' AND added_on LIKE '".date("Y-m-d")."%' ORDER BY added_on ASC";
        } else if($q == "monthly"){
            $sql = "SELECT * FROM complaints WHERE message != '' AND added_on LIKE '".date("Y-m")."%' ORDER BY added_on ASC";
        } else if($q == "annual"){
            $sql = "SELECT * FROM complaints WHERE message != '' AND added_on LIKE '".date("Y")."%' ORDER BY added_on ASC";
        } else if($q == "resolved"){
            $sql = "SELECT * FROM complaints WHERE message != '' AND status != '0' ORDER BY added_on ASC";
        } else if($q == "pending"){
            $sql = "SELECT * FROM complaints WHERE message != '' AND status = '0' ORDER BY added_on ASC";
        } else if($q == "all"){
            $sql = "SELECT * FROM complaints WHERE message != '' ORDER BY added_on ASC";
        } else{
            if(!empty($q)){
                $sql = "SELECT * FROM complaints WHERE message != '' AND (name LIKE '%".strtoupper($q)."%') OR (contact LIKE '%".$q."%') OR (added_on LIKE '%".$q."%') OR (message LIKE '%".$q."%') OR (subject LIKE '%".strtoupper($q)."%') ORDER BY added_on ASC";
            } else{
                $sql = "SELECT * FROM complaints WHERE message != '' AND status = '0' ORDER BY added_on ASC";
            }
        }

        $res = mysqli_query($connection, $sql);

        if($res){
            $data = mysqli_fetch_all($res);

            if(empty($data)){
                echo "<div class='no-feedback'>No Feedbacks Found!</div>";
                return;
            } else{
                foreach($data as $record){
                    echo "
                    <div class='feedback-message'>
                        <div>
                            <h1>".$record[3]."</h1>
                        </div>

                        <div>
                            <h2>By ".$record[1]." &nbsp; &nbsp; | &nbsp; &nbsp; Contacts: "; 
                    if(empty($record[2])){ 
                        echo "NULL"; 
                    } else{
                        echo $record[2]; 
                    } 
                
                    echo "</h2>
                            </div>

                            <div>
                                <p>".$record[4]."</p>
                            </div>
                            
                            <div>
                                <p>Sent on ".$record[6]."</p>
                                <div id='btns'>";
                                        if($record[5] == '0'){
                                            echo "<button id='resolve' value='".$record[0]."'>Add to Resolved</button>";
                                        } else{
                                            echo "<button id='resolved'><i class='fa-solid fa-check'></i> Resolved</button>";
                                    }
                        echo "
                            </div>
                        </div>
                    </div>
                    ";
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<script>
    $(document).ready(
            function(){
               let resolveBtn = document.querySelectorAll("#resolve");
               
               resolveBtn.forEach((btn)=>{
                    btn.addEventListener('click', function(){
                        btn.innerHTML = "<img src='../Assets/loading.gif'> Processing...";

                        $.ajax({
                            method: "GET",
                            url: "./feed.php",
                            data: {
                                id: this.value
                            },
                            success: function(r){
                                if(r == 'success'){
                                    notify("<span class='success'>DONE!</span><br>Feedback Processed Successfully!");
                                    btn.innerHTML = "<i class='fa-solid fa-check'></i> Resolved";
                                    btn.style = "background: rgba(0,0,0,0.05); pointer-events: none;";
                                } else{
                                    notify("<span class='success'>Error: ERR_DB_SFGD98007</span><br>There was an error processing this request...");
                                    btn.innerHTML = "Add to Resolved";
                                }
                            }
                        })
                    })
               })
            
            }
        )
</script>
<body>
    
</body>
</html>
<?php
    include "../db.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "UPDATE complaints SET status = '1' WHERE id = '".$id."'";

        $res = mysqli_query($connection, $sql);

        if($res){
            echo "success";
        } else{
            echo "error";
        }
    }

?>
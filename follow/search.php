<?php
    include "../includes/db.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM complaints WHERE id = '".$id."'";

        $res = mysqli_query($connection, $sql);

        if($res){
            $data = mysqli_fetch_assoc($res);

            if(!empty($data)){
                echo "
                <table>
                    <tr>
                        <td>Complaint ID</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>Status</td>
                    </tr>

                    <tr>
                        <td>".$data['id']."</td>
                        <td>".$data['subject']."</td>
                        <td>".$data['message']."</td>
                    ";
                if($data['status'] == 0){
                    echo "<td>Pending</td>";
                } else{
                    echo "<td>Solved</td>";
                }

                echo "
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Results</td>
                        <td>1</td>
                    </tr>
                </table>
                ";
            } else{
                echo "
                <table>
                    <tr>
                        <td>Complaint ID</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>Status</td>
                    </tr>

                    <tr>
                        <td colspan='4'>No Complaints Found Matching The Specified ID</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Results</td>
                        <td>1</td>
                    </tr>
                </table>
                ";
            }
        }
    }
?>
<?php
    include ('dbConn.php');
    if((isset($_GET['type'])) && (isset($_GET['p_id']))) {
        $table_new = $_GET['type'];
        $p_id = $_GET['p_id'];
        echo $sql_status = "SELECT * FROM  $table_new WHERE productid = '$p_id' ;";
        $run = mysqli_query($conn,$sql_status);
        while($pr = mysqli_fetch_assoc($run)){
            if ($pr['status'] == 1){
                $update = "UPDATE $table_new SET `status` = '0' WHERE productid = '$p_id' ;";
            }else{
                $update = "UPDATE $table_new SET `status` = '1' WHERE productid = '$p_id';";
            }
            $execute = mysqli_query($conn,$update);
            if($execute==1){
                header("location: statusAproved.php");
            }
        }
        
    }
?>
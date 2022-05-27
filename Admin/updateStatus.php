<?php
    include ('dbConn.php');
    if((isset($_GET['type'])) && (isset($_GET['p_id']))) {
        $table_new = $_GET['type'];
        $p_id = $_GET['p_id'];
        $sql_status = "SELECT * FROM trending WHERE category_type = '$table_new' AND product_id = '$p_id' ;";
        $run = mysqli_query($conn,$sql_status);
        while($trending = mysqli_fetch_assoc($run)){
            if ($trending['status'] == 1){
                $update = "UPDATE trending SET `status` = '0' WHERE category_type = '$table_new' AND product_id = '$p_id' ;";
            }else{
                $update = "UPDATE trending SET `status` = '1' WHERE category_type = '$table_new' AND product_id = '$p_id' ;";
            }
            $execute = mysqli_query($conn,$update);
            if($execute==1){
                header("location: statusAproved.php");
            }
        }
        
    }
?>
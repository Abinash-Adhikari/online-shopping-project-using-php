<?php
    include ("dbConn.php");
    if((isset($_GET['id'])) && (isset($_GET['table']))){
        $table  = $_GET['table'];
        $id = $_GET['id'];
        $adminId = $_SESSION['user_id'];
        $sql_check = "SELECT * FROM trending WHERE category_type = '$table' AND product_id='$id';";
        $query_check = mysqli_query($conn,$sql_check);
        $row_count = mysqli_num_rows($query_check);
        if($row_count == 0){
           echo $sql = "INSERT INTO trending (product_id,category_type,admin_id ,status) VALUES ('$id','$table','$adminId','1');";
            $query_run = mysqli_query($conn,$sql);
            if($query_run==TRUE){
                header("location : statusAproved.php");
            }
            else{
                header("location : statusAproved.php?erroe");
            } 
        }
        else{
            header("location: statusAproved.php?ae");
        }
    }


?>
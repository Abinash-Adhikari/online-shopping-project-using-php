<?php
    include ("../dbConn.php");
    $order_id = $_POST['id'];
    $status = $_POST['status'];

    $sql1 = "SELECT * FROM `order` WHERE id = '$order_id';";
    $execute1 = mysqli_query($conn,$sql1);
    $sql = "UPDATE `order` SET payment_status = 'done' WHERE id='$order_id';";
    $execute = mysqli_query($conn,$sql);
    if($execute == TRUE){
        $sql1 = "SELECT * FROM `order` WHERE id = '$order_id';";
        $execute1 = mysqli_query($conn,$sql1);
        while($data = mysqli_fetch_assoc($execute1)){
            $quantity = $data['quantity'];
            $pr_id = $data['product_id'];
            $table = $data['category_type'];
            

            $sql2 = "SELECT * FROM `$table`  WHERE productid = '$pr_id';";
            $execute2 = mysqli_query($conn,$sql2);
            while($data2 = mysqli_fetch_assoc($execute2)){
                $u_id = $data2['admin_id'];
                $cost = $data2['price'];
                if($execute2 == TRUE){
                    $total_price = $quantity * $cost;
                    $sql3 = "UPDATE admin SET balance = balance + '$total_price' WHERE user_id = '$u_id';";
                    $execute3 = mysqli_query($conn,$sql3);
                }
            }  
        }
    }
    
    

?>
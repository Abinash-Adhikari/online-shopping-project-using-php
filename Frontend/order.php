<?php
    include ("dbConn.php");
   $street =test_input( $_POST['street-address']);
   $city = test_input($_POST['city-address']);
   $zip = test_input($_POST['zip-code']);
   $pay_method = test_input($_POST['pay']);
   $user_id =  $_SESSION['user_id'];
   if($pay_method == 'cash'){
        $payment_status = 'pending';
        $product_status = 'pending';
    }
    else{
        $payment_status = 'recieved';
        $product_status = 'pending';
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if($pay_method == 'cash'){
        $success = 0;
        $total = 0;
        
        $cart_data = "SELECT * FROM cart WHERE user_id = '$user_id';";
        $run_cart = mysqli_query($conn, $cart_data);
        while($fetch=mysqli_fetch_assoc($run_cart)){
            //print_r($fetch);
            $pro_id = $fetch['product_id'];
            $cat_tbl = $fetch['category_type'];
            $quantity = $fetch['quantity'];
            $user = $_SESSION['user_id'];
            $dis_pr = "SELECT * FROM $cat_tbl WHERE productid = '$pro_id';";
            $run_dis = mysqli_query($conn, $dis_pr);
            while($fetch_dis = mysqli_fetch_assoc($run_dis)){
                $rate = $fetch_dis['price']- $fetch_dis['discount'];
                $total = $total + ( $fetch['quantity'] *  $rate );
                $seller_id = $fetch_dis['admin_id'];
                $insert = "INSERT INTO `order` (user_id,seller_id, product_id, category_type, quantity, street, city, zip_code, payment_method, payment_status, product_status) 
                VALUES ('$user_id','$seller_id','$pro_id','$cat_tbl','$quantity','$street','$city','$zip','$pay_method','$payment_status','$product_status');";
                $executeInsert = mysqli_query($conn,$insert);
                if($executeInsert == TRUE){
                    $sql_delete = "DELETE FROM cart WHERE user_id = '$user';";
                    $execute_delete = mysqli_query($conn,$sql_delete);
                    if($execute_delete == TRUE){
                        $success = 1;
                    }
                    else{
                        $success= 0;
                        header('Location: cart.php ');
                    }
                } 
                else
                {
                    header('Location: cart.php ');
                }  
            }
        }
    }
    else{
        $success = 0;
        $total = 0;
        
        $cart_data = "SELECT * FROM cart WHERE user_id = '$user_id';";
        $run_cart = mysqli_query($conn, $cart_data);
        while($fetch=mysqli_fetch_assoc($run_cart)){
            //print_r($fetch);
            $pro_id = $fetch['product_id'];
            $cat_tbl = $fetch['category_type'];
            $quantity = $fetch['quantity'];
            $user = $_SESSION['user_id'];
            $dis_pr = "SELECT * FROM $cat_tbl WHERE productid = '$pro_id';";
            $run_dis = mysqli_query($conn, $dis_pr);
            while($fetch_dis = mysqli_fetch_assoc($run_dis)){
                $rate = $fetch_dis['price']- $fetch_dis['discount'];
                $total = $total + ( $fetch['quantity'] *  $rate );
                $seller_id = $fetch_dis['admin_id'];

                $check_bal = "SELECT balance FROM admin WHERE user_id = '$user_id'";
                $execute_check = mysqli_query($conn,$check_bal);
                while ($check_data = mysqli_fetch_assoc($execute_check)){
                    $acc_balance = $check_data['balance'];
                    if($acc_balance > $total ){
                     
                        $balance = "UPDATE `admin` SET balance = balance - '$total' WHERE user_id = '$user_id';";
                        $execute = mysqli_query($conn,$balance);

                        $insert = "INSERT INTO `order` (user_id,seller_id, product_id, category_type, quantity, street, city, zip_code, payment_method, payment_status, product_status) 
                        VALUES ('$user_id','$seller_id','$pro_id','$cat_tbl','$quantity','$street','$city','$zip','$pay_method','$payment_status','$product_status');";
                        $executeInsert = mysqli_query($conn,$insert);
                        if(($executeInsert == TRUE) && ($execute == TRUE) ){
                            $sql_delete = "DELETE FROM cart WHERE user_id = '$user';";
                            $execute_delete = mysqli_query($conn,$sql_delete);
                            if($execute_delete == TRUE){
                                $success = 1;
                            }
                            else{
                                $success= 0;
                                header('Location: cart.php ');
                            }
                        } 
                        else
                        {
                            header('Location: cart.php ');
                        }
                    }else{
                        header('Location: cart.php?balance_error=1');
                    }
                }  
            }
        }
        
    }

    if($success==1){
        $to_email = $_SESSION['user_email'];
        $subject = "Product ordered from mail";
        $body = "Hi , This message inform that you buy products from alpha gadget and your total cost is RS.$total .";
        $headers = "From:  alpha.gadget62@gmail.com";
        if (mail($to_email, $subject, $body, $headers)) {
                    header('Location: index.php ');
        } else {
            echo "Email sending failed...";
        }
    }
?>
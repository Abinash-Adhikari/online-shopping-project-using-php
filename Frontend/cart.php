<?php
    include ("dbConn.php");
    if((($_SESSION['user_id'])!= "") && (($_SESSION['user_email'])!= "") ){
        $userId = $_SESSION['user_id'];
        if((isset($_GET['table'])) && (isset($_GET['id']))){
        $table  = $_GET['table'];
        $id = $_GET['id'];

        if(isset($_GET['balance_error'])){
            $error = $_GET['balance_error'];
            if($error == 1){
                echo "Not enough Balance in wallet.Remove some item from cart.";
            }
        }
        
        $user_check = "SELECT * FROM $table WHERE productid='$id';";
        $user_execute = mysqli_query($conn,$user_check);
        while($check_user =mysqli_fetch_assoc($user_execute) ){
           if($check_user['admin_id'] == $userId){
                 echo '<script> alert("This is your own product. You cannot buy.")</script>';
           }else{
                $sql_check = "SELECT * FROM cart WHERE product_id='$id' AND user_id = '$userId'";
                $query_check = mysqli_query($conn,$sql_check);
                $row_count = mysqli_num_rows($query_check);
                if($row_count == 0){
                    $sql = "INSERT INTO cart (product_id,category_type,user_id ,quantity) 
                    VALUES ('$id','$table','$userId','1');";
                    $query_run = mysqli_query($conn,$sql);
                }
           }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Font Style-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,900;1,400;1,900&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <!--Font Style-->

    <!-- fontawasome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- fontawasome -->
    <!-- jquerry -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jquerry -->
    <title>Cart</title>
    <link rel="stylesheet" href="css/first-second.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/cart.css?v=<?php echo time(); ?>">
</head>
<body>
   <div class="containner">
        <?php
            include ("navbar.php");
        ?>
        <div class="body-containner">
            <div class="cart-productShow">
                    <?php
                        include ("showCart.php");
                    ?>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="footer">
                <div class="f-logo">
                    <img src="Photos/logo2.png" alt="">
                </div>
                <div class="f-freedback">
                    <ul>
                        <li>OVERVIEW</li>
                        <li>About Us</li>
                        <li>FAQs</li>
                        <li>Privacy Policy</li>
                        <li>Terms & Conditions</li>
                        <li>Corporate Policies</li>
                    </ul>
                </div>
                <div class="f-others">
                    <ul>
                        <li>OTHERS</li>
                        <li>Advertise With Us</li>
                        <li>Careers</li>
                        <li>Customer Care</li>
                    </ul>
                </div>
                <div class="f-contact">
                    <ul>
                        <li>CONNECTS WITH US</li>
                        <li>1800 400 3000(Toll-Free)</li>
                        <li>support@gmail.com</li>
                        
                    </ul>
                </div>
                <div class="f-available">
                    AVAILABLE ON
                </div>
            </div>
            <hr>
            <div class="bottom">
                    <p>Copyright@ <?php echo date("Y") ?> </p>
            </div>
        </div>
   </div>
   <script src="js/cart.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<?php
    }
    else{
        header("location: login.php?back=cart");
    }
?>
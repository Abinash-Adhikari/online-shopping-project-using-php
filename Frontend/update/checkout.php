
<div class="check-out">
    <?php 
        include ('dbConn.php');
        $total = 0;
    ?>
    <div class="two-part">
        <div class="part-1">
            <h1> Check Out Methods </h1>
            <div class="login-part">
                <div class="login-heading">
                    <div class="plus-minus">
                        <span class="login-plus"><i class="fas fa-plus"></i></span>
                        <span class="login-minus"><i class="fas fa-minus"></i></span>
                    </div>
                    <h2> Login credential</h2>
                </div>
                <div class="login">
                    <?php       
                        $user =$_SESSION['user_id'];
                        $sql = "SELECT * FROM `admin` WHERE user_id = '$user';";
                        $run = mysqli_query($conn, $sql);
                        while( $data = mysqli_fetch_assoc($run))
                        {
                    ?>
                    <form class="user-data">
                        <h3> USER DETAILS</h3>
                        <div class="flex">
                            <div class="userFirstName">
                                <label for="userFirstName">
                                    <p class="em"> Name</p>
                                </label>
                                <input readonly type="text" id="userFirstName" placeholder="<?php echo $data['name']?>" name="registerFirstName" required>
                            </div>
                            <div class="username">
                                <label for="userID">
                                    <p class="em">Email</p>
                                </label>
                                <input readonly  type="email" id="userID" placeholder="<?php echo $data['email']?>" name="registerEmail" required>
                            </div>
                            <div class="contact">
                                <label for="contact">
                                    <p class="em"> Contact Number </p>
                                </label>
                                <input readonly  type="number" id="contact" placeholder="<?php echo $data['contact']?>" name="registerContact" required>
                            </div>
                        </div>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="form" >
                <form action=".//order.php" method="POST">
                    <div class="address-info">
                        <div class="address-heading">
                            <div class="plus-minus">
                                <span class="address-plus"><i class="fas fa-plus"></i></span>
                                <span class="address-minus"><i class="fas fa-minus"></i></span>
                            </div>
                            <h2> Address Information</h2>
                        </div>
                        <div class="address">                 
                            <div class="flex">
                                <div class="street-address">
                                    <label for="street-address">
                                        <p class="em"> Street Address</p>
                                    </label>
                                    <input  type="text" id="street-address"  name="street-address" required>
                                </div>
                                <div class="city-address">
                                    <label for="city-address">
                                        <p class="em"> City/State </p>
                                    </label>
                                    <input  type="text" id="city-address"  name="city-address" required>
                                </div>
                                <div class="zip-code">
                                    <label for="zip-code">
                                        <p class="em"> Zip Code </p>
                                    </label>
                                    <input   type="number" id="zip-code"  name="zip-code" required>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="payment-methods">
                        <div class="payment-heading">
                            <div class="plus-minus">
                                <span class="payment-plus"><i class="fas fa-plus"></i></span>
                                <span class="payment-minus"><i class="fas fa-minus"></i></span>
                            </div>
                            <h2> Payment Methods </h2>
                        </div>
                        <div class="flex payment">
                            <div class="cod">
                                <input type="radio" name="pay" value="cash" id="cod"> 
                                <label for="cod">Cash On Delivary </label><br>
                            </div>
                            <div class="opy">
                                <input type="radio" name="pay" value="wallet" id="payU"> 
                                <label for="payU"> Wallet </label>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="submit-button">
                        <button class="btn btn-submit" type="submit" name="submit"> Continue </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="part">
            <div class="part-2">
                <h2 class="p2-topic"> YOUR ORDER </h2>
                    <?php
                    $userId = $_SESSION['user_id'];  
                    $sql_show = "SELECT * FROM cart WHERE user_id = '$userId';";
                    $run = mysqli_query($conn, $sql_show);
                        while($fetch = mysqli_fetch_assoc($run)){
                            $pro_id = $fetch['product_id'];
                            $cat_tbl = $fetch['category_type'];
                            $dis_pr = "SELECT * FROM $cat_tbl WHERE productid = '$pro_id';";
                            $run_dis = mysqli_query($conn, $dis_pr);
                            while($fetch_dis = mysqli_fetch_assoc($run_dis)){
                                $rate = $fetch_dis['price']- $fetch_dis['discount'];
                    ?>
                        <div class="p2-items">
                            <div class="p2i-photo">
                                <img src="..//Admin/<?php echo $fetch_dis['mainphoto'] ;?>" alt="">
                            </div>
                            <div class="p2i-Name">
                                <div class="p2-name">
                                    <?php echo $fetch_dis['productname'] ;?>
                                </div>
                                <div class="p2-cost">
                                    <i class="fas fa-rupee-sign"></i> <span class="poisa"><?php echo $fetch['quantity'] *  $rate?></span>
                                </div>
                            </div>
                            <div class="p2i-action">
                                <button class="btn btn-remove" onclick="delete_product2(<?php echo $fetch['cart_id'] ?>)"> <i class="fas fa-trash"></i> </button>
                            </div>
                        </div>
                    <?php
                        $total = $total + ( $fetch['quantity'] *  $rate );
                        }
                    }
                    ?>
                    <hr>
                <div class="last-part">
                    <div class="total">
                    <h4> ORDER TOTAL : <i class="fas fa-rupee-sign"></i> <?php echo $total ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".login-plus").hide();
    $(".address-minus").hide();
    $(".payment-minus").hide();
    $(".address").hide();
    $(".payment").hide();
    $(".login-heading").on("click", function(){
        $(".login-plus").toggle();
        $(".login-minus").toggle();
        $(".login").toggle();
        $(".address-plus").show();
        $(".address-minus").hide();
        $(".payment-plus").show();
        $(".payment-minus").hide();
        $(".address").hide();
        $(".payment").hide();
    });
    $(".address-heading").on("click", function(){
        $(".address-plus").toggle();
        $(".address-minus").toggle();
        $(".login-plus").show();
        $(".login-minus").hide();
        $(".payment-plus").show();
        $(".payment-minus").hide();
        $(".address").toggle();
        $(".login").hide();
        $(".payment").hide();
    });
    $(".payment-heading").on("click", function(){
        $(".payment-plus").toggle();
        $(".payment-minus").toggle();
        $(".login-plus").show();
        $(".login-minus").hide();
        $(".address-plus").show();
        $(".address-minus").hide();
        $(".payment").toggle();
        $(".login").hide();
        $(".address").hide();
    });

</script>
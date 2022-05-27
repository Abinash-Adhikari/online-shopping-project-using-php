
<?php
    $total = 0;
?>
<div class="show-hide">
    <div class="header-top">
        <h1>Your Products In Cart</h1>
    </div>
    <?php
        $sql_check = "SELECT * FROM cart WHERE user_id = '$userId';";
        $execute_check = mysqli_query($conn,$sql_check);
        $row = mysqli_num_rows($execute_check);
        if($row != NULL)
        {  
    ?>
    <div class="table-cart">  
        <table border class="table ">
            <thead class="thead">
                <tr>
                    <th>Sn</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tbody change-table">
            <?php
            $int=1;
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
                
                    <tr>
                        <?php echo "<script> var productId = $pro_id </script>"; ?>
                        <td><?php echo $int ?></td>
                        <td>
                            <div class="item-image">
                                <img src="..//Admin/<?php echo $fetch_dis['mainphoto'] ;?>" alt="">
                            </div>
                        </td>
                        <td>
                            <div class="item-name">
                                <?php echo $fetch_dis['productname'] ;?>
                            </div>
                        </td>
                        <td>
                            <div class="cost">
                                <i class="fas fa-rupee-sign"></i> <?php echo $rate?>
                            </div>
                        </td>
                        <td>
                            <div class="button select-quantity">
                                <div class="minus" onclick="sub_product(<?php echo $fetch['cart_id']  ?>)">
                                    <i class="fas fa-minus"></i>
                                </div>
                                <div class="qty"><?php echo $fetch['quantity'] ?></div>
                                <div class="plus " onclick="add_product(<?php echo $fetch['cart_id']  ?>)">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="cost total-price">
                                <i class="fas fa-rupee-sign"></i> <span class="poisa"><?php echo $fetch['quantity'] *  $rate?></span>
                            </div>
                        </td>
                        <td>
                            <div class="buy-delete">
                                <div class="buttons">
                                    <button class="btn btn-remove" onclick="delete_product(<?php echo $fetch['cart_id'] ?>)"> <i class="fas fa-trash"></i> Remove </button>
                                </div>
                            </div>
                        </td>
                    </tr>
            <?php
                    $total = $total + ( $fetch['quantity'] *  $rate );
                    $int++;
                }

            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="buttom">
        <div class="df-btns">
            <a href="index.php"><button class="btn btn-continue"> Continue Shopping </button></a>
            <button class="btn" onclick="checkout(<?php echo $total; ?>)"> Check Out</button>
        </div>
    </div>
    <?php
    } 
    else{
        
        
        ?>
        <div class="e-cart">
            <h3> You didn't have any product in cart.</h3>
        </div>
<div class="buttom">
        <div class="df-btns">
            <a href="index.php"><button class="btn btn-continue"> Continue Shopping </button></a>
        </div>
    </div>
                

                <?php
            }
        ?>
</div>
<script>
    function add_product(val){
        $.ajax({
            url:'update/update.php',
            type:'post',
            data:{'id': val,'type': 'plus' },
            success: function(result){
                $(".change-table").load("update/new.php");
            }
        })  
    }
    function sub_product(val){
        $.ajax({
            url:'update/update.php',
            type:'post',
            data:{'id': val,'type': 'minus' },
            success: function(result){
                $(".change-table").load("update/new.php");
            }
        })
    }
    function delete_product(val){
        $.ajax({
            url:'update/deleteCart.php',
            type:'post',
            data:{'id': val},
            success: function(result){
                $(".change-table").load("update/new.php");
            }
        })
    }
    function delete_product2(val){
        $.ajax({
            url:'update/deleteCart.php',
            type:'post',
            data:{'id': val},
            success: function(result){
                $(".show-hide").load("update/checkout.php");
            }
        })
    }
    function checkout(val){
        console.log(val)
        $.ajax({
            url:'update/deleteCart.php',
            type:'post',
            data:{'id': val},
            success: function(result){
                $(".show-hide").load("update/checkout.php");
            }
        })
    }
</script>
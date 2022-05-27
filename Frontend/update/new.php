<?php
            include 'dbConn.php';
            $userId = $_SESSION['user_id'];
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
                <tr id=<?php echo $fetch['cart_id'] ?>>
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
                            <i class="fas fa-rupee-sign"></i> <span class="poisa"><?php echo $rate * $fetch['quantity']?></span>
                        </div>
                    </td>
                    <td>
                        <div class="buy-delete">
                            <div class="buttons">
                                <button class="btn btn-remove"> <i class="fas fa-trash"></i> Remove </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php
                    $int++;
                }
            }
            ?>
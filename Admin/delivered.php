<?php
    include ('dbConn.php');
    include ('head.php');
    if($_SESSION['controller_email'] != '' && $_SESSION['controller_id'] != ''){
        if(isset($_GET['table'])){
            $table = $_GET['table'];
        }else {
            $table = "laptop";
        }
?>
<body>
    <div class="admin-top">
        <div class="navbar">
            <div class="header-top">
                <div class="all-top">
        
                    <div class="current-page">
                        <h2 class="show"> Product Deliver </h2>
                    </div>
                    <div class="current-page">
                        <button class="btn">
                            <h2><a href="statusAproved.php">Product Aprove </a></h2>
                        </button>
                    </div>
                    <div class="search-bar">
                        <span class="input-top"><input type="text"><i class="fas fa-search"></i></span>
                    </div>
                    <div class="admin-detail">
                        <?php 
                            $email = $_SESSION['controller_email'];
                            $sql_admin = "SELECT * FROM controller WHERE email = '$email'";
                            $query = mysqli_query($conn,$sql_admin);
                            while($row=mysqli_fetch_assoc($query))
                            {
                        ?>
                        <div class="image">
                            <img src="<?php echo $row['photo'] ?>" alt="">
                        </div>
                        <div class="ad-name">
                            <h4><?php echo $row['name'] ?></h4>
                            <p>Admin</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="admin-body">
        <div class="table">
            <div class="manage-products">
                    <div class="display-flex">
                        <div class="bg">
                                <?php
                                
                                $sql1 = "SELECT DISTINCT user_id FROM `order`";
                                $execute1 = mysqli_query($conn, $sql1);
                                while($data2 = mysqli_fetch_assoc($execute1)){
                                    $user = $data2['user_id'];
                                ?>
                            <div class="product-details">
                                <div class="username">
                                    <h2>
                                        <?php 
                                        $total = 0;
                                                $sql3 = "SELECT * FROM admin WHERE user_id = '$user';";
                                                $execute3 = mysqli_query($conn,$sql3);
                                                while($data3 = mysqli_fetch_assoc($execute3)){
                                                    echo $data3['name'];
                                                }     
                                        ?>
                                    </h2>
                                </div>
                                <div class="table">
                                    <table border class="table-detailProduct">
                                       <thead class="dp-thead">
                                           <tr>
                                               <th>Id</th>
                                               <th>Product Name</th>
                                               <th>Photo</th>
                                               <th>Brand Name</th>
                                               <th>Price</th>
                                               <th>Quantity</th>
                                               <th>Cost</th>
                                               <th>Payment_Status</th>
                                               <th>Delivary_Status</th>
                                           </tr>
                                       </thead>
                                       <tbody class="dp-tbody">
                                           <?php
                                                $sql_product = "SELECT * FROM `order` WHERE user_id ='$user' AND product_status='pending';";
                                                $result= mysqli_query($conn,$sql_product);
                                                $sn =1 ;
                                                while($data=mysqli_fetch_assoc($result)){
                                                    $pr_table = $data['category_type'];
                                                    $pr_id = $data['product_id'];
                                                    $order_id = $data['id'];


                                                    $sql = "SELECT * FROM $pr_table where productid = '$pr_id';";
                                                    $execute = mysqli_query($conn, $sql);
                                                    while($data1 = mysqli_fetch_assoc($execute)){
                                                        $cost = $data1['price'] * $data['quantity'];
                                                        $total = $total + $cost;
                                            ?>  
                                                <tr>
                                                    <td><?php echo $sn ?></td>
                                                    <td><?php echo $data1['productname'] ?></td>
                                                    <td><img class="show-photo"src="<?php echo $data1['mainphoto'] ?>" alt=""></td>
                                                    <td><?php echo $data1['brandname'] ?></td>
                                                    <td><?php echo $data1['price'] ?></td>
                                                    <td><?php echo $data['quantity'] ?></td>
                                                    <td><?php echo $cost ?></td>
                                                    <td>
                                                        <?php
                                                            if($data['payment_status'] == 'done'){
                                                                echo $data['payment_status'];
                                                            }else{
                                                        ?>
                                                        <button class="btn" onclick="update_payment(<?php echo $data['id'] ?>)">
                                                            <?php echo $data['payment_status'] ?>
                                                        </button>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><button class="btn" onclick="update_delivery(<?php echo $data['id'] ;?>)" ><?php echo $data['product_status'] ?></button></td>
                                                </tr>
                                            <?php
                                                    } 
                                            $sn++;
                                            } 
                                           ?>
                                       </tbody>
                                    </table>
                                    <div class="cost">
                                        <h3> Your Total Cost : <?php
                                        echo $total;
                                        ?></h3>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <hr>
                            <hr>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
        function update_payment(val1){
            $.ajax({
                url:'update/update_payment.php',
                type:'POST',
                data:{'id': val1},
                success: function(result){
                    location.reload();
                }
            })
        }
        function update_delivery(pay){
            $.ajax({
                url:'update/update_delivary.php',
                type:'POST',
                data:{'id': val},
                success: function(result){
                   location.reload();
                }
            })
        }
    </script>
</body>

<?php

    }else{
        
        header('location: adminLogin.php');
    }

?>
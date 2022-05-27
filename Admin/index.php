<?php 
    require ("dbCOnn.php");
    require ('head.php');
    
    if($_SESSION['user_email'] != ""){
?>
<body>
     <div class="containner">
        <div class="left-section">
            <div class="navbar">
                <div class="navbar-logo">
                    <img src="./Photos/logo2.png" alt="">
                </div>
                <hr>
                <div class="navbar-buttons">
                    <a href="index.php">
                        <div class="same-class nav-dashboard">
                            <button class="btn btn-nav btn-dashboard active"><i class="fas fa-home"></i> Dashboard</button>
                        </div>
                    </a>
                    <a href="manageCategories.php">
                        <div class="same-class nav-manageCategories">
                            <button class="btn btn-nav btn-manageCategories"> <i class="fas fa-tasks"></i> Manage Categories</button>
                        </div>
                    </a>
                    <a href="manageProducts.php">
                        <div class="same-class nav-manageProducts">
                        <button class="btn btn-nav btn-manageProducts"> <i class="fas fa-cogs"></i> Manage Products</button>
                    </div>
                    </a>
                    <a href="manageUsedProducts.php">
                        <div class="same-class sub-secManageProducts">
                            <button class="btn btn-nav btn-secManageProducts"> <i class="fas fa-cogs"></i> Manage Used Products</button>
                        </div>
                    </a>
                    <a href="trendingProducts.php">
                        <div class="same-class nav-addTrendingProduct">
                            <button class="btn btn-nav btn-addTrendingProduct"> <i class="fas fa-poll"></i> Trending Products </button>
                        </div>
                    </a>
                    <a href="managePassword.php">
                        <div class="same-class nav-Password">
                            <button class="btn btn-nav btn-Password"> <i class="fas fa-unlock"></i> Password </button>
                        </div>
                    </a>
                    <a href="logout.php">
                        <div class="same-class nav-signOut">
                            <button class="btn btn-nav btn-signOut"> <i class="fas fa-sign-out-alt"></i> Sign Out </button>
                        </div>
                    </a>
                    <a href="../Frontend/index.php">
                        <div class="same-class nav-home">
                            <button class="btn btn-nav btn-home"> <i class="fas fa-arrow-left"></i> Back To Main Page </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="right-section">
            <div class="header-top">
                <div class="all-top">
                    <div class="lines">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                    <div class="current-page">
                        <h2 class="show"> Dashboard </h2>
                    </div>
                    <div class="search-bar">
                        <span class="input-top"><input type="text"><i class="fas fa-search"></i></span>
                    </div>
                    <div class="admin-detail">
                        <?php 
                            $email = $_SESSION['user_email'];
                            $sql_admin = "SELECT * FROM admin WHERE email = '$email'";
                            $query = mysqli_query($conn,$sql_admin);
                            while($row=mysqli_fetch_assoc($query))
                            {
                        ?>
                        <div class="image">
                            <img src="<?php echo $row['profile_photo'] ?>" alt="">
                        </div>
                        <div class="ad-name">
                            <h4><?php echo $row['name'] ?></h4>
                            <p>Seller</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="body">
                <div class="information">
                    <div class="boxes">
                        <div class="box"> 
                            <div class="box-views">
                                <div class="bv-total">
                                    <h3>
                                        <?php 
                                            $coun2 = 0;
                                            $adminId = $_SESSION['user_id'];
                                            $sql_data="SELECT * fROM categories ;";
                                            $result = mysqli_query($conn,$sql_data);
                                            while($data=mysqli_fetch_assoc($result)){
                                                $Tables = $data['category_name'];
                                                $new_sql2 = "SELECT * FROM $Tables where admin_id = '$adminId';";
                                                $total2 = mysqli_query($conn,$new_sql2);
                                                $count2 =  mysqli_num_rows($total2);
                                                $coun2 =$coun2 +$count2;
                                            }  
                                            echo $coun2;                              
                                        ?>
                                    </h3>
                                    <p>Total Produucts</p>
                                </div>
                                <div class="bv-icon"><i class="fas fa-shopping-bag"></i></div>
                            </div> 
                        </div>
                        <div class="box"> 
                            <div class="box-views">
                                <div class="bv-total">
                                    <?php
                                        $id = $_SESSION['user_id'];
                                        $sell = "SELECT * FROM `order` WHERE seller_id = '$id' AND payment_status = 'done';";
                                        $sell_execute = mysqli_query($conn, $sell);
                                        $num_sell = mysqli_num_rows($sell_execute);        
                                    ?>
                                    <h3><?php echo $num_sell ?></h3>
                                    <p>Total Sales</p>
                                </div>
                                <div class="bv-icon"><i class="fas fa-arrow-up"></i></div>
                            </div> 
                        </div>
                        <div class="box"> 
                            <div class="box-views">
                                <div class="bv-total">
                                    <?php
                                        $id = $_SESSION['user_id'];
                                        $buy = "SELECT * FROM `order` WHERE user_id = '$id' AND payment_status = 'done';";
                                        $buy_execute = mysqli_query($conn, $buy);
                                        $num_buy = mysqli_num_rows($buy_execute);
                                             
                                    ?>
                                    <h3><?php echo $num_buy;  ?></h3>
                                    <p>Total Buy</p>
                                </div>
                                <div class="bv-icon"><i class="fas fa-arrow-down"></i></div>
                            </div> 
                        </div>
                        <div class="box"> 
                            <div class="box-views">
                                <div class="bv-total">
                                    <?php
                                        $email = $_SESSION['user_email'];
                                        $sql_admin = "SELECT * FROM admin WHERE email = '$email'";
                                        $query = mysqli_query($conn,$sql_admin);
                                        while($row=mysqli_fetch_assoc($query))
                                        {
                                    ?>
                                    <h3>Rs <?php echo $row['balance'] ?></h3>
                                    <p> Your Balance </p>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="bv-icon"><i class="fas fa-rupee-sign"></i></div>
                            </div> 
                        </div>
                    </div>
                    <div class="thirdTables">
                        <div class="information-table ">
                            <div class="informationStatus-table bg">
                                <table class="ststus-table">
                                    <caption>
                                        <h2>Latest Sold Product Status <span><button class=" btn btn-statuShow">Show All</button></span></h>
                                    </caption>
                                    <thead class="it-thead">
                                        <tr>
                                            <th class="first"> S.N </th>
                                            <th> Name </th>
                                            <th> Payment Method </th>
                                            <th> Catogay </th>
                                            <th> Payment </th>
                                            <th> Deliver </th>
                                        </tr>
                                    </thead>
                                    <tbody class="it-tbody">
                                        <?php
                                        $n =1;
                                        $id = $_SESSION['user_id'];
                                        $total_sell = "SELECT DISTINCT * FROM `order` WHERE seller_id = '$id' ORDER BY id DESC LIMIT 5;";
                                        $total_sell_execute = mysqli_query($conn, $total_sell);
                                        while($total_num_sell = mysqli_fetch_assoc($total_sell_execute)){
                                        ?>
                                        <tr>
                                            <td> <?php echo $n ?> </td>
                                            <td> 
                                                <?php 
                                                    $sell_id = $total_num_sell['user_id'];
                                                    $select = "SELECT * FROM `admin` WHERE user_id = '$sell_id'; ";
                                                    $run = mysqli_query($conn, $select);
                                                    while($seller_data = mysqli_fetch_assoc($run)){
                                                        echo $seller_data['name'];
                                                    }
                                                ?> 
                                            </td>
                                            <td> <?php echo $total_num_sell['payment_method'] ?> </td>
                                            <td> <?php echo $total_num_sell['category_type'] ?> </td>
                                            <td> <?php echo $total_num_sell['payment_status'] ?> </td>
                                            <td> <?php echo $total_num_sell['product_status'] ?> </td>
                                        </tr>
                                        <?php
                                            $n++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="datas">
                                <div class="salesGrowth">
                                </div>
                            </div>
                        </div>
                        <div class="totalProduct-tables tables">
                            <div class="firstHand-table bg">
                                <table class="tolalItem-table">
                              
                                    <caption>
                                        <h2>New Products Status</h>
                                    </caption>
                                    <thead class="tt-thead">
                                        <tr>
                                            <th>S.N</th>
                                            <th>Catogery</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tt-tbody">
                                        <?php 
                                            $i=1;
                                            $adminId = $_SESSION['user_id'];
                                            $sql_data="SELECT * fROM categories ;";
                                            $result = mysqli_query($conn,$sql_data);
                                            while($data=mysqli_fetch_assoc($result)){
                                                $Tables = $data['category_name'];
                                                $new_sql1 = "SELECT * FROM $Tables where admin_id = '$adminId' && producttype='new';";
                                                $total1 = mysqli_query($conn,$new_sql1);
                                                $count1 = mysqli_num_rows($total1);
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?> </td>
                                            <td> <?php echo $Tables ?> </td>
                                            <td>  <?php echo $count1  ?> </td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="secondHand-Table bg">
                                <table class="tolalItem-table">
                                    <caption>
                                        <h2>Second Hanad Products Status</h>
                                    </caption>
                                    <thead class="tt-thead">
                                        <tr>
                                            <th>S.N</th>
                                            <th>Catogery</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tt-tbody">
                                        <?php 
                                            $i=1;
                                            $adminId = $_SESSION['user_id'];
                                            $sql_data="SELECT * fROM categories ;";
                                            $result = mysqli_query($conn,$sql_data);
                                            while($data=mysqli_fetch_assoc($result)){
                                                $Tables = $data['category_name'];
                                                $new_sql1 = "SELECT * FROM $Tables where admin_id = '$adminId' && producttype='old';";
                                                $total1 = mysqli_query($conn,$new_sql1);
                                                $count1 = mysqli_num_rows($total1);
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?> </td>
                                            <td> <?php echo $Tables ?> </td>
                                            <td>  <?php echo $count1  ?> </td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
     </div>
    
        <script src="app.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<?php 
    }
    else{
        header("location: login.php?123456");
    }
?>
<?php
    require ("dbCOnn.php");
    require ('head.php');
    if($_SESSION['user_email'] != ""){
        $adminId = $_SESSION['user_id'];
        if((isset($_GET['table'])) &&(isset($_GET['id']))){
            $table = $_GET['table'];
            $product_id = $_GET['id'];
            $sql_delete = "DELETE FROM $table WHERE productid = '$product_id';";
            $execute_delete = mysqli_query($conn,$sql_delete);
        }
        
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
                            <button class="btn btn-nav btn-dashboard"><i class="fas fa-home"></i> Dashboard</button>
                        </div>
                    </a>
                    <a href="manageCategories.php">
                        <div class="same-class nav-manageCategories">
                        <button class="btn btn-nav btn-manageCategories "> <i class="fas fa-tasks"></i> Manage Categories</button>
                    </div>
                    </a>
                    <a href="manageProducts.php">
                        <div class="same-class nav-manageProducts">
                        <button class="btn btn-nav btn-manageProducts "> <i class="fas fa-cogs"></i> Manage Products</button>
                    </div>
                    </a>
                    <a href="manageUsedProducts.php">
                        <div class="same-class sub-secManageProducts">
                            <button class="btn btn-nav btn-secManageProducts"> <i class="fas fa-cogs"></i> Manage Used Products</button>
                        </div>
                    </a>
                    <a href="trendingProducts.php">
                        <div class="same-class nav-addTrendingProduct">
                            <button class="btn btn-nav btn-addTrendingProduct active"> <i class="fas fa-poll"></i> Trending Products </button>
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
                        <h2 class="show"> Trending Products </h2>
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
                            <p>Admin</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="body">
                <div class="show-trending bg">
                    <div class="st-head">
                        <h2>All Trending Products</h2>
                    </div>
                    <div class="tables bg">
                        <table class="table-detailProduct">
                            <thead class="dp-thead">
                                <tr>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Photo</th>
                                    <th>Brand Name</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody class="dp-tbody">
                                <?php
                                    $sql_product = "SELECT * FROM trending WHERE admin_id = '$adminId';";
                                    $result= mysqli_query($conn,$sql_product);
                                    while($trending=mysqli_fetch_assoc($result)){
                                        $sn =1 ;
                                        $table = $trending['category_type'];
                                        $pid = $trending['product_id'];
                                        $show_Sql = "SELECT * FROM $table WHERE productid = '$pid';";
                                        $result_new = mysqli_query($conn,$show_Sql);
                                        while($data=mysqli_fetch_assoc($result_new)){
                                    ?>
                                        <tr>
                                            <td><?php echo $data['productid'] ?></td>
                                            <td><?php echo $data['productname'] ?></td>
                                            <td><img class="show-photo"src="<?php echo $data['mainphoto'] ?>" alt=""></td>
                                            <td><?php echo $data['brandname'] ?></td>
                                            <td><?php echo $data['price'] ?></td>
                                            <td><?php echo $data['discount'] ?></td>
                                            <td><?php echo $data['color'] ?></td>
                                            <td><?php echo $data['quantity'] ?></td>
                                            <td>
                                                <?php
                                                    $pro_id = $data['productid'];
                                                     $table_news = $data['categoryname'];
                                                     
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $sn++;
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>
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
            header("location: login.php");
    }
?>
<?php
require ("dbCOnn.php");
require ('head.php');
if($_SESSION['user_email'] != ""){
    if(isset($_POST['acf-submit'])){
        $catogeryName = htmlspecialchars($_POST['tableName']);
        strtolower($catogeryName);
         $email = $_SESSION['email'];
        $sql_admin = "SELECT * FROM admin WHERE email = '$email'";
        $query = mysqli_query($conn,$sql_admin);
        while($row=mysqli_fetch_assoc($query))
        {
            $adminId = $row['user_id'];
            $sql_checkCategories = "SELECT * FROM categories WHERE category_name = '$catogeryName';";
            $runSql = mysqli_query($conn,$sql_checkCategories);
            $rowCount = mysqli_num_rows($runSql);
            if($rowCount == 0)
            {
                $new = "new";
                $sql_insert = "INSERT INTO categories(category_name,status) VALUES('$catogeryName','1');";
                $result = mysqli_query($conn,$sql_insert);
                if($result==TRUE)
                {
                    $sql_create = "CREATE TABLE $catogeryName(
                    productid int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    admin_id varchar(255),
                    status int(100),
                    producttype varchar(255),
                    productname varchar(255),
                    brandname varchar(255),
                    modelnumber varchar(255),
                    categoryname varchar(255),
                    price int(255),
                    discount int(255),
                    color varchar(255),
                    quantity int(255),
                    warrenty int(255),
                    paymentmethods varchar(255),
                    delivary int(255),
                    features text,
                    mainphoto varchar(225),
                    backphoto varchar(225),
                    otherphoto1 varchar(225),
                    otherphoto2 varchar(225)
                    ); ";
                    $execute = mysqli_query($conn,$sql_create);
                    if($execute==TRUE){
                        echo ' 
                            <script> error1=" Category Added" </script>
                        ';
                    } else {
                        echo ' 
                            <script> error1="Category Added But Table not Created" </script>
                        ';
                    }
                }
                else{
                    echo ' 
                        <script> error1 = "Adding Category Error"</script>
                    ';
                }
            }
            else{
                echo '<script> error1="Category Already Available" </script>';
            }
        }
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
                            <button class="btn btn-nav btn-manageCategories active"> <i class="fas fa-tasks"></i> Manage Categories</button>
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
                        <h2 class="show"> Manage Categories </h2>
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
                <div class="manage-categores">
                    <div class="add-categories bg">
                        <div class="ac-top">
                            <h2> Add New Category </h2>
                        </div>
                        <div class="ac-form">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                <div class="duplicate-error">
                                    
                                </div>
                                <div class="inputes">
                                    <input type="text" id="acf-input" name="tableName">
                                    <button class="btn btn-submit btn-acfSubmit" type="submit" name="acf-submit">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="show-categories bg">
                        <div class="sc-table bg">
                            <table class="full-table">
                                <caption><h2> All Categories Table </h2></caption>
                                <thead class="sc-thead">
                                    <tr>
                                        <th> S.N </th>
                                        <th> Catogery </th>
                                        <th> Toal Items </th>
                                        <th> First Hand </th>
                                        <th> Second Hand </th>
                                    </tr>
                                </thead>
                                <tbody class="sc-tbody">
                                    <?php
                                        $adminId = $_SESSION['user_id'];
                                        $sql_data="SELECT * fROM categories;";
                                        $result = mysqli_query($conn,$sql_data);
                                        $int =1;
                                        while($data=mysqli_fetch_assoc($result)){
                                            $Tables = $data['category_name'];
                                            $new_sql = "SELECT * FROM $Tables where admin_id = '$adminId';";
                                            $total = mysqli_query($conn,$new_sql);
                                            $count = mysqli_num_rows($total);
                                            $new_sql1 = "SELECT * FROM $Tables where admin_id = '$adminId' && producttype='new';";
                                            $total1 = mysqli_query($conn,$new_sql1);
                                            $count1 = mysqli_num_rows($total1);
                                    ?>
                                    <tr>
                                        <td><?php echo $int ?></td>
                                        <td><?php echo $data['category_name']?></td>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $count1 ?></td>
                                        <td><?php echo ($count-$count1) ?></td>
                                    </tr>
                                    <?php
                                    $int++;
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
    
        <script src="app.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<?php 
    }
    else{
        header("location: login.php");
    }
?>

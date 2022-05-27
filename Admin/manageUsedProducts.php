<?php
    require ("dbCOnn.php");
    require ('head.php');
    if($_SESSION['user_email'] != ""){
        $adminId = $_SESSION['user_id'];
        if((isset($_GET['table'])) && (isset($_GET['id']))){
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
                            <button class="btn btn-nav btn-manageProducts"> <i class="fas fa-cogs"></i> Manage Products</button>
                        </div>
                    </a>
                    <a href="manageUsedProducts.php">
                        <div class="same-class sub-secManageProducts">
                            <button class="btn btn-nav btn-secManageProducts active"> <i class="fas fa-cogs"></i> Manage Used Products</button>
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
                        <h2 class="show"> Manage Second Hand Products </h2>
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
                <div class="manage-products">
                    <div class="display-flex">
                        <div class="categories-table full-table bg">
                            <table class="categoriesTable">
                                <caption> <h2> Categories </h2> </caption>
                                <thead class="cat-thead">
                                    <tr>
                                        <th> S.N </th>
                                        <th> Name </th>
                                    </tr>
                                </thead>
                                <tbody class="cat-tbody">
                                    <?php
                                        
                                        $sql_data="SELECT * fROM categories ;";
                                        $result = mysqli_query($conn,$sql_data);
                                        $int =1;
                                        while($data=mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $int; ?>.</td>
                                        <td>
                                            <a href="?table=<?php echo $data['category_name']?>">
                                                <button class="btn btn-tableName"><?php echo $data['category_name']?></button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $int++;
                                        }
                                    ?>
                                </tbody> 
                            </table>
                        </div>
                        <div class="categories-detail bg">
                            <div class="form form-addProduct">
                                <div class="details-top">
                                    <h2> Add New Products</h2>
                                </div>
                                <div class="form-part">
                                    <form action="uploadUsedProduct.php" method="post" enctype="multipart/form-data">
                                        <fieldset class="fieldset1">
                                            <legend> <h4> General </h4> </legend>
                                            <div class="display-flex">
                                                <div class="product-name inp-same">
                                                    <label for="product-name"> Product Name </label>
                                                    <input type="text" id="product-name" name="product-name" require>
                                                </div>
                                                <div class="brand-name inp-same">
                                                    <label for="brand-nam "> Brand Name </label>
                                                    <input type="text" id="brand-name" name="brand-name" require>
                                                </div>
                                                <div class="model-number inp-same">
                                                    <label for="model-number"> Model Number </label>
                                                    <input type="text" id="model-number" name="model-number" require>
                                                </div>
                                                
                                            </div>
                                            <div class="display-flex">
                                                <div class="category-name inp-same">
                                                    <label for="category-name"> Category Name </label>
                                                    <select name="category-name" id="category-name">
                                                        <?php
                                                            $adminId = $_SESSION['user_id'];
                                                            $sql_data="SELECT * fROM categories;";
                                                            $result = mysqli_query($conn,$sql_data);
                                                            $int =1;
                                                            while($data=mysqli_fetch_assoc($result)){
                                                        ?>
                                                        <option value="<?php echo $data['category_name']?>"><?php echo $data['category_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="price inp-same">
                                                    <label for="price"> Price </label>
                                                    <input type="number" id="price" name="price" require>
                                                </div>
                                                <div class="discount inp-same">
                                                    <label for="discount"> Discount </label>
                                                    <input type="number" id="discount" name="discount" require>
                                                </div>
                                                <div class="color inp-same">
                                                    <label for="color"> Color </label>
                                                    <input type="text" id="color" name="color" require>
                                                </div>
                                                <div class="quantity inp-same">
                                                    <label for="quantity"> Quantity </label>
                                                    <input type="number" id="quantity" name="quantity" require>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <br>
                                        <fieldset class="fieldset1">
                                            <legend> <h4> Special </h4> </legend>
                                            <div class="display-flex">
                                                <div class="warrenty inp-same">
                                                    <label for="warrenty"> Warrenty (In Months) </label>
                                                    <input type="number" id="warrenty" name="warrenty" require>
                                                </div>
                                                <div class="payment-methods inp-same">
                                                    <label for="payment-methods"> Payment-methods </label>
                                                    <select name="payment-methods" id="payment-methods">
                                                        <option value="online"> Online </option>
                                                        <option value="delivary"> Cash on Delivary </option>
                                                        <option value="Both"> Both </option>
                                                    </select>
                                                </div>
                                                <div class="delivary-time inp-same">
                                                    <label for="delivary-time "> Delivary Time(In Days) </label>
                                                    <input type="number" id="delivary-time" name="delivary-time" require>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <br>
                                        <fieldset class="fieldset1">
                                            <legend> <h4> Others </h4> </legend>
                                            <div class="display-flex">
                                                <div class="features inp-same">
                                                    <label for="features"> Features </label>
                                                    <textarea name="features" id="features" cols="30" rows="12"></textarea>
                                                </div>
                                                <div class="photos">
                                                    <h4>All Photos </h4>
                                                    <div class="main-photo inp-same">
                                                        <label for="main-photo"> Main Photo </label>
                                                        <input type="file" id="main-photo" name="main-photo" require>
                                                    </div>
                                                    <!-- <div class="left-photo inp-same">
                                                        <label for="left-photo"> Left Photo </label>
                                                        <input type="file" id="left-photo" name="left-photo" require>
                                                    </div>
                                                    <div class="right-photo inp-same">
                                                        <label for="right-photo"> Right Photo </label>
                                                        <input type="file" id="right-photo" name="right-photo" require>
                                                    </div> -->
                                                    <div class="back-photo inp-same">
                                                        <label for="back-photo"> Back Photo </label>
                                                        <input type="file" id="back-photo" name="back-photo" require>
                                                    </div>
                                                    <div class="other1-photo inp-same">
                                                        <label for="other1-photo"> Other1 Photo </label>
                                                        <input type="file" id="other1-photo" name="other1-photo" >
                                                    </div>
                                                    <div class="other2-photo inp-same">
                                                        <label for="other2-photo"> Other2 Photo </label>
                                                        <input type="file" id="other2-photo" name="other2-photo" >
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <br>
                                        <div class="submit-data">
                                            <button class="btn btn-submitProduct" type="submit" name="product-submit">Submit All Data</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                            <div class="product-details">
                                <div class="table">
                                    <?php
                                        if(isset($_GET['table'])){
                                            $table = $_GET['table'];
                                            echo '<script> var hideClass = "true" </script>';
                                    ?>
                                    <div class="table-caption">
                                        <h2>  <?php echo $table ?> All Data </h2> 
                                        <button class="btn btn-tableName btn-toggle"> Add Product </button>
                                    </div>
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
                                               <th>Status</th>
                                               <th>Trending</th>
                                               <th>Delete</th>
                                           </tr>
                                       </thead>
                                       <tbody class="dp-tbody">
                                           <?php
                                                
                                                $sql_product = "SELECT * FROM $table WHERE admin_id = '$adminId' && producttype='old';";
                                                $result= mysqli_query($conn,$sql_product);
                                                $sn =1 ;
                                                while($data=mysqli_fetch_assoc($result)){
                                                    if($data['status'] == 0){
                                                        $active = 'Deactive';
                                                    }else{
                                                        $active = 'Active';
                                                    }
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
                                                    <td><?php echo $active ?></td>
                                                    <td>
                                                        <?php
                                                            if($data['status'] != 0){
                                                        ?>
                                                                <a href="addTrending.php?table=<?php echo $table ?>&id=<?php echo $data['productid'] ?>"><i class="fas fa-plus"></i></a>
                                                        <?php
                                                            }else{
                                                                echo '<i class="fas fa-plus"></i>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><div class="delete"><a href="?table=<?php echo $table ?>&id=<?php echo $data['productid'] ?>"><i class="far fa-trash-alt"></i></a></div></td>

                                                </tr>
                                            <?php
                                            $sn++;
                                                }
                                           ?>
                                       </tbody>
                                    </table>
                                    <?php
                                    }
                                    ?>
                                </div>
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
        header("location: login.php");
    }
?>
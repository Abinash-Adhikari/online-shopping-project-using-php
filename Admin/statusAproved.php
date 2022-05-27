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
                        <h2 class="show"> Product Approve </h2>
                    </div>
                    <div class="current-page">
                        <button class="btn">
                            <h2><a href="delivered.php">Product Deliver </a></h2>
                        </button>
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
                        <div class="categories-table full-table bg">
                            <table border class="categoriesTable">
                                <caption> <h2> Categories </h2> </caption>
                                <thead class="cat-thead">
                                    <tr>
                                        <th> S.N </th>
                                        <th> Name </th>
                                    </tr>
                                </thead>
                                <tbody class="cat-tbody">
                                    <?php
                                        
                                         $sql_data="SELECT * fROM categories;";
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
                            <div class="product-details">
                                <div class="table">
                                    <div class="table-caption">
                                        <h2>  <?php echo $table ?> All Data </h2> 
                                    </div>
                                    <table border class="table-detailProduct">
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
                                           </tr>
                                       </thead>
                                       <tbody class="dp-tbody">
                                           <?php
                                                $sql_product = "SELECT * FROM $table WHERE  producttype='old';";
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
                                                    <td><a href="productStatus.php?type=<?php echo $table ?>&p_id=<?php echo $data['productid'] ?>"><?php echo $active ?></a></td>
                                                    <td>
                                                        <?php
                                                        $pro =$data['productid'];
                                                           $sql_pr = "SELECT * FROM trending WHERE category_type='$table' AND product_id = $pro;";
                                                            $result1= mysqli_query($conn,$sql_pr);
                                                            if(mysqli_num_rows($result1)==1){
                                                                while($trending=mysqli_fetch_assoc($result1)){
                                                                    if ($trending['status'] == 0)
                                                                        {
                                                                            $data = '<i class="fas fa-plus"></i>';
                                                                        } else {
                                                                        $data = '<i class="fas fa-minus"></i>';
                                                                        } 
                                                                    } 
                                                                }  
                                                            else{
                                                                    $data = '<i class="fas fa-plus"></i>';
                                                                }
                                                                ?>
                                                            <a href="addTrending.php?table=<?php echo $table ?>&id=<?php echo $data['productid'] ?>">
                                                            <?php echo $data?>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                                    
                                            $sn++;
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
</body>

<?php







    }else{
        
        header('location: adminLogin.php');
    }

?>
<?php
    include ("head.php");
    include ("dbConn.php");
?>
<body>
    <div class="containner">
        <div class="first-view">
            <div class="background-image">
                <img src="Photos/image.png" alt="">
            </div>
            <div class="navbar">
                <div class="navbar-logo">
                    <a href="index.php">
                        <img src="Photos/logo.png" alt="">
                    </a>
                </div>
                <div class="navbar-links">
                    <div class="link"> <a href="newProducts.php"> NEW PRODUCT </a> </div>
                    <div class="link"> <a href="oldProduct.php"> OLD PRODUCT </a> </div>
                    <div class="link"> <a href="../Admin/index.php"> SELL PRODUCT </a> </div>
                    <div class="link"> <a href="compareProducts.php">COMPARE PRODUCT</a> </div>
                </div>
                <div class="location">
                    <div class="location-icon"> <i class="fas fa-globe"></i> </div>
                    <div class="location-place"> 
                        <?php
                            if(isset($_SESSION['user_id'])){
                                $user_id = $_SESSION['user_id'];
                                $address_sql = "SELECT * FROM admin WHERE user_id = '$user_id';";
                                $address_execute = mysqli_query($conn, $address_sql);
                                while($data = mysqli_fetch_assoc($address_execute)){
                                    $address = $data['address'];
                                    echo $address;
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="login-register">
                    <div class="lr-text">
                        <?php 
                            if(isset($_SESSION['user_id'])){
                                if($_SESSION['user_id'] != "")
                                {
                            ?>
                                <a href="logout.php">LOGOUT</a>
                            <?php
                                }else{
                            ?>
                                <a href="login.php">LOGIN / REGISTER</a>
                             <?php
                                }
                            }else{
                        ?>
                            <a href="login.php"> LOGIN / REGISTER </a>
                        <?php
                        }
                            ?>
                    </div>
                </div>
                <div class="search-bar">
                    <form action="search.php">
                        <input class="input-search" type="search" name="id" id="search-icon">
                        <label for="search-icon"><button class="none" type="sumbit"><i class="fas fa-search"></i></button></label>
                    </form>
                </div>
                <div class="cart">
                    <a href="cart.php"><div class="cart-logo"> <i class="fas fa-shopping-cart"></i> </div></a>
                </div>
            </div>
            <div class="sologon">
                <div class="slgn-text">
                    <p> <strong> Powered </strong> by Intellect</p>
                    <p> <strong> Driven </strong> by Values</p>
                    <a href="allGadgets.php"><button class="btn btn-shop">Shop Now</button></a>
                </div>
            </div>
        </div>
        <div class="containner-second">
            <div class="our-products">
                <div class="title">
                    <div class="line"></div>
                    <div class="title-text">
                        <h2>OUR</h2>
                        <h2>PRODUCTS</h2>
                    </div>
                </div>
                <div class="compare-productShow">
                    <?php
                        $sql_table =  "SELECT * FROM categories;";
                        $execute_table = mysqli_query($conn,$sql_table);
                        while($tableArray = mysqli_fetch_assoc($execute_table)){
                             $array[] = $tableArray['category_name'];
                        }
                        $new_table =  $array[array_rand($array)];
                    ?>
                    <div class="first-second">
                        <div class="first-hand">
                             <div class="fh-top">
                                 <h1>First Hand Products</h1 >
                             </div>
                              <?php
                                echo "<h3> $new_table </h3>";
                                $sql2 = "SELECT * FROM $new_table WHERE producttype = 'new' LIMIT 2 ;";
                                $query = mysqli_query($conn,$sql2);     
                                while($table = mysqli_fetch_assoc($query)){
                                    $p_id = $table['productid'];
                            ?>
                             <div class="fh-body">
                                 <a href="detailProduct.php?table=<?php echo $new_table ?>&id=<?php echo $p_id ?>">
                                    <div class="show-image">
                                        <img src="..//Admin/<?php echo $table['mainphoto'] ?>" alt="">
                                    </div>
                                </a>
                                <div class="item-details">
                                    <div class="name-cost">
                                        <div class="it-name"><h3><?php echo $table['productname'] ?></h3></div>
                                        <div class="id-cost"><i class="fas fa-rupee-sign"></i><?php echo ($table['price'] - $table['discount'] ) ?></div>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                             </div>
                             <?php
                                }
                                ?>
                        </div>
                        <div class="second-hand">
                            <div class="sh-top">
                                <h1>Second Hand Products</h1>
                            </div>
                            <?php
                                echo "<h3> $new_table </h3>";
                                $sql2 = "SELECT * FROM $new_table WHERE producttype = 'old' LIMIT 2 ;";
                                $query = mysqli_query($conn,$sql2);     
                                while($table = mysqli_fetch_assoc($query)){
                                    $p_id = $table['productid'];
                            ?>
                            <div class="fh-body">
                                <a href="detailProduct.php?table=<?php echo $new_table ?>&id=<?php echo $p_id ?>">
                                    <div class="show-image">
                                        <img src="..//Admin/<?php echo $table['mainphoto'] ?>" alt="">
                                    </div>
                                </a>
                                <div class="item-details">
                                    <div class="name-cost">
                                        <div class="it-name"><h3><?php echo $table['productname'] ?></h3></div>
                                        <div class="id-cost"><i class="fas fa-rupee-sign"></i><?php echo ($table['price'] - $table['discount'] ) ?></div>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="explore">
                        <a href="first-second.php">
                            <div class="button">
                                <button class="btn btn-explore">Explore More</button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="div-common cs-1">
                <div class="title">
                    <div class="line"></div>
                    <div class="title-text">
                        <h2>WHY</h2>
                        <h2>ALPHA GADGET</h2>
                    </div>
                </div>
                <div class="boxes">
                    <div class="box">
                        <div class="box-icon">
                            <img src="Photos/secure payment.png" alt="">
                        </div>
                        <div class="box-text">
                            <h3>SECURE</h3>
                            <h3>PAYMENT</h3>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-icon">
                            <img src="Photos/freedelivary.png" alt="">
                        </div>
                        <div class="box-text">
                            <h3>FREE</h3>
                            <h3>DELIVARY</h3>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-icon">
                            <img src="Photos/moneyback.png" alt="">
                        </div>
                        <div class="box-text">
                            <h3>MONEY BACK</h3>
                            <h3>GURANTEE</h3>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-icon">
                            <img src="Photos/alwalysSupport.png" alt="">
                        </div>
                        <div class="box-text">
                            <h3>ALWALYS</h3>
                            <h3>SUPPORT</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="div-common">
                <div class="title">
                    <div class="line"></div>
                    <div class="title-text">
                        <h2>FEATURED</h2>
                        <h2>PRODUCTS</h2>
                    </div>
                </div>
                <div class="featured-products">
                    <div class="top-list">
                        <?php
                            $sql = "SELECT * FROM categories ORDER BY 's_n' ASC;";
                            $query = mysqli_query($conn,$sql);
                            while($table = mysqli_fetch_assoc($query)){
                        ?>
                            <a href="?tables=<?php echo $table['category_name'] ?>"><button class="btn btn-list"> <?php echo $table['category_name'] ?> </button></a>
                            <?php
                            }
                        ?> 
                    </div>  
                    <div class="all-carousel">
                        <div class="item-header">
                            <h1><?php 
                             $new_tables='';
                                if(isset($_GET['tables'])){
                                    $new_tables =$_GET['tables'];
                                    echo ' <script> var scroll = "on" </script> ';
                                }else{
                                    $new_tables = "laptop";
                                    echo ' <script> var scroll = "off" </script> ';
                                }
                            echo $new_tables ;
                            ?></h1>
                        </div>
                        <div class="owl-carousel owl-theme">
                            <?php
                               
                                $sql2 = "SELECT * FROM $new_tables ;";
                                $query = mysqli_query($conn,$sql2);                        
                                $first=1;
                                while($table = mysqli_fetch_assoc($query)){
                                    $p_id = $table['productid'];
                            ?>
                                <div class="item ">
                                    <div class="first<?php echo $first ?>">
                                        <a href="detailProduct.php?table= <?php echo $new_tables ?>&id=<?php echo $p_id ?>">
                                            <div class="item-image">
                                                <img src="..//Admin/<?php echo $table['mainphoto'] ?>" alt="">
                                            </div>
                                        </a>
                                        <div class="item-details">
                                            <div class="name-cost">
                                                <div class="it-name"><?php echo $table['productname'] ?></div>
                                                <span class="d-flex">
                                                    <div class="it-cost"><i class="fas fa-rupee-sign"></i><?php echo ($table['price']) ?></div>
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            <?php
                                $first ++;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="our-services">
                <div class="title">
                    <div class="line"></div>
                    <div class="title-text">
                        <h2>OUR</h2>
                        <h2>SERVICES</h2>
                    </div>
                </div>
                <div class="icons">
                    <div class="first-row">
                        <div class="icon-box">
                            <div class="ib-image">
                                <img src="Photos/pca.png" alt="">
                            </div>
                            <div class="ib-text">
                                <h3>Personal Costumer <br> Adviser</h3>
                            </div>
                        </div>
                        <div class="icon-box">
                            <div class="ib-image">
                                <img src="Photos/ei.png" alt="">
                            </div>
                            <div class="ib-text"><h3>Essay Insurance</h3></div>
                        </div>
                        <div class="icon-box">
                            <div class="ib-image">
                                <img src="Photos/rm.png" alt="">
                            </div>
                            <div class="ib-text"><h3>Refurbish Mobile</h3></div>
                        </div>
                    </div>
                    <div class="second-row">
                        <div class="icon-box">
                            <div class="ib-image">
                                <img src="Photos/lce.png" alt="">
                            </div>
                            <div class="ib-text"><h3>Low Cost EMI</h3></div>
                        </div>
                        <div class="icon-box">
                            <div class="ib-image">
                                <img src="Photos/byp.png" alt="">
                            </div>
                            <div class="ib-text"><h3>Book Your Product</h3></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="trending-products">
                <div class="title">
                    <div class="line"></div>
                    <div class="title-text">
                        <h2>TRENDING</h2>
                        <h2>PRODUCTS</h2>
                    </div>
                </div>
                <div class="show-trending">
                    <div class="owl-carousel owl-theme">
                            <?php
                                $sql2 = "SELECT * FROM trending WHERE status = '1';";
                                $query = mysqli_query($conn,$sql2);                        
                                $first=1;
                                while($trending = mysqli_fetch_assoc($query)){
                                     $table_name = $trending['category_type'];
                                    $pid = $trending['product_id'];
                                    $show_Sql = "SELECT * FROM $table_name WHERE productid = '$pid';";
                                    $result_new = mysqli_query($conn,$show_Sql);
                                    while($table=mysqli_fetch_assoc($result_new)){
                            ?>
                                <div class="item ">
                                    <div class="first<?php echo $first ?>">
                                        <a href="detailProduct.php?table= <?php echo $table_name ?>&id=<?php echo $pid ?>">
                                            <div class="item-image">
                                                <img src="..//Admin/<?php echo $table['mainphoto'] ?>" alt="">
                                            </div>
                                        </a>
                                        <div class="item-detail">
                                            <div class="name-cost">
                                                <div class="it-name"><?php echo $table['productname'] ?></div>
                                                <div class="it-cost mb"><i class="fas fa-rupee-sign"></i><?php echo ($table['price'] - $table['discount'] ) ?></div>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            <?php
                                $first ++;
                                }
                            }
                            ?>
                        </div>
                </div>
            </div>
            <div class="latest-update">
                <div class="title">
                    <div class="line"></div>
                    <div class="title-text">
                        <h2>LATEST</h2>
                        <h2>NEWS AND UPDATE</h2>
                    </div>
                </div>
                <div class="news-update">
                    <div class="nu-image">
                        <img src="Photos/lnu.png" alt="">
                    </div>
                </div>
            </div>
            <div class="client-review">
                <div class="title">
                    <div class="line"></div>
                    <div class="title-text">
                        <h2>OUR CLIENT</h2>
                        <h2>REVIEWS</h2>
                    </div>
                </div>
                <div class="client-reviews">
                    <div class="nu-image">
                        <img src="Photos/cr1.png" alt="">
                    </div>
                    <div class="nu-image">
                        <img src="Photos/cr2.png" alt="">
                    </div>
                </div>
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
    <script src="js/homePage.js?v=<?php echo time(); ?>"></script>
</body>
</html>
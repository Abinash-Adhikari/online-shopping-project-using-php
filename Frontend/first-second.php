<?php
    include ("dbConn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Font Style-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,900;1,400;1,900&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <!--Font Style-->

    <!-- fontawasome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- fontawasome -->
    <!-- jquerry -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jquerry -->
    <title>First-Second</title>
    <link rel="stylesheet" href="css/first-second.css?v=<?php echo time(); ?>">
</head>
<body>
   <div class="containner">
        <?php
            include ("navbar.php");
        ?>
        <div class="body-containner">
            <div class="compare-productShow">
                    <?php
                        $sql_table =  "SELECT * FROM categories;";
                        $execute_table = mysqli_query($conn,$sql_table);
                        while($tableArray = mysqli_fetch_assoc($execute_table)){
                             $new_table = $tableArray['category_name'];
                       
                    ?>
                    <div class="first-second">
                        <div class="first-hand">
                             <div class="fh-top">
                                 <h1>First Hand Products</h1>
                                 <br>
                                 <h2> <?php echo  $new_table ?> </h2>
                             </div>
                              <?php
                                // echo "<h3> $new_table </h3>";
                                $sql2 = "SELECT * FROM $new_table WHERE producttype = 'new';";
                                $query = mysqli_query($conn,$sql2);     
                                while($table = mysqli_fetch_assoc($query)){
                                    $p_id = $table['productid'];
                            ?>
                             <div class="fh-body">
                                 <a href="detailProduct.php?table=laptop&id=<?php echo $p_id ?>">
                                    <div class="show-image">
                                        <img src="..//Admin/<?php echo $table['mainphoto'] ?>" alt="">
                                    </div>
                                </a>
                                <div class="item-details">
                                    <div class="name-cost">
                                        <div class="it-name"><h3><?php echo $table['productname'] ?></h3></div>
                                        <div class="id-cost">
                                            <span><i class="fas fa-rupee-sign"></i> <?php echo $table['price']- $table['discount']?></span>
                                            <span><strike><i class="fas fa-rupee-sign"></i> <?php echo $table['price']?></strike> <span class="lite-color">(<i class="fas fa-rupee-sign"></i><?php echo $table['discount'] ?> Discount)</span></span>    
                                        </div>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-brief-first">
                                    <div class="pd-description">
                                        <span class="lite-color"><h3>Descripion</h3></span>
                                        <p><?php echo $table['features']?></p>
                                    </div>
                                </div>
                                <br>
                                <a href="cart.php?table=<?php echo $table['categoryname']?>&id=<?php echo $table['productid'] ?>">
                                    <div class="button">
                                        <button class="btn btn-brief btn-second">Add To  Cart</button>
                                    </div>
                                </a>
                                <br>
                                <br>
                             </div>
                             <?php
                                }
                                ?>
                        </div>
                        <div class="second-hand">
                            <div class="sh-top">
                                <h1>Second Hand Products</h1>
                                <br>
                                <h2> <?php echo  $new_table ?> </h2>
                            </div>
                            <?php
                                // echo "<h3> $new_table </h3>";
                                $sql2 = "SELECT * FROM $new_table WHERE producttype = 'old'  AND status = '1';";
                                $query = mysqli_query($conn,$sql2);     
                                while($table = mysqli_fetch_assoc($query)){
                                    $p_id = $table['productid'];
                            ?>
                            <div class="fh-body">
                                <a href="detailProduct.php?table=laptop&id=<?php echo $p_id ?>">
                                    <div class="show-image">
                                        <img src="..//Admin/<?php echo $table['mainphoto'] ?>" alt="">
                                    </div>
                                </a>
                                <div class="item-details">
                                    <div class="name-cost">
                                        <div class="it-name"><h3><?php echo $table['productname'] ?></h3></div>
                                        <div class="id-cost">
                                            <span><i class="fas fa-rupee-sign"></i> <?php echo $table['price']- $table['discount']?></span>
                                            <span><strike><i class="fas fa-rupee-sign"></i> <?php echo $table['price']?></strike> <span class="lite-color">(<i class="fas fa-rupee-sign"></i><?php echo $table['discount'] ?> Discount)</span></span>    
                                        </div>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-brief-second">
                                    <div class="pd-description">
                                        <span class="lite-color"><h3>Descripion</h3></span>
                                        <p><?php echo $table['features']?></p>
                                    </div>
                                </div>
                                <br>
                                <a href="cart.php?table=<?php echo $table['categoryname']?>&id=<?php echo $table['productid'] ?>">
                                    <div class="button">
                                        <button class="btn btn-brief btn-second">Add To  Cart</button>
                                    </div>
                                </a>
                                <br>
                                <br>

                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                     }
                     ?>
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
   <script src="js/first-second.js?v=<?php echo time(); ?>"></script>
</body>
</html>
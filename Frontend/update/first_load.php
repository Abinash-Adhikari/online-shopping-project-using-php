<?php
    include ("dbConn.php");
    $table_name=$_POST['table'];
    $pr_id=$_POST['id'];

?>
<?php
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
    
     <!-- owl carousel css class -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- owl carousel class -->
    <!-- owl carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/homePage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/detailProduct.css?v=<?php echo time(); ?>">
    <script src="js/detailProducts.js?v=<?php echo time(); ?>"></script>
    <title>Details Product</title>
</head>
<body>
   <div class="containner">
        <?php 
            $sql = "SELECT * FROM $table_name WHERE productid = '$pr_id';";
            $execute = mysqli_query($conn,$sql);
            while($data = mysqli_fetch_assoc($execute)){
        ?>
        <div class="body-containner">
            <div class="pd-images flex-center">
                <div class="main-image" style="width: 26rem; height: 20rem;">
                    <img src="..//Admin/<?php echo $data['mainphoto'] ?>" alt="">
                </div>
                <div class="others-images" style="width: 27rem; height: auto;">
                    <div class="other-image" style="width: 9rem; height: auto;">
                        <img src="..//Admin/<?php echo $data['backphoto'] ?>" alt="">
                    </div>
                    <div class="other-image" style="width: 9rem; height: auto;">
                        <img src="..//Admin/<?php echo $data['otherphoto1'] ?>" alt="">
                    </div>
                    <div class="other-image" style="width: 9rem; height: auto;">
                        <img src="..//Admin/<?php echo $data['otherphoto2'] ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="product-details">
                <div class="pd-body">
                    <div class="item-name">
                        <h1><?php echo  $data['productname'] ?></h1>
                    </div>
                    <div class="pd-model mb">
                        <small class="pd-model">Model Number: <?php echo $data['modelnumber'] ?> </small>
                    </div>
                    <div class="pb-reviews mb">
                        <p>5 reviews</p>
                        <div class="star">
                            <span><i class="fas fa-star"></i> 4.5 </span>
                        </div>
                    </div>
                    <div class="pd-price mb">
                        <span><i class="fas fa-rupee-sign"></i> <?php echo $data['price']?></span>
                        <span><strike><i class="fas fa-rupee-sign"></i> <?php echo $data['price'] +  $data['discount']?></strike> <span class="lite-color">(<i class="fas fa-rupee-sign"></i><?php echo $data['discount'] ?> Discount)</span></span>
                    </div>
                    <div class="pd-color mb">
                        color
                        <div class="color-box" style="background-color: <?php echo $data['color'] ?>"></div>
                    </div>
                    <div class="pd-delivary mb">
                        <div class="delivary-time">
                            <span class="lite-color">Eatimate delivary</span>
                            <p><?php echo $data['delivary']?> Days</p>
                        </div>
                        <div class="delivary-charge">
                            <span class="lite-color">Delivary Charge</span>
                            <div><i class="fas fa-rupee-sign"></i> Free</div>
                        </div>
                    </div>
                    <div class="pd-description">
                        <span class="lite-color">Descripion</span>
                        <p><?php echo $data['features']?></p>
                    </div>
                </div>
            </div>
            <div class="pd-buttons">
                <div class="d-center">
                    <div class="button buton-cart">
                        <a href="cart.php?table=<?php echo $data['categoryname']?>&id=<?php echo $data['productid'] ?>">
                            <button class="btn-cart">Add to cart</button>
                        </a>
                    </div>
                    <div class="button buton-cart">
                        <button class="btn-question">Have any Question?</button>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="detail-review mb">
            <div class="underline mb ">
                <div class="specification actives">
                    Product Details
                </div>
                <div class="review">
                    Rating and reviews
                </div>
            </div>
            <div class="content">
                <div class="specification-content mb">
                    <div class="display-flex mb">
                        <div class="m-n">
                            <div>Brand </div>
                            <div class="c-white">
                                <?php echo  $data['brandname'] ?>
                            </div>
                        </div>
                        <div class="m-n">
                            <div>Model Name </div>
                            <div class="c-white">
                                <?php echo  $data['productname'] ?> <?php echo $data['modelnumber'] ?>
                            </div>
                        </div>
                        <div class="m-n">
                            <div>Seller </div>
                            <?php
                                $user= $data['admin_id'];
                                $seller = "SELECT * FROM admin WHERE user_id = '$user'";
                                $querry_user = mysqli_query($conn,$seller);
                                while($data_user = mysqli_fetch_assoc($querry_user))
                                {
                            ?>
                            <div class="c-white">
                                <?php echo  $data_user['name'] ?>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="display-flex">
                        <div class="m-n">
                            <div>From factor </div>
                            <div class="c-white">
                                <?php echo  $table_name ?>
                            </div>
                        </div>
                        <div class="m-n">
                            <div>Product Type </div>
                            <div class="c-white">
                                <?php 
                                    if(  $data['producttype'] == "old"){
                                        echo "Second Hand Product";
                                    }else{
                                        echo "Fresh New Product";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    
                </div>
            </div>
            <hr>
        </div>
         <?php
            }
        ?>
   </div>
   <script src="js/homePage.js?v=<?php echo time(); ?>"></script>
</body>
</html>
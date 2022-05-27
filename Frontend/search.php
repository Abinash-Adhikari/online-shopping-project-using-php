<?php
    include ("dbConn.php");
    $search_value = $_GET['id'];
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
    <title>All Gadgets</title>
    <link rel="stylesheet" href="css/allGadget.css?v=<?php echo time(); ?>">
</head>
<body>
   <div class="containner">
        <?php
            include ("navbar.php");
        ?>
        <div class="all-top">
            <h1>All Gadgets</h1>
        </div>
        <div class="all-products">
            <div class="body-containner new">
                <div class="header">
                   New Gadgets
                </div>
                <hr>
                <div class="options">
                    <?php
                        $sql_selectCategories = "SELECT * FROM categories;";
                        $query_run = mysqli_query($conn,$sql_selectCategories);
                        while($catName = mysqli_fetch_assoc($query_run))
                        {
                    ?>
                    <div class="all-images">
                        <?php
                            $table = $catName['category_name'];
                            $Sql_data = "SELECT * FROM $table WHERE producttype = 'new'  INTERSECT SELECT * FROM $table WHERE productname LIKE '%$search_value%' OR brandname LIKE '%$search_value%' OR categoryname LIKE '%$search_value%' OR features LIKE '%$search_value%';";
                            $Query = mysqli_query($conn,$Sql_data);
                            while($all=mysqli_fetch_assoc($Query)){
                                $p_id = $all['productid'];
                                echo 
                                "<script> 
                                        var product_table = '$table';
                                        var product_id = ' $p_id ';
                                </script>"
                        ?>
                            <div class="show-box">

                                <div class="sb-image new-Photo">
                                    <img src="..//Admin/<?php echo $all['mainphoto'] ?>" alt="">
                                </div>
                                <div class="sb-text">
                                    <div class="sb-brandName">
                                        <span><h4><?php echo $all['productname'] ?></h4></span>
                                    </div>
                                    <div class="sb-others">
                                        <span><i class="fas fa-rupee-sign"></i> <?php echo $all['price'] - $all['discount'] ?></span>
                                        <span class="sbo-icon">
                                            <a href="cart.php?table=<?php echo $all['categoryname']?>&id=<?php echo $all['productid'] ?>">
                                                <span><i class="fas fa-shopping-cart"></i></span>
                                            </a>  
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>  
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div class="body-containner old">
                <div class="header">
                    Second Hand Gadgets
                </div>
                <hr>
                <div class="options">
                    <?php
                        $sql_selectCategories = "SELECT * FROM categories;";
                        $query_run = mysqli_query($conn,$sql_selectCategories);
                        while($catName = mysqli_fetch_assoc($query_run))
                        {
                    ?>
                    <div class="all-images">
                        <?php
                            $table = $catName['category_name'];
                            $Sql_data = "SELECT * FROM $table WHERE producttype = 'old' AND status = '1' INTERSECT (SELECT * FROM $table WHERE productname LIKE '%$search_value%' OR brandname LIKE '%$search_value%' OR categoryname LIKE '%$search_value%' OR features LIKE '%$search_value%');";
                            $Query = mysqli_query($conn,$Sql_data);
                            while($all=mysqli_fetch_assoc($Query)){
                                $p_id = $all['productid'];
                        ?>
                            <div class="show-box">
                                <div class="sb-image old-Photo">
                                    <img src="..//Admin/<?php echo $all['mainphoto'] ?>" alt="">
                                </div>
                                <div class="sb-text">
                                    <div class="sb-brandName">
                                        <span><h4><?php echo $all['productname'] ?></h4></span>
                                    </div>
                                    <div class="sb-others">
                                        <span><i class="fas fa-rupee-sign"></i> <?php echo $all['price'] - $all['discount'] ?></span>
                                        <span class="sbo-icon">
                                            <a href="cart.php?table=<?php echo $all['categoryname']?>&id=<?php echo $all['productid'] ?>">
                                                <span><i class="fas fa-shopping-cart"></i></span>
                                            </a>  
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>  
                    </div>
                    <?php
                        }
                    ?>
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
   <script src="js/allGadget.js?v=<?php echo time(); ?>"></script>
</body>
</html>
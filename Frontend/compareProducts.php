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
    <title>Compare Products</title>
    <link rel="stylesheet" href="css/compareProduct.css?v=<?php echo time(); ?>">
</head>
<body>
   <div class="containner">
        <?php
            include ("navbar.php");
        ?>
        <div class="body-containner">
            
            <div class="show-all-pr"> 
                            
                <div class="first-hand">
                    <div class="header">
                        First Hand Gadgets
                    </div>
                    <div class="sh-div1">
                    </div>
                    <div class="options-val">
                        <div class="result">
                            <?php
                                $Sql_data = "SELECT * FROM laptop WHERE producttype = 'new';";
                                $Query = mysqli_query($conn,$Sql_data);
                                $count = mysqli_num_rows($Query);
                                {
                            ?>
                                <span>Currently Showing : <?php echo $count ?> results </span>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="short-by">
                            <Span>Short By: 
                                <select name="shortBy" id="short-by">
                                    <option value="ASC">Low to High</option>
                                    <option value="DESC">High to Low</option>
                                </select> 
                            </Span>
                        </div>
                    </div>
                    <div class="options-items">
                        <div class="op-box">
                            <select name="category" id="select-category">
                            <?php
                                $sql_selectCategories = "SELECT * FROM categories;";
                                $query_run = mysqli_query($conn,$sql_selectCategories);
                                while($catName = mysqli_fetch_assoc($query_run))
                                {
                            ?>
                                <option value="<?php echo $catName['category_name'] ?>"><?php echo $catName['category_name'] ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="op-box">
                            <select name="brand" id="select-brand">
                                <?php
                                    $sql_select = "SELECT * , COUNT(*) FROM laptop WHERE producttype = 'new' GROUP BY brandname HAVING COUNT(*) > 0;";
                                    $query_run1 = mysqli_query($conn,$sql_select);
                                    while($Name = mysqli_fetch_assoc($query_run1))
                                    {
                                ?>
                                    <option value="<?php echo $Name['brandname'] ?>"><?php echo $Name['brandname'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="all-images">
                        <?php
                            $Sql_data = "SELECT * FROM laptop WHERE producttype = 'new';";
                            $Query = mysqli_query($conn,$Sql_data);
                            while($all=mysqli_fetch_assoc($Query)){
                                $p_id = $all['productid'];
                        ?>
                        <div class="show-box">
                                <a href="javascript:void(0);" onclick="first_detail('laptop',<?php echo $p_id ?>)">
                                    <div class="sb-image">
                                        <img src="..//Admin/<?php echo $all['mainphoto'] ?>" alt="">
                                    </div>
                                 </a>
                                <div class="sb-text">
                                    <div class="sb-brandName">
                                        <span><h4><?php echo $all['productname'] ?></h4></span>
                                    </div>
                                    <div class="sb-others">
                                        <span><i class="fas fa-rupee-sign"></i> <?php echo $all['price'] - $all['discount'] ?></span>
                                        <a href="detailProduct.php?table=laptop&id=<?php echo $p_id ?>">
                                            <span class="sbo-icon">
                                                <span><i class="fas fa-shopping-cart"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        
                    </div>
                </div>
                <hr>
                <div class="second-hand">
                    <div class="header">
                        Second Hand Gadgets
                    </div>
                    <div class="sh-div">
                    </div>
                    <div class="options-val">
                        <div class="two-options">
                            <div class="result2">
                                <?php
                                    $Sql_data = "SELECT * FROM laptop WHERE producttype = 'old';";
                                    $Query = mysqli_query($conn,$Sql_data);
                                    $count = mysqli_num_rows($Query);
                                    {
                                ?>
                                    <span>Currently Showing : <?php echo $count ?> results </span>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="short-by">
                            <Span>Short By: 
                                <select name="shortBy" id="short-by2">
                                    <option value="ASC">Low to High</option>
                                    <option value="DESC">High to Low</option>
                                </select> 
                            </Span>
                        </div>
                    </div>
                    <div class="options-items">
                        <div class="op-box">
                            <select name="category" id="select-category2">
                            <?php
                                $sql_selectCategories = "SELECT * FROM categories;";
                                $query_run = mysqli_query($conn,$sql_selectCategories);
                                while($catName = mysqli_fetch_assoc($query_run))
                                {
                            ?>
                                <option value="<?php echo $catName['category_name'] ?>"><?php echo $catName['category_name'] ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="op-box">
                            <select name="brand" id="select-brand2">
                                <?php
                                    $sql_select = "SELECT * , COUNT(*) FROM laptop WHERE producttype = 'old' GROUP BY brandname HAVING COUNT(*) > 0;";
                                    $query_run1 = mysqli_query($conn,$sql_select);
                                    while($Name = mysqli_fetch_assoc($query_run1))
                                    {
                                ?>
                                    <option value="<?php echo $Name['brandname'] ?>"><?php echo $Name['brandname'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="all-images2">
                        <?php
                            $Sql_data = "SELECT * FROM laptop WHERE producttype = 'old';";
                            $Query = mysqli_query($conn,$Sql_data);
                            while($all=mysqli_fetch_assoc($Query)){
                                $p_id = $all['productid'];
                        ?>
                            <div class="show-box">
                                <a href="javascript:void(0);" onclick="second_detail('laptop',<?php echo $p_id ?>)">
                                    <div class="sb-image">
                                        <img src="..//Admin/<?php echo $all['mainphoto'] ?>" alt="">
                                    </div>
                                 </a>
                                <div class="sb-text">
                                    <div class="sb-brandName">
                                        <span><h4><?php echo $all['productname'] ?></h4></span>
                                    </div>
                                    <div class="sb-others">
                                        <span><i class="fas fa-rupee-sign"></i> <?php echo $all['price'] - $all['discount'] ?></span>
                                        <a href="detailProduct.php?table=laptop&id=<?php echo $p_id ?>">
                                            <span class="sbo-icon">
                                                <span><i class="fas fa-shopping-cart"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?> 
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
   <script src="js/allGadget.js?v=<?php echo time(); ?>"></script>
   <script>
       function second_detail(var1,var2){
           console.log(var1);
           console.log(var2);
           $(".sh-div").load("update/second_load.php",{
               table:var1,
               id:var2
           });
       }
       function first_detail(var1,var2){
           console.log(var1);
           $(".sh-div1").load("update/second_load.php",{
               table:var1,
               id:var2
           });
       }
    </script>
    <script src="./js/homePage.js?v=<?php echo time(); ?>"></script>
</body>
</html>
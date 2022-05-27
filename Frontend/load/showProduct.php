<?php
    include ("dbConn.php");
    $table = $_POST['productType'];
    if(isset($_POST['orderby'])){
        $orderBy = $_POST['orderby'];
        $Sql_data = "SELECT * FROM $table ORDER BY price $orderBy;";
    }else{
        $Sql_data = "SELECT * FROM $table;";
    }
    if(isset($_POST['brand'])){
        $brandName = $_POST['brandname'];
        $Sql_data = "SELECT * FROM $table WHERE brandname = '$brandName' ORDER BY price $orderBy;";
    }
    $Query = mysqli_query($conn,$Sql_data);
    while($all=mysqli_fetch_assoc($Query)){
        $p_id = $all['productid'];
?>
<a href="detailProduct.php?table=<?php echo $table ?>&id=<?php echo $p_id ?>">
    <div class="show-box">
        <div class="sb-image">
            <img src="..//Admin/<?php echo $all['mainphoto'] ?>" alt="">
        </div>
        <div class="sb-text">
            <div class="sb-brandName">
                <span><h4><?php echo $all['productname'] ?></h4></span>
            </div>
            <div class="sb-others">
                <span><i class="fas fa-rupee-sign"></i> <?php echo $all['price'] - $all['discount'] ?></span>
                <span class="sbo-icon">
                    <span><i class="far fa-bookmark"></i></span>
                    <span><i class="fas fa-shopping-cart"></i></span>
                </span>
            </div>
        </div>
    </div>
</a>
<?php
    }
?>

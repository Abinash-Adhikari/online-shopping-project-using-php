<?php
    include ("dbConn.php");
    $table = $_POST['productType'];
    if(isset($_POST['orderby'])){
        $orderBy = $_POST['orderby'];
        $Sql_data = "SELECT * FROM $table WHERE producttype = 'old' AND status = '1' ORDER BY price $orderBy;";
    }else{
        $Sql_data = "SELECT * FROM $table WHERE producttype = 'old' AND status = '1';";
    }
    if(isset($_POST['brand'])){
        $brandName = $_POST['brand'];
        $Sql_data = "SELECT * FROM $table WHERE brandname = '$brandName' AND producttype = 'old' AND status = '1' ORDER BY price $orderBy;";
    }
    $Query = mysqli_query($conn,$Sql_data);
    while($all=mysqli_fetch_assoc($Query)){
        $p_id = $all['productid'];
?>
<div class="show-box">
    <a href="javascript:void(0);" onclick="second_detail('<?php echo $table ?>',<?php echo $p_id ?>)">
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
            <a href="detailProduct.php?table=<?php echo $table ?>&id=<?php echo $p_id ?>">
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
<script>
       function second_detail(var1,var2){
           console.log(var1);
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
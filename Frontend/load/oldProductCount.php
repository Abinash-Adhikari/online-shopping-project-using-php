<?php
    include ("dbConn.php");
    $table = $_POST['productType'];
?>

<div class="result">
    <?php
        $Sql_data = "SELECT * FROM $table WHERE producttype = 'old' AND status = '1';";
        $Query = mysqli_query($conn,$Sql_data);
        $count = mysqli_num_rows($Query);
        {
    ?>
        <span>Currently Showing : <?php echo $count ?> results </span>
    <?php
        }
    ?>
</div>
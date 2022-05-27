<?php
    include ("dbConn.php");
    $table = $_POST['productType'];
?>

<div class="result">
    <?php
        $Sql_data = "SELECT * FROM $table WHERE producttype = 'new';";
        $Query = mysqli_query($conn,$Sql_data);
        $count = mysqli_num_rows($Query);
        {
    ?>
        <span>Currently Showing : <?php echo $count ?> results </span>
    <?php
        }
    ?>
</div>
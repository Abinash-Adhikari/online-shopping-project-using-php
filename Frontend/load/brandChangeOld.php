<?php
    include ("dbConn.php");
    $table = $_POST['productType'];
    $sql_select = "SELECT * , COUNT(*) FROM $table WHERE producttype = 'old' GROUP BY brandname HAVING COUNT(*) > 0 ;";
    $query_run1 = mysqli_query($conn,$sql_select);
    while($Name = mysqli_fetch_assoc($query_run1))
    {
?>
    <option value="<?php echo $Name['brandname'] ?>"><?php echo $Name['brandname'] ?></option>
<?php
    }
?>
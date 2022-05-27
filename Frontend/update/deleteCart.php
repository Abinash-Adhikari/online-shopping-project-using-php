<?php
    include "dbConn.php";
    $adminId = $_SESSION['admin_id'];
    if(isset($_POST['id'])){
        $cart_id = $_POST['id'];
        $sql_delete = "DELETE FROM cart WHERE cart_id = '$cart_id';";
        $execute_delete = mysqli_query($conn,$sql_delete);
    }
?>
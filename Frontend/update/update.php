<?php
    include ('dbConn.php');
  $cart_id = $_POST['id'];
  $operation = $_POST['type'];
  if($operation === 'plus'){
      $sql = "UPDATE cart SET quantity = quantity + 1 WHERE cart_id = '".$cart_id."'";
       $qry = mysqli_query($conn,$sql);
       $check = "SELECT * FROM cart WHERE cart_id = '$cart_id'";
      $qry1 = mysqli_query($conn,$check);
      while($data = mysqli_fetch_assoc($qry1))
      {
         echo $data['quantity'];
      }
  }
  if($operation === 'minus'){
    $check = "SELECT * FROM cart WHERE cart_id = '$cart_id'";
      $qry = mysqli_query($conn,$check);
      while($data=mysqli_fetch_assoc($qry))
      {
        if($data['quantity'] > 1){
            $sql = "UPDATE cart SET quantity = quantity - 1 WHERE cart_id = '".$cart_id."'";
            $qry = mysqli_query($conn,$sql);
        }
      }
  }
?>
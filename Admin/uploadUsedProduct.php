<?php
    require ('dbConn.php');
    if(isset($_POST['product-submit'])){
        
        //datas
        $productName = $_POST['product-name'];
        $brandName = $_POST['brand-name'];
        $modelNumber = $_POST['model-number'];
        $categoryName = $_POST['category-name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $color = $_POST['color'];
        $quantity = $_POST['quantity'];
        $warrenty = $_POST['warrenty'];
        $paymentMethods = $_POST['payment-methods'];
        $delivaryTime = $_POST['delivary-time'];
        $features = $_POST['features'];
        $producttype = "old";  
        
        //main photo
        $mainPhoto = $_FILES['main-photo'];
        $mpName = $mainPhoto['name'];
        $mpType = $mainPhoto['type'];
        $mpTempName = $mainPhoto['tmp_name'];
        $mpError = $mainPhoto['error'];
        $mpSize = $mainPhoto['size'];
        
        $mpPhotoExt = explode(".",$mpName);
        $mpPhotoActualExt = strtolower(end($mpPhotoExt));
        $mpAllowed = array('jpg','jepg','png'); 
        

        //left
        // $leftPhoto = $_FILES['left-photo'];
        // $lpName = $leftPhoto['name'];
        // $lpType = $leftPhoto['type'];
        // $lpTempName = $leftPhoto['tmp_name'];
        // $lpError = $leftPhoto['error'];
        // $lpSize = $leftPhoto['size'];
        
        // $lpPhotoExt = explode(".",$lpName);
        // $lpPhotoActualExt = strtolower(end($lpPhotoExt));
        // $lpAllowed = array('jpg','jepg','png');


        // //right photo
        // $rightPhoto = $_FILES['right-photo'];
        // $rpName = $rightPhoto['name'];
        // $rpType = $rightPhoto['type'];
        // $rpTempName = $rightPhoto['tmp_name'];
        // $rpError = $rightPhoto['error'];
        // $rpSize = $rightPhoto['size'];
        
        // $rpPhotoExt = explode(".",$rpName);
        // $rpPhotoActualExt = strtolower(end($rpPhotoExt));
        // $rpAllowed = array('jpg','jepg','png');
        

        //back
        $backPhoto = $_FILES['back-photo'];
        $bpName = $backPhoto['name'];
        $bpType = $backPhoto['type'];
        $bpTempName = $backPhoto['tmp_name'];
        $bpError = $backPhoto['error'];
        $bpSize = $backPhoto['size'];
        
        $bpPhotoExt = explode(".",$bpName);
        $bpPhotoActualExt = strtolower(end($bpPhotoExt));
        $bpAllowed = array('jpg','jepg','png');


        //other1
        $other1Photo = $_FILES['other1-photo'];
        $op1Name = $other1Photo['name'];
        $op1Type = $other1Photo['type'];
        $op1TempName = $other1Photo['tmp_name'];
        $op1Error = $other1Photo['error'];
        $op1Size = $other1Photo['size'];
        
        $op1PhotoExt = explode(".",$op1Name);
        $op1PhotoActualExt = strtolower(end($op1PhotoExt));
        $op1Allowed = array('jpg','jepg','png');


        //other2
        $other2Photo = $_FILES['other2-photo'];
        $op2Name = $other2Photo['name'];
        $op2Type = $other2Photo['type'];
        $op2TempName = $other2Photo['tmp_name'];
        $op2Error = $other2Photo['error'];
        $op2Size = $other2Photo['size'];
        
        $op2PhotoExt = explode(".",$op2Name);
        $op2PhotoActualExt = strtolower(end($op2PhotoExt));
        $op2Allowed = array('jpg','jepg','png');


        if(in_array($mpPhotoActualExt,$mpAllowed)  && in_array($bpPhotoActualExt,$bpAllowed) && in_array($op1PhotoActualExt,$op1Allowed) && in_array($op2PhotoActualExt,$op2Allowed)){
            if(($mpError === 0) && ($bpError === 0) && ($bpError === 0) && ($op1Error === 0) && ($op2Error === 0)){
                if(($mpSize < 80000000)  && ($bpSize < 80000000) && ($op1Size < 80000000) && ($op2Size < 80000000))
                {
                    //main photo
                    $mpPhotoNewName = uniqid('',true).".".$mpPhotoActualExt;
                    $mpPhotoDestionation = 'documents/'.$mpPhotoNewName;
                    move_uploaded_file($mpTempName,$mpPhotoDestionation);

                    //left photo
                    // $lpPhotoNewName = uniqid('',true).".".$lpPhotoActualExt;
                    // $lpPhotoDestionation = 'documents/'.$lpPhotoNewName;
                    // move_uploaded_file($lpTempName,$lpPhotoDestionation);

                    //right photo
                    // $rpPhotoNewName = uniqid('',true).".".$rpPhotoActualExt;
                    // $rpPhotoDestionation = 'documents/'.$rpPhotoNewName;
                    // move_uploaded_file($rpTempName,$rpPhotoDestionation);
                     
                    //back Photo
                    $bpPhotoNewName = uniqid('',true).".".$bpPhotoActualExt;
                    $bpPhotoDestionation = 'documents/'.$bpPhotoNewName;
                    move_uploaded_file($bpTempName,$bpPhotoDestionation);

                    //option1
                    $op1PhotoNewName = uniqid('',true).".".$op1PhotoActualExt;
                    $op1PhotoDestionation = 'documents/'.$op1PhotoNewName;
                    move_uploaded_file($op1TempName,$op1PhotoDestionation);

                    //option2
                    $op2PhotoNewName = uniqid('',true).".".$op2PhotoActualExt;
                    $op2PhotoDestionation = 'documents/'.$op2PhotoNewName;
                    move_uploaded_file($op2TempName,$op2PhotoDestionation);

                    
                    $adminId =  $_SESSION['admin_id'];
                     $sql = "INSERT INTO $categoryName (admin_id,status,producttype,productname,brandname,modelnumber,categoryname,price,discount,color,quantity,warrenty,paymentmethods,delivary,features,mainphoto,leftphoto,rightphoto,backphoto,otherphoto1,otherphoto2) 
                    VALUES('$adminId','0','$producttype','$productName','$brandName','$modelNumber','$categoryName','$price','$discount','$color','$quantity','$warrenty','$paymentMethods','$delivaryTime','$features','$mpPhotoDestionation','$lpPhotoDestionation','$rpPhotoDestionation','$bpPhotoDestionation','$op1PhotoDestionation','$op2PhotoDestionation');";
                    $result = mysqli_query($conn,$sql);
                    if($result==TRUE)
                    {
                        header("location: manageUsedProducts.php?table=laptop");
                    }
                    else{
                        echo "Database Connection Error";
                    }
               
                }else{
                    echo"You upload more than 10MB photo";
                }
            }else{
                echo " Error in uploading Image";
                }
        }else{
            echo "jpg , jepg and png photo is allowed to upload";
        }
    
    }
?>
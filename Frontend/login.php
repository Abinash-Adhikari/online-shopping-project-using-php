<?php 
    require ("dbCOnn.php");
    require ('head.php');


    //Login Section
    if(isset($_POST['loginSubmit'])){
        $email = htmlspecialchars($_POST['loginname']);
        $password = htmlspecialchars($_POST['loginPassword']);
        $sql = "SELECT * FROM `admin` WHERE email = '$email' && password = '$password';";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1)
        {
            echo "email password correct";
            $row = mysqli_fetch_assoc($result);
            $active = $row['email_active'];
            if($active == 0){
                 echo "email not activated";
                $x = mt_rand(1000,9999);
                $_SESSION['key'] = $x;
                $to_email = $email;
                $subject = "Activate your email";
                $body = "Your email is deactive. OTP for your account for activation is `$x` ";
                $headers = "From:  alpha.gadget62@gmail.com";
                if (mail($to_email, $subject, $body, $headers)) {
                     $_SESSION['user_email'] = $email;
                    header('Location: emailActive.php ');
                } else {
                    echo 
                    '
                    <script>
                        alert("Invalid Email");
                    </script>
                    ';
                }
            }else{
                 echo "email activated ";
                if($row['email'] == $email && $row['password'] == $password )
                {
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['user_id'];
                    if(isset($_GET['back'])){
                        $url = $_GET['back'];
                        header("location: '$url'.php");
                    }
                    header('Location: index.php ');

                }
                else{
                    header("location: login.php?error=databaseError");
                }
            }    
        }
        else{
            echo 
            '
            <script>
                alert("email or password invalid");
            </script>
            ';
        }
        
    }

    //Register Section
    if(isset($_POST['registerSubmit'])){
        $firstName = test_input($_POST['registerFirstName']);
        $lastName = test_input($_POST['registerLastName']);
        $email = test_input($_POST['registerEmail']);
        $contact = test_input($_POST['registerContact']);
        $address = test_input($_POST['registerAddress']);
        $password = test_input($_POST['registerPassword']);

        $fullName = $firstName." ".$lastName;
        
        
        //for id prove
        $idPicture = $_FILES['registerIdprove'];
        $idName = $idPicture['name'];
        $idType = $idPicture['type'];
        $idTempName = $idPicture['tmp_name'];
        $idError = $idPicture['error'];
        $idSize = $idPicture['size'];

        $photoExt = explode(".",$idName);
        $photoActualExt = strtolower(end($photoExt));
        $allowed = array('jpg','jepg','png');



        // for profile pic
        $proflePicture = $_FILES['registerProfile'];
        $ppName = $proflePicture['name'];
        $ppType = $proflePicture['type'];
        $ppTempName = $proflePicture['tmp_name'];
        $ppError = $proflePicture['error'];
        $ppSize = $proflePicture['size'];

        $ppPhotoExt = explode(".",$ppName);
        $ppPhotoActualExt = strtolower(end($ppPhotoExt));
        $ppAllowed = array('jpg','jepg','png');
        if(in_array($ppPhotoActualExt,$ppAllowed) && in_array($photoActualExt,$allowed)){
            if(($ppError === 0) && ($idError === 0)){
                if(($ppSize < 80000000) && ($idSize < 80000000) ){

                    $ppPhotoNewName = uniqid('',true).".".$ppPhotoActualExt;
                    $ppPhotoDestionation = './Admin/documents/'.$ppPhotoNewName;
                    move_uploaded_file($ppTempName,$ppPhotoDestionation);

                    $photoNewName = uniqid('',true).".".$photoActualExt;
                    $photoDestionation = './Admin/documents/'.$photoNewName;
                    move_uploaded_file($idTempName,$photoDestionation);


                    $checksql = "SELECT * FROM admin where email = `$email` && contact = `$contact`;";
                    $execute = mysqli_query($conn,$checksql);
                    if(mysqli_num_rows($execute) == 0){
                        $sql = "INSERT INTO `admin` (name,email,password,contact,address,profile_photo,idprove_photo) 
                        VALUES('$fullName','$email','$password','$contact','$address','$ppPhotoDestionation','$photoDestionation')";
                        $result = mysqli_query($conn,$sql);
                        if($result==TRUE){
                           $x = mt_rand(1000,9999);
                            $_SESSION['key'] = $x;
                            $to_email = $email;
                            $subject = "Activate your email";
                            $body = "Your email is deactive. OTP for your account for activation is `$x` ";
                            $headers = "From:  alpha.gadget62@gmail.com";
                            if(mail($to_email, $subject, $body, $headers)) {
                                $_SESSION['user_email'] = $email;
                                echo header("location: emailActive.php");
                            } else {
                                echo 
                                '
                                <script>
                                    alert("Invalid Email");
                                </script>
                                ';
                            }
                        }
                        else{
                            echo "Database Connection Error";
                        }

                    }else
                    {
                        echo 
                        '
                        <script>
                            alert("email or mobile number  already used");
                        </script>
                        ';
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
<body>
    <div class="login-signup">
        <div class="img">
            <a href="index.php"><img src="./Photos/logo2.png" alt=""></a>
        </div>
        <div class="rotate">
            <div class="form-signin">
                <div class="input-part">
                    <div class="logo">
                        <i class="far fa-user"></i>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="input-form" enctype="multipart/form-data">
                        <h2> SIGN IN </h2>
                        <div class="username">
                            <label for="userID">
                                <p class="em">Email</p>
                            </label>
                            <input type="email" id="userID" name="loginname" required>
                        </div>
                        <div class="password">
                            <label for="password">
                                <p class="pas">Password</p>
                            </label>
                            <input type="password" id="password" name="loginPassword" required>
                        </div>
                        <div class="submit-data">
                            <button class="btn btn-login" type="submit" name="loginSubmit"> Login </button>
                        </div>
                    </form>
                    <div class="to-register">
                        <p>Not Having Account?<span class="btn btn-toregister"> Register </span></p>
                    </div>
                </div>
            </div>
            <div class="form-register">
                <div class="input-part">
                    <div class="logo">
                        <i class="far fa-user"></i>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="input-form" enctype="multipart/form-data">
                        <h2> CREATE ACCOUNT</h2>
                         <div class="flex">
                            <div class="userFirstName">
                                <label for="userFirstName">
                                    <p class="em"> First Name</p>
                                </label>
                                <input type="text" id="userFirstName" name="registerFirstName" required>
                            </div>
                            <div class="userLastName">
                                <label for="userLastName">
                                    <p class="em"> Last Name </p>
                                </label>
                                <input type="text" id="userLastName" name="registerLastName" required>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="username">
                                <label for="userID">
                                    <p class="em">Email</p>
                                </label>
                                <input type="email" id="userID" name="registerEmail" required>
                            </div>
                            <div class="contact">
                                <label for="contact">
                                    <p class="em"> Contact Number </p>
                                </label>
                                <input type="number" id="contact" name="registerContact" required>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="address">
                                <label for="address">
                                    <p class="pas"> Address </p>
                                </label>
                                <input type="text" id="address" name="registerAddress" required>
                            </div>
                            <div class="password">
                                <label for="password">
                                    <p class="pas">Password</p>
                                </label>
                                <input type="password" id="password" name="registerPassword" required>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="profile">
                                <label for="profile">
                                    <p class="pas"> Profile Picture </p>
                                </label>
                                <input type="file" id="profile" name="registerProfile" required>
                            </div>
                            <div class="idprove">
                                <label for="idprove">
                                    <p class="pas">Id Prove</p>
                                </label>
                                <input type="file" id="idprove" name="registerIdprove" required>
                            </div>
                        </div>
                        <div class="submit-data">
                            <button class="btn btn-register" type="submit" name="registerSubmit"> Register </button>
                        </div>
                    </form>
                    <div class="to-register">
                        <p>Already Having Account?<span class="btn btn-tosignin"> Signin </span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>
<script src="js/homePage.js?v=<?php echo time(); ?>"></script>
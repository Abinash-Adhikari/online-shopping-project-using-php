<?php
    require ("dbCOnn.php");
    require ('head.php');
    if(isset($_POST['confirm'])){
        $otp = $_POST['otpNumber'];
        $sessionOtp = $_SESSION['admin_key'];
        $email = $_SESSION['user_email'];
        if($otp == $sessionOtp){

           $sql = "UPDATE `controller` SET email_active = 1 WHERE email = '$email';";
           $execute = mysqli_query($conn,$sql);
           if($execute == TRUE){
               $sql2 = "SELECT * FROM `controller` WHERE email = '$email';";
               $execute2 = mysqli_query($conn,$sql2);
               $row = mysqli_fetch_assoc($execute2);
               if($execute2 == TRUE){
                    $_SESSION['controller_email'] = $row['email'];
                    $_SESSION['controller_id'] = $row['user_id'];
                    $_SESSION['key'] = "";
                    header('location: statusAproved.php');
                }
            }
        }
    }
?>

<div class="login-signup">
    <div class="form-signin">
        <div class="input-part">
            <div class="logo">
                <i class="far fa-lock"></i>
            </div>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <br>
                <h2> Email Activation </h2>
                <br>
                <p>Please Check your mail to get OTP.</p>
                <br>
                <div class="username">
                    <label for="userID">
                        <p class="em">Enter OTP</p>
                    </label>
                    <input type="number" id="userID" name="otpNumber" required>
                </div>
                <div class="submit-data">
                    <button class="btn btn-login" type="submit" name="confirm"> Confirm OTP </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    require ("dbCOnn.php");
    require ('head.php');
    if($_SESSION['user_email'] != ""){
        if(isset($_POST['passwordSubmit']))
        {
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];
            $email = $_SESSION['email'];
             if($newPassword==$confirmPassword){
                $sql = "SELECT * FROM admin WHERE email = '$email';";
                $result = mysqli_query($conn, $sql);
                while($data = mysqli_fetch_assoc($result)){
                    $dbPassword = $data['password'];
                    if($dbPassword == $oldPassword){
                        $sql_update = "UPDATE admin SET password = '$newPassword' WHERE email = '$email' ;";
                        $update_result = mysqli_query($conn,$sql_update);
                        if($update_result==TRUE){
                            echo '
                            <script>
                                var error=" Successfully Changed!!!";
                            </script>';
                        }
                        else{
                            echo '
                        <script>
                            var error=" DB UPDATE ERROR !!!";
                        </script>';
                        }
                    }else {
                         echo '
                    <script>
                        var error=" Incorrect Password!!!";
                    </script>';
                    }
                }
             }else{
                 echo '
                    <script>
                        var error="New Password Doesnot Match!!!";
                    </script>';
             }
        }
?>
<body>
     <div class="containner">
        <div class="left-section">
            <div class="navbar">
                <div class="navbar-logo">
                    <img src="./Photos/logo2.png" alt="">
                </div>
                <hr>
                <div class="navbar-buttons">
                    <a href="index.php">
                        <div class="same-class nav-dashboard">
                            <button class="btn btn-nav btn-dashboard"><i class="fas fa-home"></i> Dashboard</button>
                        </div>
                    </a>
                    <a href="manageCategories.php">
                        <div class="same-class nav-manageCategories">
                            <button class="btn btn-nav btn-manageCategories"> <i class="fas fa-tasks"></i> Manage Categories</button>
                        </div>
                    </a>
                    <a href="manageProducts.php">
                        <div class="same-class nav-manageProducts">
                        <button class="btn btn-nav btn-manageProducts"> <i class="fas fa-cogs"></i> Manage Products</button>
                    </div>
                    </a>
                    
                    <a href="manageUsedProducts.php">
                        <div class="same-class sub-secManageProducts">
                            <button class="btn btn-nav btn-secManageProducts"> <i class="fas fa-cogs"></i> Manage Used Products</button>
                        </div>
                    </a>
                    <a href="trendingProducts.php">
                        <div class="same-class nav-addTrendingProduct">
                            <button class="btn btn-nav btn-addTrendingProduct"> <i class="fas fa-poll"></i> Trending Products </button>
                        </div>
                    </a>
                    <a href="managePassword.php">
                        <div class="same-class nav-Password">
                            <button class="btn btn-nav btn-Password active"> <i class="fas fa-unlock"></i> Password </button>
                        </div>
                    </a>
                    <a href="logout.php">
                        <div class="same-class nav-signOut">
                            <button class="btn btn-nav btn-signOut"> <i class="fas fa-sign-out-alt"></i> Sign Out </button>
                        </div>
                    </a>
                    <a href="../Frontend/index.php">
                        <div class="same-class nav-home">
                            <button class="btn btn-nav btn-home"> <i class="fas fa-arrow-left"></i> Back To Main Page </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="right-section">
            <div class="header-top">
                <div class="all-top">
                    <div class="lines">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                    <div class="current-page">
                        <h2 class="show"> Manage Password </h2>
                    </div>
                    <div class="search-bar">
                        <span class="input-top"><input type="text"><i class="fas fa-search"></i></span>
                    </div>
                    <div class="admin-detail">
                        <?php 
                            $email = $_SESSION['user_email'];
                            $sql_admin = "SELECT * FROM admin WHERE email = '$email'";
                            $query = mysqli_query($conn,$sql_admin);
                            while($row=mysqli_fetch_assoc($query))
                            {
                        ?>
                        <div class="image">
                            <img src="<?php echo $row['profile_photo'] ?>" alt="">
                        </div>
                        <div class="ad-name">
                            <h4><?php echo $row['name'] ?></h4>
                            <p>Seller</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="body">
                <div class="content">
                    <div class="change-password bg">
                        <div class="header">
                            <h1> Change Password </h1>
                        </div>
                        <div class="form">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="input-form" enctype="multipart/form-data">
                                <div class="password">
                                    <label for="password">
                                        <p class="pas"> Old Password</p>
                                    </label>
                                    <input type="password" id="password" name="oldPassword" required>
                                </div>
                                <div class="password">
                                    <label for="new-password">
                                        <p class="pas">New Password</p>
                                    </label>
                                    <input type="password" id="new-password" name="newPassword" required>
                                </div>
                                <div class="password">
                                    <label for="confirm-password">
                                        <p class="pas">Confirm Password</p>
                                    </label>
                                    <input type="password" id="confirm-password" name="confirmPassword" required>
                                </div>
                                <div class="error">
                                </div>
                                <div class="submit-data">
                                    <button class="btn btn-changePassword" type="submit" name="passwordSubmit"> Change Password </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    
        <script src="app.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<?php 
    }
    else{
        header("location: login.php");
    }
?>
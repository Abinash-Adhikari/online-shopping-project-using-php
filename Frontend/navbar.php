<div class="navbar">
    <div class="navbar-logo">
        <a href="index.php">
            <img src="Photos/logo2.png" alt="">
        </a>
    </div>
    <div class="navbar-links ">
        <div class="link"> <a href="newProducts.php"> NEW PRODUCT </a> </div>
        <div class="link"> <a href="oldProduct.php"> OLD PRODUCT </a> </div>
        <div class="link"> <a href="../Admin/index.php"> SELL PRODUCT </a> </div>
        <div class="link"> <a href="compareProducts.php">COMPARE PRODUCT</a> </div>
    </div>
    <div class="location">
        <div class="location-icon"> <i class="fas fa-globe"></i> </div>
        <div class="location-place"> Nijgadh </div>
    </div>
    <div class="login-register">
        <div class="lr-text">
            <?php 
                if(isset($_SESSION['user_id'])){
                    if($_SESSION['user_id'] != "")
                    {
                ?>
                    <a href="logout.php">LOGOUT</a>
                <?php
                    }else{
                ?>
                    <a href="login.php">LOGIN / REGISTER</a>
                    <?php
                    }
                }
                else{
                ?>
                    <a href="login.php">LOGIN / REGISTER</a>
                    <?php
                    }
            ?>
        </div>
    </div>
    <div class="search-bar">
        <form action="search.php">
            <input class="input-search" type="search" name="id" id="search-icon">
            <label for="search-icon"><button class="none" type="sumbit"><i class="fas fa-search"></i></button></label>
        </form>
    </div>
    <div class="cart">
        <a href="cart.php"><div class="cart-logo"> <i class="fas fa-shopping-cart"></i> </div></a>
    </div>
</div>
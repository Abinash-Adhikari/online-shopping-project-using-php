
$(".btn-secondHand").on("click", function(){
    $("button").removeClass("active");
    $(".btn-secondHand").addClass("active");
    $(".sub-secManageCategories").toggle();
    $(".sub-secManageProducts").toggle();
    $(".icon-up").toggle();
    $(".icon-down").toggle();
});
$(".btn-secManageCategories").on("click", function(){
    $("button").removeClass("active");
    $(".btn-secManageCategories").addClass("active");
});
$(".btn-secManageProducts").on("click", function(){
    $("button").removeClass("active");
    $(".btn-secManageProducts").addClass("active");
});


//Signin-Register
$(".form-register").hide();
$(".btn-toregister").on("click", function(){
    $(".form-signin").hide(100);
    $(".form-register").show(100);
});
$(".btn-tosignin").on("click", function(){
    $(".form-signin").show(100);
    $(".form-register").hide(100);
});



//show product data part
$(".btn-toggle").on("click", function(){
    $(".product-details").hide();
    $(".form-addProduct").show();
});

if(hideClass == "true"){
     $(".product-details").show();
    $(".form-addProduct").hide();
    console.log('Good Abinash');
}

var error,error1;
$(".duplicate-error").html(error1);
// Password worong
$(".error").html(error);
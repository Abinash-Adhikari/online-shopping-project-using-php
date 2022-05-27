$('.owl-carousel').owlCarousel({
    loop:true,
    responsiveClass:true,
    nav:true,
    //  autoplay:true,
    // autoplayTimeout:3000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

var scrollHeight= $(".first-view").height()+$(".cs-1").height()+$(".cs-2").height();
console.log(scrollHeight);
if(scroll == "on"){
    $(window).scrollTop(scrollHeight + 100);
    console.log("Done");
}

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


$(window).ready(function(){
       
var qty = $(".quantity").val();
    var qty =1;
     $(".quantity").val(qty);
    console.log($.type(parseInt(qty)))
    $(".plus").on("click", function(){
        if(qty>=10){
            qty = 10;
            $(".quantity").val(qty);
        } else {
            qty=qty+1;
            $(".quantity").val(qty);
        }
    })
    $(".minus").on("click", function(){
        if(qty<=1){
            qty = 1;
            $(".quantity").val(qty);
        } else {
            qty=qty-1;
            $(".quantity").val(qty);
        }
    })
})

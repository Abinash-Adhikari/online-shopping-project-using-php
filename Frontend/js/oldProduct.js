$(document).ready(function(){
    $("#select-category").on("change", function(){
        var item = this.value;
        $(".all-images").load("load/oldProductLoad.php",{
            productType:item
        });
        $(".result").load("load/oldProductCount.php",{
            productType:item
        });
        $("#select-brand").load("load/brandChangeOld.php",{
            productType:item
        });
        
    })
    $("#short-by").on("change", function(){
        var table = $("#select-category") .val();  
        var order = this.value;
        $(".all-images").load("load/oldProductLoad.php",{
            productType:table,
            orderby:order
        });
    })
    $("#select-brand").on("change", function(){
        var brandname= this.value;
        var table = $("#select-category") .val();  
        var order = $("#short-by").val();
        $(".all-images").load("load/oldProductLoad.php",{
            productType:table,
            orderby:order,
            brand:brandname
        });
    })
    $(".new-Photo").on("click", function(){
        console.log(product_table);
        console.log(product_id);
    })
    $(".old-Photo").on("click", function(){
        console.log(old_table);
        console.log(old_id);
    })
})
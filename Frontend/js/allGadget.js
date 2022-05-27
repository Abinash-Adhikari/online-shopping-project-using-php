$(document).ready(function(){
    $("#select-category").on("change", function(){
        var item = this.value;
        $(".all-images").load("load/newProductLoad.php",{
            productType:item
        });
        $(".result").load("load/productCount.php",{
            productType:item
        });
        $("#select-brand").load("load/brandChange.php",{
            productType:item
        });
        
    })
    $("#select-category2").on("change", function(){
        var item = this.value;
        $(".all-images2").load("load/oldProductLoad.php",{
            productType:item
        });
        $(".result2").load("load/oldproductCount.php",{
            productType:item
        });
        $("#select-brand2").load("load/brandChange.php",{
            productType:item
        });
        
    })
    $("#short-by").on("change", function(){
        var table = $("#select-category") .val();  
        var order = this.value;
        $(".all-images").load("load/newProductLoad.php",{
            productType:table,
            orderby:order
        });
    })
    $("#short-by2").on("change", function(){
        var table = $("#select-category2") .val();  
        var order = this.value;
        $(".all-images2").load("load/oldProductLoad.php",{
            productType:table,
            orderby:order
        });
    })
    $("#select-brand").on("change", function(){
        var brandname= this.value;
        var table = $("#select-category") .val();  
        var order = $("#short-by").val();
        $(".all-images").load("load/newProductLoad.php",{
            productType:table,
            orderby:order,
            brand:brandname
        });
    })
    $("#select-brand2").on("change", function(){
        var brandname= this.value;
        var table = $("#select-category2") .val();  
        var order = $("#short-by2").val();
        $(".all-images2").load("load/oldProductLoad.php",{
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
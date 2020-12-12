var iconCart = document.getElementsByClassName("icon_cart");

var iconAdd = document.getElementsByClassName("addToCart");

var addSymbol = new Array(iconAdd.length).fill(false);
var cartCount = 0;
var orderCardArray = new Array();




$('.addToCart').html('<i class="fas fa-plus"></i>');
var i = 0;
// alert("i = " +i);
$(document).ready(function(){
    $('.addToCart').click(function (){
        var currentIcon = $(this).html();
        console.clear();    
                                               
        if (currentIcon == '<i class="fas fa-plus"></i>') {
            cartCount++;
            console.log(cartCount + "items");
            $(this).html('<i class="fas fa-times"></i>');  

            //Add cart details inside array
            orderCardArray[$('.addToCart').index($(this))] = $(this).parents().html();
            console.log("clicked on button " + $('.addToCart').index($(this)));            
            

        }else {
            cartCount--;
            console.log(cartCount + "items");
            $(this).html('<i class="fas fa-plus"></i>');       

            // Remove cart details from array
            orderCardArray[$('.addToCart').index($(this))] = null;            
            console.log("clicked on button " + $('.addToCart').index($(this)));            
        }

        //Display cart badge when items > 0
        if (cartCount > 0) {
            $('.cartBadge').html(cartCount).css('display', 'flex');
            $('.icon_cart').css('color', '#FA6304');

        }else {
            $('.cartBadge').html(cartCount).css('display', 'none');
            $('.icon_cart').css('color', 'black');

        }
       
        // alert(orderCardArray.forEach(myFunction));
        // alert(orderCardArray[0]+ orderCardArray[1]);

        // console.log(i + "\n");
        // console.log("clicked on button " + $('.addToCart').index($(this)));
        

        // $(this).html(function(idx, html){
        //     return html == '<i class="fas fa-plus"></i>' ? '<i class="fas fa-times"></i>' : '<i class="fas fa-plus"></i>';
        // });
        // alert($('.addToCart').index($(this)));

        // Display all the card items in orders Page
  

    });
});


function addToCartFunc(item, index) {

    if (item != null) {
        document.getElementById('purchase_list').innerHTML +='<div class = "menu_stack" id="food' + index + '">' + item + '</div>' + index;
    }
        $('#purchase_list .menu_stack' ).click(function (){
            var lol = $(this).html();

            alert(this.id);
        });

    
    console.log(item + index);
    // alert("Total index is"+ orderCardArray.length);
  }










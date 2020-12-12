<?php

include('orderCRUD.php');

    if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
        $countCartList = "SELECT COUNT(food_id) FROM cartlist WHERE `employee_id` = '".$_SESSION['kioskLoginID']."'  ";
        $countCartList_run = mysqli_query($con, $countCartList);
        $countCartList_run_rows = mysqli_fetch_assoc($countCartList_run);


        $_SESSION['cartNumber'] = $countCartList_run_rows['COUNT(food_id)'];
        if($countCartList_run_rows['COUNT(food_id)'] > 0){
            //CHANGE CART COLOR AND NUMBER
            $_SESSION['changeCart']  = 1;
        }else if ($countCartList_run_rows['COUNT(food_id)'] == 0){
            $_SESSION['changeCart']  = 0;
        }
    }else{
        $countCartList = "SELECT COUNT(food_id) FROM cartlist WHERE `user_id` = '".$_SESSION['kioskLoginID']."' ";
        $countCartList_run = mysqli_query($con, $countCartList);
        $countCartList_run_rows = mysqli_fetch_assoc($countCartList_run);

        $_SESSION['cartNumber'] = $countCartList_run_rows['COUNT(food_id)'];
        if($countCartList_run_rows['COUNT(food_id)'] > 0){
            //CHANGE CART COLOR AND NUMBER
            $_SESSION['changeCart']  = 1;
        }else if ($countCartList_run_rows['COUNT(food_id)'] == 0){
            $_SESSION['changeCart']  = 0;
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
        
<head>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<link rel="stylesheet" href="../Default/linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../Default/linkFiles/Modals_CSS/menu.css" type="text/css" />
<link rel="stylesheet" href="../Default/linkFiles/Modals_CSS/popUpModals.css" type="text/css" />
<style>
@import url('https://fonts.googleapis.com/css?family=Bitter');

.tabcontent {
    padding: 0;
    margin: 0;

    width: 100%;
    height: 100%;

    display: none;
    flex-direction: column;
    align-items: center;

    border-radius: 25px;

    background-color: #F9EEE8;

    position: relative;

    overflow: hidden;
    
}

.menu_top {   
    width: calc(100% - 50px);
    min-height: 80px;

    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 2.4vw;
}

.menu_title {
    height: 100%;

    font-size: 2.4vw;
    font-family: 'Heebo', Arial, sans-serif;
    text-transform: uppercase;

    display: flex;
    align-items: center;

    margin: 0 auto; 

    color: orangered;
}

.icon_back {
    margin-left: 25px;
    color: inherit;
}

.icon_cart {
    position: relative;
    margin-right: 25px;
}

.menu_bottom {
    width: calc(100% - 50px);
    height: 80%;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-flow:  wrap;
    /* flex-wrap: wrap; */

    overflow-y: auto;
    overflow-x: hidden;
    
    padding: 20px 0px;
}

.menu_stack {
    background-color: white;
    box-shadow: 3px 3px 3px rgba(0,0,0,.15);  

    min-width: 380px;
    width: 380px;
    min-height: 130px;
    height: 130px;
    margin: 10px 75px;

    display: flex;
    /* justify-content: center; */
    align-items: center;

    border-radius: 15px;

    position: relative;
}

.menu_pic_cage {
    width: 95px;
    height: 95px;

    position: absolute;

    border-radius: 15px;

    left: -40px;

    box-shadow: 3px 3px 3px rgba(0,0,0,.15);
    
    background-image: url('../Image/no_content.png');
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; /* Resize the background image to cover the entire container */
}
.menu_pic_cage img{
    width: 95px;
    height: 95px;

    position: absolute;

    border-radius: 15px;

}

.menu_content_cage{
    /* width: 60%; */
    margin-left:  70px;  

    display: flex;
    flex-direction: column;

    font-family: 'Heebo', Arial, sans-serif;
}

.menu_content_title h2 {
    margin: 0;
    padding: 0;

    font-size: 2.1em;
}

.menu_content_items {
    background-color: #fff;
}

.menu_content_price {
    font-size: 1.3em;
}

.menu_button_cage, .menu_button_delete {
    color: red;
    background-color: #E1E0E0;
    box-shadow: 3px 3px 3px rgba(0,0,0,.25);

    width: 65px;
    height: 65px;

    

    border-radius: 50px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    font-size: 2.5vw;
}

.menu_button_cage {
    position: absolute;
    right: -32px;
}

.menu_button_delete {
    outline: none;
    border: none;

    position: absolute;
    /* top: -45px; */
    /* right: calc(50% - 50px); */

    /* left: -75px; */
    /* top: -30px; */
    
    text-decoration: none;
    left: -90px;

}

.number_tallSize {
    width: 65px;
    height: 115px;

    border-radius: 15px;
    justify-content: space-around;
    justify-content: space-evenly;

}

.menu_quantity {
    /* font-size: 0.7em;  */
    font-size: 3vh; 
}

.menu_button_quantity {
    outline: none;
    border: none;
    padding: 0;
    margin: -5px;
    margin-right: -20px;
    font-size: 3vh; 
    width: 50px;

    text-align: center;
    background-color: transparent;
}

.purchase_sum_cage {
    width: calc(100% - 50px);    
    min-height: 80px;

    /* overflow: hidden; */
}
    
.purchase_form_cage {
    position: absolute; 
    /* bottom: -34vw; */
    bottom: calc(-100% + 160px);

    width: calc(100% - 50px);
    height: calc(100% - 80px);

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    transition: all 0.5s ease;

    z-index: 2;

    background-color: #F9EEE8;
}

.purchase_fullForm {
    bottom: 0;
}

.purchase_title_cage {
    margin: 15px 0px 20px 0px;
    padding: 0px 20px;

    width: calc(100% - 60px);
    height: 50px;

    border-radius: 15px;
    box-shadow: 3px 3px 3px rgba(0,0,0,.15);
    background-color: white;

    display: flex;
    justify-content: space-between;
    align-items: center;

    font-family: 'Heebo', Arial, sans-serif;
    font-size: 2vh;
}

.purchase_title_cage h2 {
    padding: 0;
    margin: 0;
}

.purchase_title_cage i {
    font-size: 3.2vh;   
    color: orangered;
}

.purchase_detail_cage {
    width: calc(100% - 60px);
    max-height: 330px;

    background-color: white;
    box-shadow: 3px 3px 3px rgba(0,0,0,.15);
    border-radius: 15px;

    padding: 10px 0px;

    display: flex;
    flex-direction: column;
    align-items: center;

    overflow: auto;
}

.purchase_detail_bar {
    width: calc(100% - 50px);
    max-height: 30px;

    margin: 25px 0px;

    display: flex;
    justify-content: flex-end;
    align-items: center;

    /* font-size: 1.8vw; */
    font-size: 3.2vh;
    font-family: 'Bitter', Arial, sans-serif;
}

.purchase_detail_items {
    margin-right: auto;
}

.purchase_detail_quantity {
    min-width: 180px;
    height: 100%;

    margin-left: 20px;

    display: flex;
    align-items: center;
}

.purchase_detail_quantity input {
    outline: none;
    border: none;

    font-size: 3.2vh;
    line-height: -10px;

    /* background-color: transparent; */

    height: 25px;
    width: 130px;

}

.purchase_buttons {
    margin-top: auto;
    margin-bottom: 30px;

    width: calc(100% - 110px);

    display: flex;
    align-items: center;
    justify-content: space-between;

    
}

.purchase_buttons * {
    font-size: 2.2vw;
    outline: none;
    border: none;
}

.purchase_button_delete {
    border-radius: 100%;

    border: 5px solid orangered;
    background-color: transparent;
    color: orangered;
    width: 3.9vw;
    height: 3.9vw;
    /* padding: 15px; */

    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

.purchase_button_chkOut {
    font-size: 2vw;
    font-family: 'Bitter', Arial, sans-serif;

    padding: 10px 10px;

    border-radius: 20px;

    background-color: orangered;
    color: #fafafa; 
}

/* Display vendor tabcontent page by default */
#orderList {
    display: flex;
}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/



</style>
<?php
if(isset($_SESSION['changeCart'])){
    if($_SESSION['changeCart'] == 1){
        echo '<style>
    
        .cartBadge{
            display: flex;
        }
        .icon_cart{
            color: orangered;
        }   
        </style>';
    
    }else if($_SESSION['changeCart'] == 0){
        echo '<style>
    
        .cartBadge{
            display: none;
        }
        .icon_cart{
            color: black;
        }</style>';
    }
}

if(isset($_GET['deleteOrder'])){
    echo '<style>
    
    #Modal4{
        display: flex;
    }
    
    </style>';
    // header('Location: home.php');
}

if(isset($_GET['ordersuccess'])){
    
    echo '<style>
    
    #Modal4{
        display: none;
    }

    #receiptModal{
        display: flex;

    }



    
    </style>';
}

if(isset($_GET['notEnoughCredit'])){
    echo '<style>
    
    #Modal3{
        display: flex;
    }

    
    </style>';
}



?>
</head>

<body>
    <!--Title Bar-->
    <div class="top">
        <div class="top_left">
            APU Cafeteria System
            <i class="fas fa-utensils"></i>
        </div>

        <form class="top_right">
            <button type="button" id="user"> <div class="user_cover"><i class="fas fa-user-circle"></i></div></button>
            
        </form>

        <div class="notif_setting_cage">
            <a class="notif_setting_stack">
                <h2> <?php echo $_SESSION['kioskLoginRole'];?> </h2>                
            </a>
            
            <a href="../../orderKioskServer.php?logout" class="notif_setting_stack">
                <h2>Log Out</h2>
            </a>
        </div>
    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <div id="bottom_left">
            <a href="./home.php" id="home" class="btn  tablinks"><i class="fas fa-home"></i>Home </a>
            <a href="./order.php" id="order" class="btn activeTab tablinks"><i class="fas fa-chart-area"></i>Orders</a>
        </div>

        <div class="bottom_right">
            <div class="analysis_cage">


                <div id="orderList" class="tabcontent">
                    <div class="menu_top">
                        <!-- <div class="icon_back tablinks" onclick="openCity(event, 'foodList');">
                            <i class="fas fa-arrow-left"></i>
                        </div> -->

                        <div class="menu_title">
                            List of Orders
                        </div>

                        <div class="icon_cart">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="cartBadge"><?php echo $_SESSION['cartNumber'];?></div>
                        </div>
                    </div>

                    <div id="purchase_list" class="menu_bottom">
                    <?php
                            $selectedFoods = array();
                            $selectCart = "SELECT * FROM cartlist WHERE `user_id` = '".$_SESSION['kioskLoginID']."' ";
                            $selectCart_run = mysqli_query($con, $selectCart);
                            // echo mysqli_affected_rows($con);

                            while($selectCart_run_rows = mysqli_fetch_assoc($selectCart_run)){
                                $selectedFoods[] = $selectCart_run_rows['food_id'];
                            }

                            if(count($selectedFoods) == 0){
                                //errmessage

                                echo    '<form class="empty_stack" action="orderCRUD.php" action = "POST" style="justify-content: center; width: 750px; height: 400px; font-size: 3vw; text-align:center;">
                           
                             
                                            <div class="menu_content_title ">
                                                It seems that you have added any items into the cart. Explore more food and beverages <a href = "home.php" style="color: gold; text-decoration:none; font-weight:bold;">here</a>, add them to the cart and it would appeared here
                                            </div>
            
                                         </form>';
                            }else{
                                for($i = 0; $i < count($selectedFoods); $i++){

                                    $getSelected = "SELECT * FROM vendorfood WHERE foodID = '".$selectedFoods[$i]."'    ";
                                    $getSelected_run = mysqli_query($con, $getSelected);
                                    $getSelected_run_rows = mysqli_fetch_assoc($getSelected_run);
                                    $foodImage =$getSelected_run_rows['foodPic'];
                                    $foodid =$getSelected_run_rows['foodID'];


                                    echo    '<form class="menu_stack" action="orderCRUD.php" action = "POST">
                                                <div class="menu_pic_cage">
                                                    <img class="vendor_profile_image" alt="profile_image" src="data:USER_IMAGE/jpg;base64,'.base64_encode($foodImage).'" />                                                
                                                </div>
                
                                                <div class="menu_content_cage">
                                                    <div class="menu_content_title arrTitle">
                                                        <h2>'.$getSelected_run_rows['foodName'].'</h2>
                                                        <input class = "foodid" name = "foodid" type="text" value = '.$foodid.' hidden>
                                                    </div>
                    
                                                    <div class="menu_content_price arrPrice">'.$getSelected_run_rows['foodPrice'].'</div>
                                                </div>
                    
                                                <a href ="orderCRUD.php?deletecart='.$foodid.'"  type="submit" class="menu_button_delete">
                                                    <i class="fas fa-times"></i>
                                                </a>
                    
                                                <div class="menu_button_cage number_tallSize">
                                                    <div class="menu_quantity count_plus">
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <input class="menu_button_quantity" type="number"  readonly value="1" max="99">
                                                    <div class="menu_quantity count_minus">
                                                        <i class="fas fa-minus"></i>
                                                    </div>
                                                </div>
                                            </form>';


                                }   
                            }

                                                     

                        ?>

                    </div>

                    <div class="purchase_sum_cage">
                        <div class="purchase_form_cage">
                            <div class="purchase_title_cage">
                                <h2>Shopping Cart Summary</h2> 

                                <i class="fas fa-chevron-up"></i>
                            </div>

                            <form id="chkOut" action="orderCRUD.php" method="POST" class="purchase_detail_cage">
                               
                            </form>

                            <div class="purchase_buttons">
                                <button id="popUp1V2" class="purchase_button_delete">
                                    <i class="fas fa-trash"></i>
                                </button>  

                                <button type="button" id="popUp1" class="purchase_button_chkOut"> 
                                    Checkout
                                </button>  
                            </div>

                        </div>
                    </div> 


            </div>
            </div>

            <div id="Modal1" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_infoTitle">
                                ARE YOU SURE YOU WANT TO CHECKOUT THE FOLLOWING ORDERS?
                            </div>
                            <div class="content_info_bottomCage">
                                
                            </div>

                        </div>

                        <form class="button_group align_flexEnd" action = "" method="POST">
                            <button name = "confirmOrder" type="button" id="popUp_successAdd" class="close"> <a href="javascript: submitCart()">Confirm</a> </button>
                            <button type="button" class="close">Cancel</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>

            <div id="Modal2" class="modal">
                    <!-- Modal content -->
                    <div class="content_cage">
                        <div class="content_outerCage">
                            <div class="content_innerCage">
                                <div class="content_infoTitle">
                                ARE YOU SURE YOU WANT TO DELETE THE ORDERS COMPLETELY?                                    
                                </div>
                                <div class="content_info_bottomCage">
                                    
                                </div>
    
                            </div>
    
                            <form class="button_group align_flexEnd" action="orderCRUD.php" method = "POST">
                                <button type="submit" id="popUp_successDelete" name ="popUp_successDelete" class="close">Confirm</button>
                                <button type="button" class="close">Cancel</button>
                            </form>
                            
                            
                        </div>
                    </div>
            </div>

       


            <div id="Modal3" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Not Enough Credit !!
                           
                        </div>
                        <span class="close close_all">Dismiss</span>

                    </div>
                </div>
            </div>

            <div id="Modal4" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Successfully Deleted!
                        </div>

                        <span class="close close_all">Dismiss</span>

                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/headerModal.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/cartNotif.js"></script>   
    <script type="text/javascript" src="../Default/linkFiles/popUpModal.js"></script>   
    <script>
        //Arrays fpr selected food items
        var foodItemName = []; 
        var foodItemPrice = [];
        var foodItemQtty = [];
        var foodSingleTotal = [];
        var foodItemID = [];
        var sum;
        var countItems;

        $(".purchase_title_cage").click(function() {
            $('.purchase_form_cage').toggleClass('purchase_fullForm');
            $('.purchase_title_cage i').toggleClass("fa-chevron-up fa-chevron-down");
            sum = 0;
            if ( $('.purchase_title_cage i').hasClass('fa-chevron-down')) {
                countItems =  $('.arrTitle').length;  

                //Clear summary table
                $('.purchase_detail_cage').html("");

                //Display summary detail header
                $('.purchase_detail_cage').append('<div class="purchase_detail_bar">' 
                                                    + '<div class="purchase_detail_items">'
                                                        + 'Details'
                                                    + '</div>'

                                                    + '<div class="purchase_detail_quantity">'
                                                        + 'Qty'
                                                    + '</div>'

                                                    + '<div class="purchase_detail_quantity">'
                                                        + 'Price'
                                                    + '</div>'

                                                    + '<div class="purchase_detail_quantity">'
                                                        + 'Total'
                                                    + '</div>'
                                                + '</div>');



                for (var foodCount = 0; foodCount < countItems; foodCount++) {
                    //Insert items into array
                    foodItemName[foodCount] = $('.arrTitle').eq(foodCount).text();
                    foodItemPrice[foodCount] = $('.arrPrice').eq(foodCount).text().replace(/Rm|RM|\s/g,'');
                    foodItemQtty[foodCount] = $('.menu_button_quantity').eq(foodCount).val();
                    foodItemID[foodCount] = $('.foodid').eq(foodCount).val();


                    //Calculate a single item price and insert into an array
                    foodSingleTotal[foodCount] = (foodItemPrice[foodCount] * foodItemQtty[foodCount]);

                    //Calculate the total price and insert into a variable
                    sum += (foodItemPrice[foodCount] * foodItemQtty[foodCount]);


                    // Display the summary details
                    $('.purchase_detail_cage').append('<div class="purchase_detail_bar">'
                                                        + '<div class="purchase_detail_items">'
                                                            + foodItemName[foodCount]
                                                        + '</div>'

                                                        + '<div class="purchase_detail_quantity">'
                                                            + 'X <input type="text" name = "purchaseQuantity[]" value="' + foodItemQtty[foodCount] + '" readonly>'
                                                            + '<input type="hidden" name = "purchaseID[]" value="' + foodItemID[foodCount] + '" readonly>'
                                                        + '</div>'

                                                        + '<div class="purchase_detail_quantity">'
                                                            + 'RM <input type="text" name = "purchasePrice[]" value="' + Number(foodItemPrice[foodCount]).toFixed(2) + '" readonly>'
                                                        + '</div>'

                                                        + '<div class="purchase_detail_quantity">'
                                                            + 'RM <input type="text" name = "purchaseSubtotal[]" value="' +  Number(foodSingleTotal[foodCount]).toFixed(2) + '" readonly>'
                                                        + '</div>'
                                                    + '</div>');
                }
                
                //Display blank bar
                $('.purchase_detail_cage').append('<div class="purchase_detail_bar"></div>');

                //Display total sum
                $('.purchase_detail_cage').append('<div class="purchase_detail_bar">'
                                                        + '<div class="purchase_detail_items">'
                                                            +'Grand Total :'
                                                        + '</div>'

                                                        + '<div class="purchase_detail_quantity">'
                                                            + 'RM <input name = "totalAmount" type="text" value="' + Number(sum).toFixed(2) + '" readonly>'
                                                        + '</div>'
                                                        + '</div>');

                                                        if (countItems <= 0) {
                $('.purchase_buttons').css("display","none");
                }
            }
        });


        //Food item quantity function
        $(".count_plus").click(function() {
            var count =parseInt($(this).siblings('.menu_button_quantity').val());
           
            if (count < 99) {
                count++;
            }
           $(this).siblings('.menu_button_quantity').val(count);
        });

        $(".count_minus").click(function() {
            var count =parseInt($(this).siblings('.menu_button_quantity').val());
           
            if (count > 1) {
                count--;
            }
           $(this).siblings('.menu_button_quantity').val(count);
        });

        // document.forms['menu_button_quantity'].addEventListener('invalid', function() {
        // // Optional response here
        // alert('invalid');
        // }, false);


        // function createArray(length) {
        // var arr = new Array(length || 0),
        //     i = length;

        // if (arguments.length > 1) {
        //     var args = Array.prototype.slice.call(arguments, 1);
        //     while(i--) arr[i] = createArray.apply(this, args);
        // }        
        // return arr;
        // }


        // var testArray = createArray(10, 10, 10);
        // testArray = 

        


        
        // console.log($('#purchase_list .menu_content_title').eq(0).text());
        
        // $.alert({
        //     title: 'Alert!',
        //     content: 'Simple alert!',
        // });

        function submitCart() {
            // document.chkOut.submit();
            document.forms['chkOut'].submit();
        }



        // When the user clicks the button, open the modal 
        btn1.onclick = function(){
            modal1.style.display = "flex";

            $('.content_info_bottomCage').html("");

            $('.content_info_bottomCage').append('<div class="content_detail_stack">'
                                                    + '<div class="content_name">Details</div>'
                                                    + '<div class="content_detail">Qty</div>'
                                                    + '<div class="content_detail">Price</div>'
                                                    + '<div class="content_detail">Total</div>'
                                                + '</div>');


            for (var foodCount2 = 0; foodCount2 < countItems; foodCount2++) {
                $('.content_info_bottomCage').append('<div class="content_detail_stack">'
                                                        + '<div class="content_name">'+ foodItemName[foodCount2] +'</div>'
                                                        + '<div class="content_detail"> X'+ foodItemQtty[foodCount2] +'</div>'
                                                        + '<div class="content_detail"> RM'+ Number(foodItemPrice[foodCount2]).toFixed(2) +'</div>'
                                                        + '<div class="content_detail"> RM'+ Number(foodSingleTotal[foodCount2]).toFixed(2) +'</div>'
                                                    + '</div>');
            }

            $('.content_info_bottomCage').append('<div class="content_detail_stack">'
                                                    + '<div class="content_name">Grand Total:</div>'
                                                    + '<div class="content_detail"></div>'
                                                    + '<div class="content_detail"></div>'
                                                    + '<div class="content_detail"> RM'+ Number(sum).toFixed(2) + '</div>'
                                                + '</div>');   
        }

        btn2.onclick = function(){
            modal2.style.display = "flex";

            $('.content_info_bottomCage').html("");

            $('.content_info_bottomCage').append('<div class="content_detail_stack">'
                                                    + '<div class="content_name">Details</div>'
                                                    + '<div class="content_detail">Qty</div>'
                                                    + '<div class="content_detail">Price</div>'
                                                    + '<div class="content_detail">Total</div>'
                                                + '</div>');


            for (var foodCount2 = 0; foodCount2 < countItems; foodCount2++) {
                $('.content_info_bottomCage').append('<div class="content_detail_stack">'
                                                        + '<div class="content_name">'+ foodItemName[foodCount2] +'</div>'
                                                        + '<div class="content_detail"> X'+ foodItemQtty[foodCount2] +'</div>'
                                                        + '<div class="content_detail"> RM'+ Number(foodItemPrice[foodCount2]).toFixed(2) +'</div>'
                                                        + '<div class="content_detail"> RM'+ Number(foodSingleTotal[foodCount2]).toFixed(2) +'</div>'
                                                    + '</div>');
            }

            $('.content_info_bottomCage').append('<div class="content_detail_stack">'
                                                    + '<div class="content_name">Grand Total:</div>'
                                                    + '<div class="content_detail"></div>'
                                                    + '<div class="content_detail"></div>'
                                                    + '<div class="content_detail"> RM'+ Number(sum).toFixed(2) + '</div>'
                                                + '</div>');   
        }

    


    </script>
    
</body>
</html>
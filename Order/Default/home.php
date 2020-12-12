<?php

include('homeCRUD.php');

if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
    @$countCartList = "SELECT COUNT(food_id) FROM cartlist WHERE `employee_id` = '".$_SESSION['kioskLoginID']."'  ";
    @$countCartList_run = mysqli_query($con, $countCartList);
    @$countCartList_run_rows = mysqli_fetch_assoc($countCartList_run);
    @$_SESSION['cartNumber'] = $countCartList_run_rows['COUNT(food_id)'];

    
    if($countCartList_run_rows['COUNT(food_id)'] > 0){
        //CHANGE CART COLOR AND NUMBER
        @$_SESSION['changeCart']  = 1;
    }else if ($countCartList_run_rows['COUNT(food_id)'] == 0){
        @$_SESSION['changeCart']  = 0;   
    }
}else{
    @$countCartList = "SELECT COUNT(food_id) FROM cartlist WHERE `user_id` = '".$_SESSION['kioskLoginID']."' ";
    @$countCartList_run = mysqli_query($con, $countCartList);
    @$countCartList_run_rows = mysqli_fetch_assoc($countCartList_run);
    @$_SESSION['cartNumber'] = $countCartList_run_rows['COUNT(food_id)'];
    
    if($countCartList_run_rows['COUNT(food_id)'] > 0){
        //CHANGE CART COLOR AND NUMBER
        @$_SESSION['changeCart']  = 1;
    }else if ($countCartList_run_rows['COUNT(food_id)'] == 0){
        @$_SESSION['changeCart']  = 0;
    }
}

// echo $_SESSION['changeCart'];

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
}

.menu_pic_cage img{

    width: 95px;
    height: 95px;

    position: absolute;

    border-radius: 15px;
}

.menu_pic_cate {
    background-image: url('../Image/category.png');
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; /* Resize the background image to cover the entire container */
}

.menu_vendor_pic {
    background-image: url('../Image/stall.png');
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; /* Resize the background image to cover the entire container */
}

.menu_list_emptyPic {
    background-image: url('../Image/no_content.png');
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; /* Resize the background image to cover the entire container */
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

.menu_content_rating {
    background-color: green;
    color: yellow;
    font-size: 20px;
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
    text-decoration: none;
}

.menu_button_delete {
    

    outline: none;
    border: none;

    position: absolute;
    /* top: -45px; */
    /* right: calc(50% - 50px); */

    /* left: -75px; */
    /* top: -30px; */
    
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
    background-color: brown;   
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

}

.purchase_sum_cage {
    width: calc(100% - 50px);    
    min-height: 80px;

    background-color: blue;
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
    

    background-color:green;

    transition: all 0.5s ease;

    z-index: 2;
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
    color: #FA6304;
}

.purchase_detail_cage {
    width: calc(100% - 60px);
    max-height: 70%;

    background-color: purple;

    border-radius: 15px;

    padding: 10px 0px;

    display: flex;
    flex-direction: column;
    align-items: center;

    overflow: auto;
}

.purchase_detail_bar {
    background-color: orange;

    width: calc(100% - 50px);
    height: 30px;

    margin: 10px 0px;

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

    background-color: red;

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
    background-color: gray;

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

    border: 5px solid #FA6304;
    color: #FA6304;
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

    background-color: #FA6304;
    color: #fafafa; 
    
}

/* Display vendor tabcontent page by default */
#Vendor {
    display: flex;
}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
@media print {
    body * {
        visibility: hidden;
        
    }

    .content_cage, .content_cage *{
        visibility: visible;
        color-adjust: exact;
        -webkit-print-color-adjust: exact;
        z-index: 2;



    }


    .content_cage {
        position: fixed;
        height: auto;
        width: 80%;
        overflow: hidden;


        left: 10%;
        top: 20%;
        

    }

    .content_cage button{
        display: none;

    }


}


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


if(isset($_GET['vid']))
{

    echo '<style>

    #Vendor{
        display: none;
    }
    #foodType{
        display: flex;
    }
   
    #foodList{
        display: none;
    }
    
    </style>';
}

if(isset($_GET['category'])){

    echo '<style>

    #Vendor{
        display: none;
    }
    #foodType{
        display: none;
    }
   
    #foodList{
        display: flex;
    }
    
    </style>';

}

if(isset($_GET['displayCategory'])){

    echo '<style>

    #Vendor{
        display: none;
    }
    #foodType{
        display: flex;
    }
   
    #foodList{
        display: none;
    }
    
    </style>';

}


if(isset($_GET['displayFoods'])){

    echo '<style>

    #Vendor{
        display: none;
    }
    #foodType{
        display: none;
    }
   
    #foodList{
        display: flex;
    }
    </style>';
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

if(isset($_GET['deleteOrder'])){
    echo '<style>
    
    #Modal4{
        display: flex;
    }
    
    </style>';
    // header('Location: home.php');
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
                <h2> <?php echo $_SESSION['kioskLoginID'];?> </h2>
            </a>

            <a href="../../orderKioskServer.php?logout" class="notif_setting_stack">
                <h2>Log Out</h2>
            </a>
        </div>
    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <div id="bottom_left">
            <a href="./home.php" id="home" class="btn activeTab tablinks" onclick="openCity(event, 'Vendor');"><i class="fas fa-home"></i>Home </a>
            <a href="./order.php" id="order" class="btn tablinks"><i class="fas fa-chart-area  "></i>Orders</a>
        </div>

        <div class="bottom_right">
            <div class="analysis_cage">
            
                <div id="Vendor" class="tabcontent">
                    <div class="menu_top">
                        <div class="menu_title">
                            Select Vendor
                        </div>

                        <div class="icon_cart tablinks">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="cartBadge"><?php echo $_SESSION['cartNumber'];?></div>
                        </div>
                    </div>

                    <div class="menu_bottom">

                        <?php
                            //ARRAY DECLARATION
                            $vendorArray = array();

                            //PASS VALUES TO vendorIDArray[]
                            $selectVendor = "SELECT * FROM `vendor`";
                            $selectVendor_run = mysqli_query($con, $selectVendor);

                            while($selectVendor_run_rows = mysqli_fetch_assoc($selectVendor_run))
                            {
                                
                                $vendorArray[] = $selectVendor_run_rows['vendor_id'];
                                
                            }
                         
                            for($i =0; $i <  count($vendorArray); $i++ ){

                                //SELECT VENDOR INFORMATION FROM vendor_id 
                                $displayVendor = "SELECT COUNT(foodID), vendorID, vendorName FROM `vendorfood` WHERE vendorID = '".$vendorArray[$i]."'    ";
                                $displayVendor_run = mysqli_query($con, $displayVendor);
                                $displayVendor_run_rows = mysqli_fetch_assoc($displayVendor_run);

                                $vid = $vendorArray[$i];
                                echo '
                                        <div class="menu_stack">
                                            <div class="menu_pic_cage menu_vendor_pic"></div>
                
                                            <div class="menu_content_cage">
                                                <div class="menu_content_title">
                                                    <h2>'.$displayVendor_run_rows['vendorName'].'</h2>
                                                </div>
                
                                                <div class="menu_content_items">'.$displayVendor_run_rows['COUNT(foodID)'].' items</div>
                                            </div>
                
                                            <a href= "home.php?vid='.$vid.'"  class="menu_button_cage tablinks" >
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    ';
                            }
                        ?>
                    </div>

                </div>

                <div id="foodType" class="tabcontent">
                    <div class="menu_top">
                        <a class="icon_back tablinks" href="home.php" style="color:inherit; text-decoration:none;">
                            <i class="fas fa-arrow-left"></i>
                        </a>

                        <div class="menu_title">
                            <?php 
                            
                            if(isset($_GET['vid'])){
                                $_SESSION['venID'] = $_GET['vid'];

                                $getVName = "SELECT * from vendor where vendor_id = '".$_SESSION['venID']."' ";
                                $getVName_run = mysqli_query($con, $getVName);
                                $getVName_run_rows = mysqli_fetch_assoc($getVName_run);
                                echo $getVName_run_rows['vendor_name'];
                            }else{

                                $getVName = "SELECT * from vendor where vendor_id = '".$_SESSION['venID']."' ";
                                $getVName_run = mysqli_query($con, $getVName);
                                $getVName_run_rows = mysqli_fetch_assoc($getVName_run);
                                echo $getVName_run_rows['vendor_name'];
                            }

                            
                            
                            ?>
                        </div>

                        <div class="icon_cart tablinks" onclick="openCity(event, 'orderList');">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="cartBadge"><?php echo $_SESSION['cartNumber'];?></div>

                        </div>
                    </div>

                    <div class="menu_bottom">


                        <?php
                            if(isset($_GET['vid'])){
                                $categoryArray = array();      

                                $selectCategory = "SELECT foodCategory FROM vendorfood WHERE vendorID = '".$_GET['vid']."' GROUP BY foodCategory ";
                                $selectCategory_run = mysqli_query($con, $selectCategory);
                                while($selectCategory_run_rows = mysqli_fetch_assoc($selectCategory_run)){
                                    $categoryArray[] = $selectCategory_run_rows['foodCategory'];
                                }

                                for($i = 0; $i < count($categoryArray); $i++){

                                    $displayCategory = "  SELECT foodCategory, COUNT(foodID), vendorID  FROM vendorfood WHERE vendorID = '".$_GET['vid']."' AND foodCategory = '".$categoryArray[$i]."'    ";
                                    $displayCategory_run = mysqli_query($con, $displayCategory);
                                    $displayCategory_run_rows = mysqli_fetch_assoc($displayCategory_run);

                                    $_SESSION['vid'] = $displayCategory_run_rows['vendorID'];
                                    $category = $displayCategory_run_rows['foodCategory'];
                                    // $_SESSION['foodCategory'] = $displayCategory_run_rows['foodCategory'];


                             
                                    echo '<div class="menu_stack">
                                                <div class="menu_pic_cage menu_pic_cate"></div>
                    
                                                <div class="menu_content_cage">
                                                    <div class="menu_content_title">
                                                        <h2>'.$displayCategory_run_rows['foodCategory'].'</h2>
                                                    </div>
                    
                                                    <div class="menu_content_items">'.$displayCategory_run_rows['COUNT(foodID)'].' items</div>
                                                </div>
                    
                                                <a href= "home.php?category='.$category.'"  class="menu_button_cage tablinks" >
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        ';


                                }
                            }

                            if(isset($_GET['displayCategory'])){
                                $categoryArray = array();      

                                $selectCategory = "SELECT foodCategory FROM vendorfood WHERE vendorID = '".$_SESSION['vid']."'  GROUP BY foodCategory ";
                                $selectCategory_run = mysqli_query($con, $selectCategory);

                                while($selectCategory_run_rows = mysqli_fetch_assoc($selectCategory_run)){
                                    $categoryArray[] = $selectCategory_run_rows['foodCategory'];
                                }

                                for($i = 0; $i < count($categoryArray); $i++){

                                    $displayCategory = "  SELECT foodCategory, COUNT(foodID), vendorID  FROM vendorfood WHERE vendorID = '".$_SESSION['vid']."' AND foodCategory = '".$categoryArray[$i]."'    ";
                                    $displayCategory_run = mysqli_query($con, $displayCategory);
                                    $displayCategory_run_rows = mysqli_fetch_assoc($displayCategory_run);

                                    $_SESSION['vid'] = $displayCategory_run_rows['vendorID'];
                                    $category = $displayCategory_run_rows['foodCategory'];
                                    // $_SESSION['foodCategory'] = $displayCategory_run_rows['foodCategory'];

                             
                                    echo '<div class="menu_stack">
                                                <div class="menu_pic_cage menu_pic_cate"></div>
                    
                                                <div class="menu_content_cage">
                                                    <div class="menu_content_title">
                                                        <h2>'.$displayCategory_run_rows['foodCategory'].'</h2>
                                                    </div>
                    
                                                    <div class="menu_content_items">'.$displayCategory_run_rows['COUNT(foodID)'].' items</div>
                                                </div>
                    
                                                <a href= "home.php?category='.$category.'"  class="menu_button_cage tablinks" >
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        ';
                                }

                            }

                        ?>

                    </div>


                </div>

                <div id="foodList" class="tabcontent">
                        <div class="menu_top">
                            <a href="home.php?displayCategory"  class="icon_back tablinks" >
                                <i class="fas fa-arrow-left"></i>
                            </a>
    
                            <div class="menu_title">
                                <?php
                                    
                                    if(isset($_GET['category'])){
                                        echo $_GET['category'];
                                    }else{
                                        echo $_GET['displayFoods'];
                                    }
                                ?>
                            </div>
    
                            <div class="icon_cart tablinks" onclick="openCity(event, 'orderList');">
                                <i class="fas fa-shopping-cart"></i>
                                <div class="cartBadge"><?php echo $_SESSION['cartNumber'];?></div>
                            </div>
                        </div>
    
                        <div class="menu_bottom">


                            <!-- /////////////////////////// -->
                            <?php
                                //CALCULATE AMOUNT OF FOODS IN EACH CATEGORY
                                if(isset($_GET['displayFoods'])){
                                    $foodArray = array();   

                                    $selectFood = "SELECT foodID, foodName, foodPrice FROM vendorfood WHERE foodCategory = '".$_GET['displayFoods']."' AND vendorID = '".$_SESSION['vid']."'     ";
                                    $selectFood_run = mysqli_query($con, $selectFood);
                                    while($selectFood_run_rows = mysqli_fetch_assoc($selectFood_run)){
                                        $foodArray[] = $selectFood_run_rows['foodID'];
                                    }

                                    for($i = 0; $i < count($foodArray); $i++){

                                        if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
                                            $countFoods = "SELECT * FROM cartlist WHERE food_id = '".$foodArray[$i]."' AND `employee_id` = '".$_SESSION['kioskLoginID']."'  ";
                                            $countFoods_run = mysqli_query($con, $countFoods);
                                            $countFoods_run_rows = mysqli_fetch_assoc($countFoods_run);
                                            if(mysqli_affected_rows($con) > 0){
                                                //DATA EXIST
                                                $iconStatus = 1;
                                            }else{ //affected_rows 0 or less than 0
                                                //DATA DOES NOT EXIST
                                                $iconStatus = 0;
                                            }
                                        }else{
                                            $countFoods = "SELECT * FROM cartlist WHERE food_id = '".$foodArray[$i]."' AND `user_id` = '".$_SESSION['kioskLoginID']."'  ";
                                            $countFoods_run = mysqli_query($con, $countFoods);
                                            $countFoods_run_rows = mysqli_fetch_assoc($countFoods_run);
                                            if(mysqli_affected_rows($con) > 0){
                                                //DATA EXIST
                                                $iconStatus = 1;
                                            }else{ //affected_rows 0 or less than 0
                                                //DATA DOES NOT EXIST
                                                $iconStatus = 0;
                                            }
                                        }



                                            //RUN AND DISPLAY DATA 
                                            $displayFood = "  SELECT vendorID, foodPic, foodName, foodPrice, foodID, foodCategory FROM vendorfood WHERE foodID = '".$foodArray[$i]."'    ";
                                            $displayFood_run = mysqli_query($con, $displayFood);
                                            $displayFood_run_rows = mysqli_fetch_assoc($displayFood_run);

                                            //PASS DATA INTO VARIABLES 
                                            $_SESSION['vid'] = $displayFood_run_rows['vendorID'];
                                            // $_SESSION['foodid'] = $displayFood_run_rows['foodID'];    
                                            // $_SESSION['foodCategory'] = $displayFood_run_rows['foodCategory'];   
                                            $foodid = $displayFood_run_rows['foodID'];                                    
                                            $foodImage =$displayFood_run_rows['foodPic'];

                                        echo '<div class="menu_stack">
                                                    <div class="menu_pic_cage">
                                                        <img class="vendor_profile_image" alt="profile_image" src="data:USER_IMAGE/jpg;base64,'.base64_encode($foodImage).'" />
                                                    </div>
                        
                                                    <div class="menu_content_cage">
                                                        <div class="menu_content_title">
                                                            <h2>'.$displayFood_run_rows['foodName'].'</h2>
                                                        </div>
                        
                                                        <div class="menu_content_price">RM '.$displayFood_run_rows['foodPrice'].'</div>
                                                    </div>';


                                            //CHOOSE ICON TYPE
                                            if($iconStatus == 0){
                                                echo    '<a href = "homeCRUD.php?addcart='.$foodid.'"   class="menu_button_cage addToCart">
                                                            <i class="fas fa-plus"></i>
                                                        </a>';
                                            }else if ($iconStatus == 1 ){
                                                echo    '<a href = "homeCRUD.php?deletecart='.$foodid.'"   class="menu_button_cage addToCart">
                                                            <i class="fas fa-times"></i>
                                                        </a>';
                                            }
                                        echo '</div>';
                        

                                    }
                                }
                                
                                if(isset($_GET['category'])){
                                //     //CALCULATE AMOUNT OF FOODS IN EACH CATEGORY
                                    $foodArray = array();      

                                    $selectFood = "SELECT foodID, foodName, foodPrice FROM vendorfood WHERE foodCategory = '".$_GET['category']."' AND vendorID = '".$_SESSION['vid']."'     ";
                                    $selectFood_run = mysqli_query($con, $selectFood);
                                    while($selectFood_run_rows = mysqli_fetch_assoc($selectFood_run)){
                                        $foodArray[] = $selectFood_run_rows['foodID'];
                                    }

                                    for($i = 0; $i < count($foodArray); $i++){

                                        if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
                                            $countFoods = "SELECT * FROM cartlist WHERE food_id = '".$foodArray[$i]."' AND `employee_id` = '".$_SESSION['kioskLoginID']."'  ";
                                            $countFoods_run = mysqli_query($con, $countFoods);
                                            $countFoods_run_rows = mysqli_fetch_assoc($countFoods_run);
                                            if(mysqli_affected_rows($con) > 0){
                                                //DATA EXIST
                                                $iconStatus = 1;
                                            }else{ //affected_rows 0 or less than 0
                                                //DATA DOES NOT EXIST
                                                $iconStatus = 0;
                                            }
                                        }else{
                                            $countFoods = "SELECT * FROM cartlist WHERE food_id = '".$foodArray[$i]."' AND `user_id` = '".$_SESSION['kioskLoginID']."'  ";
                                            $countFoods_run = mysqli_query($con, $countFoods);
                                            $countFoods_run_rows = mysqli_fetch_assoc($countFoods_run);
                                            if(mysqli_affected_rows($con) > 0){
                                                //DATA EXIST
                                                $iconStatus = 1;
                                            }else{ //affected_rows 0 or less than 0
                                                //DATA DOES NOT EXIST
                                                $iconStatus = 0;
                                            }
                                        }

                                            //RUN AND DISPLAY DATA 
                                            $displayFood = "  SELECT vendorID, foodPic, foodName, foodPrice, foodID, foodCategory FROM vendorfood WHERE foodID = '".$foodArray[$i]."'    ";
                                            $displayFood_run = mysqli_query($con, $displayFood);
                                            $displayFood_run_rows = mysqli_fetch_assoc($displayFood_run);

                                            //PASS DATA INTO VARIABLES 
                                            $_SESSION['vid'] = $displayFood_run_rows['vendorID'];
                                            // $_SESSION['foodid'] = $displayFood_run_rows['foodID'];    
                                            // $_SESSION['foodCategory'] = $displayFood_run_rows['foodCategory'];   
                                            $foodid = $displayFood_run_rows['foodID'];                                    
                                            $foodImage =$displayFood_run_rows['foodPic'];

                                        echo '<div class="menu_stack">
                                                    <div class="menu_pic_cage">
                                                        <img class="vendor_profile_image" alt="profile_image" src="data:USER_IMAGE/jpg;base64,'.base64_encode($foodImage).'" />
                                                    </div>
                        
                                                    <div class="menu_content_cage">
                                                        <div class="menu_content_title">
                                                            <h2>'.$displayFood_run_rows['foodName'].'</h2>
                                                        </div>
                        
                                                        <div class="menu_content_price">RM '.$displayFood_run_rows['foodPrice'].'</div>
                                                    </div>';


                                            //CHOOSE ICON TYPE
                                            if($iconStatus == 0){
                                                echo    '<a href = "homeCRUD.php?addcart='.$foodid.'"   class="menu_button_cage addToCart">
                                                            <i class="fas fa-plus"></i>
                                                        </a>';
                                            }else if ($iconStatus == 1 ){
                                                echo    '<a href = "homeCRUD.php?deletecart='.$foodid.'"   class="menu_button_cage addToCart">
                                                            <i class="fas fa-times"></i>
                                                        </a>';
                                            }
                                        echo '</div>';

                        

                                    }
                                
                                }

                            ?>
    
    
                         

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

                            <span class="close close_all"><a href = "home.php">Dismiss</a></span>

                        </div>
                    </div>
                </div>

                <div id="receiptModal" class="modal">
                    <!-- Modal content -->
                    <div class="content_cage">
                        <div class="content_outerCage">
                            <div class="content_innerCage">
                                <div class="content_infoTitle">
                                Receipt                                  
                                </div>
                                <div class="content_info_bottomCage_receipt">

                                    <div class="content_detail_stack">
                                        <div class="content_name_receiptName"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                    </div>
                                    <div class="content_detail_stack">
                                        <div class="content_name_receiptName"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail"><?php echo "Date:    ".date("Y-m-d")?></div>
                                    </div>

                                    <div class="content_detail_stack">
                                        <div class="content_name_receiptName"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                    </div>
                                    <?php

                                        echo 
                                            '<div class="content_detail_stack">
                                                <div class="content_name_receiptName">Details</div>
                                                <div class="content_detail_receipt">Qty</div>
                                                <div class="content_detail_receipt">Price</div>
                                                <div class="content_detail_receipt">Total</div>
                                            </div>';
                                        $arrOrderID = array();
                                        $arrFoodName = array();
                                        $arrFoodPrice = array();
                                        $arrQuantity = array();
                                        $arrTotalSub = array();
                                        // $arrTransDate = array();
                                        $displayReceipt = "SELECT * FROM usertransaction WHERE transID = '".$_SESSION['purchaseTransaction']."'  ";
                                        $displayReceipt_run = mysqli_query($con, $displayReceipt);
                                        while($displayReceipt_run_rows = mysqli_fetch_assoc($displayReceipt_run)){
                                            $arrOrderID[] = $displayReceipt_run_rows['orderID'];
                                            $arrFoodName[] = $displayReceipt_run_rows['foodName'];
                                            $arrQuantity[]= $displayReceipt_run_rows['Quantity'];
                                            $arrTotalSub[] = $displayReceipt_run_rows['TotalSub'];
                                            $arrFoodPrice[] = $displayReceipt_run_rows['foodPrice'];


                                          
                                        }

                                        for($i=0; $i<count($arrOrderID); $i++){
                                            echo 
                                            '<div class="content_detail_stack">
                                                <div class="content_name_receiptName">'.$arrOrderID[$i].' '.$arrFoodName[$i].'</div>
                                                <div class="content_detail_receipt">X'.$arrQuantity[$i].'</div>
                                                <div class="content_detail_receipt">'.$arrFoodPrice[$i].'</div>
                                                <div class="content_detail_receipt">RM '.$arrTotalSub[$i].'</div>
                                            </div>';

                                        }
                                    ?>
                                    <div class="content_detail_stack">'
                                        <div class="content_name_receiptName"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                    </div>
                                    <div class="content_detail_stack">'
                                        <div class="content_name_receiptName">Grand Total: </div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"></div>
                                        <div class="content_detail_receipt"><?php echo "RM ".$_SESSION['totalAmount'];?></div>
                                    </div>
                                </div>
    
                            </div>
    
                            <form class="button_group align_flexEnd" action="orderCRUD.php" method = "POST">
                                <button id="print_button" onclick="window.print();" class="print"><a href="home.php" style="color:inherit; text-decoration:none;">Print</a></button>
                                <button type="button" class="close"><a href = "home.php">Dismiss</a></button>
                            </form>
                            
                            
                        </div>
                    </div>
            </div>

            </div>

           
            
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/headerModal.js"></script>
    <!-- <script type="text/javascript" src="../Default/linkFiles/cartNotif.js"></script>    -->
    <script type="text/javascript" src="../Default/linkFiles/finalOrder.js"></script>   
    <!-- <script type="text/javascript" src="../Default/linkFiles/popUpModal.js"></script>    -->
    <script type="text/javascript" src="../Default/linkFiles/home.js"></script>   

    
    <script>
       // Function to redirect to order page
        $(document).ready(function() {
            $('.icon_cart').click(function() {
                window.location.href = "./order.php";
            });
        });

        var modal4 = document.getElementById('Modal4');
        var closeBtn = document.getElementsByClassName("close");
        var receiptModal = document.getElementsByClassName("receiptModal");

        for (var i = 0; i < closeBtn.length; i++) {
            closeBtn[i].onclick = function() {
                modal1.style.display = "none";
                modal2.style.display = "none";
                receiptModal.style.display = "none";
                modal4.style.display = "none";
            }
        }
	
    </script>

    
</body>
</html>
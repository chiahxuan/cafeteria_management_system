<?php
    include('menuCRUD.php');
    
        if(isset($_GET['unset'])){
            unset($_SESSION['keepFoodSearch']);

        }

        if(isset($_GET['ModalAdded'])){
         
        }

        //SECURE WEBPAGE WITH LOGIN ROLE TO AVOID UNAUTHORIZED ACCESS
        if(!isset($_SESSION['loginRole'])){

            header('location: ../../../Admin/Default/login.php');
    
        }
        

?>

<!DOCTYPE html>
<html lang="en">
        
<head>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<link rel="stylesheet" href="../linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../linkFiles/Modals_CSS/menu.css" type="text/css" />
<link rel="stylesheet" href="../linkFiles/transactionPriceColour.css" type="text/css" />
<style>


.analysis_top {

    width: 100%;
    height: 110px;
    min-height: 110px;


    display: flex;
    justify-content: space-between;
    background-color: white;
}

.report_type {

    max-width: 70%;
    height: 100%;

    display: flex;
    align-items: center;

    background-color: white;
}

.report_type button {
    outline: 0;
    border: 0;

    width: 230px;
    height: 50px;

    margin-left: 30px;

    font-size: 1.5em;
    word-wrap: break-word;
    
    font-family:  'Heebo', Arial, sans-serif;
    background-color: #EBF2FA;
    color: #427AA1;
}

.report_search {
    width: 30%;
    height: 100%;

    font-size: 30px;

    display: flex;
    justify-content: flex-end;
    align-items: center;

    padding-right: 25px;

    background-color: white;
}

.report_search * {
    outline: none;
    border: none;
}

.report_search input {
    width: 200px;
    height: 48px;
    
    background-color: inherit;
    border-bottom: 3px solid #427AA1;

    margin-right: 5px;

    font-size: 1.7vw;
}

.report_search button {
    font-size: 30px;
    background-color:white;
    color: #427AA1;
}


.analysis_bottom {
    width: 100%;
    height: 100%;

    background-color: brown; 

    display: flex;
    justify-content: center;
    align-items: center;

}

.tabcontent {
    width: 100%;
    height: 100%;

    display: none;
    
    align-items: center;
    flex-direction: column;

    background-color: #EBEBEB;
}

.table_top_bar {
    width: 100%;
    min-height: fit-content ;

    margin-top: 25px;
    padding-bottom: 5px;

   display: flex;
   justify-content: flex-start;
    
  
   background-color: #EBF2FA;
}

.table_outside {
    background-color: #FFFFFF;
}

.table_top_title {
    display: flex;
    align-items: center;

    font-size: 1.8vw;
    font-family:  'Heebo', Arial, sans-serif;

    color: #427AA1;
    margin-left: 25px;
}

.table_top_button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    
    margin-left: auto; 
    margin-right: 45px;

}

.table_top_button button {
    width: 50px;
    height: 50px;

    margin: 5px;

    font-size: 30px;

    outline: none;
    border: none;

    background-color: transparent;
    color: #427AA1;
}

.table_bottom_cage {
    width: 100%;
    height: 83%;

    background-color: white;

   
    display: flex; 
    flex-direction: column;
    align-items: center;
    
}

.vendor_button {
    display: flex;
    align-self: flex-end;
}

.vendor_button button {
    outline: none;
    border: none;
    border-radius: 50px;
    
    padding: 15px 30px;
    margin-right: 20px;
    
    
    align-self: flex-end;

    font-size: 1.6vw;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;

    color: #427AA1;
    background-color: #BBEDFF;
}

/*Styling the table*/
table {
    width: calc(100% - 50px);
    border-spacing: 5px;
    
}

table tr {
    
    height: 55px;
    max-height: 55px;

    text-indent: 20px;
    font-size: 1.5em;
    font-family: 'Heebo', Arial, sans-serif;
}


table tr td {
    background-color: #EBF2FA;
    color: #427AA1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; 
    max-width: 500px;

}


/*Vendor Profile tab*/
.vendor_profile_cage {
    

    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;

    overflow: hidden;

    background-color: #EBF2FA;
}

.vendor_profile_pic {
    background-color: ;

    width: 300px;
    height: 300px;

    border-radius: 100%;

    margin-right: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.vendor_profile_image {
    background-color: firebrick;

    width: 300px;
    height: 300px;

    border-radius: 100%;

    margin-right: 60px;
    position: absolute;
    display: flex;
    align-self: center;
    align-content: center;
    align-items: center;

    text-align: center;
    /* line-height: 50%; */

}


.vendor_content {
    width: 65%;
    height: fit-content;

    display: flex;

    color: #427AA1;
}

.vendor_attribute {
    width: 35%;
    height: 100%;    

    display: flex;
    flex-direction: column;
}

.vendor_attribute_block {
    width: 100%;
    height: 6vh;
    
    text-align: right;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    
    font-size: 1.8vw;
    font-family:  'Heebo', Arial, sans-serif;
    text-transform: uppercase;    
}

.vendor_input {
    width: 70%;
    height: 100%;

    display: flex;
    flex-direction: column;
}

.vendor_input input,.vendor_input select {
    outline: none;
    border: none;

    /* width: 100%; */
    height: calc(6vh - 2px);

    font-size: 1.8vw;
    text-indent: 40px;
}


/*Transaction history tab*/
.trans_list {
    width: 100%;
    height: 100%;

    background-color: cornflowerblue;

    display: flex;
    flex-direction: column;
    align-items: center;
}

.trans_title_cage {
    width: 60%;
    height: 115px;

    background-color: darkgreen;

    display: flex;
    justify-content: space-between;

    font-family: 'Heebo', Arial, sans-serif;
}

.trans_title_cage div h2 {
    padding: 0px;
    margin: 0px;
    line-height: 90%;
}

.trans_title_cage div span {
    font-size: 0.9vw;
}

.trans_title_time, .trans_title_profit {
    
    height: 100%;

    margin: 0px 30px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    font-size: 1.5vw;

    background-color: blueviolet;
}


.trans_detail_cage {
    width: calc(100% - 60px);
    height: 80%;

    background-color: darkgoldenrod;
    display: flex; 
    flex-direction: column;
}

.trans_detail {
    width: 100%;
    height: 70px;

    padding: 10px 0px;

    background-color: indigo;
    display: flex;
    justify-content: space-between;
}

.trans_detail_food, .trans_detail_price {
    width: 30%;
    height: 100%;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;

    font-size: 1.6vw;
    font-family: 'Heebo', Arial, sans-serif;

    background-color: darkorange;
}

.trans_detail_food {
    margin-left: 30px;
}

.trans_detail_food span {
    font-size: 1.2vw;
}

.trans_detail_price {
    font-size: 2vw;
    white-space: nowrap;

    margin-right: 30px;

    width: unset;
}

/* Open cafeteriaUser tab by default */
#Category {
    display: flex;
}

input[type=checkbox] {
  transform: scale(2);
}

table a {
    display: block; 
    text-decoration:none;
    color:inherit;
}

/* datalist{
    display: block;
} */


/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
</style>
<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />

<?php

    if(isset($_SESSION['keepFoodSearch'])){
        echo '<style>      
        
        #Food{
            display: flex;
        }

        #Category{
            display: none;
        }


        </style>';
        unset($_SESSION['keepFoodSearch']);
    }

    
    if(isset($_SESSION['showFoodDetails'])){
        echo '<style>      
        
        #Food{
            display: none;
        }

        #Category{
            display: none;
        }

        #Profile{
            display: flex;
        }


        </style>';
        unset($_SESSION['showFoodDetails']);
    }

    if(isset($_SESSION['updateSuccess'])){
        echo '<style>      
        
        #Food{
            display: none;
        }

        #Category{
            display: flex;
        }

        #Profile{
            display: none;
        }

        
        #Modal1{
            display: none;
        }
        
        #Modal2{
            display: flex;
        }

        #Modal3{
            display: none;
        }

        #Modal4{
            display: none;
        }
       

        #Modal5{
            display: none;
        }
       
        </style>';
        unset($_SESSION['updateSuccess']);
    }

    if(isset($_GET['foodUpdateSuccess'])){
        echo '<style>      
        
        #Food{
            display: flex;
        }

        #Category{
            display: none;
        }

        #Profile{
            display: none;
        }

        
        #Modal1{
            display: none;
        }
        
        #Modal2{
            display: flex;
        }

        #Modal3{
            display: none;
        }

        #Modal4{
            display: none;
        }
       

        #Modal5{
            display: none;
        }
       
        </style>';
    }


    if(isset($_SESSION['displayModalDeleted'])){
        echo '<style>      
        
        #Food{
            display: flex;
        }

        #Category{
            display: none;
        }

        #Profile{
            display: none;
        }

        
        #Modal1{
            display: flex;
        }
        
        #Modal2{
            display: none;
        }

        #Modal3{
            display: none;
        }

        #Modal4{
            display: none;
        }
       

        #Modal5{
            display: none;
        }
       
        </style>';
        unset($_SESSION['displayModalDeleted']);
    }


    if(isset($_GET['ModalAdded'])){
        echo '<style>      
        
        #Food{
            display: flex;
        }

        #Category{
            display: none;
        }

        #Profile{
            display: none;
        }

        
        #Modal1{
            display: none;
        }
        
        #Modal2{
            display: none;
        }

        #Modal3{
            display: none;
        }

        #Modal4{
            display: flex;
        }
       

        #Modal5{
            display: none;
        }
       
        </style>';
    }

    if(isset($_GET['category'])){
        
        echo '<style>      
        
        #Food{
            display: none;
        }

        #Category{
            display: none;
        }

        #Profile{
            display: none;
        }

        
        #addCategory{
            display: flex;
        }

        #Modal1{
            display: none;
        }
        
        #Modal2{
            display: none;
        }

        #Modal3{
            display: none;
        }

        #Modal4{
            display: none;
        }
       

        #Modal5{
            display: none;
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
            <button  type="button"id="user"> <div class="user_cover"> <i class="fas fa-user-circle"></i></div></button>             
        </form>

        <div class="notif_setting_cage">
            <a href="../userSettings/userSettings.php?unset" class="notif_setting_stack">
                <h2> View Profile</h2>
            </a>

            <a href="../../../Admin/Default/server.php?logout" class="notif_setting_stack notif_border">
                <h2>Log Out</h2>
            </a>
        </div>
    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <div id="bottom_left">
            <a href="../homeFoodvendor.php?unset" class="btn"><i class="fas fa-home"></i>Home </a>
            <a href="../Analysis/analysisMain.php?unset" class="btn"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../order/order.php?unset" class="btn"><i class="fas fa-store"></i>Order </a>
            <a href="../Transaction/Transaction.php?unset" class="btn"><i class="fas fa-id-card"></i>Transaction</a>
            <a href="../employee/employee.php?unset" class="btn"><i class="fas fa-user"></i>Employee</a>
			<a href="../Menu/menu.php?unset" class="btn activeTab"><i class="fas fa-book-open"></i>Food Menu</a>
        </div>
<!-- onclick="openCity(event, 'Cafeteria');" id="defaultOpen" -->
        <div class="bottom_right">
           <div class="analysis_cage">
                

                <div class="analysis_bottom">
                    <!-- Cafeteria User table -->
                    <div id="Category" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks tab_colour" onclick="openCity(event, 'Category');">Category</button>
                                <button class="tablinks" onclick="openCity(event, 'Food');">Food</button>

                            </div>
        
                            <!-- <form action="" class="report_search">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form> -->
                        </div>

                        <div class="table_top_bar table_outside">
                                <div class="table_top_button">
                                    <!-- <button class="tablinks" onclick="openCity(event, 'addCategory');"><i class="fas fa-plus"></i></button> -->
                                    <!-- <button><i class="fas fa-pen"></i></button>
                                    <button><i class="fas fa-trash"></i></button> -->
                                </div>
                            </div>
                        
                        <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                            

                            <table>
                                <tr>
                                    <td>No.</td>
                                    <td>Category Name</td>
                                    <td>Food Quantiy</td>
                                   
                                </tr>

                                <!-- <tr class="tablinks" onclick="openCity(event, 'Profile');">
                                    <td>1</td>
                                    <td>V010001</td>
                                    <td>Ganas Rice</td>
                                </tr> -->

                                <?php

                                    $showCategory = "SELECT food_category as category, COUNT(food_id) as foodNumber FROM `food` WHERE vendor_id = 'VD000001' GROUP BY food_category";
                                    $showCategory_run = mysqli_query($con, $showCategory);
                                    // echo mysqli_affected_rows($con);
                                    $no = 0;
                                    while($showCategory_run_rows = mysqli_fetch_assoc($showCategory_run)){
                                        $no++;
                                        echo "<tr>";
                                        echo "<td><a href = 'menu.php?category=".$showCategory_run_rows['category']."'>".$no."</a></td>";
                                        echo "<td><a href = 'menu.php?category=".$showCategory_run_rows['category']."'>".$showCategory_run_rows['category']."</a></td>";
                                        echo "<td><a href = 'menu.php?category=".$showCategory_run_rows['category']."'>".$showCategory_run_rows['foodNumber']."</a></td>";
                                        echo "</td>";


                                    }
                                
                                
                                ?>

                              
                            </table>
                        </div>
                           

                    </div>
                    
                    <!-- Employee table -->
                    <div id="Food" class="tabcontent">
                            <div class="analysis_top">
                                <div class="report_type" >
                                    <button class="tablinks " onclick="openCity(event, 'Category');">Category</button>
                                    <button class="tablinks tab_colour" onclick="openCity(event, 'Food');">Food</button>
                                </div>
            
                                <form action="menu.php" method = "POST" class="report_search">
                                    <input name = "foodSearchInput" type="search" placeholder="Search"> 
                                    <button name="foodSearch" type="submit"><i class="fas fa-search"></i></button> 
                                </form>
                            </div>
    
                            <div class="table_top_bar table_outside">
                                <div class="table_top_button">
                                    <button class="tablinks" onclick="openCity(event, 'addProfile');"><i class="fas fa-plus"></i></button>
                                    <!-- <button><i class="fas fa-pen"></i></button>
                                    <button ><i class="fas fa-trash"></i></button> -->
                                </div>
                            </div>
                            
                            <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                                
    
                                <table>
                                    <tr>
                                        <td>No.</td>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Category</td>
                                    </tr>
    
                                    <?php
                                        if(isset($_POST['foodSearch'])){

                                            $_SESSION['keepFoodSearch'] = 'set';
                                            
                                            // echo "hailat";
                                            $input = $_POST['foodSearchInput'];

                                            $selectFood = "SELECT * FROM food WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."' 
                                            AND( `food_id` LIKE '%$input%' OR `food_name` LIKE '%$input%' OR `food_price` LIKE '%$input%' OR `food_category` LIKE '%$input%')";
                                            $selectFood_run = mysqli_query($con, $selectFood);
                                            
                                            if(mysqli_num_rows($selectFood_run) == 0)
                                            {
                                                echo "<td> No Data </td>";
                                                echo "<td> No Data </td>";
                                                echo "<td> No Data </td>";
                                                echo "<td> No Data </td>";
                                            }else{
                                                $no = '0';
                                                while($selectFood_run_rows = mysqli_fetch_assoc($selectFood_run))
                                                {
                                                
                                                    $no++;
                                                    echo "<tr class='tablinks' onclick='openCity(event, 'Profile');'>";
                                                    echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$no."</a></td>";
                                                    echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$selectFood_run_rows['food_id']."</a></td>";
                                                    echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$selectFood_run_rows['food_name']."</a></td>";
                                                    echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$selectFood_run_rows['food_category']."</a></td>";
                                                    echo "</tr>";

                                                }
                                            }
                                           


                                        }else{

                                          
                                            $selectFood = "SELECT * FROM food WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."' ";
                                            $selectFood_run = mysqli_query($con, $selectFood);
                                            $no = 0;
                                            while($selectFood_run_rows = mysqli_fetch_assoc($selectFood_run)){

                                                $no++;
                                                echo "<tr class='tablinks' onclick='openCity(event, 'Profile');'>";
                                                echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$no."</a></td>";
                                                echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$selectFood_run_rows['food_id']."</a></td>";
                                                echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$selectFood_run_rows['food_name']."</a></td>";
                                                echo "<td><a href = 'menuCRUD.php?foodid=".$selectFood_run_rows['food_id']."'>".$selectFood_run_rows['food_category']."</a></td>";
                                                echo "</tr>";


                                            }
                                        }
                                    
                                    
                                    ?>

                                </table>
                            </div>
                               
    
                        </div>


                    <div id="addProfile" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tab_colour">Existing Menu</button>
                            </div>
        
                            <form action="" class="report_search">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>


                        <div class="table_top_bar">
                            <div class="table_top_title">ADD MENU</div>
                            <div class="table_top_button">
                                <!-- <button><i class="fas fa-pen"></i></button>
                                <button><i class="fas fa-trash"></i></button> -->
                            </div>
                        </div>
                        
                        <div class="table_bottom_cage">
                            <div class="vendor_profile_cage">

                                <div class="vendor_content">
                                    <div class="vendor_attribute">
                                        <div class="vendor_attribute_block">
                                            MENU ID:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            MENU Name:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            MENU PRICE:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            MENU CATEGORY:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            MENU PHOTO:
                                        </div>

                                        
                                    </div>

                                    <form class="vendor_input" action = "menuCRUD.php" method = "POST" enctype = "multipart/form-data"> 
                                        
                                        <input type="text" placeholder="MENU ID WILL BE GENERATED" readonly>

                                        <input name = "menuNewName" type="text" placeholder="MENU NAME" pattern="[^&][a-zA-Z0-9&\s]+" title="Name should not include any character" required >

                                        <input name = "menuNewPrice" type="text" placeholder="MENU PRICE" pattern="[0-9]{2}([\.,][0-9]{2})?" step="0.01"
                                        title="Price should not exceed RM99.99 and should include 2 decimal places." required >

                                        <select id = "foodCategoryinput" name = "menuNewCategory" type="text" readonly>
                                            <?php
                                                
                                                $foodOption = "SELECT food_category FROM food WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."' GROUP BY food_category ";
                                                $foodOption_run = mysqli_query($con, $foodOption);
                                                
                                                while($foodOption_run_rows = mysqli_fetch_assoc($foodOption_run))
                                                    {
                                                        $category = $foodOption_run_rows['food_category'];
                                                        // echo '<option value = "vendorID">'$vendorLoad.['vendor_id'].'</option>';
    
                                                        echo '<option value="'.$category.'" >'.$category.'</option>';
                                                    }

                                            ?>
                                        </select>

                                        <input id = "AddfoodPhotoinput" name = "AddfoodPhotoinput" type="file"  >


                                        <!-- <input id = "foodIDinput" name = "foodIDinput"  type="text" value="<?php //echo $_SESSION['foodID']; ?>" readonly>

                                        <input id = "foodNameinput" name = "foodNameinput" type="text" value="<?php //echo $_SESSION['foodName']; ?>" readonly>
                                        
                                        <input id = "foodPriceinput" name = "foodPriceinput" type="text" value="<?php //echo $_SESSION['foodPrice']; ?>" readonly>

                                        <input id = "foodCategoryinput" name = "foodCategoryinput" type="text" value="<?php //echo $_SESSION['foodCategory']; ?>" readonly> -->

                                        

                                        <div class="vendor_button">
                                            <button name ="foodConfirmAdd" type="submit" id="" class="">Confirm</button>
                                            <button type="button" onclick="openCity(event, 'Food');">Cancel</button>

                                            <!-- <button name ="foodConfirmAdd" type="submit" id="popUp1V2" class="" >Confirm</button>
                                            <button id = "cancelBtn" type="button" onclick="openCity(event, 'Food');">Cancel</button>
                                            <button id="backBtn" type="button" onclick="openCity(event, 'Food');">Back</button> -->
                                        </div>
                                        
                                    </form>
                                </div>

                            </div>
                            
                            
                        </div>
                        
                    </div>

                    <div id="addCategory" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tab_colour">Existing Menu</button>
                                
                            </div>
        
                            <form action="" class="report_search">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>


                        <div class="table_top_bar">
                            <div class="table_top_title">ADD CATEGORY</div>
                            <div class="table_top_button">
                                <button id = "editCategory" type = "button"><i class="fas fa-pen"></i></button>
                                <button id = "deleteCategory" type = "button"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        
                        <div class="table_bottom_cage">
                            <div class="vendor_profile_cage">

                                <div class="vendor_content">
                                    <div class="vendor_attribute">
                                       
                                        <div class="vendor_attribute_block">
                                            CATEGORY Name: 
                                        </div>

                                        <div class="vendor_attribute_block">
                                            TOTAL FOODS: 
                                        </div>

                                        <div class="vendor_attribute_block">
                                            CATEGORY PIC:
                                        </div>

                                        

                                        
                                    </div>

                                    <form class="vendor_input" action = "menuCRUD.php" method = "POST"> 

                                        <?php
                                     
                                            $_SESSION['tempCat'] = $_GET['category'];
                                                echo '<input list = "FoodCategory" name = "Categoryinput" id = "CategoryInputDL"  value = "'.$_GET['category'].'" pattern="[^&][a-zA-Z0-9&\s]+" title="Name should not include any character" readonly>';
                                                    echo '<datalist id = "FoodCategory">';

                                                    $foodOption = "SELECT food_category FROM food WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."' GROUP BY food_category ";
                                                    $foodOption_run = mysqli_query($con, $foodOption);
                                              
                                                    while($foodOption_run_rows = mysqli_fetch_assoc($foodOption_run))
                                                    {
                                                        $category = $foodOption_run_rows['food_category'];
                                                        echo '<option value="'.$category.'" >';

                                                    }

                                                echo '</datalist>';

                                                ////GET NUMBER OF FOODS 
                                                $showAmount = "SELECT food_category as category, COUNT(food_id) as foodNumber FROM `food` WHERE vendor_id = 'VD000001' AND food_category = '".$_GET['category']."' GROUP BY food_category";
                                                $showAmount_run = mysqli_query($con, $showAmount);
                                                $showAmount_run_rows = mysqli_fetch_assoc($showAmount_run);
                                                
                                                $showAmount_run_rows['foodNumber'];


                                            ?>

                                        <input id = "categoryName"  name = "categoryName" type="text" placeholder="MENU NAME" value = "<?php echo $showAmount_run_rows['foodNumber'];?>" readonly >
                                        <input id = "categoryPhotoinput" name = "categoryPhotoinput" type="file"  disabled>
                                        
                                        <div class="vendor_button">
                                            <button class="tab_colour" name ="categoryConfirmEdit" type="submit" id="categoryConfirm" class=""  style = "display:none">Confirm</button>
                                            <button id = "categoryCancel" type="button"  style = "display:none">Cancel</button>
                                            <button id = "categoryBack" type="button" onclick="openCity(event, 'Category');">Back</button>
                                        </div>
                                        
                                    </form>
                                </div>

                            </div>
                            
                            
                        </div>
                        
                    </div>

						<!-- Profile section -->
                    
                    
                    
                    <div id="Profile" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks tab_colour">Menu</button>
                                
                            </div>
        
                            <form action="" class="report_search">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>


                        <div class="table_top_bar">
                            <div class="table_top_button">
                                
                                <button  id="foodEdit"><i class="fas fa-pen"></i></button>
                                <button  id="foodDelete"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        
                        <div class="table_bottom_cage">
                            <div class="vendor_profile_cage">
                                <div class="vendor_profile_pic">
                                    <?php
                                       $foodImage = $_SESSION['foodPic'];
                                       echo '<img class="vendor_profile_image" alt="profile_image" src="data:USER_IMAGE/jpg;base64,'.base64_encode($foodImage).'" />';
                                    ?>
                                    
                                </div>

                                <div class="vendor_content">
                                    <div class="vendor_attribute">
                                        <div class="vendor_attribute_block">
                                           MENU ID:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            MENU Name:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            MENU PRICE:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            CATEGORY:
                                        </div>
                                        
                                        <div class="vendor_attribute_block">
                                            MENU PHOTO:
                                        </div>

                               


                                    </div>

                                    <form class="vendor_input" action="menuCRUD.php" method = "POST" enctype = "multipart/form-data"> 
                                        <input id = "foodIDinput" name = "foodIDinput"  type="text" value="<?php echo $_SESSION['foodID']; ?>" readonly>

                                        <input id = "foodNameinput" name = "foodNameinput" type="text" value="<?php echo $_SESSION['foodName']; ?>" pattern="[^&][a-zA-Z0-9&\s]+" title="Name should not include anycharacter" required  readonly>

                                        <input id = "foodPriceinput" name = "foodPriceinput" type="text" value="RM<?php echo $_SESSION['foodPrice']; ?>" readonly>

                                        <!-- <input list = "FoodCategory">
                                        <datalist id = "FoodCategory">
                                                    <option value = "la njiao">
                                                    <option value = "hialat">
                                        </datalist> -->




                                        <!-- <select id = "foodCategoryinput" name = "foodCategoryinput" type="text" readonly> -->
                                            <?php
                                                $originalCategory = $_SESSION['foodCategory']; 
                                                echo '<input list = "FoodCategory" name = "foodCategoryinput" id = "foodCategoryInputDL"  value = "'.$originalCategory.'" readonly>';
                                                echo '<datalist id = "FoodCategory">';
                                                    
                                                    $foodOption = "SELECT food_category FROM food WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."' GROUP BY food_category ";
                                                    $foodOption_run = mysqli_query($con, $foodOption);                                               

                                                while($foodOption_run_rows = mysqli_fetch_assoc($foodOption_run))
                                                {
                                                    $category = $foodOption_run_rows['food_category'];
                                                    echo '<option value="'.$category.'" >';

                                                }

                                                echo '</datalist>';
                                            ?>
                                        <!-- </select> -->

                                        <input id = "foodPhotoinput" name = "foodPhotoinput" type="file"  disabled>


                                        <div class="vendor_button">
                                            <button name ="foodConfirmEdit" type="submit" id="popUp1V2" class="" style = "visibility:hidden">Confirm</button>
                                            <button id = "cancelBtn" type="button" style = "visibility:hidden">Cancel</button>
                                            <button id="backBtn" type="button" onclick="openCity(event, 'Food');">Back</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            
                        </div>
                        
                    </div>
							
                </div>
                  
           </div>
           
           <!-- The DELETE FOOD Confirmation Modal-->
            <div id="Modal3" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_infoTitle">
                                ARE YOU SURE YOU WANT TO DELETE/EDIT THE FOLLOWING USER?
                            </div>
                            <div class="content_info_bottomCage">
                                <div class="content_detail_stack">
                                    <div class="content_name">MENU ID</div>
                                    <span>:</span>
                                    <div class="content_detail"><?php echo $_SESSION['foodID']; ?></div>
                                </div>

                                <div class="content_detail_stack">
                                    <div class="content_name">MENU Name</div>
                                    <span>:</span>
                                    <div class="content_detail"><?php echo $_SESSION['foodName']; ?></div>
                                </div>

                                <div class="content_detail_stack">
                                    <div class="content_name">MENU PRICE</div>
                                    <span>:</span>
                                    <div class="content_detail"><?php echo $_SESSION['foodPrice']; ?></div>
                                </div>

                                <div class="content_detail_stack">
                                    <div class="content_name">MENU CATEGORY</div>
                                    <span>:</span>
                                    <div class="content_detail"><?php echo $_SESSION['foodCategory']; ?></div>
                                </div>

    
                            </div>

                        </div>

                        <form class="button_group align_flexEnd" action = "menuCRUD.php" method = "POST">
                            <button name = "confirmDelete" type="submit" class="content_inn">Confirm</button>
                            <button type="button" class="close">Cancel</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>

            <div id="Modal5" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_infoTitle">
                                ARE YOU SURE YOU WANT TO DELETE THE ENTIRE CATEGORY?
                            </div>
                            <div class="content_info_bottomCage">

                                <div class="content_detail_stack">
                                    <div class="content_name">CATEGORY: </div>
                                    <span>:</span>
                                    <div class="content_detail"><?php echo $_SESSION['tempCat']; ?></div>
                                </div>

                                <div class="content_detail_stack">
                                    <div class="content_name">FOOD AMOUNT</div>
                                    <span>:</span>
                                    <div class="content_detail"><?php echo $showAmount_run_rows['foodNumber'] ?></div>
                                </div>
    
                            </div>

                        </div>

                        <form class="button_group align_flexEnd" action = "menuCRUD.php" method = "POST">
                            <button name = "cfmDeleteModal" type="submit" class="content_inn">Confirm</button>
                            <button type="button" class="close">Cancel</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
			
			<!--Show Successful Refund Modal-->
			<div id="Modal1" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Successfully DELETE!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>

            <!--Show Successful Refund Modal-->
			<div id="Modal2" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Successfully EDIT!
                        </div>

                        <span class="close">Dismiss</span>

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
                            Successfully ADDED!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>
			
        </div>
    </div>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/menuModal.js"></script>
    <script type="text/javascript" src="../linkFiles/transactionPriceColour.js"></script>
    <script type="text/javascript" src="../linkFiles/menu.js"></script>
</body>
</html>
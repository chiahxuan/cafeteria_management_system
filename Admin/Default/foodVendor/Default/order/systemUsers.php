<?php
    //SECURE WEBPAGE WITH LOGIN ROLE TO AVOID UNAUTHORIZED ACCESS
    if(!isset($_SESSION['loginRole'])){

        header('location: ../../../Admin/Default/login.php');

    }

?><!DOCTYPE html>
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
    background-color: gray;
}

.report_type {

    width: 70%;
    height: 100%;

    display: flex;
    align-items: center;

    background-color: aqua;
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
}

.report_search {
    width: 30%;
    height: 100%;

    font-size: 30px;

    display: flex;
    justify-content: flex-end;
    align-items: center;

    padding-right: 25px;

    background-color: beige;
}

.report_search * {
    outline: none;
    border: none;
}

.report_search input {

    width: 200px;
    height: 48px;
    
    background-color: inherit;
    border-bottom: 3px solid blue;
    

    margin-right: 5px;

    font-size: 1.7vw;
}

.report_search button {
    font-size: 30px;
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

    background-color: teal;
}

.table_top_bar {
    width: 100%;
    min-height: fit-content ;

    margin-top: 25px;
    padding-bottom: 5px;

   display: flex;
   justify-content: flex-start;
    
  

    background-color: burlywood;
}

.table_top_title {
    background-color: blueviolet;

    display: flex;
    align-items: center;

    font-size: 1.8vw;
    font-family:  'Heebo', Arial, sans-serif;

}

.table_top_button {

    display: flex;
    justify-content: space-between;
    align-items: center;
    
    margin-left: auto; 
    margin-right: 45px;

    background-color: deepskyblue;
}

.table_top_button button {
    width: 50px;
    height: 50px;

    margin: 5px;

    font-size: 30px;

    outline: none;
    border: none;
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
    background-color: purple;

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
    background-color: aqua;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; 
    max-width: 500px;

}


/*Vendor Profile tab*/
.vendor_profile_cage {
    background-color: yellow;

    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;

    overflow: hidden;
}

.vendor_profile_pic {
    background-color: firebrick;

    width: 300px;
    height: 300px;

    border-radius: 100%;

    margin-right: 60px;
}

.vendor_content {
    background-color:lightslategray;

    width: 65%;
    height: fit-content;

    display: flex;
}

.vendor_attribute {

    width: 35%;
    height: 100%;

    background-color: crimson;
    

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
    text-transform: uppercase;
    
    background-color: magenta;
}

.vendor_input {

    width: 70%;
    height: 100%;

    background-color: tomato;

    display: flex;
    flex-direction: column;
}

.vendor_input input {
    outline: none;
    border: none;

    width: 100%;
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
#cafeteriaUser {
    display: flex;
}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
</style>
<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />
</head>

<body>
    <!--Title Bar-->
    <div class="top">
        <div class="top_left">
            APU Cafeteria System
            <i class="fas fa-utensils"></i>
        </div>

        <form class="top_right">
          <button  type="button" id="notif"><i class="far fa-bell"></i><div class="badge">5</div></button> 
          <button  type="button"id="user"> <div class="user_cover"> <i class="fas fa-user-circle"></i></div></button> 
            
        </form>

        <div class="notif_cage">
            <div class="notif_stack">
                <h2>Your weekly report is out</h2>
                <div>Nov 12 2018 at 00:00 AM</div>
            </div>

            <div class="notif_stack">
                <h2>Your weekly report is out</h2>
                <div>Nov 12 2018 at 00:00 AM</div>
            </div>

            <div class="notif_stack">
                <h2>Your weekly report is out</h2>
                <div>Nov 12 2018 at 00:00 AM</div>
            </div>

            <div class="notif_stack">
                <h2>Your weekly report is out</h2>
                <div>Nov 12 2018 at 00:00 AM</div>
            </div>

            <div class="notif_stack">
                <h2>Your weekly report is out</h2>
                <div>Nov 12 2018 at 00:00 AM</div>
            </div>
        </div>

        <div class="notif_setting_cage">
            <a href="../userSettings/userSettings.html" class="notif_setting_stack">
                <h2> View Profile</h2>
            </a>

            <div class="notif_setting_stack">
                <h2>Log Out</h2>
            </div>
        </div>
    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <div id="bottom_left">
            <a href="../homeAdmin.html" class="btn"><i class="fas fa-home"></i>Home </a>
            <a href="../Analysis/analysisMain.html" class="btn"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../foodVendor/foodVendorMain.html" class="btn" ><i class="fas fa-store"></i>Food Vendors </a>
            <a href="../accessCard/accessCardMain.html" class="btn"><i class="fas fa-id-card"></i>Access Cards</a>
            <a href="../systemUsers/systemUsers.html" class="btn activeTab tablinks" onclick="openCity(event, 'cafeteriaUser');" ><i class="fas fa-user"></i>System Users</a>
        </div>
        <!-- onclick="openCity(event, 'Cafeteria');" id="defaultOpen" -->
        <div class="bottom_right">
           <div class="analysis_cage">
                

                <div class="analysis_bottom">
                    <!-- Cafeteria User table -->
                    <!-- <div id="cafeteriaUser" class="tabcontent"> -->
                        <!-- <div class="analysis_top"> -->
                            <!-- <div class="report_type" > -->
                                <!-- <button class="tablinks" onclick="openCity(event, 'cafeteriaUser');">Cafeteria User</button> -->
                                <!-- <button class="tablinks" onclick="openCity(event, 'Employee');">Employee</button> -->
                                <!-- <button class="tablinks" onclick="openCity(event, 'Visitor');">Visitor</button> -->
                            <!-- </div> -->
        
                            <!-- <form action="" class="report_search"> -->
                                <!-- <input type="search" placeholder="Search">  -->
                                <!-- <button><i class="fas fa-search"></i></button>  -->
                            <!-- </form> -->
                        <!-- </div> -->

                        <!-- <div class="table_top_bar"> -->
                        <!-- </div> -->
                        
                        <!-- <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;"> -->
                            

                            <!-- <table> -->
                                <!-- <tr> -->
                                    <!-- <td>No.</td> -->
                                    <!-- <td>ID</td> -->
                                    <!-- <td>Name</td> -->
                                    <!-- <td>Role</td> -->
                                <!-- </tr> -->

                                <!-- <tr class="tablinks" onclick="openCity(event, 'Profile');"> -->
                                    <!-- <td>1</td> -->
                                    <!-- <td>V010001</td> -->
                                    <!-- <td>Western Corner</td> -->
                                    <!-- <td>Staff</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>2</td> -->
                                    <!-- <td>V010002</td> -->
                                    <!-- <td>Chinese Delish</td> -->
                                    <!-- <td>Student</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>3</td> -->
                                    <!-- <td>V010003</td> -->
                                    <!-- <td>Kebab Gulash</td> -->
                                    <!-- <td>Student</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>4</td> -->
                                    <!-- <td>V010004</td> -->
                                    <!-- <td>Ni Ju Ichi</td> -->
                                    <!-- <td>Student</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>5</td> -->
                                    <!-- <td>V010005</td> -->
                                    <!-- <td>Economy Rice</td> -->
                                    <!-- <td>Staff</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>6</td> -->
                                    <!-- <td>V010006</td> -->
                                    <!-- <td>Muscle Delight</td> -->
                                    <!-- <td>Staff</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>7</td> -->
                                    <!-- <td>V010006</td> -->
                                    <!-- <td>BLOB Delight</td> -->
                                    <!-- <td>Staff</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>8</td> -->
                                    <!-- <td>V010006</td> -->
                                    <!-- <td>LMAO Delight</td> -->
                                    <!-- <td>Student</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>6</td> -->
                                    <!-- <td>V010006</td> -->
                                    <!-- <td>Muscle Delight</td> -->
                                    <!-- <td>Student</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>7</td> -->
                                    <!-- <td>V010006</td> -->
                                    <!-- <td>BLOB Delight</td> -->
                                    <!-- <td>Student</td> -->
                                <!-- </tr> -->

                                <!-- <tr> -->
                                    <!-- <td>8</td> -->
                                    <!-- <td>V010006</td> -->
                                    <!-- <td>LMAO Delight</td> -->
                                    <!-- <td>Student</td> -->
                                <!-- </tr> -->
                            <!-- </table> -->
                        <!-- </div> -->
                           

                    <!-- </div> -->
                    
                    <!-- Employee table -->
                    <div id="Employee" class="tabcontent">
                            <div class="analysis_top">
                                <div class="report_type" >
                                    <button class="tablinks" onclick="openCity(event, 'cafeteriaUser');">Cafeteria User</button>
                                    <button>Employee</button>
                                    <button class="tablinks" onclick="openCity(event, 'Visitor');">Visitor</button>
                                </div>
            
                                <form action="" class="report_search">
                                    <input type="search" placeholder="Search"> 
                                    <button><i class="fas fa-search"></i></button> 
                                </form>
                            </div>
    
                            <div class="table_top_bar">
                                <div class="table_top_button">
                                    <button class="tablinks" onclick="openCity(event, 'addProfile');"><i class="fas fa-plus"></i></button>
                                    <button><i class="fas fa-pen"></i></button>
                                    <button><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            
                            <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                                
    
                                <table>
                                    <tr>
                                        <td>No.</td>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Role</td>
                                    </tr>
    
                                    <tr class="tablinks" onclick="openCity(event, 'Profile');">
                                        <td>1</td>
                                        <td>V010001</td>
                                        <td>Western Corner bin KFJENKFJN KFJNFRJKN wrifhiuorfhieuorh iuoerhgiuoergh </td>
                                        <td>Kitchen Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>2</td>
                                        <td>V010002</td>
                                        <td>Chinese Delish</td> 
                                        <td>Help Desk Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>3</td>
                                        <td>V010003</td>
                                        <td>Kebab Gulash</td>
                                        <td>Help Desk Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>4</td>
                                        <td>V010004</td>
                                        <td>Ni Ju Ichi</td>
                                        <td>Help Desk Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>5</td>
                                        <td>V010005</td>
                                        <td>Economy Rice</td>
                                        <td>Kitchen Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>6</td>
                                        <td>V010006</td>
                                        <td>Muscle Delight</td>
                                        <td>Food Vendor Owner</td>
                                    </tr>
    
                                    <tr>
                                        <td>7</td>
                                        <td>V010006</td>
                                        <td>BLOB Delight</td>
                                        <td>Food Vendor Owner</td>
                                    </tr>
    
                                    <tr>
                                        <td>8</td>
                                        <td>V010006</td>
                                        <td>LMAO Delight</td>
                                        <td>Food Vendor Owner</td>
                                    </tr>
    
                                    <tr>
                                        <td>6</td>
                                        <td>V010006</td>
                                        <td>Muscle Delight</td>
                                        <td>Kitchen Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>7</td>
                                        <td>V010006</td>
                                        <td>BLOB Delight</td>
                                        <td>Kitchen Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>8</td>
                                        <td>V010006</td>
                                        <td>LMAO Delight</td>
                                        <td>Food Vendor Owner</td>
                                    </tr>
                                </table>
                            </div>
                               
    
                        </div>

                        <div id="Visitor" class="tabcontent">
                            <div class="analysis_top">
                                <div class="report_type" >
                                    <button class="tablinks" onclick="openCity(event, 'cafeteriaUser');">Cafeteria User</button>
                                    <button class="tablinks" onclick="openCity(event, 'Employee');">Employee</button>
                                    <button>Visitor</button>
                                </div>
            
                                <form action="" class="report_search">
                                    <input type="search" placeholder="Search"> 
                                    <button><i class="fas fa-search"></i></button> 
                                </form>
                            </div>
    
                            <div class="table_top_bar">
                                <div class="table_top_button">
                                    <button class="tablinks" onclick="openCity(event, 'addProfile');"><i class="fas fa-plus"></i></button>
                                    <button><i class="fas fa-pen"></i></button>
                                    <button><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            
                            <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                                
    
                                <table>
                                    <tr>
                                        <td>No.</td>
                                        <td>ID</td>
                                        <td>Balance</td>
                                        <td>Status</td>
                                    </tr>

                                    <tr class="tablinks" onclick="openCity(event, 'Profile');">
                                        <td>1</td>
                                        <td>V010001</td>
                                        <td>RM100.00</td>
                                        <td>Activated</td>
                                    </tr>
    
                                    <tr>
                                        <td>2</td>
                                        <td>V010002</td>
                                        <td>RM150.50</td>
                                        <td>Activated</td>
                                    </tr>
    
                                    <tr>
                                        <td>3</td>
                                        <td>V010003</td>
                                        <td>RM50.00</td>
                                        <td>Activated</td>
                                    </tr>
    
                                    <tr>
                                        <td>4</td>
                                        <td>V010004</td>
                                        <td>RM0.00</td>
                                        <td>Dectivated</td>
                                    </tr>
    
                                    <tr>
                                        <td>5</td>
                                        <td>V010005</td>
                                        <td>RM0.00</td>
                                        <td>Dectivated</td>
                                    </tr>
    
                                    <tr>
                                        <td>6</td>
                                        <td>V010006</td>
                                        <td>RM400.00</td>
                                        <td>Activated</td>
                                    </tr>
    
                                    <tr>
                                        <td>7</td>
                                        <td>V010006</td>
                                        <td>BLOB Delight</td>
                                        <td>Food Vendor Owner</td>
                                    </tr>
    
                                    <tr>
                                        <td>8</td>
                                        <td>V010006</td>
                                        <td>LMAO Delight</td>
                                        <td>Food Vendor Owner</td>
                                    </tr>
    
                                    <tr>
                                        <td>6</td>
                                        <td>V010006</td>
                                        <td>Muscle Delight</td>
                                        <td>Kitchen Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>7</td>
                                        <td>V010006</td>
                                        <td>BLOB Delight</td>
                                        <td>Kitchen Employee</td>
                                    </tr>
    
                                    <tr>
                                        <td>8</td>
                                        <td>V010006</td>
                                        <td>LMAO Delight</td>
                                        <td>Food Vendor Owner</td>
                                    </tr>
                                </table>
                            </div>
                                
    
                        </div>


                    <!-- Profile section -->
                    <div id="Profile" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks" onclick="openCity(event, 'Profile');">Profile</button>
                                <button class="tablinks" onclick="openCity(event, 'Transaction');" >Transaction History</button>
                            </div>
        
                            <form action="" class="report_search">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>


                        <div class="table_top_bar">
                            <div class="table_top_button">
                                
                                <button><i class="fas fa-pen"></i></button>
                                <button><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        
                        <div class="table_bottom_cage">
                            <div class="vendor_profile_cage">
                                <!-- <div class="vendor_profile_pic">
                                    
                                </div> -->

                                <div class="vendor_content">
                                    <div class="vendor_attribute">
                                        <div class="vendor_attribute_block">
                                           Vendor ID: 
                                        </div>

                                        <div class="vendor_attribute_block">
                                            Vendor Name:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            Vendor Owner:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            Email:
                                        </div>
                                    </div>

                                    <form class="vendor_input"> 
                                        <input type="text" placeholder="VENDOR ID">

                                        <input type="text" placeholder="VENDOR NAME">

                                        <input type="text" placeholder="VENDOR OWNER">

                                        <input type="text" placeholder="EMAIL">

                                        <div class="vendor_button">
                                            <button type="button" id="popUp1V2" class="">Confirm</button>
                                            <button type="button">Cancel</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            
                        </div>
                        
                    </div>
                    
                    <!-- Transaction section -->
                    <div id="Transaction" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks" onclick="openCity(event, 'Profile');">Profile</button>
                                <button class="tablinks" onclick="openCity(event, 'Transaction');" >Transaction History</button>
                            </div>
        
                            <form action="" class="report_search">
                                <input type="search" placeholder="Search">
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>

                        <div class="trans_list">
                            <div class="trans_title_cage">
                                <div class="trans_title_time">
                                    <h2>V010001</h2>
                                    <span>Last Updated</span>
                                    <span style="font-size: 22px;">Nov 26 2018 at 05:36 PM</span>
                                </div>

                                <div class="trans_title_profit">
                                    <span>Profit</span>
                                    <h2>RM 12000.80</h2>
                                </div>
                            </div>

                            <div class="trans_detail_cage">
                                <div class="trans_detail">
                                    <div class="trans_detail_food">
                                        NASI LEMAK
                                        <span>Nov 26 2018 at 05:36 PM</span>
                                    </div>

                                    <div class="trans_detail_price">
                                        RM 10.00
                                    </div>
                                </div>

                                <div class="trans_detail">
                                    <div class="trans_detail_food">
                                        NASI LEMAK
                                        <span>Nov 26 2018 at 05:36 PM</span>
                                    </div>

                                    <div class="trans_detail_price">
                                        RM 10.00
                                    </div>
                                </div>

                                <div class="trans_detail">
                                    <div class="trans_detail_food">
                                        NASI LEMAK
                                        <span>Nov 26 2018 at 05:36 PM</span>
                                    </div>

                                    <div class="trans_detail_price">
                                        RM 10.00
                                    </div>
                                </div>

                                    
                            </div>
                        </div>
                    </div>

                    <div id="addProfile" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button>Total Vendors: 6</button>
                                <button>Available Stalls: 2</button>
                            </div>
        
                            <form action="" class="report_search">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>


                        <div class="table_top_bar">
                            <div class="table_top_title">ADD PAGE</div>
                            <div class="table_top_button">
                                <button><i class="fas fa-pen"></i></button>
                                <button><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        
                        <div class="table_bottom_cage">
                            <div class="vendor_profile_cage">
                                <!-- <div class="vendor_profile_pic"> -->
                                    
                                <!-- </div> -->

                                <div class="vendor_content">
                                    <div class="vendor_attribute">
                                        <div class="vendor_attribute_block">
                                           Vendor ID: 
                                        </div>

                                        <div class="vendor_attribute_block">
                                            Vendor Name:
                                        </div>

                                       
                                    </div>

                                    <form class="vendor_input"> 
                                        <input type="text" placeholder="VENDOR ID">

                                        <input type="text" placeholder="VENDOR NAME">
                                        

                                        <div class="vendor_button">
                                            <button type="button" id="popUp1" class="">Confirm</button>
                                            <button type="button" >Cancel</button>
                                        </div>
                                      
                                    </form>
                                </div>

                            </div>
                            
                            
                        </div>
                        
                    </div>

                </div>
                  
           </div>
           
           <!-- The Add Confirmation Modal-->
           <div id="Modal1" class="modal">
            <!-- Modal content -->
            <div class="content_cage">
                <div class="content_outerCage">
                    <div class="content_innerCage">
                        <div class="content_infoTitle">
                            ARE YOU SURE YOU WANT TO DELETE THE FOLLOWING USER?
                        </div>
                        <div class="content_info_bottomCage">
                            <div class="content_detail_stack">
                                <div class="content_name">Vendor ID</div>
                                <span>:</span>
                                <div class="content_detail">V01</div>
                            </div>

                            <div class="content_detail_stack">
                                <div class="content_name">Vendor Name</div>
                                <span>:</span>
                                <div class="content_detail">LMAOLMAOLMAO</div>
                            </div>

                            <div class="content_detail_stack">
                                <div class="content_name">Vendor Owner Name</div>
                                <span>:</span>
                                <div class="content_detail">SIBI KIA</div>
                            </div>

                            <div class="content_detail_stack">
                                <div class="content_name">Email</div>
                                <span>:</span>
                                <div class="content_detail">chiahxuan@gmail.com</div>
                            </div>
                        </div>

                    </div>

                    <form class="button_group align_flexEnd">
                        <button type="button" class="close">Confirm</button>
                        <button type="button" class="close">Cancel</button>
                    </form>
                    
                    
                </div>
            </div>
           </div>


        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/systemUsersModal.js"></script>
    <script type="text/javascript" src="../linkFiles/transactionPriceColour.js"></script>
</body>
</html>
<?php 

    include('analysisCRUD.php');
    if(isset($_GET['unset']))
    {
        unset($_SESSION['checkCafReport']);
        unset($_SESSION['VendorReportExist']);


    }

    //SECURE WEBPAGE WITH LOGIN ROLE TO AVOID UNAUTHORIZED ACCESSX
    if(!isset($_SESSION['loginRole'])){

        header('location: ../login.php');

    }
    
?>

<!DOCTYPE html>
<html lang="en">
        
<head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../linkFiles/print.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<link rel="stylesheet" href="../linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../linkFiles/Modals_CSS/menu.css" type="text/css" />
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

    width: 50%;
    height: 100%;

    display: flex;
    align-items: center;

    background-color: white;
}

.report_type button {
    outline: 0;
    border: 0;

    width: 220px;
    height: 50px;
    color: #427AA1;
    background-color: #EBF2FA;

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

.report_search input {

    width: 200px;
    height: 48px;
    
    

    background-color: inherit;

    outline: none;
    border: none;
    border-bottom: 3px solid #427AA1;
    

    margin-right: 5px;

    font-size: 1.7vw;
}

.analysis_bottom {
    width: 100%;
    height: 90%;
    min-height: 90%;

    background-color: white; 

    display: flex;
    justify-content: center;
    align-items: center;
    align-self: flex-end;

}

.tabcontent {
  padding: 0;
  margin: 0;

  width: calc(100% - 50px);
  height: calc(100% - 50px);
  max-height: calc(100% - 50px);

  display: none;
  flex-direction: column;
  justify-content: space-between;
 
  

  background-color: white;
}

.report_displayType {
    display: flex;
    align-items: center;
    
    width: 15em;
}

.report_type_button {
    width: 50%;
    height: min-content;    
    padding: 5px 5px;

    text-align: center;
    font-size: 1.2em;
    font-family:  'Heebo', Arial, sans-serif;
    background-color:#BBEDFF;
    color:#427AA1;
}

/* Report designs */
.report_cage {
    width: 100%;
    height: 90%;
    
    background-color: white;

    display: flex;
    flex-direction: column;

    
}

.report_topbar {
    width: 100%;
    height: 70px;
    min-height: 70px;

    display: flex;
    align-items: center;

    background-color: #427AA1;
}

.report_top_title {
    font-size: 1.6em;
    font-family:  'Heebo', Arial, sans-serif;
    text-transform: uppercase;

    background-color: #427AA1;
    color:white;
    margin: 0px 25px;
}

.report_comboBox {
    outline: none;
    border: none;

    font-size: 1.6em;
    font-family:  'Heebo', Arial, sans-serif;

    padding: 0px 15px;
    border-radius: 50px;
}

#print_button,#monthBtn, #vendorReportBtn{
    outline: none;
    border: none;

    font-size: 1.6em;
    font-family:  'Heebo', Arial, sans-serif;

    padding: 0px 15px;
    border-radius: 50px;

    margin-left: auto;
    margin-right: 5%;
}

.report_content_cage {
    width: 100%;
    height: 100%;

    background-color: white;

    display: flex;
    justify-content: center;
    align-items: flex-start;

    overflow-y: scroll;
    overflow-x: hidden;
}

.report_content_border {
    border: 1px solid #427AA1;

    margin: 20px;

    /* width: 2480px; */
    width: 95%;
    height: max-content;

    display: flex;
    justify-content: center;
    align-items: center;
}

.report_content_insideCage {
    width: 90%;
    height: 95%;

    margin: 20px;

    background-color: #EBF2FA;

    display: flex;
    flex-direction: column;
    align-items: center;
    
}

.report_inside_title {
    width: 100%;
    height: fit-content;
    padding: 20px 0px;

    background-color: #EBF2FA;
    color:#427AA1;
    font-size: 2em;
    font-family: 'Arial', Times, serif;
    text-align: center;
}

.report_info_bar {
    width: 90%;
    height: fit-content;
    padding: 25px 0;

    display: flex;
    justify-content: space-around;
    font-size: 1.5em;
    font-family: 'Arial', Times, serif;

   color: #427AA1;

}

.report_info_detail {

    min-width: 10em;

}

.report_table {
    width: 100%;
}

.report_table tr *{
    border: 1px solid #427AA1;
    color: #427AA1;
    text-align: center;
    font-size: 1.5em;
    font-family: 'Arial', Times, serif;
    padding: 15px 0px;

    width: fit-content;
}

/* Style the first column */
.report_table td:nth-child(1) {
    background-color: #EBF2FA;
}

/* Open Cafeteria page first */
#Cafeteria {
    display: flex;
}

.selectform {
    display:flex;
}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/


@media print {
    body * {
        visibility: hidden;
        
    }

    .report_content_border, .report_content_border * {
        visibility: visible;
        z-index: 2;
        -webkit-print-color-adjust: exact;
       /* print-color-adjust */
        color-adjust: exact;
      
    }

    .report_content_border {
        position: fixed;
        height: 98%;
        width: 97%;
        overflow: hidden;

        

        /* left: -28%;
        top: -10%; */

        left: 0;
        top: 0;
        
        /* display: flex;
        justify-content: center;
        align-self: center; */
    }


}
</style>

<?php
if(isset($_SESSION['checkCafReport']))
{

    echo '<style>

    #Cafeteria{
        display: none;
    }
    #cafe_report{
        display: flex;
    }
   
    #vendor_report{
        display: none;
    }
    #Vendor{
        display: none;
    }


    </style>';
}

if(isset($_SESSION['VendorReportExist']))
{
    // echo '<script>alert("hailat");</script>';

    echo '<style>

        #Cafeteria{
            display: none;
        }
        #vendor_report{
            display: flex;
        }
        #Vendor{
            display: none;
        }
        #cafe_report{
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
          <!-- <button type="button" id="notif"><i class="far fa-bell"></i><div class="badge">5</div></button>  -->
          <button type="button" id="user"> <div class="user_cover"> <i class="fas fa-user-circle"></i></div></button> 
            
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
            <a href="../userSettings/userSettings.php" class="notif_setting_stack">
                <h2> View Profile</h2>
            </a>


            <a href="../server.php?logout" class="notif_setting_stack">
                <h2>Log Out</h2>
            </a>
        </div>

    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <form id="bottom_left" action= "analysisCRUD.php" action = "POST">
            <a href="../homeAdmin.php?unset" class="btn"><i class="fas fa-home"></i>Home </a>
            <a href="../Analysis/analysisMain.php?unset" class="btn activeTab"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../foodVendor/foodVendorMain.php?unset" class="btn"><i class="fas fa-store"></i>Food Vendors </a>
            <a href="../accessCard/accessCardMain.php?unset" class="btn"><i class="fas fa-id-card"></i>Access Cards</a>
            <a href="../systemUsers/systemUsers.php?unset" class="btn"><i class="fas fa-user"></i>System Users</a>
        </form>

        <div class="bottom_right">
           <div class="analysis_cage">
                <div class="analysis_top">
                    <div class="report_type">
                        <button class="tablinks tab_defaultColour tab_colour " onclick="openCity(event, 'Cafeteria'); analysisCafeteria();">Cafeteria Report</button>
                        <button class="tablinks tab_defaultColour" onclick="openCity(event, 'Vendor'); analysisVendor();" >Vendor Report</button>
                    </div>

                    <!-- <form action="" class="report_search">
                        <input type="search" placeholder="Search"> <i class="fas fa-search"></i>
                    </form> -->
                </div>

                <div class="analysis_bottom">
                  
                    <div id="Cafeteria" class="tabcontent">
                        <div id="barchart_material" class="test" style="width: 100%; height: 90%;"></div>
                        <div class="report_displayType">
                            <div class="report_type_button tab_colour">
                                Chart View 
                            </div>

                            <div class="report_type_button tablinks" onclick="openCity(event, 'cafe_report');">
                                Report View
                            </div>

                            
                        </div>
                    </div>

                    <div id="cafe_report" class="tabcontent">
                        <div class="report_cage">
                            <div class="report_topbar">
                               <div class="report_top_title">
                                    Please Select The Month :
                                </div>

                                <form action="analysisCRUD.php" method="POST" class = "selectform">
                                    <select id="month" name = "month" class="report_comboBox" >
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">Octorber</option>
                                        <option value="11">November</option>
                                        <option value="12">Decemeber</option>                                        
                                    </select>
                                

                               
                                <button type = "submit" id = "monthBtn" name = "CafmonthBtn" >Select</button>
                                </form>
                                <button id="print_button" onclick="window.print();">Print</button>

                            </div>

                            <div class="report_content_cage">
                                <div class="report_content_border">
                                    <div class="report_content_insideCage">
                                        <div class="report_inside_title">
                                            APU Cafeteria Management System Monthly Sales Report
                                        </div>

                                        <div class="report_info_bar">
                                            <div class="report_info_detail">
                                                User ID: <?php echo @$_SESSION['loginID']; ?>
                                            </div>


                                            <div class="report_info_detail">
                                                User Name: <?php echo @$_SESSION['loginName']; ?>
                                            </div>
                                        </div>

                                        <div class="report_info_bar">
                                            <div class="report_info_detail">
                                                User Role: <?php echo @$_SESSION['loginRole']; ?>
                                            </div>

                                            <div class="report_info_detail">
                                                Current Date: <?php @$today = date("d/m/Y"); echo $today; ?>
                                            </div>
                                        </div>


                                        <table class="report_table">
                                            <tr>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Food Vendor</th>
                                                <th>Total Sales</th>
                                            </tr>


                                            <?php 
                                                 ///***********************************************ALWAYS BREAK JS HERE************************* */
                                                //echo $_SESSION['monthValue'];
                                                @$vendorIDArray = array();
                                                @$foodIDArray = array();
                                                @$foodCategoryArray = array();
                                                @$CalAmountArray = array();
                                                @$CalRefundArray = array();
                                                @$totalProfit = array();
                                                @$thisYear = date("Y");
                                                @$thisMonth = intval(date('m'));//will echo 3
                                                @$TablemonthName = date("F");
                                                @$GrandTotalArray = 0;
                                                
                                                if(isset($_SESSION['checkCafReport']))
                                                {
                                                    //LOAD DATA OF CURRENT MONTH
                                                    @$selectedMonth =  $_SESSION['monthValue'];
                                                    @$dateObj   = DateTime::createFromFormat('!m', $_SESSION['monthValue']);
                                                    @$monthName = $dateObj->format('F'); 
                                                    
  
                                                    //LOAD DATA ACCORDING TO GIVEN DATA
                                                    //GET VENDOR INFORMATION
                                                    @$selectVendor = "SELECT * FROM `vendor`";
                                                    @$selectVendor_run = mysqli_query($con, $selectVendor);

                                                    while($selectVendor_run_rows = mysqli_fetch_assoc($selectVendor_run))
                                                    {
                                                        @$vendorIDArray[] = $selectVendor_run_rows['vendor_id'];
                                                    }

                                                    //GET FOOD INFORMATION BASED ON VENDOR ID 
                                                    for($i = 0; $i< count($vendorIDArray); $i++)
                                                    {
                                                        @$selectView = "SELECT `vendorID`, SUM(totalPrice) AS Sales FROM calamount WHERE vendorID = '".$vendorIDArray[$i]."' AND NumberOfMonth = '$selectedMonth' ";
                                                        @$selectView_run = mysqli_query($con, $selectView);
                                                        @$selectView_run_rows = mysqli_fetch_assoc($selectView_run);

                                                        @$selectRefund = "SELECT * FROM calrefund WHERE vendorID = '".$vendorIDArray[$i]."'  AND NumberOfMonth = '$selectedMonth' ";
                                                        @$selectRefund_run = mysqli_query($con, $selectRefund);
                                                        @$selectRefund_run_rows = mysqli_fetch_assoc($selectRefund_run);

                                                        @$totalProfit = $selectView_run_rows['Sales'] - $selectRefund_run_rows['totalRefundPrice'];                                                    
                                                        @$GrandTotalArray = $GrandTotalArray + $totalProfit;
                                                        
                                                        if($i == 0)
                                                        {
                                                            echo "<tr>";
                                                                echo '<td style="font-weight: bold;">'.$thisYear.'</td>';
                                                                echo '<td>'.@$monthName.'</td>'; //*****REMEMBER TO INCLUDE $_POSTFOR DATE */   
                                                                echo "<td>".$vendorIDArray[$i]."</td>";
                                                                echo '<td>RM'.$totalProfit."</tr> ";
                                                            echo "</tr>";

                                                        }else{
                                                            echo "<tr>";
                                                                echo '<td></td>';
                                                                echo '<td></td>';
                                                                echo "<td>".@$vendorIDArray[$i]."</td>";
                                                                echo '<td>RM'.@$totalProfit."</tr> ";
                                                            echo "</tr>";
                                                        }
                                                        
                                                    }
                                                    if($i = count($vendorIDArray))
                                                        {
                                                            echo '<tr>';
                                                                echo '<th>Grand Total</th>';
                                                                echo '<td></td>'; 
                                                                echo '<td></td>';
                                                                echo '<td>RM'.@$GrandTotalArray.'</td>'; 
                                                            echo '</tr>';
                                                            
                                                        }

                                            

                                                }
                                                else
                                                {

                                                
                                                    //GET VENDOR INFORMATION
                                                    @$selectVendor = "SELECT * FROM `vendor`";
                                                    @$selectVendor_run = mysqli_query($con, $selectVendor);

                                                    while($selectVendor_run_rows = mysqli_fetch_assoc($selectVendor_run))
                                                    {
                                                        @$vendorIDArray[] = $selectVendor_run_rows['vendor_id'];
                                                    }

                                                    // GET FOOD INFORMATION BASED ON VENDOR ID 
                                                    for($i = 0; $i< count($vendorIDArray); $i++)
                                                    {
                                                        @$selectView = "SELECT `vendorID`, SUM(totalPrice) AS Sales FROM calamount WHERE vendorID = '".$vendorIDArray[$i]."' AND NumberOfMonth = '$thisMonth' ";
                                                        @$selectView_run = mysqli_query($con, $selectView);
                                                        @$selectView_run_rows = mysqli_fetch_assoc($selectView_run);

                                                        @$selectRefund = "SELECT * FROM calrefund WHERE vendorID = '".$vendorIDArray[$i]."'  AND NumberOfMonth = '$thisMonth'";
                                                        @$selectRefund_run = mysqli_query($con, $selectRefund);
                                                        @$selectRefund_run_rows = mysqli_fetch_assoc($selectRefund_run);

                                                        @$totalProfit = $selectView_run_rows['Sales'] - $selectRefund_run_rows['totalRefundPrice'];                                                    
                                                        @$GrandTotalArray = $GrandTotalArray + $totalProfit;
                                                        
                                                        if($i == 0)
                                                        {
                                                            echo "<tr>";
                                                                echo '<td style="font-weight: bold;">'.@$thisYear.'</td>';
                                                                echo '<td>'.@$TablemonthName.'</td>'; //*****REMEMBER TO INCLUDE $_POSTFOR DATE */   
                                                                echo "<td>".@$vendorIDArray[$i]."</td>";
                                                                echo '<td>RM'.@$totalProfit."</tr> ";
                                                            echo "</tr>";

                                                        }else{
                                                            echo "<tr>";
                                                                echo '<td></td>';
                                                                echo '<td></td>';
                                                                echo "<td>".@$vendorIDArray[$i]."</td>";
                                                                echo '<td>RM'.@$totalProfit."</tr> ";
                                                            echo "</tr>";
                                                        }
                                                        
        
                                                    }

                                                    if($i = count($vendorIDArray))
                                                        {
                                                            echo '<tr>';
                                                                echo '<th>Grand Total</th>';
                                                                echo '<td></td>'; 
                                                                echo '<td></td>';
                                                                echo '<td>RM'.@$GrandTotalArray.'</td>'; 
                                                            echo '</tr>';
                                                            
                                                        }
                                                }
                                        
                                            ?>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="report_displayType">
                            <div class="report_type_button tablinks" onclick="openCity(event, 'Cafeteria'); analysisCafeteria();">
                                Chart View
                            </div>

                            <div class="report_type_button tab_colour">
                                Report View
                            </div>
                        </div>
                    </div>

                    
                    
                    <div id="Vendor" class="tabcontent">
                        <div id="columnchart_values" style="width: 100%; height: 90%; "></div>
                        <div class="report_displayType">
                            <div class="report_type_button tab_colour">
                                Chart View
                            </div>

                            <div class="report_type_button tablinks" onclick="openCity(event, 'vendor_report');">
                                Report View
                            </div>
                        </div>
                    </div>

                    <div id="vendor_report" class="tabcontent">
                        <div class="report_cage">
                            <div class="report_topbar">
                               <div class="report_top_title">
                                    Please Select The Month :
                                </div>


                                <form action="analysisCRUD.php" method="POST" class = "selectform" required>
                                    <select id="Vendormonth" name = "vendorReportMonth" class="report_comboBox">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>773
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">Octorber</option>
                                        <option value="11">November</option>
                                        <option value="12">Decemeber</option>                                        
                                    </select>


                                    <select id="loopVendor" name = "VendorOption" class="report_comboBox" required>
                                        <?php
                                            @$selectVendorOption = "SELECT * FROM vendor ";
                                            @$selectVendorOption_run = mysqli_query($con, $selectVendorOption);
                                            
                                            while($selectVendorOption_run_rows = mysqli_fetch_assoc($selectVendorOption_run))
                                            {
                                                echo '<option values = '.$selectVendorOption_run_rows['vendor_id'].'>'.$selectVendorOption_run_rows['vendor_id'].'</option>';

                                            }

                                        ?>                                      
                                    </select>

                                    <button type = "submit" id = "vendorReportBtn" name = "vendorReportBtn">Select</button>
                                </form>
                                <button id="print_button" onclick="window.print();">Print</button>

                            </div>

                            <div class="report_content_cage">
                                <div class="report_content_border">
                                    <div class="report_content_insideCage">
                                        <div class="report_inside_title">
                                            APU VENDOR Sales Report
                                        </div>

                                        <div class="report_info_bar">
                                            <div class="report_info_detail">
                                                User: <?php echo @$_SESSION['loginName']; ?>
                                            </div>

                                            <div class="report_info_detail">
                                                Current Date: <?php @$today = date("d/m/Y"); echo $today; ?>
                                            </div>
                                        </div>

                                        <div class="report_info_bar">
                                              <div class="report_info_detail">
                                                Role:<?php echo @$_SESSION['loginRole']; ?>
                                            </div>

                                            <div class="report_info_detail">
                                                Page: 1 out of 1
                                            </div>
                                        </div>

                                        <table class="report_table">
                                            <tr>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Food Vendor</th>
                                                <th>Food Category</th>
                                                <th>Sum of Quantity</th>
                                                <th>Total Sales</th>
                                            </tr>

                                            <?php

                                                $j = 0;
                                                $grandTotal = 0;                                               

                                                if(isset($_SESSION['vendorReportMonth'],$_SESSION['VendorOption']))
                                                {
                                                
                                                    @$getFood = "SELECT * FROM viewfoodcategory WHERE vendorID = '".$_SESSION['VendorOption']."' GROUP BY foodCategory";
                                                    @$getFood_run = mysqli_query($con, $getFood);
                                                    
                                                    
                                                    while($getFood_run_rows = mysqli_fetch_assoc($getFood_run))
                                                    {
                                                        // $foodIDArray[] = $getFood_run_rows['food_id'];
                                                        @$foodCategoryArray[] = $getFood_run_rows['foodCategory'];
                                                        // echo $foodCategoryArray[$j];
                                                        @$j++;
                                                    }   
                                                    $k=0;
                                                    for($j=0; $j < count($foodCategoryArray); $j++)
                                                    {
                                                        
                                                        
                                                        @$selectVenView = "SELECT vendorID, MonthNumber, FoodID, foodCategory, FoodName, FoodPrice, 
                                                        SUM(orderQuantity) , SUM(totalAmount) as Sales

                                                        FROM `viewfoodcategory`
                                                        WHERE vendorID = '".$_SESSION['VendorOption']."' AND MonthNumber = '".$_SESSION['vendorReportMonth']."' AND foodCategory ='".$foodCategoryArray[$j]."' AND orderQuantity > 0
                                                        GROUP BY foodCategory";
                                                        @$selectVenView_run = mysqli_query($con, $selectVenView);

                                                        // $totalProfit = $selectView_run_rows['Sales'] - $selectRefund_run_rows['totalRefundPrice'];     
                                                    
                                                        while($selectFoodOrders = mysqli_fetch_assoc($selectVenView_run))
                                                        {
                                                            @$grandTotal += $selectFoodOrders['Sales'];
                                                            // echo $foodIDArray[$j];
                                                            if(mysqli_num_rows($selectVenView_run) >0)
                                                            {
                                                                
                                                                if($k == 0)
                                                                {
                                                                        
                                                                        echo '<tr>';
                                                                            echo '<td>'.@$thisYear.'</td>';
                                                                            echo '<td>'.@$TablemonthName.'</td>';
                                                                            echo '<td>'.@$selectFoodOrders['vendorID'].'</td>';
                                                                            echo '<td>'.@$selectFoodOrders['foodCategory'].'</td>';
                                                                            echo '<td>'.@$selectFoodOrders['SUM(orderQuantity)'].'</td>';
                                                                            echo '<td>'.@$selectFoodOrders['Sales'].'</td>';
                                                                        echo '</tr>';
                                                                        
                                                                }else{
                                                                    echo '<tr>';
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        echo '<td>'.@$selectFoodOrders['foodCategory'].'</td>';
                                                                        echo '<td>'.@$selectFoodOrders['SUM(orderQuantity)'].'</td>';
                                                                        echo '<td>'.@$selectFoodOrders['Sales'].'</td>';
                                                                    echo '</tr>';
                                                                    
                                                                }

                                                            }
                                                        
                                                            @$k++;
                                                            
                                                        }
                                                    }

                                                    if($j = count($foodCategoryArray))
                                                    {
                                                        echo '<tr>';
                                                        echo '<th>Grand Total</th>';
                                                        echo '<td></td>'; 
                                                        echo '<td></td>';
                                                        echo '<td></td>';
                                                        echo '<td></td>';
                                                        echo '<td>RM'.@$grandTotal.'</td>'; 
                                                        echo '</tr>';
                                                    }

                                                }else{
                                                    echo "default";
                                                    @$selectVdr = "SELECT * FROM `vendor`";
                                                    @$selectVdr_run = mysqli_query($con, $selectVdr);

                                                    while($selectVdr_run_rows = mysqli_fetch_assoc($selectVdr_run))
                                                    {
                                                        @$vrdIDArray[] = $selectVdr_run_rows['vendor_id'];
                                                    }
                                                   @ $defaultVid = $vrdIDArray[0];
                                                    
                                                    @$getFood = "SELECT * FROM viewfoodcategory WHERE vendorID = '$defaultVid' AND MonthNumber = '$thisMonth' GROUP BY foodCategory";
                                                    @$getFood_run = mysqli_query($con, $getFood);
                                                    
                                                    
                                                    while($getFood_run_rows = mysqli_fetch_assoc($getFood_run))
                                                    {
                                                        // $foodIDArray[] = $getFood_run_rows['food_id'];
                                                        @$foodCategoryArray[] = $getFood_run_rows['foodCategory'];
                                                        // echo $foodCategoryArray[$j];
                                                        @$j++;
                                                    }   
                                                    @$k=0;
                                                    for($j=0; $j < count($foodCategoryArray); $j++)
                                                    {
                                                        
                                                        
                                                        @$selectVenView = "SELECT vendorID, MonthNumber, FoodID, foodCategory, FoodName, FoodPrice, 
                                                        SUM(orderQuantity) , SUM(totalAmount) as Sales

                                                        FROM `viewfoodcategory`
                                                        WHERE vendorID = '$defaultVid' AND MonthNumber = '$thisMonth' AND foodCategory ='".$foodCategoryArray[$j]."' AND orderQuantity > 0
                                                        GROUP BY foodCategory";
                                                        @$selectVenView_run = mysqli_query($con, $selectVenView);

                                                        while($selectFoodOrders = mysqli_fetch_assoc($selectVenView_run))
                                                        {
                                                            $grandTotal += $selectFoodOrders['Sales'];
                                                            // echo $foodIDArray[$j];
                                                            if(mysqli_num_rows($selectVenView_run) >0)
                                                            {
                                                                
                                                                if($k == 0)
                                                                {
                                                                        
                                                                        echo '<tr>';
                                                                            echo '<td>'.$thisYear.'</td>';
                                                                            echo '<td>'.$TablemonthName.'</td>';
                                                                            echo '<td>'.$selectFoodOrders['vendorID'].'</td>';
                                                                            echo '<td>'.$selectFoodOrders['foodCategory'].'</td>';
                                                                            echo '<td>'.$selectFoodOrders['SUM(orderQuantity)'].'</td>';
                                                                            echo '<td>'.$selectFoodOrders['Sales'].'</td>';
                                                                        echo '</tr>';
                                                                        
                                                                }else{
                                                                    echo '<tr>';
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        echo '<td>'.$selectFoodOrders['foodCategory'].'</td>';
                                                                        echo '<td>'.$selectFoodOrders['SUM(orderQuantity)'].'</td>';
                                                                        echo '<td>'.$selectFoodOrders['Sales'].'</td>';
                                                                    echo '</tr>';
                                                                }
                                                            }
                                                            $k++;
                                                        }
                                                    }

                                                    if($j = count($foodCategoryArray))
                                                    {
                                                        echo '<tr>';
                                                        echo '<th>Grand Total</th>';
                                                        echo '<td></td>'; 
                                                        echo '<td></td>';
                                                        echo '<td></td>';
                                                        echo '<td></td>';
                                                        echo '<td>RM'.$grandTotal.'</td>'; 
                                                        echo '</tr>';
                                                    }

                                                }

                                            ?>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="report_displayType">
                            <div class="report_type_button tablinks" onclick="openCity(event, 'Vendor'); analysisCafeteria();">
                                Chart View 
                            </div>

                            <div class="report_type_button tab_colour">
                                Report View
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           
        </div>
    </div>

    <?php

        @$arrVendorID = array();
        @$month = date('m', time());
        @$arrColor = array('#EA4A10', '#3048D1', '#6C1C82', '#F4826E', '#ACBEA3', '#581535', '#ffc305', 'c70039' );
        @$getGraphVendorID= "SELECT * FROM vendorgraphcategory group by vendorID ";
        @$getGraphVendorID_run = mysqli_query($con, $getGraphVendorID);

        while($getGraphVendorID_run_rows = mysqli_fetch_assoc($getGraphVendorID_run))
        {
            // $foodIDArray[] = $getFood_run_rows['food_id'];
            @$arrVendorID[] = $getGraphVendorID_run_rows['vendorID'];
            // echo $foodCategoryArray[$j];
        } 



        //BAR CHARTS FOR CAFETERIA REPORT 
        @$middleVendorSales= "";   
        for($i = 0; $i < count($arrVendorID); $i++){
            @$graphSales  = "SELECT vendorName, SUM(totalAmount) FROM `admingraphtotalsales` WHERE vendorID = '".$arrVendorID[$i]."' GROUP BY vendorID  ";
            @$graphSales_run = mysqli_query($con, $graphSales);
            while($graphSales_run_rows = mysqli_fetch_assoc($graphSales_run)){
                if($i == 0){
                    @$firstVendorSales = '[\''.$graphSales_run_rows['vendorName'].'\', '.$graphSales_run_rows['SUM(totalAmount)'].', \'color: '.$arrColor[$i].'\'], ';
                }else if ($i == count($arrVendorID)-1  ){
                    @$lastVendorSales = '[\''.$graphSales_run_rows['vendorName'].'\', '.$graphSales_run_rows['SUM(totalAmount)'].', \''.$arrColor[$i].'\'] ';
                }else{
                    @$middleVendorSales .= '[\''.$graphSales_run_rows['vendorName'].'\', '.$graphSales_run_rows['SUM(totalAmount)'].', \''.$arrColor[$i].'\'], ';
                }
            }

        }



        //BAR CHARTS FOR VENDOR REPORT 
        //SHOWS SALES OF EACH CATEGORY OF VENDOR
        $getGraphVid= "SELECT * FROM vendorgraphcategory group by vendorID ";
        $getGraphVid_run = mysqli_query($con, $getGraphVid);
        $arrayVendorID = array();
        while($getGraphVid_run_rows = mysqli_fetch_assoc($getGraphVid_run))
        {
            $arrayVendorID[] = $getGraphVid_run_rows['vendorID'];
        } 

        $middleTopCategory = "";
        for($i = 0; $i < count($arrayVendorID); $i++){
            
            $arrayCategory = array();
            $getCategory = "SELECT SUM(`totalAmount`) as `topFood`, foodCategory, vendorName FROM admingraphtotalsales WHERE vendorID = '".$arrayVendorID[$i]."' GROUP BY foodCategory ORDER BY `totalAmount` DESC limit 1";
            $getCategory_run = mysqli_query($con, $getCategory);
            while($getFood_run_rows = mysqli_fetch_assoc($getCategory_run)){
                // $arrayCategory[] = $getFood_run_rows['foodCategory'];

                if($i == 0){
                    $firstTopCategory = '[\''.$getFood_run_rows['vendorName'].'\n '.$getFood_run_rows['foodCategory'].'\', '.$getFood_run_rows['topFood'].', \'color: '.$arrColor[$i].'\'], ';
                }else if ($i == count($arrVendorID)-1  ){
                    $lastTopCategory = '[\''.$getFood_run_rows['vendorName'].'\n '.$getFood_run_rows['foodCategory'].'\', '.$getFood_run_rows['topFood'].', \''.$arrColor[$i].'\'] ';
                }else{
                    $middleTopCategory .= '[\''.$getFood_run_rows['vendorName'].'\n '.$getFood_run_rows['foodCategory'].'\', '.$getFood_run_rows['topFood'].', \''.$arrColor[$i].'\'], ';
                }
                
            }

        }

    
    
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/tabColour.js"></script>
    <script type="text/javascript" src="../linkFiles/charts.js"></script>
    <script type="text/javascript" src="../linkFiles/headerModal.js"></script>
    <script type="text/javascript" src="../linkFiles/headerModal.js"></script>
    <script type="text/javascript" src="../linkFiles/print.js"></script>
    <script>
        //!!!For ANALYSIS PAGE
        //Stacked bar chart for Cafeteria Report (Analysis Page)
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(analysisCafeteria);

        function analysisCafeteria() {
        var data = google.visualization.arrayToDataTable([
            ['Vendor', 'Sales (RM)', { role: 'style' }],
            <?php echo $firstVendorSales.$middleVendorSales.$lastVendorSales;?>
        ]);

        var options = {
            chart: {
            title: 'Vendor Sales of <?php echo date("F", strtotime('m')); ?>',
            subtitle: 'Total sales of current month from each of the vendor',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
        }


        //////
        
//Column chart for Vendor Report (Analysis Page)
google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(analysisVendor);
function analysisVendor() {
    var data = google.visualization.arrayToDataTable([
            ["Vendor", "Top Sales", { role: "style" }],
            <?php echo $firstTopCategory.$middleTopCategory.$lastTopCategory;?>
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                    { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                    2]);

    var options = {
        title: "TOP CATEGORY SALES OF VENDORS   ",
        fontSize: 20,
        bar: {groupWidth: "95%"},
 
        //legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
}


    
    
    
    
    
    </script>
    

   
</body>
</html>
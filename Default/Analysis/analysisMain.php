<?php
    include('foodVendorAnalysisCRUD.php');
    if(isset($_GET['unset']))
    {
        unset($_SESSION['VendorReportExist']);
        unset($_SESSION['orderCompleted']);
        unset($_SESSION['cannotUpdate']);
        

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

    width: 70%;
    height: 100%;

    display: flex;
    align-items: center;
}

.report_type button {
    outline: 0;
    border: 0;

    width: 220px;
    height: 50px;

    margin-left: 30px;

    font-size: 1.5em;
    word-wrap: break-word;
    
    font-family:  'Heebo', Arial, sans-serif;
    color:white;
    background-color:#427AA1;
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
    height: calc(100% - 110px);
    

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
    background-color: #427AA1;
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

    color: white;

    margin: 0px 25px;
}

#select_month{
    display:flex;
}

.report_comboBox {
    outline: none;
    border: none;

    font-size: 1.6em;
    font-family:  'Heebo', Arial, sans-serif;

    padding: 0px 15px;
    border-radius: 50px;
    color: #427AA1;
}

#print_button, #vendorReportBtn {
    outline: none;
    border: none;

    font-size: 1.6em;
    font-family:  'Heebo', Arial, sans-serif;

    padding: 0px 15px;
    border-radius: 50px;

    margin-left: auto;
    margin-right: 5%;
    color: #427AA1;
    background-color:white;
}
#vendorReportBtn{
    margin-left: 10%;
}

.report_content_cage {
    width: 100%;
    height: 100%;

    background-color: #EBF2FA;

    display: flex;
    justify-content: center;
    align-items: flex-start;

    overflow-y: scroll;
    overflow-x: hidden;
}

.report_content_border {
    border: 1px solid black;

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
    color:#427AA1;

    display: flex;
    flex-direction: column;
    align-items: center;
}

.report_inside_title {
    width: 100%;
    height: fit-content;
    padding: 20px 0px;

    background-color: #427AA1;
    color:white;

    font-size: 2em;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
}

.report_info_bar {
    width: 90%;
    height: fit-content;
    padding: 25px 0;

    display: flex;
    justify-content: space-around;
    font-size: 1.5em;
    font-family: 'Times New Roman', Times, serif;
}

.report_info_detail {
    min-width: 10em;
}

.report_table {
    width: 100%;
}

.report_table tr *{
    border: 1px solid #427AA1;

    text-align: center;
    font-size: 1.3em;
    /*font-family: 'Times New Roman', Times, serif;*/
    padding: 15px 0px;

    width: fit-content;
}

td i {
	font-size: 1px;
	background-color: #EBF2FA;
}

/* Open Cafeteria page first */
#Cafeteria {
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

    if(isset($_SESSION['VendorReportExist']))
    {
        // echo '<script>alert("hailat");</script>';

        echo '<style>

            #Cafeteria{
                display: none;
            }
            #cafe_report{
                display: flex;
            }
          
            
            </style>';
    }

    if(isset($_SESSION['orderCompleted'])){
        
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
          <button type="button" id="user"> <div class="user_cover"> <i class="fas fa-user-circle"></i></div></button> 
            
        </form>

        <div class="notif_setting_cage">
            <a href="../userSettings/userSettings.php" class="notif_setting_stack">
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
            <a href="../Analysis/analysisMain.php?unset" class="btn activeTab"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../order/order.php?unset" class="btn"><i class="fas fa-store"></i>Order </a>
            <a href="../Transaction/Transaction.php?unset" class="btn"><i class="fas fa-id-card"></i>Transaction</a>
            <a href="../employee/employee.php?unset" class="btn"><i class="fas fa-user"></i>Employee</a>
			<a href="../Menu/menu.php?unset" class="btn"><i class="fas fa-book-open"></i>Food Menu</a>
			
        </div>

        <div class="bottom_right">
           <div class="analysis_cage">
                <div class="analysis_top">
                    <div class="report_type">
                        <button class="tablinks" onclick="openCity(event, 'Cafeteria'); analysisCafeteria();">Sales Report</button>
                    </div>

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

                                <form action="foodVendorAnalysisCRUD.php" method = "POST" id = "select_month">
                                    <select id="Vendormonth" name = "vendorReportMonth" class="report_comboBox">
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
                                <button type = "submit" id = "vendorReportBtn" name = "vendorReportBtn">Select</button>
                                </form>

                                <button id="print_button" onclick="window.print();">Print</button>
                            </div>

                            <div class="report_content_cage">
                                <div class="report_content_border">
                                    <div class="report_content_insideCage">
                                        <div class="report_inside_title">
                                            Monthly Sales Report
                                        </div>

                                        <div class="report_info_bar">
                                            <div class="report_info_detail">
                                                User:  <?php echo $_SESSION['loginName']; ?>
                                            </div>

                                            <div class="report_info_detail">
                                                Current Date: <?php $today = date("d/m/Y"); echo $today; ?>
                                            </div>
                                        </div>

                                        <div class="report_info_bar">
                                            <div class="report_info_detail">
                                                Role: <?php echo $_SESSION['loginRole']; ?>
                                            </div>

                                            <div class="report_info_detail">
                                                Vendor ID : <?php echo $_SESSION['loginRelatedVendor'];?>
                                            </div>
                                        </div>

                                        <table class="report_table">
                                            <tr>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Food Category</th>
                                                <th>Sum of Quantity</th>
                                                <th>Total Sales</th>
                                            </tr>

                                           
                                            <?php


                                                $vendorIDArray = array();
                                                $foodIDArray = array();
                                                $foodCategoryArray = array();
                                                $CalAmountArray = array();
                                                $CalRefundArray = array();
                                                $totalProfit = array();
                                                $thisYear = date("Y");
                                                $thisMonth = intval(date('m'));//will echo 3
                                                $TablemonthName = date("F");//will print April
                                                $GrandTotalArray = 0;
                                                $j = 0;
                                                $grandTotal = 0;                                               

                                                if(isset($_SESSION['vendorReportMonth']))
                                                {

                                                    //LOAD DATA OF CURRENT MONTH
                                                    $dateObj   = DateTime::createFromFormat('!m', $_SESSION['vendorReportMonth']);
                                                    $selectedMonth = $dateObj->format('F'); 

                                                    
                                                    $getFood = "SELECT * FROM viewfoodcategory WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' GROUP BY foodCategory";
                                                    $getFood_run = mysqli_query($con, $getFood);
                                                    
                                                    
                                                    while($getFood_run_rows = mysqli_fetch_assoc($getFood_run))
                                                    {
                                                        // $foodIDArray[] = $getFood_run_rows['food_id'];
                                                        $foodCategoryArray[] = $getFood_run_rows['foodCategory'];
                                                        // echo $foodCategoryArray[$j];
                                                        $j++;
                                                    }   
                                                    $k=0;



                                                    for($j=0; $j < count($foodCategoryArray); $j++)
                                                    {
                                                        
                                                        
                                                        $selectVenView = "SELECT vendorID, MonthNumber, FoodID, foodCategory, FoodName, FoodPrice, 
                                                        SUM(orderQuantity) , SUM(totalAmount) as Sales

                                                        FROM `viewfoodcategory`
                                                        WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' AND MonthNumber = '".$_SESSION['vendorReportMonth']."' AND foodCategory ='".$foodCategoryArray[$j]."' AND orderQuantity > 0
                                                        GROUP BY foodCategory";
                                                        $selectVenView_run = mysqli_query($con, $selectVenView);

                                                        // $totalProfit = $selectView_run_rows['Sales'] - $selectRefund_run_rows['totalRefundPrice'];     
                                                    
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
                                                                            echo '<td>'.$selectedMonth.'</td>';
                                                                            
                                                                            // // echo '<td>'.$selectFoodOrders['MonthNumber'].'</td>';
                                                                            // // echo $selectFoodOrders['FoodID'].'</td>';
                                                                            echo '<td>'.$selectFoodOrders['foodCategory'].'</td>';
                                                                            // // echo $selectFoodOrders['FoodName']."<br>";
                                                                            // // echo $selectFoodOrders['FoodPrice']."<br>";
                                                                            echo '<td>'.$selectFoodOrders['SUM(orderQuantity)'].'</td>';

                                                                            echo '<td>'.$selectFoodOrders['Sales'].'</td>';
                                                                        echo '</tr>';
                                                                        
                                                                }else{
                                                                    echo '<tr>';
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        // // echo '<td>'.$selectFoodOrders['MonthNumber'].'</td>';
                                                                        // // echo $selectFoodOrders['FoodID'].'</td>';
                                                                        echo '<td>'.$selectFoodOrders['foodCategory'].'</td>';
                                                                        echo '<td>'.$selectFoodOrders['SUM(orderQuantity)'].'</td>';
                                                                        // // echo $selectFoodOrders['FoodPrice']."<br>";
                                                                        echo '<td>'.$selectFoodOrders['Sales'].'</td>';

                                                                        // echo '<td>'.$selectFoodOrders['(FoodPrice * SUM(orderQuantity))'].'</td>';
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
                                                        echo '<td>RM'.$grandTotal.'</td>'; 
                                                        echo '</tr>';
                                                    }

                                                }else{
                                                    
                                                    $getFood = "SELECT * FROM viewfoodcategory WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' GROUP BY foodCategory";
                                                    $getFood_run = mysqli_query($con, $getFood);
                                                    
                                                    
                                                    while($getFood_run_rows = mysqli_fetch_assoc($getFood_run))
                                                    {
                                                        // $foodIDArray[] = $getFood_run_rows['food_id'];
                                                        $foodCategoryArray[] = $getFood_run_rows['foodCategory'];
                                                        // echo $foodCategoryArray[$j];
                                                        $j++;
                                                    }   
                                                    $k=0;



                                                    for($j=0; $j < count($foodCategoryArray); $j++)
                                                    {
                                                        
                                                        
                                                        $selectVenView = "SELECT vendorID, MonthNumber, FoodID, foodCategory, FoodName, FoodPrice, 
                                                        SUM(orderQuantity) , SUM(totalAmount) as Sales

                                                        FROM `viewfoodcategory`
                                                        WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' AND MonthNumber = '$thisMonth' AND foodCategory ='".$foodCategoryArray[$j]."' AND orderQuantity > 0
                                                        GROUP BY foodCategory";
                                                        $selectVenView_run = mysqli_query($con, $selectVenView);

                                                        // $totalProfit = $selectView_run_rows['Sales'] - $selectRefund_run_rows['totalRefundPrice'];     
                                                    
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
                                                                            
                                                                            // // echo '<td>'.$selectFoodOrders['MonthNumber'].'</td>';
                                                                            // // echo $selectFoodOrders['FoodID'].'</td>';
                                                                            echo '<td>'.$selectFoodOrders['foodCategory'].'</td>';
                                                                            // // echo $selectFoodOrders['FoodName']."<br>";
                                                                            // // echo $selectFoodOrders['FoodPrice']."<br>";
                                                                            echo '<td>'.$selectFoodOrders['SUM(orderQuantity)'].'</td>';

                                                                            echo '<td>'.$selectFoodOrders['Sales'].'</td>';
                                                                        echo '</tr>';
                                                                        
                                                                }else{
                                                                    echo '<tr>';
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        // // echo '<td>'.$selectFoodOrders['MonthNumber'].'</td>';
                                                                        // // echo $selectFoodOrders['FoodID'].'</td>';
                                                                        echo '<td>'.$selectFoodOrders['foodCategory'].'</td>';
                                                                        echo '<td>'.$selectFoodOrders['SUM(orderQuantity)'].'</td>';
                                                                        // // echo $selectFoodOrders['FoodPrice']."<br>";
                                                                        echo '<td>'.$selectFoodOrders['Sales'].'</td>';

                                                                        // echo '<td>'.$selectFoodOrders['(FoodPrice * SUM(orderQuantity))'].'</td>';
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
                            <div class="report_type_button tablinks" onclick="openCity(event, 'Cafeteria'); analysisCafeteria();">
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

    <?php
                        
        $arrCategory = array();
        $graphCategory= "SELECT * FROM vendorgraphcategory WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' GROUP BY foodcategory";
        $graphCategory_run = mysqli_query($con, $graphCategory);

        while($graphCategory_run_rows = mysqli_fetch_assoc($graphCategory_run))
        {
            // $foodIDArray[] = $getFood_run_rows['food_id'];
            $arrCategory[] = $graphCategory_run_rows['foodCategory'];
            // echo $foodCategoryArray[$j];
        }   
            $j = 0;//th counter
            $k=0;//tr counter
            $quadNum = $k +1;
 
        $secondValue = "";
        //LOAD DATA OUT FOR FIRST ROW
        for($i = 0; $i < count($arrCategory); $i++){
            // echo count($arrCategory);
            $selectQuarter  = "SELECT NumbofQuarter, SUM(totalAmount) FROM `vendorgraphcategory` WHERE foodCategory = '".$arrCategory[$i]."' ";
            $selectQuarter_run = mysqli_query($con, $selectQuarter);
            if($i == 0){
                $firstValue = '[\'Quarters within a year\', '."'$arrCategory[$i]'".", ";
                // $firstValueInt = (int)$firstValue;

            }else if($i == count($arrCategory)-1  ){
                $firstFinal = "'$arrCategory[$i]'"."],";

            }else{
                $secondValue .= "'$arrCategory[$i]'".", ";
            }

        } 

        $firstrowValue2 = "";
        //LOAD THE REST OF THE TABLE
        for($j = 0; $j < count($arrCategory); $j++){
            // echo $j+1 ;
            $selectQuarter  = "SELECT NumbofQuarter, SUM(totalAmount) FROM `vendorgraphcategory` WHERE foodCategory = '".$arrCategory[$j]."' AND NumbofQuarter = 1 ";
            $selectQuarter_run = mysqli_query($con, $selectQuarter);
            // $selectQuarter_run_rows = mysqli_fetch_assoc($selectQuarter_run);
            // echo $selectQuarter_run_rows['SUM(totalAmount)'];
            while($selectQuarter_run_rows = mysqli_fetch_assoc($selectQuarter_run)){
                if($j == 0){
                    $firstrowValue1 = '[\'Quarter 1\''.', '.$selectQuarter_run_rows['SUM(totalAmount)'].',';

                }else if ($j == count($arrCategory)-1  ){
                    $firstrowValue3 =  $selectQuarter_run_rows['SUM(totalAmount)'].'],';

                }else{
                    $firstrowValue2 .= $selectQuarter_run_rows['SUM(totalAmount)'].', ';

                }
            }

        }
        
        $secondrowValue2 = "";
        //LOAD THE REST OF THE TABLE
        for($j = 0; $j < count($arrCategory); $j++){
            // echo $j+1 ;
            $selectQuarter  = "SELECT NumbofQuarter, SUM(totalAmount) FROM `vendorgraphcategory` WHERE foodCategory = '".$arrCategory[$j]."' AND NumbofQuarter = 2 ";
            $selectQuarter_run = mysqli_query($con, $selectQuarter);
            // $selectQuarter_run_rows = mysqli_fetch_assoc($selectQuarter_run);
            // echo $selectQuarter_run_rows['SUM(totalAmount)'];
            while($selectQuarter_run_rows = mysqli_fetch_assoc($selectQuarter_run)){
                if($j == 0){
                    $secondrowValue1 = '[\'Quarter 2\', '.$selectQuarter_run_rows['SUM(totalAmount)'].', ';

                }else if ($j == count($arrCategory)-1  ){
                    $secondrowValue3 = $selectQuarter_run_rows['SUM(totalAmount)'].'],';

                }else{
                    $secondrowValue2 .= $selectQuarter_run_rows['SUM(totalAmount)'].', ';

                }
            }
        }

        $thirdrowValue2 = "";
        //LOAD THE REST OF THE TABLE
        for($j = 0; $j < count($arrCategory); $j++){
            // echo $j+1 ;
            $selectQuarter  = "SELECT NumbofQuarter, SUM(totalAmount) FROM `vendorgraphcategory` WHERE foodCategory = '".$arrCategory[$j]."' AND NumbofQuarter = 3 ";
            $selectQuarter_run = mysqli_query($con, $selectQuarter);
            // echo mysqli_affected_rows($con);
            if(mysqli_affected_rows($con) < 1){
                $noSecondQuarter = "['Quarter 3', 0, 0, 0, 0]";
            }else{
                while($selectQuarter_run_rows = mysqli_fetch_assoc($selectQuarter_run)){
                    if($j == 0){
                        $thirdrowValue1 =  '[\'Quarter 3\', '.$selectQuarter_run_rows['SUM(totalAmount)'].', ';
    
                    }else if ($j == count($arrCategory)-1  ){
                        $thirdrowValue3 = $selectQuarter_run_rows['SUM(totalAmount)'].'], ';
    
                    }else{
                        $thirdrowValue2 .=  $selectQuarter_run_rows['SUM(totalAmount)'].', ';
    
                    }
                }
            }
            
        }
        $fourthrowValue2 = "";
        //LOAD THE REST OF THE TABLE
        for($j = 0; $j < count($arrCategory); $j++){
            // echo $j+1 ;
            @$selectQuarter  = "SELECT NumbofQuarter, SUM(totalAmount) FROM `vendorgraphcategory` WHERE foodCategory = '".$arrCategory[$j]."' AND NumbofQuarter = 4 ";
            @$selectQuarter_run = mysqli_query($con, $selectQuarter);
            // echo mysqli_affected_rows($con);
            if(mysqli_affected_rows($con) < 1){
                $noForthQuarter = "['4th Quarter', 0, 0, 0, 0]";
            }else{
                while($selectQuarter_run_rows = mysqli_fetch_assoc($selectQuarter_run)){
                    if($j == 0){
                        @$fourthrowValue1 = '[\'Quarter 4\', '.$selectQuarter_run_rows['SUM(totalAmount)'].', ';

                    }else if ($j == count($arrCategory)-1  ){
                        @$fourthrowValue3 = $selectQuarter_run_rows['SUM(totalAmount)'].'] ';

                    }else{
                        @$fourthrowValue2 .= $selectQuarter_run_rows['SUM(totalAmount)'].', ';

                    }
                }
            }
            
        }

        @$checkTopQuarter = "SELECT * FROM `vendorgraphcategory` WHERE vendorID = '".$_SESSION['loginRelatedVendor']."'  and  `NumbofQuarter` LIMIT 1";
        @$checkTopQuarter_run = mysqli_query($con, $checkTopQuarter);
        @$checkTopQuarter_run_rows = mysqli_fetch_assoc($checkTopQuarter_run);
        // echo $checkTopQuarter_run_rows['NumbofQuarter'];

    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/tabColour.js"></script>
    <script type="text/javascript" src="../linkFiles/charts.js"></script>
    <script type="text/javascript" src="../linkFiles/headerModal.js"></script>
    <script type="text/javascript" src="../linkFiles/print.js"></script>
                                    
    <script>
        //!!!For ANALYSIS PAGE
        //Stacked bar chart for Cafeteria Report (Analysis Page)
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(analysisCafeteria);

        function analysisCafeteria() {
        var data = google.visualization.arrayToDataTable([

            <?php echo $firstValue.$secondValue.$firstFinal;?> 
            <?php 
                //quarter 1
                echo $firstrowValue1.$firstrowValue2.$firstrowValue3;
                

                //quarter 2
                if($checkTopQuarter_run_rows['NumbofQuarter'] >='2'){
                    echo $secondrowValue1.$secondrowValue2.$secondrowValue3;
                }else{
                   // echo $secondrowValue1.$secondrowValue2.$secondrowValue3;
                }

               
                //quarter 3
                if($checkTopQuarter_run_rows['NumbofQuarter'] >= '3'){
                    echo $thirdrowValue1.$thirdrowValue2.$thirdrowValue3;
                }else{
                }

                 //quarter 4
                 if($checkTopQuarter_run_rows['NumbofQuarter'] >='4'){
                    echo $fourthrowValue1.$fourthrowValue2.$fourthrowValue3;
                }else{
                }
            ?>
        ]);

        var options = {
            chart: {
            title: 'Food Vendors Performance',
            subtitle: 'Sales made within the year 2019 displayed quarterly',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    
    
    </script>

   
</body>
</html>
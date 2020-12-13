<?php

include('../../Admin/Default/server.php');

    //SECURE WEBPAGE WITH LOGIN ROLE TO AVOID UNAUTHORIZED ACCESSX
    if(!isset($_SESSION['loginRole'])){

        header('location: ../../Admin/Default/login.php');
        
    }

    $calTodaySales = "SELECT COUNT(orderID) FROM `orderfood` WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' AND transDate = CURRENT_DATE";
    $calTodaySales_run = mysqli_query($con, $calTodaySales);
    $calTodaySales_run_rows = mysqli_fetch_assoc($calTodaySales_run);

    $calPendingOrders = "SELECT COUNT(orderID) FROM orderFood WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' AND transDate = CURRENT_DATE AND order_status = 'INCOMPLETE' ";
    $calPendingOrders_run = mysqli_query($con, $calPendingOrders);
    $calPendingOrders_run_rows = mysqli_fetch_assoc($calPendingOrders_run);

    $calTotalEmployee = "SELECT COUNT(employee_id) FROM employee WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."' ";
    $calTotalEmployee_run = mysqli_query($con, $calTotalEmployee);
    $calTotalEmployee_run_rows = mysqli_fetch_assoc($calTotalEmployee_run);
    

?><!DOCTYPE html>
<html lang="en">
        
<head>
        
        

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<link rel="stylesheet" href="../Default/linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../Default/linkFiles/Modals_CSS/menu.css" type="text/css" />
<style>

body {
    color: #666666;
}

.stats_group {
    width: 50%;
    height: 100%;
}

.stats {
    width: 100%;
    height: 25%;
    text-align: center;
    display: flex;
}

.stat {
    width:50%;

    font-size: 20px;
    font-family:  'Lato', Arial, sans-serif;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.stat span {
    height:40px;
    margin-bottom: 20px;
}

.stat_circle {
    padding: 0px;
    margin: 0px auto;

    width: 80px;
    height: 80px;
    border-radius: 50px;

    background-color: Lightgrey;

    font-size: 42px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.complain {
    width: 100%;
    height: 75%;

    color: rgb(14, 14, 14);

    display: flex;
    justify-content: center;
    align-items: center;

}


.order_cage{
	width: 50%; 
    height: 100%;
 
    display:flex;
    justify-content:center;
    align-items:center;
}

.order_innercage {
    width: 95%;
    height: 95%;

    background-color: #FFFFFF;

    display:flex;
	flex-direction:column;
	justify-content:space-between;
	align-items:center;
}

.order_titlecage{
	width:100%;
	height:20%;
	display:flex;
	justify-content:center;
	align-items:center;

}

.order_title {
    width: 85%;
    height: 40%;
	margin-left:30px;
    color: #FA6304;

    font-size: 32px;
    font-family:  'Heebo', Arial, sans-serif;
    text-align: center;

    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.order_content{
	width:100%;
	height:80%;
	
	overflow: scroll;
    overflow-x: hidden;
}

.order_item{
	width:90%;
	height:15%;
	background-color:pink;

    margin: 0 auto;
    margin-top: 10px;
    margin-bottom: 15px; 

    color: rgb(102, 102, 102);
    background-color: rgb(209, 209, 209);

    border-radius: 25px;

    font-size: 20px;
    font-weight: bold;
    font-family:  'Lato', Arial, sans-serif;
   
    display: flex;
    justify-content: space-around;
    align-items: center;

}

.order_name{
	display:flex;
	flex-direction:column;
	
	
}

.order_itemname{
	font-size: 30px;
}

.order_itemdate{
	font-size: 15px;
}
/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/



</style>
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
            <a href="./userSettings/userSettings.php" class="notif_setting_stack">
                <h2> View Profile</h2>
            </a>

            <a href="../../Admin/Default/server.php?logout" class="notif_setting_stack notif_border">
                <h2>Log Out</h2>
            </a>
        </div>
    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <div id="bottom_left">
            <a href="./homeFoodvendor.php" class="btn activeTab"><i class="fas fa-home"></i>Home </a>
            <a href="./Analysis/analysisMain.php" class="btn"><i class="fas fa-chart-area"></i>Analysis </a>
            <a href="./order/order.php" class="btn"><i class="fas fa-store"></i>Order </a>
            <a href="./Transaction/Transaction.php" class="btn"><i class="fas fa-id-card"></i>Transaction</a>
            <a href="./employee/employee.php" class="btn"><i class="fas fa-user"></i>Employee</a>
			<a href="./Menu/menu.php" class="btn"><i class="fas fa-book-open"></i>Food Menu</a>
        </div>



        <div class="bottom_right">
            <div class="stats_group">
                <div class="stats">
                    <div class="stat left">
                        <span>Total Employee</span>

                        <div class="stat_circle"><?php echo $calTotalEmployee_run_rows['COUNT(employee_id)'];  ?></div>
                    </div>

                    <div class="stat mid">
                        <span>Today's Sales</span>

                        <div class="stat_circle"><?php echo $calTodaySales_run_rows['COUNT(orderID)'];   ?></div>
                    </div>

                    <div class="stat right">
                        <span>Pending Orders</span>

                        <div class="stat_circle"><?php echo $calPendingOrders_run_rows['COUNT(orderID)']; ?></div>
                    </div>
                </div>

                <div class="complain">
                        <div id="barchart_material" class="test" style="width: 90%; height: 70%;"></div>
                </div>

            </div>

			<div class="order_cage">

				<div class= "order_innercage">
				
					<div class= "order_titlecage">
						<div class="order_title">
						Orders
						</div>
					</div>
				
					<div class= "order_content">
						
		
                        <?php
                            
                            
                            $selectOrder = "SELECT * FROM orderFood WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' AND transDate = CURRENT_DATE AND order_status = 'INCOMPLETE' " ;
                            $selectOrder_run = mysqli_query($con, $selectOrder);

                            if(mysqli_affected_rows($con))
                            {
                                
                                    while($selectOrder_run_rows = mysqli_fetch_assoc($selectOrder_run)){
   
                                        
                                echo '<div class= "order_item">';
                                    echo '<div class="order_number">'.$selectOrder_run_rows['orderID'].'</div>';
                                    
                                    echo '<div class="order_name">';
                                        echo '<div class="order_itemname">'.$selectOrder_run_rows['foodName'].'</div>';
                                        
                                        echo '<div class="order_itemdate">'.$selectOrder_run_rows['transDate'].'</div>';
                                    echo '</div>';
                                    
                                    echo '<div class="order_quantity">'.$selectOrder_run_rows['quantity'].'</div>';
                                    
                                echo '</div>';
                                    }
                            } else{
                                //PRINT NO DATA
                                echo '<div class= "order_item">';
                                    echo '<div class="order_number">NO DATA</div>';
                                    
                                    echo '<div class="order_name">';
                                        echo '<div class="order_itemname">CLEARED ORDERS</div>';
                                        
                                        echo '<div class="order_itemdate">NO DATA</div>';
                                    echo '</div>';
                                    
                                    echo '<div class="order_quantity">NO DATA</div>';
                                    
                                echo '</div>';

                            }
                        
                        ?>

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
    <script type="text/javascript" src="../Default/linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/headerModal.js"></script>
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
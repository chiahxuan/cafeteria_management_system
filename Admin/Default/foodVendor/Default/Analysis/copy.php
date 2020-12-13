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
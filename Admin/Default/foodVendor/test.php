<?php
    $con = mysqli_connect("localhost", "root", "root", "cafeteria") or die("Unable to connect");
    session_start();

    
    // //VIEW FOOD VENDOR TRANSACTIONz
    // $vendorIDArray = array();
    // $foodIDArray  = array();
    // $foodPriceArray = array();
    // $orderIDArray = array();
    // $quantityArray = array();
    // $transIDArray = array();
    // $transAmountArray = array();


    // //GET VENDOR INFORMATION
    // $selectVendor = "SELECT * FROM `vendor`";
    // $selectVendor_run = mysqli_query($con, $selectVendor);

    // while($selectVendor_run_rows = mysqli_fetch_assoc($selectVendor_run))
    // {
    //     $vendorIDArray[] = $selectVendor_run_rows['vendor_id'];
    // }

    //GET FOOD INFORMATION BASED ON VENDOR ID 
    for($i = 0; $i< count($vendorIDArray); $i++)
    {
        $selectFood = "SELECT * FROM `food` WHERE `vendor_id` = '".$vendorIDArray[$i]."' ";
        $selectFood_run = mysqli_query($con, $selectFood);

        while($selectFood_run_rows = mysqli_fetch_assoc($selectFood_run))
        {
            $foodIDArray[] = $selectFood_run_rows['food_id'];
            $foodPriceArray[] = $selectFood_run_rows['food_price'];
        }
        
    }

    // for($i = 0; $i< count($foodIDArray); $i++)
    // {
    //     // /* validate get food info */echo $foodIDArray[$i];
    //     $selectOrder = "SELECT * FROM `order` WHERE `food_id` = '".$foodIDArray[$i]."' ";
    //     $selectOrder_run = mysqli_query($con, $selectOrder);

    //     while($selectOrder_run_rows = mysqli_fetch_assoc($selectOrder_run))
    //     {
    //         $orderIDArray[] = $selectOrder_run_rows['order_id'];
    //         $quantityArray[] = $selectOrder_run_rows['quantity'];
    //         $transIDArray[] = $selectOrder_run_rows['trans_id'];
    //     }
    // }

    // $total = 0;

    // for($i = 0; $i< count($transIDArray); $i++)
    // {
    //     // echo $orderIDArray[$i];
    //     $selectTrans = "SELECT * FROM `transaction` WHERE `trans_id` = '".$transIDArray[$i]."'  ";//AND `trans_title` != 'PENDING'
    //     $selectTrans_run = mysqli_query($con, $selectTrans);

    //     while($selectTrans_run_rows = mysqli_fetch_assoc($selectTrans_run))
    //     {
    //         $transAmountArray[] = $selectTrans_run_rows['trans_amount'];
    //     }

    //     // echo $transAmountArray[$i]." ";
    //     echo $transAmountArray[$i];

    //     $total = $total + $transAmountArray[$i];

    // }

            
    // echo " this is total: ".$total;
    // echo "<br>";
    // echo "<br>";

    // $TransQuery = 
    // "SELECT `v.vendor_id`, `f.food_id`, `f.food_name`, `f.food_price`, `odr.order_id`, `odr.quantity`, `trs.trans_id`, `trs.trans_amount` FROM
    // `vendor` AS v 
    // JOIN `food` AS f 
    // ON `f.vendor_id` = `v.vendor_id`
    
    // JOIN `order` AS odr
    // ON `odr.food_id` = `f.food_id`
    
    // JOIN `transaction` AS trs
    // ON `trs.trans_id` = `odr.trans_id`
    
    // WHERE `v.vendor_id` = 'VD000001' AND `trs.trans_title` = 'FOOD' ";

    //////////////////////

    $sql = "SELECT * FROM citys LEFT JOIN comments ON comments.city=citys.city WHERE citys.id=$id";

    $TransQuery = 
    "SELECT vendor.vendor_id, food.food_id, food.food_name, food.food_price, `order`.order_id, `order`.trans_id, `transaction`.trans_amount FROM `vendor` 

    JOIN `food` 
    ON food.vendor_id = vendor.vendor_id 
    
    JOIN `order` 
    ON `order`.food_id = food.food_id 
    
    JOIN `transaction` 
    ON `transaction`.trans_id = `order`.trans_id
    
    WHERE vendor.vendor_id = 'VD000001'
    GROUP BY `transaction`.`trans_id` ";

    /////////////////////////////////////////
    SELECT vendor.vendor_id, food.food_id, food.food_name, food.food_price, `order`.order_id, `order`.trans_id, `transaction`.trans_amount FROM `vendor` 

    JOIN `food` 
    ON food.vendor_id = vendor.vendor_id 

    JOIN `order` 
    ON `order`.food_id = food.food_id 

    JOIN `transaction` 
    ON `transaction`.trans_id = `order`.trans_id

    WHERE vendor.vendor_id = 'VD000001'
    GROUP BY `transaction`.`trans_id`

    ////////////////////////////////////////////////////////////////////////////
    SELECT vendor.vendor_id, food.food_id, food.food_name, food.food_price, `order`.quantity, `order`.trans_id, `transaction`.`trans_date` FROM `vendor` 

    JOIN `food` 
    ON food.vendor_id = vendor.vendor_id 

    JOIN `order` 
    ON `order`.food_id = food.food_id 

    JOIN `transaction` 
    ON `transaction`.trans_id = `order`.trans_id

    WHERE vendor.vendor_id = 'VD000001'
    GROUP BY `transaction`.`trans_id`
/////////////////////////////////////

SELECT vendor.vendor_id, food.food_id, food.food_name, food.food_price, `order`.quantity, `order`.trans_id, EXTRACT(MONTH FROM `transaction`.`trans_date`) FROM `vendor` 

JOIN `food` 
ON food.vendor_id = vendor.vendor_id 

JOIN `order` 
ON `order`.food_id = food.food_id 

JOIN `transaction` 
ON `transaction`.trans_id = `order`.trans_id

WHERE vendor.vendor_id = 'VD000001' AND EXTRACT(MONTH FROM `transaction`.`trans_date`) = '3'
GROUP BY `transaction`.`trans_id`

?????//


    <input name= stallid value = sfasdfaw>
    .
    .
    $_POST['stallid']

    SELECT * from transaction where stall_id ='".$_POST['stallid']."';
    query_run;

    for($i=0; $i< count($_id); $i)


?>

////CAFETEREIA REPORT
CREATE VIEW calamount
AS 
SELECT vendor.vendor_id AS `vendorID`, vendor.vendor_name as vendorName, food.food_id, food.food_name foodName, food.food_price as foodPrice, `order`.order_id as orderID, `order`.order_type as orderType,`order`.quantity AS quantity, (food.food_price * `order`.quantity ) AS totalPrice, `order`.trans_id, EXTRACT(MONTH FROM `transaction`.`trans_date`) as `NumberOfMonth`
FROM `vendor` 
JOIN `food` ON food.vendor_id = vendor.vendor_id 
JOIN `order` ON `order`.food_id = food.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type = 'PURCHASE'

CREATE VIEW calRefund
AS 
SELECT vendor.vendor_id AS `vendorID`, vendor.vendor_name as vendorName, food.food_id, food.food_name as foodName, food.food_price as food_Price, `order`.order_id as orderID, `order`.order_type as orderType,`order`.quantity AS quantity, 
(food.food_price * `order`.quantity ) AS totalRefundPrice, `order`.trans_id, EXTRACT(MONTH FROM `transaction`.`trans_date`) as `NumberOfMonth` 

FROM `vendor` 
JOIN `food` ON food.vendor_id = vendor.vendor_id 
JOIN `order` ON `order`.food_id = food.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type = 'REFUND' 



//total profit
//cannnot be view as it should be loop with month, and vendor ID

//php query
SELECT calamount.vendorName, SUM(calamount.totalPrice) as total_sales, SUM(calrefund.totalPrice) AS total_refund, 
(SUM(calamount.totalPrice) - SUM(calrefund.totalPrice) )AS totalProfit 

FROM calrefund 
JOIN calamount on calamount.vendorID = calrefund.vendorID

//test 
SELECT calamount.vendorName, SUM(calamount.totalPrice) as total_sales, SUM(calrefund.totalRefundPrice) AS total_refund, 
(SUM(calamount.totalPrice) - SUM(calrefund.totalRefundPrice) )AS totalProfit 

FROM calrefund 
JOIN calamount on calamount.vendorID = calrefund.vendorID 
where calrefund.vendorID = 'VD000002' AND 

////VENDOR REPORT 
CREATE VIEW viewfoodCategory 
AS 
SELECT `vendor`.vendor_id as vendorID, EXTRACT(MONTH FROM `transaction`.`trans_date`) as MonthNumber, `food`.`food_id` as FoodID, `food`.food_category as foodCategory, `food`.`food_name` as FoodName, 
`food`.`food_price` as FoodPrice, `order`.`quantity` as orderQuantity, (`food`.`food_price` * `order`.`quantity`)as totalAmount


FROM `vendor` 
JOIN `food` ON `food`.vendor_id = `vendor`.vendor_id 
JOIN `order` ON `order`.food_id = `food`.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type = 'PURCHASE'
/////query 


//SECOND STEP
SELECT vendorID, MonthNumber, FoodID, foodCategory, FoodName, FoodPrice, 
SUM(orderQuantity) , SUM(totalAmount)

FROM `viewfoodcategory`
WHERE vendorID = 'VD000001' AND MonthNumber = '3'AND foodCategory = 'pizza'
GROUP BY foodCategory

//////User Transaction vIEW


CREATE VIEW userTOPUP
AS
SELECT * FROM `transaction`
WHERE trans_title = 'TOP UP' ORDER BY trans_date




if(isset($_GET['orderid']))
{

    echo $_GET['orderid'];
    $orderid = $_GET['orderid'];
    echo "hello;";

    $selectOrder = "SELECT * FROM usertransaction WHERE orderID = '$orderid'  ";
    $selectOrder_run = mysqli_query($con, $selectOrder);
    echo mysqli_num_rows($selectOrder_run);

    if(mysqli_num_rows($selectOrder_run) < 1)
    {
        //  ERROR REDIRECT
        header:
    }else
    {
        //  SUCESS, FETCH ARRAY
        $selectOrder_run_rows = mysqli_fetch_assoc($selectOrder_run);

        $_SESSION['foodName'] = $selectOrder_run_rows['Title'];
        $_SESSION['transID'] = $selectOrder_run_rows['transID'];
        $_SESSION['quantity'] = $selectOrder_run_rows['Quantity'];
        $_SESSION['amount'] = $selectOrder_run_rows['TotalSub'];
        $_SESSION['date'] = $selectOrder_run_rows['transDate'];
        $_SESSION['time'] = $selectOrder_run_rows['transTime'];
      
        $_SESSION['displayTransHis'] = "SET";
        echo $_SESSION['foodName'];
        echo $_SESSION['transID'];
        echo $_SESSION['quantity'];
        echo $_SESSION['amount'] ;
        echo $_SESSION['date'] ;
        echo $_SESSION['time'] ;

        header("location: foodVendorMain.php?displayTransHis=".$_SESSION['displayTransHis']);

    }

}

(OKAY DE)
create view usertransaction as 

SELECT `transaction`.`trans_title` as Title, `order`.`quantity` as Quantity, `transaction`.`trans_amount` as TotalSub, `transaction`.`trans_date` AS transDate,
`transaction`.`trans_time` AS transTime, `transaction`.`user_id` AS userID, `transaction`.`employee_id` AS employeeID, `order`.`food_id` as foodName, `order`.`order_id` as orderID, `transaction`.`trans_id` AS transID, `food`.`food_price` as foodPrice

FROM `transaction` 
JOIN `order` ON `order`.`trans_id` = 	`transaction`.`trans_id`
JOIN food ON food.food_id = `order`.`food_id`
WHERE `transaction`.`trans_title` != 'FOOD' AND `transaction`.`trans_title` != 'PENDING'  AND `transaction`.`trans_title` != 'PURCHASE'

UNION

SELECT  food.food_name, `order`.`quantity`, (`food`.`food_price` * `order`.`quantity`), `transaction`.`trans_date`, `transaction`.`trans_time`, `transaction`.`user_id`, `transaction`.`employee_id`, food.food_name, `order`.`order_id` as orderID, `transaction`.`trans_id` AS transID, `food`.`food_price` as foodPrice
FROM `order`
JOIN food ON food.food_id = `order`.`food_id`
JOIN `transaction` ON `transaction`.`trans_id` = `order`.`trans_id` AND `transaction`.`trans_title` != 'PENDING'  AND (`transaction`.`trans_title` = 'PURCHASE' OR  `transaction`.`trans_title` != 'REFUND')

UNION

SELECT `transaction`.`trans_title` as Title, `order`.`quantity` as Quantity, `transaction`.`trans_amount` as TotalSub, `transaction`.`trans_date` AS transDate,
`transaction`.`trans_time` AS transTime, `transaction`.`user_id` AS userID, `transaction`.`employee_id` AS employeeID, `order`.`order_status`, `order`.`order_id` as orderID, `transaction`.`trans_id` AS transID, `order`.`quantity`

FROM `transaction` 
JOIN `order` ON `order`.`trans_id` = `transaction`.`trans_id`
WHERE `transaction`.`trans_title` = 'TOP UP' 

     //////////////////////////////////////
(OK DE)
CREATE VIEW pendingrequest
as
SELECT vendor.vendor_id AS `vendorID`, 
vendor.vendor_name as vendorName, 
food.food_id,
food.food_name as foodName, 
food.food_price as food_Price, 
`order`.order_id as orderID, 
`order`.order_type as orderType,
`order`.quantity AS quantity, 
(food.food_price * `order`.quantity ) AS totalRefundPrice, 
`order`.trans_id, 
`transaction`.`trans_date` as transDate,
`transaction`.`trans_time` as transTime,  
`transaction`.`user_id` as userID, 
`transaction`.`employee_id` as employeeID

FROM `vendor` 
JOIN `food` ON food.vendor_id = vendor.vendor_id 
JOIN `order` ON `order`.food_id = food.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type = 'PENDING'




///////
(NOT REALLY)
//
 
SELECT vendor.vendor_id AS `vendorID`, vendor.vendor_name as vendorName, food.food_id, food.food_name as foodName, food.food_price as food_Price, `order`.order_id as orderID, `order`.order_type as orderType,`order`.quantity AS quantity, 
(food.food_price * `order`.quantity ) AS totalRefundPrice, `order`.trans_id, EXTRACT(MONTH FROM `transaction`.`trans_date`) as `NumberOfMonth` , `transaction`.`user_id` as userID

FROM `vendor` 
JOIN `food` ON food.vendor_id = vendor.vendor_id 
JOIN `order` ON `order`.food_id = food.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type = 'REFUND'

UNION 

SELECT vendor.vendor_id AS `vendorID`, vendor.vendor_name as vendorName, food.food_id, food.food_name as foodName, food.food_price as food_Price, `order`.order_id as orderID, `order`.order_type as orderType,`order`.quantity AS quantity, 
(food.food_price * `order`.quantity ) AS totalRefundPrice, `order`.trans_id, EXTRACT(MONTH FROM `transaction`.`trans_date`) as `NumberOfMonth`, `transaction`.`employee_id` as userID
 

FROM `vendor` 
JOIN `food` ON food.vendor_id = vendor.vendor_id 
JOIN `order` ON `order`.food_id = food.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type = 'REFUND' 




////




$viewPending = "SELECT * FROM pendingrequest WHERE userID = '".$_SESSION['accessUserID']."' ORDER BY transDate DESC ";
$viewPending_run = mysqli_query($con, $viewPending);

if(mysqli_affected_rows($con) < 1)
{
  
    $viewPending = "SELECT * FROM pendingrequest WHERE employeeID = '".$_SESSION['accessUserID']."' ORDER BY transDate DESC ";
    $viewPending_run = mysqli_query($con, $viewPending);

    while ($viewPending_run_rows = mysqli_fetch_assoc($viewPending_run))
    {
        $orderID = $viewuserTrans_run_rows['orderID'];

        echo "<a class='trans_detail' href = 'systemuserCRUD.php?orderid=".$orderID."'>";

                echo '<div class="trans_detail_food">';
                echo $viewuserTrans_run_rows['foodName'];
                echo "<span>".$viewuserTrans_run_rows['transDate']." at ".$viewuserTrans_run_rows['transTime']."</span>";
                echo '</div>';
                
                echo '<div class="trans_detail_price">';
                echo  $viewuserTrans_run_rows['quantity'];
                echo '</div>';

                echo '<div class="trans_detail_price">';
                echo $viewuserTrans_run_rows['totalRefundPrice'];
                echo '</div>';

        echo '</a>';
    }

   

}else{
      

    while ($viewPending_run_rows = mysqli_fetch_assoc($viewPending_run))
    {
        $orderID = $viewuserTrans_run_rows['orderID'];

        echo "<a class='trans_detail' href = 'systemuserCRUD.php?orderid=".$orderID."'>";

                echo '<div class="trans_detail_food">';
                echo $viewuserTrans_run_rows['foodName'];
                echo "<span>".$viewuserTrans_run_rows['transDate']." at ".$viewuserTrans_run_rows['transTime']."</span>";
                echo '</div>';
                
                echo '<div class="trans_detail_price">';
                echo  $viewuserTrans_run_rows['quantity'];
                echo '</div>';

                echo '<div class="trans_detail_price">';
                echo $viewuserTrans_run_rows['totalRefundPrice'];
                echo '</div>';

        echo '</a>';
    }
    
}

/////////////////////
CREATE VIEW viewtransaction
AS
SELECT vendor.vendor_id AS `vendorID`, vendor.vendor_name as vendorName, food.food_id, food.food_name as foodName, food.food_price as food_Price, `order`.order_id as orderID, `order`.order_type as orderType,`order`.order_status as orderStatus, `order`.quantity AS orderQuantity, (food.food_price * `order`.quantity ) AS totalAmount, `order`.trans_id AS transactionID, `transaction`.`trans_date` AS transactionDate, `trans_time` AS transactionTime, EXTRACT(MONTH FROM `transaction`.`trans_date`) as `NumberOfMonth` , `transaction`.`user_id` as userID

FROM `vendor` 
JOIN `food` ON food.vendor_id = vendor.vendor_id 
JOIN `order` ON `order`.food_id = food.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type !='PENDING' AND `transaction`.employee_id IS NUll 

UNION

SELECT vendor.vendor_id AS `vendorID`, vendor.vendor_name as vendorName, food.food_id, food.food_name as foodName, food.food_price as food_Price, `order`.order_id as orderID, `order`.order_type as orderType,`order`.order_status as orderStatus, `order`.quantity AS orderQuantity, (food.food_price * `order`.quantity ) AS totalAmount, `order`.trans_id AS transactionID, `transaction`.`trans_date` AS transactionDate, `trans_time` AS transactionTime, EXTRACT(MONTH FROM `transaction`.`trans_date`) as `NumberOfMonth` , `transaction`.`employee_id` as userID

FROM `vendor` 
JOIN `food` ON food.vendor_id = vendor.vendor_id 
JOIN `order` ON `order`.food_id = food.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type !='PENDING' AND `transaction`.user_id IS NUll 

///////////////////////////

CREATE VIEW viewvendortransaction
as 

SELECT `transaction`.`trans_title` as Title,
`order`.`quantity` as Quantity,
`transaction`.`trans_amount` as TotalSub,
`transaction`.`trans_date` AS transDate,
`transaction`.`trans_time` AS transTime, 
`food`.`vendor_id` AS vendorID,
`order`.`food_id` as foodID, 
`food`.`food_name` as foodName,
`food`.`food_price`as foodPrice,
`order`.`order_id` as orderID, 
`transaction`.`trans_id` AS transID

FROM `transaction` 
JOIN `order` ON `order`.`trans_id` = 	`transaction`.`trans_id`
JOIN food ON food.food_id = `order`.food_id
JOIN `vendor` ON `vendor`.vendor_id = `food`.`vendor_id`
WHERE `transaction`.`trans_title` != 'FOOD' AND `transaction`.`trans_title` != 'PENDING'

UNION

SELECT  food.food_name, `order`.`quantity`, 
(`food`.`food_price` * `order`.`quantity`),
`transaction`.`trans_date`, 
`transaction`.`trans_time`, 
`food`.`vendor_id`, 
`order`.`food_id` as foodID, 
food.food_name, 
`food`.`food_price`as foodPrice,
`order`.`order_id` as orderID, 
`transaction`.`trans_id` AS transID

FROM `order`
JOIN `food` ON `food`.food_id = `order`.`food_id`
JOIN `vendor` on `vendor`.vendor_id = `food`.`vendor_id`
JOIN `transaction` ON `transaction`.`trans_id` = `order`.`trans_id` 
WHERE `transaction`.`trans_title` = 'FOOD' AND `transaction`.`trans_title` != 'PENDING'
/////////////////////////////////////////////////////////////////////
create view 
orderfood
as 
SELECT `order`.`order_id` as orderID,
`food`.`food_id` as foodId,  
`food`.`food_name` as foodName, 
`transaction`.`trans_date` as transDate,
`order`.`quantity` as quantity, 
`order`.`order_status` as order_status,
`food`.`vendor_id` as vendorID

FROM `order`
JOIN `food` ON `food`.`food_id` = `order`.`food_id`
JOIN `transaction` ON `transaction`.trans_id = `order`.`trans_id`
///////////////////////////////////
CREATE VIEW vendorgraphcategory as 
SELECT `vendor`.vendor_id as vendorID, 	QUARTER(`transaction`.`trans_date`) as NumbofQuarter, `food`.`food_id` as FoodID, `food`.food_category as foodCategory, `food`.`food_name` as FoodName, 
`food`.`food_price` as FoodPrice, `order`.`quantity` as orderQuantity, (`food`.`food_price` * `order`.`quantity`)as totalAmount


FROM `vendor` 
JOIN `food` ON `food`.vendor_id = `vendor`.vendor_id 
JOIN `order` ON `order`.food_id = `food`.food_id 
JOIN `transaction` ON `transaction`.trans_id = `order`.trans_id 

WHERE `order`.order_type = 'PURCHASE'
/////////////////
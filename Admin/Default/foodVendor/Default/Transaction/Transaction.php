<?php
    include('foodVendorTransaction.php');
    if(isset($_GET['unset']))
    {
        unset($_SESSION['displayTransHistory']);


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
    background-color: gray;
}

.report_type {

    width: 100%;
    height: 100%;

    display: flex;
    align-items: center;

    background-color: white;
}

.report_type button {
    outline: 0;
    border: 0;

    width: 270px;
    height: 50px;

    margin-left: 30px;

    font-size: 1.5em;
    word-wrap: break-word;
    
    font-family:  'Heebo', Arial, sans-serif;
    background-color: #427AA1;
    color:white;
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
    background-color: white;
    color:#427AA1;
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
    height: 100%;

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
    height: 90%;

    background-color: #EBF2FA;

    display: flex;
    flex-direction: column;
    align-items: center;
}

.trans_title_cage {
    width: 60%;
    height: 115px;

    background-color: #427AA1;

    margin-bottom: auto;
    margin: 25px;
    
    display: flex;
    justify-content: space-between;
    padding: 15px;
    

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
    color:white;

}


.trans_detail_cage {
    width: calc(100% - 60px);
    height: 80%;

    display: flex; 
    flex-direction: column;
}

.trans_detail, .trans_detail_static {
    width: 100%;
    height: 70px;
	min-height: 70px;

    border-bottom: 1px solid #707070;

    padding: 10px 0px;

    background-color: #EBF2FA;
    display: flex;
    justify-content: flex-end;

    color:inherit;
    text-decoration:none;
}

.trans_detail_food, .trans_detail_price, .trans_qty {
    width: 30%;
    height: 100%;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;

    font-size: 1.6vw;
    font-family: 'Heebo', Arial, sans-serif;

    background-color: #EBF2FA
}

.trans_detail_food {
    margin-left: 30px;
    color:#427AA1;
    margin-right: auto;
}

.trans_detail_food span {
    font-size: 1.2vw;
    color:#427AA1;
}

.trans_detail_price, .trans_qty {
    font-size: 2vw;
    white-space: nowrap;
    margin-right: 30px;

    width: 5em;
}

.trans_qty {
    color:#427AA1;
}

.trans_head_style {
    font-size: 2.2vw;
    color:#427AA1;

}

/* Open transaction tab by default */
#Transaction {
    display: flex;
}



/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
</style>


<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />

<?php
    if(isset($_SESSION['displayTransHistory']))
    {
        echo '<style>      
        
        #Transaction{
            display: flex;
        }

        #transHistory{
            display: flex;
        }

        #Modal1{
            display: none;
        }
        </style>';
        unset($_SESSION['displayTransHistory']);

    }

    if(isset($_GET['orderreset'])){
        echo '<style>      
        
        #Transaction{
            display: flex;
        }

        #transHistory{
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
        </style>';

    }

    if(isset($_GET['successRefund'])){
        
        echo '<style>      
        
        #Transaction{
            display: flex;
        }

        #transHistory{
            display: none;
        }

        #Modal1{
            display: none;
        }

        #Modal2{
            display: none;
        }

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

        <?php
            if($_SESSION['loginRole'] == 'kitchen owner'){
                echo '<div id="bottom_left">';
                    echo '<a href="../homeFoodvendor.php?unset" class="btn"><i class="fas fa-home"></i>Home </a>';
                    echo '<a href="../Analysis/analysisMain.php?unset" class="btn"><i class="fas fa-chart-area  "></i>Analysis </a>';
                    echo '<a href="../order/order.php?unset" class="btn"><i class="fas fa-store"></i>Order </a>';
                    echo '<a href="../Transaction/Transaction.php?unset" class="btn activeTab"><i class="fas fa-id-card"></i>Transaction</a>';
                    echo '<a href="../employee/employee.php?unset" class="btn"><i class="fas fa-user"></i>Employee</a>';
                    echo '<a href="../Menu/menu.php?unset" class="btn"><i class="fas fa-book-open"></i>Food Menu</a>';
                echo '</div>';
            }else if($_SESSION['loginRole'] == 'kitchen employee'){
                echo '<div id="bottom_left">';
                    echo '<a href="../order/order.php?unset" class="btn"><i class="fas fa-store"></i>Order </a>';
                    echo '<a href="../Transaction/Transaction.php?unset" class="btn activeTab"><i class="fas fa-id-card"></i>Transaction</a>';
                echo '</div>';
            }

        ?>
        <!-- onclick="openCity(event, 'Cafeteria');" id="defaultOpen" -->
        <div class="bottom_right">
           <div class="analysis_cage">
                

                <div class="analysis_bottom">
						
					<!-- Transaction section -->
                    <div id="Transaction" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks" onclick="openCity(event, 'Transaction');" >Transaction History</button>
                            </div>
        
                            <form action="Transaction.php" method = "POST" class="report_search">
                                <input name ="vendorSearchInput" type="search" placeholder="Search" pattern="[a-zA-Z0-9\s]+" title ="Search index should not include characters, try to insert Food Name, Transaction ID, Food ID or Order ID" required>
                                <button name = "vendorSearch" type = "submit"><i class="fas fa-search"></i></button> 
                            </form>
                        </div>

                        <div class="trans_list">
                            <div class="trans_title_cage">
                                
                                <?php
                                    
                                    //DECLARE VARIABLE
                                    date_default_timezone_set("Asia/Kuala_Lumpur");
                                    $currentDate = date("d-m-Y");
                                    $currentTime = date("h:i a") ;
                                    
                                    $selectVDetails = "SELECT * FROM vendor WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."'   ";
                                    $selectVDetails_run = mysqli_query($con, $selectVDetails);
                                    $selectVDetails_run_rows = mysqli_fetch_assoc($selectVDetails_run);

                                    echo ' <div class="trans_title_time">';
                                        echo '<h2>'. $_SESSION['loginRelatedVendor'].'</h2>';
                                        echo '<span>Last Updated</span>';
                                        echo ' <span style="font-size: 22px;">'.$currentDate.' at '.$currentTime.'</span>';
                                    echo '</div>';

                                    echo '<div class="trans_title_profit">';
                                        echo '<span>Profit</span>';
                                        echo '<h2>'.$selectVDetails_run_rows['vendor_balance'].'</h2>';
                                    echo '</div>';
       
                                ?>

                            </div>

							
                            <div class="trans_detail_cage">
								<div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                                    <div class="trans_detail_static"> 
                                        <div class="trans_detail_food trans_head_style">FOOD NAME</div>
                                        <div class="trans_qty trans_head_style">Qty</div>
                                        <div class="trans_qty trans_head_style">Price</div>
                                    </div>
                                <?php

                                    
                                    
                                    if(isset($_POST['vendorSearch']))
                                    {

                                        $input = $_POST['vendorSearchInput'];
                                        
                                        $selectTransaction = "SELECT * FROM  viewvendortransaction WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' AND (transID LIKE '%$input%' OR orderID 
                                         LIKE '%$input%' OR foodID  LIKE '%$input%' OR foodName LIKE '%$input%' OR transDate LIKE '%$input%')
                                         ORDER BY transDate DESC";
                                        $selectTransaction_run = mysqli_query($con, $selectTransaction);
                                        
                                        
                                        if(mysqli_num_rows($selectTransaction_run) == 0)
                                        {
                                            echo '<div class="trans_detail">';
                                            echo '<div class="trans_detail_food">';
                                            echo "NO DATA";
                                            echo "<span>NO DATA</span>";
                                            echo '</div>';
                                            echo '<div class="trans_qty">';
                                            echo "NO DATA";
                                            echo '</div>';
                                            echo '<div class="trans_detail_price">';
                                            echo "NO DATA";
                                            echo '</div>';

                                            echo '</div>';
                                        }

                                        while($selectTransaction_run_rows = mysqli_fetch_assoc($selectTransaction_run))
                                        {
                                           
                                            $orderID = $selectTransaction_run_rows['orderID'];

                                            // echo $orderID;
                                            echo "<a class='trans_detail' href = 'foodVendorTransaction.php?orderid=".$orderID."'>";

                                                echo '<div class="trans_detail_food">';
                                                    // echo "<a href = 'vendorCRUD.php?orderid=".$transSearch_run_row['orderID']."'>";
                                                    echo $selectTransaction_run_rows['foodName'];
                                                        echo "<span>".$selectTransaction_run_rows['transDate'];
                                                        // echo  "<a href = 'vendorCRUD.php?orderid=".$transSearch_run_row['orderID']."'>";
                                                        echo "</span>";
                                                echo '</div>';
                                                    echo '<div class="trans_qty">';
                                                    // echo  "<a href = 'vendorCRUD.php?orderid=".$transSearch_run_row['orderID']."'>";
                                                    echo $selectTransaction_run_rows['Quantity'];
                                                    echo '</div>';
                                                echo '<div class="trans_detail_price">';
                                                // echo  "<a href = 'vendorCRUD.php?orderid=".$transSearch_run_row['orderID']."'>";
                                                echo "RM ".$selectTransaction_run_rows['TotalSub'];
                                                echo '</div>';
                                            echo '</a>';
                                        }

                                    }else{
                                        $selectTransaction = "SELECT * FROM viewvendortransaction WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' ORDER BY transDate DESC , transDate DESC"; 
                                        $selectTransaction_run = mysqli_query($con, $selectTransaction);
                                                   
                                        while($selectTransaction_run_rows = mysqli_fetch_assoc($selectTransaction_run))
                                        {
                                            
                                            $orderID = $selectTransaction_run_rows['orderID'];

                                            if($selectTransaction_run_rows  ['Title'] == 'REFUND'){
        
                                                echo "<a class='trans_detail' href = 'foodVendorTransaction.php?orderid=".$orderID."'>";
                                                    echo '<div class="trans_detail_food">';
                                                    echo $selectTransaction_run_rows['Title'];
                                                    echo "<span>".$selectTransaction_run_rows['transDate']." at ".$selectTransaction_run_rows['transTime']."</span>";
                                                    echo '</div>';
                                                    echo '<div class="trans_qty">';
                                                    echo $selectTransaction_run_rows['Quantity'];
                                                    echo '</div>';
                                                    echo '<div class="trans_detail_price">';
                                                    echo "-RM ".$selectTransaction_run_rows['TotalSub'];
                                                    echo '</div>';
        
                                                echo '</a>';
                                            }else{
        
                                                echo "<a class='trans_detail' href = 'foodVendorTransaction.php?orderid=".$orderID."'>";
                                                    echo '<div class="trans_detail_food">';
                                                    echo $selectTransaction_run_rows['foodName'];
                                                    echo "<span>".$selectTransaction_run_rows['transDate']." at ".$selectTransaction_run_rows['transTime']."</span>";
                                                    echo '</div>';
                                                    echo '<div class="trans_qty">';
                                                    echo $selectTransaction_run_rows['Quantity'];
                                                    echo '</div>';
                                                    echo '<div class="trans_detail_price">';
                                                    echo "RM ".$selectTransaction_run_rows['TotalSub'];
                                                    echo '</div>';
        
                                                echo '</a>';
                                            }

                                        }


                                    }

                                    
                                   
                                
                                
                                
                                ?>
           
                            </div>
                        </div>
                    </div>
                </div>
			</div>
          
           <!-- Show transaction history Modal-->
            <div id="transHistory" class="modal">
            <!-- Modal content -->
            <div class="content_cage trans_position">
                <div class="content_outerCage trans_content">
                    <div class="content_bar">
                    <h2><?php echo $_SESSION['foodName']; unset($_SESSION['foodName']);?></h2>
                            <div>Transaction ID: <?php echo @$_SESSION['transID']; unset($_SESSION['transID']);?></div>
                            <div>Amount: <?php echo @$_SESSION['quantity']; unset($_SESSION['quantity']);?></div>
                            <div>Total: <?php echo @$_SESSION['amount']; unset($_SESSION['amount']); ?></div>
                            <div>Status: <?php echo @$_SESSION['orderStatus']; ?> </div>
                            <h3><?php echo @$_SESSION['date']." at ".$_SESSION['time']; unset($_SESSION['date']); unset($_SESSION['time']);?></h3>
                    </div>
                    
                    <form action = "foodVendorTransaction.php" method = "POST">
                        <div class="content_refundBtn">

                            <?php
                                if($_SESSION['orderStatus'] == 'COMPLETED'){
                                    echo '<button name = "resetOrder" type = "submit" class="content_inn">Reset Order</button>';
                                    echo '<button name = "refundBtn"  type = "submit" class = "content_inn" >Refund</button>';
                                    echo '<span class="close">Dismiss</span>';
                                }else{
                                    
                                    echo '<button name = "refundBtn"  type = "submit" class = "content_inn" >Refund</button>';
                                    echo '<span class="close">Dismiss</span>';
                                }
                            ?>
                        </div>
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
                            Successfully Refunded!
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
                            Successfully Reset!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>

             <!--Show Successful Refund Modal-->
			<div id="Modal3" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Successfully Refund!
                        </div>

                        <span class="close">Dismiss</span>

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
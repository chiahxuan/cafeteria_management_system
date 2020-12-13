<?php
    include('orderCRUD.php');
    if(isset($_GET['unset']))
    {
        unset($_SESSION['orderCompleted']);

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

    width: 70%;
    height: 100%;

    display: flex;
    align-items: center;

}

.report_type button {
    outline: 0;
    border: 0;

    width: 230px;
    height: 50px;

    margin-left: 30px;

    font-size: 1.5em;
    word-wrap: break-word;
    color:white;
    background-color:#427AA1;
    
    font-family:  'Heebo', Arial, sans-serif;
}

.analysis_bottom {
    width: 100%;
    height: 100%;

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
}

.table_bottom_cage {
    width: 100%;
    height: 83%;

    background-color: white;
   
    display: flex; 
    flex-direction: column;
    align-items: center;
}

/*Styling the table*/
table {
    width: calc(100% - 50px);
    border-spacing: 0px;
    color:#427AA1;
    
}

table tr {
    
    height: 55px;
    max-height: 55px;

    text-indent: 20px;
    font-size: 1.5em;
    font-family: 'Heebo', Arial, sans-serif;
}


table tr td {
    /* background-color: aqua; */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; 
    max-width: 500px;
    border-bottom: 3px solid #427AA1;


}

/* Open cafeteriaUser tab by default */
#cafeteriaUser {
    display: flex;
}

input[type=checkbox] {
  transform: scale(2);
}


/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
</style>
<?php
    if(isset($_SESSION['orderCompleted'])){
        echo '<style>
            
            #ModalCompletedOrder{
                display: flex;
            }
            #transHistory{
                display: none;
            }
            
          
            
            </style>'; 
        unset($_SESSION['orderCompleted']);

    }







?>
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
          <button  type="button"id="user"> <div class="user_cover"> <i class="fas fa-user-circle"></i></div></button> 
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
        
        <?php
            if($_SESSION['loginRole'] == 'kitchen owner'){
                echo '<div id="bottom_left">';
                    echo '<a href="../homeFoodvendor.php?unset" class="btn"><i class="fas fa-home"></i>Home </a>';
                    echo '<a href="../Analysis/analysisMain.php?unset" class="btn"><i class="fas fa-chart-area  "></i>Analysis </a>';
                    echo '<a href="../order/order.php?unset" class="btn activeTab"><i class="fas fa-store"></i>Order </a>';
                    echo '<a href="../Transaction/Transaction.php?unset" class="btn"><i class="fas fa-id-card"></i>Transaction</a>';
                    echo '<a href="../employee/employee.php?unset" class="btn"><i class="fas fa-user"></i>Employee</a>';
                    echo '<a href="../Menu/menu.php?unset" class="btn"><i class="fas fa-book-open"></i>Food Menu</a>';
                echo '</div>';
            }else if($_SESSION['loginRole'] == 'kitchen employee'){
                echo '<div id="bottom_left">';
                    echo '<a href="../order/order.php?unset" class="btn activeTab"><i class="fas fa-store"></i>Order </a>';
                    echo '<a href="../Transaction/Transaction.php?unset" class="btn"><i class="fas fa-id-card"></i>Transaction</a>';
                echo '</div>';
            }

        ?>
        <!-- onclick="openCity(event, 'Cafeteria');" id="defaultOpen" -->
        <div class="bottom_right">
           <div class="analysis_cage">
                

                <div class="analysis_bottom">
                    <!-- Pending Order table -->
                    <div id="cafeteriaUser" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks" onclick="openCity(event, 'cafeteriaUser');">Pending Order</button>
                            </div>
        
							</div>

                        <div class="table_top_bar">
                        </div>
                        
                        <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                            

                            <table>
                                <tr>
                                    <td>Order ID</td>
                                    <td>Name</td>
                                    <td>Quantity</td>
                                    <td>Status</td>
                                </tr>

                                <?php

                                    $selectOrder = "SELECT * FROM orderFood WHERE vendorID = '".$_SESSION['loginRelatedVendor']."' AND transDate = CURRENT_DATE AND order_status = 'INCOMPLETE' " ;
                                    $selectOrder_run = mysqli_query($con, $selectOrder);

                                    if(mysqli_affected_rows($con))
                                    {
                                        
                                         while($selectOrder_run_rows = mysqli_fetch_assoc($selectOrder_run)){
                                            echo "<tr class='tablinks' onclick='openCity(event, 'Profile');'>";
                                            echo "<td>".$selectOrder_run_rows['orderID']."</td>";
                                            echo "<td>".$selectOrder_run_rows['foodName']."</td>";
                                            echo "<td>".$selectOrder_run_rows['quantity']."</td>";
                                            echo '<td><input class = "orderCheck" type = "checkbox" value= '.$selectOrder_run_rows['orderID'].'></td>';                                            
                                            echo "</tr>";
                                         }
                                    } else{
                                        //PRINT NO DATA
                                        echo "<tr class='tablinks' onclick='openCity(event, 'Profile');'>";
                                            echo "<td>NO DATA</td>";
                                            echo "<td>NO DATA</td>";
                                            echo "<td>NO DATA</td>";
                                            echo "<td>NO DATA</td>";                                        
                                        echo "</tr>";

                                    }
                                   

                                ?>
                            </table>
                        </div>
                           

                    </div>

                </div>
                  
           </div>
           
           <!-- The Add Confirmation Modal-->

			<div id="transHistory" class="modal">
                <!-- Modal content -->
                <div class="content_cage trans_position">
                    <div class="content_outerCage trans_content">
                        <div class="content_bar">
                            <h2>Pan Mee</h2>
                            <div>Transaction ID: 101010</div>
                            <div>Acount: RM -10.00</div>
                            <div>Card Balance: RM 50.00</div>
                            <h3>Nov 26 2018 at 05:36 PM</h3>
                        </div>
                        
                        <div class="content_refundBtn">
                            <span class="close">Dismiss</span>
                        </div>
                        
                    </div>
                </div>
			</div>

            <div id="ModalCompletedOrder" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Completed Order!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/orderModal.js"></script>
    <script type="text/javascript" src="../linkFiles/transactionPriceColour.js"></script>
    <script>
        $(document).ready(function(){

            $(".orderCheck").on('click', function(){
                // alert($(this).val());
                var link = 'orderCRUD.php?orderID=' + $(this).val() + '';
                window.location.href= link;

            });
        });
        



    </script>
</body>
</html>


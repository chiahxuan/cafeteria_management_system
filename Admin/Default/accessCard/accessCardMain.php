<?php
    include('accesscardCRUD.php');

    if(@isset($_POST['backBtn']))
    {   
        unset($_SESSION['accessUserID']);
    }
    if(@isset($_GET['unset']))
    {
        unset($_SESSION['accessUserID']);
        // unset($_SESSION['getprofile']);

    }

    
    if(@!isset($_SESSION['loginRole'])){

        header('location: ../login.php');

    }

?>

<!DOCTYPE html>
<html lang="en">
        
<head>


        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="../linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../linkFiles/Modals_CSS/menu.css" type="text/css" />
<script src="https://www.google.com/jsapi"></script>
<style>


.tabcontent {
    padding: 0;
    margin: 0;

    width: 100%;
    height: 100%;

    display: none;
    flex-direction: column;
    
    align-items: center;

    background-color: #EBEBEB;
    
}

.analysis_top {

    width: 100%;
    height: 110px;
    min-height: 110px;

    display: flex;
    justify-content: flex-start;
    align-items: center;
    background-color: white;
}

.step_design {
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;

    text-align: center;
    font-size: 1.5em;
    word-wrap: break-word;
    font-family:  'Heebo', Arial, sans-serif;
}

.angle {
    max-width: 0px;
    max-height: 0px;
    

    border-top: 55px solid #427AA1;
    border-left: 55px solid #427AA1;
    border-right: 30px solid #427AA1;
    border-bottom: 55px solid #427AA1;
    
}

.step_length{
    padding: 0 30px 0 30px;
}

.step_darkColour {
    background-color: #427AA1;
    color: white;
}

.tri_dark_medium {
    border-top-color:  #EBF2FA;
    border-right-color: #EBF2FA;
    border-bottom-color: #EBF2FA;
}

.step_mediumColour {
    background-color: #EBF2FA;
    color: #427AA1;
}

.tri_medium_light {
    border-top-color:  white;
    border-left-color:  #EBF2FA;
    border-right-color: white;
    border-bottom-color: white;
}

.step_lightColour {
    background-color: white;
    color: #427AA1;
}

.tri_light {
    border-top-color:  white;
    border-left-color:  white;
    border-right-color: white;
    border-bottom-color: white;
}

.tri_medium_dark {
    border-top-color:  #427AA1;
    border-left-color:  #EBF2FA;
    border-right-color: #427AA1;
    border-bottom-color: #427AA1;
}

.tri_dark_light {
    border-top-color:  white;
    border-left-color:  #427AA1;
    border-right-color: white;
    border-bottom-color: white;
}

.tri_light_dark {
    border-top-color: #427AA1;
    border-left-color: white;
    border-right-color: #427AA1;
    border-bottom-color: #427AA1;
}


#back_button {
    outline: none;
    border: none;

    width: 50px;
    height: 50px;

    margin-left: auto;
    margin-right: 80px;

    font-size: 2vw;

    border-radius: 100%;

    background-color:white;
    color:#427AA1;
}

/*DEFAULT SETTING DO NOT TOUCH*/
/*Revert triangle padding to 0px to ensure the sized is fixed across all triangles*/
.angle {
    padding: 0px;
}
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
.analysis_bottom {
    width: 100%;
    height: calc(100% - 110px);

    margin-top: 25px;

    background-color: #EBF2FA;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/*Step1 CSS*/
.reload_pic, .activity_option_icon {
    width: 250px;
    height: 250px;

    border-radius: 100%;

    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 8em;

    background-color: white;
}

.reload_title {
    /* background-color: #BBEDFF; */
    color:#427AA1;

    margin: 20px 0px;

    text-align: center;
    text-transform: uppercase;
    font-size: 2.5em;
    word-wrap: break-word;
    font-family:  'Heebo', Arial, sans-serif;
}

.reload_input {
    width: 500px;
    height: 80px;

    display: flex;
    justify-content: center;
    align-items: center;

    background-color: lightcoral;

    
}

.reload_input * {
    outline: none;
    border: none;
    
}

.reload_input input {
    width: 100%;
    height: calc(80px - 2px);
    
    font-size:  2.2em;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
}

.reload_input button {
    min-width: 80px;
    width: 80px;
    height: inherit;
    background-color: #EBEBEB;
    color: #427AA1;

    font-size:  2.6em;
}
/*^^^^^^^^^*/

/*Step2 CSS*/
.activity_cage {
    width: 100%;
    height: 100%;

    background-color: white;
    display: flex;
}

.activity_stack {
    width: 35%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.card_status {
    width: 100%;
    height: 90px;
    min-height: 90px;

    display: flex;
    justify-content: center;
    align-items: center;

    background-color: white;

    text-transform: uppercase;
    font-size:  2.2em;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
}

.card_status span {
    color: lightgreen;
    margin-left: 10px;
}

.activity_option {
    width: calc(100% - 50px);
    height: calc(100% - 140px);

    margin: auto;

    border-radius: 50px;

    background-color: #BBEDFF;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.activity_option_button {
    width: 100%;

    display: flex;
    justify-content: center;

    margin: 15px 0px;

}

.activity_option_button button {
    outline: none;
    border: none;

    width: 90%;
    
    min-height: 60px;

    border-radius: 20px;

    
    background-color:#427AA1;
    color:white;

    text-transform: uppercase;
    /*font-size:  2.2em;*/
    font-size: 1.8vw;
    word-wrap: break-word;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
}

/*Step3: Reload amount section*/
.reload {
    width: 200px;
    height: 200px;
}

.reload_cage {
    width: 50%;
    
    margin-top: 20px;

    display: flex;
    
    flex-direction: column;
    
}

.reload_cage button {
    outline: none;
    border: none;
    border-radius: 50px;
    
    padding: 15px 20px;
    margin-right: 20px;
    
    
    
    align-self: flex-end;

    font-size: 1.6vw;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
    color:white;
    background-color:#427AA1;

}

.reload_stack {
    width: 100%;
    height: 20%;

    margin-bottom: 15px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.reload_stack_title {
    width: 40%;
    height: 100%;

    color: #427AA1;

    font-size: 1.8vw;
    word-wrap: break-word;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;

    display: flex;
    align-items: center;
}

.reload_stack_title span {
    margin-left: auto;
}

.reload_stack input {
    outline: none;
    border: none;

    height: 100%;
    width: 50%;

    font-size: 1.8vw;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
}

/*Ste3A: Refund transaction*/
.trans_title_cage {
    width: 60%;
    height: 115px;

    background-color: #427AA1;

    margin-bottom: auto;
    margin: 25px;
    
    display: flex;
    justify-content: space-between;
    padding:50px;
    

    font-family: 'Heebo', Arial, sans-serif;
}

.trans_title_cage div h2 {
    padding: 0px;
    margin: 0px;
    line-height: 90%;
    color:white;
}

.trans_title_cage div span {
    font-size: 0.9vw;
    color:white;
}

.trans_title_time, .trans_title_profit {
    
    height: 100%;

    margin: 0px 30px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    font-size: 1.5vw;
}

.trans_detail_cage {
    width: 100%;
    height: 80%;

    flex-direction: column;

    overflow-y: scroll;
    overflow-x: hidden;
}



.trans_detail, .trans_detail_search {
    width: 100%;
    height: 70px;
    min-height: 70px;

    padding: 10px 0px;

    display: flex;
    justify-content: space-between;

    color:inherit;

    text-decoration: none;

    border-bottom: 3px solid #427AA1;
    
}

.trans_detail_food, .trans_detail_price, .trans_detailTitle {
    width: 35%;
    height: 100%;


    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;

    font-size: 1.6vw;
    font-family: 'Heebo', Arial, sans-serif;

    color:#427AA1;

}

.trans_detail_food, .trans_detailTitle {
    padding-left: 30px;
}

.trans_detailTitle {
    font-size: 1.8vw;
    text-transform: uppercase;
}

.trans_detail_food span {
    font-size: 1.2vw;
}

.trans_detail_price {
    font-size: 2vw;

    align-items: flex-end;
    padding-right: 30px;

    width: unset;
}

/*Search div for step3A Refund*/
.report_search {
    width: 30%;
    height: 100%;

    font-size: 30px;

    display: flex;
    justify-content: flex-end;
    align-items: center;

    padding-right: 30px;

    background-color: #EBF2FA;
    color : #427AA1;
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
}


#Card {
    display: flex;
}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
</style>
<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />

<?php
    if(isset($_SESSION['accessUserID']))
    {
        echo '<style>

        #Card{
            display: none;
            
        }
        
        #Activity {
            display: flex;
            
        }
        </style>';
    }

    //NAVIGATION AFTER TOP UP   
    if (isset( $_SESSION['checkTopUP']))
    {

        echo '<style>

        #Modal1{
            display: flex;
        }

        #Refund{
            display: none;
        }

        #topUp{
            display: flex;
        }

        #Activity{
            display: none;
        }

        </style>';

        unset($_SESSION['checkTopUP']);

    }

    if(isset($_SESSION['displayTransHis']))
    {
        echo '<style>#Modal1 {
            display: none;
        }
        
        
        #Activity {
            display: none;
        }
        
        #topUp{
            display: none;
        }

        #Refund{
            display: flex;
        }

        #transHistory{
            display: flex;
        }

        </style>';
        unset($_SESSION['displayTransHis']);


    }

    if(isset($_GET['toomuch']))
    {
        echo '<style>

        #Modal1{
            display: none;
        }

        #Refund{
            display: none;
        }

        #topUp{
            display: flex;
        }

        #Activity{
            display: none;
        }
        #toomuchModal{
            display: flex;

        }
    
        </style>';

    }

    if(isset($_GET['notenoughamount'])){
        echo '<style>

        #Modal1{
            display: none;
        }

        #Refund{
            display: none;
        }

        #topUp{
            display: flex;
        }

        #Activity{
            display: none;
        }
        #toolessModal{
            display: flex;

        }

        </style>';
    }



    //NAVIGATION AFTER REFUND PROCESS
    if(isset($_SESSION['doneRefund']))
    {

        echo '<style>

        #Modal2{
            display: flex;
        }

        #Modal1{
            display: none;
        }

        #Refund{
            display: flex;
        }

        #topUp{
            display: none;
        }

        #Activity{
            display: none;
        }

        </style>';

        unset($_SESSION['doneRefund']);
    }

    if(isset($_GET['invalidid'])){
        echo '<style>

        #invalididModal{
            display: flex;
        }

      
        </style>';
    }

    if(isset($_GET['deactivatedcard'])){
        echo '<style>

        #deactivatedModal{
            display: flex;
        }

      
        </style>';
    }



?>


<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />
</head>

<body>
    <!--Title Bar-->
    <div class="top">
        <div class="top_left LOL" id = "popUp2">
            APU Cafeteria System
            <i class="fas fa-utensils"></i>
        </div>

        <form class="top_right">
          <button type="button" id="user"> <span class="user_cover"> <i class="fas fa-user-circle"></i></span></button> 
            
        </form>


        <div class="notif_setting_cage">
            <a href="../userSettings/userSettings.php" class="notif_setting_stack">
                <h2>View Profile</h2>
            </a>

            <a href="../server.php?logout" class="notif_setting_stack">
                <h2>Log Out</h2>
            </a>
        </div>

    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <!-- <div id="bottom_left" class="">
            <a href="../homeAdmin.php?unset" class="btn unset"><i class="fas fa-home"></i>Home </a>
            <a href="../Analysis/analysisMain.php?unset" class="btn unset"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../foodVendor/foodVendorMain.php?unset" class="btn unset"><i class="fas fa-store"></i>Food Vendors </a>
            <a href="../accessCard/accessCardMain.php?unset" class="btn unset activeTab tablinks" onclick="openCity(event, 'Card');"><i class="fas fa-id-card"></i>Access Cards</a>
            <a href="../systemUsers/systemUsers.php?unset" class="btn unset"><i class="fas fa-user"></i>System Users</a>
        </div> -->

        <?php


        //FILTER PAGES TO BE ACCESSED BY ADMIN AND HELP DESK
        if($_SESSION['loginRole'] == "admin"){
            echo ' <div id="bottom_left" class="">';
                echo '<a href="../homeAdmin.php?unset" class="btn unset"><i class="fas fa-home"></i>Home </a>';
                echo '<a href="../Analysis/analysisMain.php?unset" class="btn unset"><i class="fas fa-chart-area  "></i>Analysis </a>';
                echo '<a href="../foodVendor/foodVendorMain.php?unset" class="btn unset"><i class="fas fa-store"></i>Food Vendors </a>';
                echo '<a href="../accessCard/accessCardMain.php?unset" class="btn unset activeTab tablinks" onclick="openCity(event, "Card");"><i class="fas fa-id-card"></i>Access Cards</a>';
                echo '<a href="../systemUsers/systemUsers.php?unset" class="btn unset"><i class="fas fa-user"></i>System Users</a>';
            echo '</div>';

        }else if ($_SESSION['loginRole'] == "help desk"){
            echo ' <div id="bottom_left">';
                echo '<a href="../accessCard/accessCardMain.php?unset" class="btn unset activeTab tablinks" onclick="openCity(event, "Card");"><i class="fas fa-id-card"></i>Access Cards</a>';
                echo '<a href="../systemUsers/systemUsers.php?unset" class="btn unset"><i class="fas fa-user"></i>System Users</a>';
            echo '</div>';
        }


?>

        <div class="bottom_right">
           <div class="analysis_cage">
                    
                    <!-- Step1: Enter User ID -->
                    <div id="Card" class="tabcontent">
                        <div class="analysis_top">
                           <div class="step_design step_length step_darkColour" style="padding: 0px 30px 0px 80px;">
                            Step 1: Enter ID
                           </div>

                           <div class="angle tri_dark_medium"></div>

                           <div class="step_design step_length step_mediumColour">
                            Step 2
                           </div>

                           <div class="angle tri_medium_light"></div>

                           <div class="step_design step_length step_lightColour">
                            Step 3
                           </div>

                           <div class="angle  tri_light"></div>
                        </div>

                        <div class="analysis_bottom">
                            <div class="reload_pic">
                                    <i class="fas fa-id-card"></i>
                            </div>
                            <div class="reload_title">
                                Please Enter The Card ID:
                            </div>
                            <form class="reload_input" action="accesscardCRUD.php" method = "POST">
                                <input name = "userID" type="text" pattern ="[TP,VS,EM,HD,AD,SF,sf,tp,vs,em,hd,ad]{2}[0-9]{6}" title="id is case sensitive, be sure to include characters such as TP, VS, EM, AD, HD" required>
                                <button type="submit" name = "btnConfirm"><i class="fas fa-arrow-right"></i></button>

                            </form>
                        </div>
                     </div>

                     <!-- Step2: Select your activity section -->
                    <div id="Activity" class="tabcontent">
                        <div class="analysis_top">
                            <div class="step_design step_length step_mediumColour" style="padding: 0px 30px 0px 80px;">
                                Step 1
                            </div>
    
                            <div class="angle tri_medium_dark "></div>
    
                            <div class="step_design step_length step_darkColour ">
                                Step 2: Select Your Activity
                            </div>
    
                            <div class="angle tri_dark_light"   ></div>
    
                            <div class="step_design step_length step_lightColour">                             
                                Step 3
                            </div>
    
                            <div class="angle  tri_light"></div>

                            <button id="back_button" class="tablinks" onclick="openCity(event, 'Card');" name = "backBtn" form="accessTabBack"><i class="fas fa-arrow-left"></i></button>
                           <form action="accessCardMain.php" id = "accessTabBack" method="post"></form>
                        </div>

                        <div class="analysis_bottom">
                            <div class="activity_cage">
                                <div class="activity_stack">
                                    <div class="card_status">
                                        <?php echo "CARD ID: ".$_SESSION['accessUserID'];?>
                                    </div>

                                    <div class="activity_option">
                                        <div class="activity_option_icon">
                                            <i class="far fa-money-bill-alt"></i>
                                        </div>

                                        <form class="activity_option_button">
                                            <button type="button" class="tablinks" onclick="openCity(event, 'topUp');">Top Up</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="activity_stack" >
                                    <div class="card_status">
                                        <?php
                                        
                                        if(@$_SESSION['referRole'] == 'kitchen employee' OR $_SESSION['referRole'] == 'kitchen owner')
                                        {
                                            echo "BALANCE: RM".$_SESSION['employeeBalance'];
                                            @$_SESSION['balance'] = $_SESSION['employeeBalance'];
                                        }else
                                        {
                                            echo "BALANCE: RM".$_SESSION['userBalance'];
                                            @$_SESSION['balance'] = $_SESSION['userBalance'];
                                        }

                                        ?>
                                    </div>

                                    <div class="activity_option" >
                                        <div class="activity_option_icon">
                                            <i class="fas fa-redo-alt"></i>
                                        </div>

                                        <form class="activity_option_button">
                                            <button type="button" class="tablinks" onclick="openCity(event, 'Refund');">Refund</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="activity_stack" >
                                    <div class="card_status" >
                                        STATUS : <span> <?php 
                                            if(@$_SESSION['referRole'] == 'kitchen employee' OR $_SESSION['referRole'] == 'kitchen owner')
                                            {
                                                echo $_SESSION['employeeStatus'];
                                                @$_SESSION['status'] = $_SESSION['employeeStatus'];
                                            }else
                                            {
                                                echo $_SESSION['userStatus'];
                                               @ $_SESSION['status'] = $_SESSION['userStatus'];
    
                                            }

                                        ?></span> 
                                    </div>

                                    <div class="activity_option" >
                                        <div class="activity_option_icon">
                                            <i class="far fa-money-bill-alt"></i>
                                        </div>

                                        <form class="activity_option_button" action = "accesscardCRUD.php" method= "POST">
                                            <button id = "popUp_CardStatus" type="button" name = "changeStatusBtn">Change card status</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step3: Top Up section-->
                    <div id="topUp" class="tabcontent">
                        <div class="analysis_top">
                            <div class="step_design step_length step_mediumColour" style="padding: 0px 30px 0px 80px;">
                                Step 1
                            </div>

                            <div class="angle tri_medium_light"></div>

                            <div class="step_design step_length step_lightColour">
                                Step 2
                            </div>

                            <div class="angle tri_light_dark"></div>

                            <div class="step_design step_length step_darkColour">
                                Step 3: Enter Top Up Amount
                            </div>

                            <div class="angle  tri_dark_light"></div>

                            <button id="back_button" class="tablinks" onclick="openCity(event, 'Activity');"><i class="fas fa-arrow-left"></i></button>
                        </div>
 
                        <div class="analysis_bottom">
                            <div class="reload_pic reload">
                                    <i class="far fa-money-bill-alt"></i>
                            </div>
                           
                            <form class="reload_cage" action="accesscardCRUD.php" method = "POST">
                                <div class="reload_stack"> 
                                    <div class="reload_stack_title">
                                        Card ID 
                                        <span>:</span>
                                    </div>

                                    <input type="text" value = "<?php echo $_SESSION['accessUserID'];?>" readonly>
                                </div>

                                <div class="reload_stack"> 
                                    <div class="reload_stack_title">
                                        Balance 
                                        <span>:</span>
                                    </div>

                                    <input class="reload_input_number" type="number" value = "<?php echo $_SESSION['balance']?>" readonly>
                                </div>

                                <div class="reload_stack"> 
                                    <div class="reload_stack_title">
                                        Amount
                                        <span>:</span>
                                    </div>

                                    <input name = "amount" class="reload_input_number" type="text" pattern = "^\d*(\.\d{0,2})?$" tilte = "Invalid number format. Integers only." required>
                                </div>

                                <button name = "topupConfirmBtn" type="submit" id="popUp1">Confirm</button>
                            </form>
                        </div>
                    </div>



                    <!-- Step3A: Refund transaction -->
                    <form id="Refund" class="tabcontent" action="accessCardMain.php" method = "POST">
                        <div class="analysis_top">
                            <div class="step_design step_length step_mediumColour" style="padding: 0px 30px 0px 80px;">
                                Step 1
                            </div>

                            <div class="angle tri_medium_light"></div>

                            <div class="step_design step_length step_lightColour">
                                Step 2
                            </div>

                            <div class="angle tri_light_dark"></div>

                            <div class="step_design step_length step_darkColour">
                                Step 3: Refund transaction
                            </div>

                            <div class="angle  tri_dark_light"></div>

                            <button id="back_button" class="tablinks" onclick="openCity(event, 'Activity');"><i class="fas fa-arrow-left"></i></button>
                        </div>

                        <div class="analysis_bottom">
                            <div class="trans_title_cage">
                                <div class="trans_title_time">
                                <?php
                                    
                                    if ($_SESSION['referRole'] == 'kitchen employee' OR $_SESSION['referRole'] == 'kitchen owner')
                                    {
                                        //VIEW KITCHEN OWNER. KITCHEN EMPLOYEE'S TRANSACTION HISTORY
                                        $eTransquery = "SELECT * FROM `employee` WHERE `employee_id` = '".$_SESSION['accessUserID']."' ";
                                        $eTransquery_run = mysqli_query($con, $eTransquery);
                                        $eTransquery_run_rows = mysqli_fetch_assoc($eTransquery_run);
                                        $showTransData = $eTransquery_run_rows['employee_balance'];
                                        $current_Date = date("d-m-Y");

                                        echo "<h2>".$_SESSION['accessUserID']."</h2>";
                                        echo "<span>","Last Updated","</span>";
                                        echo '<span name ="storeLatestDate" style="font-size: 22px;">'.$current_Date.'</span>';
                                        echo "</div>";

                                        echo "<div class='trans_title_profit'>";
                                        echo "<span>Profit</span>";
                                        echo "<h2>".$showTransData."</h2>"  ;
                                        echo "</div>";

                                    }else
                                    {
                                        //VIEW HELP DESK, STAFF AND STUDENT'S TRANSACTION HISTORY
                                        $uTransquery = "SELECT * FROM `user` WHERE `user_id` = '".$_SESSION['accessUserID']."' ";
                                        $uTransquery_run = mysqli_query($con, $uTransquery);
                                        $uTransquery_run_rows = mysqli_fetch_assoc($uTransquery_run);
                                        $showTransData = $uTransquery_run_rows['card_amount'];
                                        $current_Date = date("d-m-Y");

                                        
                                        echo "<h2>".$_SESSION['accessUserID']."</h2>";
                                        echo "<span>","Last Updated","</span>";
                                        echo '<span name ="storeLatestDate" style="font-size: 22px;">'.$current_Date.'</span>';
                                        echo "</div>";

                                        echo "<div class='trans_title_profit'>";
                                        echo "<span>Balance</span>";
                                        echo "<h2>".$showTransData."</h2>"  ;
                                        echo "</div>";

                                    }
                                    ?>

                            </div>

                            <div class="trans_detail_search">
                                <div class="trans_detailTitle">
                                    Select The Transaction : 
                                </div>

                        
                                <!-- <FORM></FORM> -->
                                <div class="report_search" >
                                    <input class = "report_search" name = "accessSearchInput"  type="text" placeholder="Search" pattern="[a-zA-Z0-9\s]+"  title ="Search index should not include special characters, try to search with order ID, transaction ID or food names" required>
                                    <button class = "" name = "accessSearch" type = "submit" ><i class="fas fa-search"></i></button>
                                </div>

                            </div>

                            <div class="trans_detail_cage">
                                <?php
                                    //MAKE SURE refund is always open
                                    if(isset($_POST['accessSearch']))
                                    {

                                        echo '<style>

                                            #Modal1{
                                                display: none;
                                            }

                                            #Refund{
                                                display: flex;
                                            }

                                            #topUp{
                                                display: none;
                                            }

                                            #Activity{
                                                display: none;
                                            }

                                            </style>';

                                        $input = $_POST['accessSearchInput'];

                                        $viewPending = "SELECT * FROM pendingrequest 
                                        WHERE userID = '".$_SESSION['accessUserID']."' 
                                        AND (foodName LIKE '%$input%' OR trans_id LIKE '%$input%' OR orderID LIKE '%$input%' OR transDate LIKE '%$input%' OR transTime LIKE '%$input%' )

                                        ORDER BY transDate DESC ";
                                        $viewPending_run = mysqli_query($con, $viewPending);

                                        if(mysqli_affected_rows($con) < 1)
                                        {
                                          
                                            $viewPending = "SELECT * FROM pendingrequest WHERE userID = '".$_SESSION['accessUserID']."' 
                                            AND (foodName LIKE '%$input%' OR trans_id LIKE '%$input%' OR orderID LIKE '%$input%' OR transDate LIKE '%$input%' OR transTime LIKE '%$input%' )
                                            ORDER BY transDate DESC ";
                                            $viewPending_run = mysqli_query($con, $viewPending);
                                            
                                             while ($viewPending_run_rows = mysqli_fetch_assoc($viewPending_run))
                                            {
                                                $orderID = $viewPending_run_rows['orderID'];

                                                echo "<a class='trans_detail' href = 'accesscardCRUD.php?orderid=".$orderID."'>";

                                                        echo '<div class="trans_detail_food">';
                                                        echo $viewPending_run_rows['foodName'];
                                                        echo "<span>".$viewPending_run_rows['transDate']." at ".$viewPending_run_rows['transTime']."</span>";
                                                        echo '</div>';
                                                        
                                                        echo '<div class="trans_detail_price">';
                                                        echo  $viewPending_run_rows['quantity'];
                                                        echo '</div>';

                                                        echo '<div class="trans_detail_price">';
                                                        echo $viewPending_run_rows['totalRefundPrice'];
                                                        echo '</div>';

                                                echo '</a>';
                                            }
                                           

                                        }else{
                                              

                                            while ($viewPending_run_rows = mysqli_fetch_assoc($viewPending_run))
                                            {
                                                $orderID = $viewPending_run_rows['orderID'];

                                                echo "<a class='trans_detail' href = 'accesscardCRUD.php?orderid=".$orderID."'>";

                                                        echo '<div class="trans_detail_food">';
                                                        echo $viewPending_run_rows['foodName'];
                                                        echo "<span>".$viewPending_run_rows['transDate']." at ".$viewPending_run_rows['transTime']."</span>";
                                                        echo '</div>';
                                                        
                                                        echo '<div class="trans_detail_price">';
                                                        echo  $viewPending_run_rows['quantity'];
                                                        echo '</div>';

                                                        echo '<div class="trans_detail_price">';
                                                        echo $viewPending_run_rows['totalRefundPrice'];
                                                        echo '</div>';

                                                echo '</a>';
                                            }
                                            
                                        }
                                    }else{
                                        

                                        $viewPending = "SELECT * FROM pendingrequest WHERE userID = '".$_SESSION['accessUserID']."' ORDER BY transDate DESC ";
                                        $viewPending_run = mysqli_query($con, $viewPending);
                                        // echo mysqli_affected_rows($con);
                                        if(mysqli_affected_rows($con) < 1)
                                        {
                                          
                                            $viewPending = "SELECT * FROM pendingrequest WHERE employeeID = '".$_SESSION['accessUserID']."' ORDER BY transDate DESC ";
                                            $viewPending_run = mysqli_query($con, $viewPending);
                                            


                                             while ($viewPending_run_rows = mysqli_fetch_assoc($viewPending_run))
                                            {
                                                $orderID = $viewPending_run_rows['orderID'];

                                                echo "<a class='trans_detail' href = 'accesscardCRUD.php?orderid=".$orderID."'>";

                                                        echo '<div class="trans_detail_food">';
                                                        echo $viewPending_run_rows['foodName'];
                                                        echo "<span>".$viewPending_run_rows['transDate']." at ".$viewPending_run_rows['transTime']."</span>";
                                                        echo '</div>';
                                                        
                                                        echo '<div class="trans_detail_price">';
                                                        echo  $viewPending_run_rows['quantity'];
                                                        echo '</div>';

                                                        echo '<div class="trans_detail_price">';
                                                        echo $viewPending_run_rows['totalRefundPrice'];
                                                        echo '</div>';

                                                echo '</a>';
                                            }
                                           

                                        }else{
                                              

                                            while ($viewPending_run_rows = mysqli_fetch_assoc($viewPending_run))
                                            {
                                                $orderID = $viewPending_run_rows['orderID'];

                                                echo "<a class='trans_detail' href = 'accesscardCRUD.php?orderid=".$orderID."'>";

                                                        echo '<div class="trans_detail_food">';
                                                        echo $viewPending_run_rows['foodName'];
                                                        echo "<span>".$viewPending_run_rows['transDate']." at ".$viewPending_run_rows['transTime']."</span>";
                                                        echo '</div>';
                                                        
                                                        echo '<div class="trans_detail_price">';
                                                        echo  $viewPending_run_rows['quantity'];
                                                        echo '</div>';

                                                        echo '<div class="trans_detail_price">';
                                                        echo $viewPending_run_rows['totalRefundPrice'];
                                                        echo '</div>';

                                                echo '</a>';
                                            }
                                            
                                        }
                                    }



                                ?>
                            </div>
                        </div>
                    </form>
                  
           </div>
           
            <!-- The Modal 1-->
            <div id="Modal1" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Successfully Added!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>

            <!-- The Modal 1-->
            <div id="Modal2" class="modal">
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
            
            <!-- The Modal 1-->
            <div id="toomuchModal" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            Exceeded limit of RM1000 !!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>
            
            <!-- The Modal 1-->
            <div id="invalididModal" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            Invalid ID !!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>
            <!-- The Modal 1-->
            <div id="toolessModal" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-exclamation"></i>
                            </div>
                                The minimum limit is RM 10 !!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>

            <!--deactivatedModal-->
            <div id="deactivatedModal" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-exclamation"></i>
                            </div>
                                Card Deactivated !!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>


            

            <!-- The Add Confirmation Modal-->
            <div id="accessCardConfirm" class="modal">
            <!-- Modal content -->
            <div class="content_cage">
                <div class="content_outerCage">
                    <form class="content_innerCage" action = "accesscardCRUD.php" method = "POST">
                        <div class="content_infoTitle">
                            ARE YOU SURE YOU WANT TO Deactivate THE FOLLOWING card?
                        </div>
                        <div class="content_info_bottomCage">
                            <div class="content_detail_stack">
                                <div class="content_name">Card ID</div>
                                <span>:</span>
                                <div class="content_detail"><?php echo @$_SESSION['accessUserID'];?></div>
                            </div>

                            <div class="content_detail_stack">
                                <div class="content_name">Balance</div>
                                <span>:</span>
                                <div class="content_detail"><?php echo @$_SESSION['balance']; ?></div>
                            </div>

                            <div class="content_detail_stack">
                                <div class="content_name">Current Status</div>
                                <span>:</span>
                                <div class="content_detail"><?php echo @$_SESSION['status']; ?></div>
                            </div>



          

                        </div>
                        

                    </form>

                    <form class="button_group align_flexEnd" action = "accesscardCRUD.php" method = "POST">
                        <button type="submit" name = "changeStatusBtn" class="actionBtn">Confirm</button>
                        <button type="button" class="close">Cancel</button>

                    </form>
                    
                    
                </div>
            </div>
            </div>

            <!-- Show transaction history Modal-->
            <div id="transHistory" class="modal">
                <!-- Modal content -->
                <div class="content_cage trans_position">
                    <div class="content_outerCage trans_content">
                        <div class="content_bar">
                            <h2><?php echo @$_SESSION['pendingfoodName'];?></h2>
                            <div>Transaction ID: <?php echo @$_SESSION['pendingtransID'];?></div>
                            <div>Amount: <?php echo @$_SESSION['pendingquantity'];?></div>
                            <div>Total: <?php echo @"RM".$_SESSION['pendingtotalamount']; ?></div>
                            <h3><?php echo @$_SESSION['pendingdate']." at ".$_SESSION['pendingtime']; ?></h3>
                        </div>
                        
                        <form action = "accesscardCRUD.php" method = "POST">
                            <div class="content_refundBtn">
                                <button name = "refundBtn"  class = "actionBtn" >Refund</button>
                                <span class="close">Dismiss</span>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

  
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/accessCardModal.js"></script>
    <script type="text/javascript" src="../linkFiles/transactionPriceColour.js"></script>

</body>
</html>
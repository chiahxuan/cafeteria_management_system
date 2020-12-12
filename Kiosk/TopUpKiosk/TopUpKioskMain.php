<?php
    include("topUpCRUD.php");


?><!DOCTYPE html>
<html lang="en">
        
<head>        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="../linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../linkFiles/Modals_CSS/menu.css" type="text/css" />
<link rel="stylesheet" href="../linkFiles/transactionPriceColour.css" type="text/css" />
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

    background-color: rgb(235, 235, 235);
    
}

.topUpKiosk_top {

    width: 100%;
    height: 110px;
    min-height: 110px;

    display: flex;
    justify-content: flex-start;
    align-items: center;
    background-color :#EBF2FA;
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
    background-color: #fa3404;
    color:white;
}

.tri_dark_medium {
    border-top-color:  rgb(255, 211, 200);
    border-left-color:  #fa3404;
    border-right-color: rgb(255, 211, 200);
    border-bottom-color: rgb(255, 211, 200);
}

.step_mediumColour {
    background-color: rgb(255, 211, 200);
    color: #fa3404;
}

.tri_medium_light {
    border-top-color:  #EBF2FA;
    border-left-color:  rgb(255, 211, 200);
    border-right-color: #EBF2FA;
    border-bottom-color: #EBF2FA;
}

.step_lightColour {
    background-color: #EBF2FA;
    color: #fa3404;
}

.tri_light {
    border-top-color:  #EBF2FA;
    border-left-color:  #EBF2FA;
    border-right-color: #EBF2FA;
    border-bottom-color: #EBF2FA;
}

.tri_medium_dark {
    border-top-color:  #fa3404;
    border-left-color: rgb(255, 211, 200);
    border-right-color: #fa3404;
    border-bottom-color: #fa3404;
}

.tri_dark_light {
    border-top-color:  #EBF2FA;
    border-left-color:  #fa3404;
    border-right-color: #EBF2FA;
    border-bottom-color: #EBF2FA;
}

.tri_light_dark {
    border-top-color:  #fa3404;
    border-left-color:  #EBF2FA;
    border-right-color: #fa3404;
    border-bottom-color: #fa3404;
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
}

/*DEFAULT SETTING DO NOT TOUCH*/
/*Revert triangle padding to 0px to ensure the sized is fixed across all triangles*/
.angle {
    padding: 0px;
}
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

.topUpKiosk_bottom {
    width: 75%;
    height: 68%;

    margin-top: 2.6%;

    z-index: 1;
    position:relative;
    border-radius: 100px;

    background-color:rgb(255, 211, 200);

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    position:relative;
}

/*Step1 CSS*/
.topUp_pic, .activity_option_icon {
    width: 250px;
    height: 250px;

    border-radius: 100%;
    margin-top:-50px;

    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 8em;

    background-color: white;
    color:#fa3404;
}

.topUp_title {
    

    margin: 20px 0px;

    color:#fa3404;

    text-align: center;
    text-transform: uppercase;
    font-size: 2.5em;
    word-wrap: break-word;
    font-family:  'Heebo', Arial, sans-serif;
}

.topUp_input {
    width: 500px;
    height: 80px;

    display: flex;
    justify-content: center;
    align-items: center;

    background-color: lightcoral; 
}

.topUp_input * {
    outline: none;
    border: none;
    
}

.topUp_input input {
    width: 100%;
    height: calc(80px - 2px);
    
    font-size:  2.2em;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
    color:#fa3404;
}

.topUp_input button {
    min-width: 80px;
    width: 80px;
    height: inherit;

    font-size:  2.6em;
}
/*^^^^^^^^^*/

/*Step3: Top Up amount section*/
.topUp {
    width: 250px;
    height: 250px;
}

.topUp_cage {
    width: 100%;
    
    margin-top: 20px;

    display: flex;
    align-items: center;
    flex-direction: column;
    background-color: rgb(255, 211, 200);
    
}

.topUp_buttonCage{
    width:85%;
    display:flex;   
    justify-content: flex-end;
    align-items:flex-end;

    margin-top:-30px;

    position: absolute;
    bottom: -150px;
    right: -50px;
}

.topUp_buttonCage button{
    outline: none;
    border: none;
    border-radius: 75px;
    
    padding: 15px 20px;
    margin-right: 20px;
    
    width: 7em;

    background-color: white;
    color:#fa3404;

    font-size: 1.6vw;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
    z-index:2;
}

.topUp_stack {
    width: 100%;
    height: 20%;

    background-color: rgb(255, 211, 200);

    margin-bottom: 15px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.topUp_stack_title {
    width: 50%;
    height: 100%;

    background-color: rgb(255, 211, 200);
    color:#fa3404;

    font-size: 2.2vw;
    margin-right:250px;
    word-wrap: break-word;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;

    display: flex;
    align-items: center;
    
}

.topUp_stack_title span {
    margin-left: auto;
}

.topUp_stack input {
    outline: none;
    border: none;

    height: 100%;
    width: 80%;

    color:#fa3404;

    font-size: 1.8vw;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
}

/* Open card tab by default */
#Card {
    display: flex;
}

#Activity {
    display: none;
}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
</style>
<?php

    if(isset($_GET['deactivatedcard'])){
        echo '<style>

        #deactivatedModal{
            display: flex;
        }


    
        </style>';
    }

    if(isset($_GET['displayActivity'])){
        echo '<style>
        #Card {
            display: none;
        }
        
        
        #Activity {
            display: flex;
        }
        
            
        </style>';
    }

    if(isset($_GET['topupsuccess'])){
        echo '<style>
        #Card {
            display: flex;
        }
        
        
        #Activity {
            display: none;
        }
        #Modal1{
            display: flex;        
        }
        </style>';
    }

    if(isset($_GET['toomuch']))
    {
        echo '<style>

        #Card{
            display: none;
        }
        #Activity{
            display: flex;
        }

        #toomuchModal{
            display: flex;

        }
    
        </style>';

    }

    if(isset($_GET['notenoughamount'])){
        echo '<style>

        #Card{
            display: none;
        }
        #Activity{
            display: flex;
        }
        #toolessModal{
            display: flex;

        }

        </style>';
    }

    
    if(isset($_GET['invalidid'])){
        echo '<style>

        #invalididModal{
            display: flex;
        }

      
        </style>';
    }


?>
<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />
</head>

<body>

    <!--Menu Bar-->
    <div class="bottom">
        <div class="bottom_right">
           <div class="topUpKiosk_cage">       
                    <!-- Step1: Enter User ID -->
                    <div id="Card" class="tabcontent">
                        <div class="topUpKiosk_top">
                           <div class="step_design step_length step_darkColour" style="padding: 0px 30px 0px 80px;">
                            Step 1: Enter ID
                           </div>

                           <div class="angle tri_dark_medium"></div>

                           <div class="step_design step_length step_mediumColour">
                            Step 2
                           </div>

                           <div class="angle tri_medium_light"></div>

                           <div class="step_design step_length step_lightColour">
                            
                           </div>

                           <div class="angle  tri_light"></div>
                        </div>

                        <div class="topUpKiosk_bottom">
                            <div class="topUp_pic">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="topUp_title">
                                Please Enter The Card ID:
                            </div>
                            <form class="topUp_input" action="topUpCRUD.php" method = "POST">
                                <input name = "userID" type="text" pattern ="[TP,VS,EM,HD,AD, SF,sf, tp,vs,em,hd,ad]{2}[0-9]{6}" title="id is case sensitive, be sure to include characters such as TP, VS, EM, AD, HD" required>
                                <button type="submit" name = "btnConfirm"><i class="fas fa-arrow-right"></i></button>
                            </form>

              
                        </div>
                     </div>

                     <!-- Step2: Enter Top Up Amount -->
                    <div id="Activity" class="tabcontent">
                        <div class="topUpKiosk_top">
                            <div class="step_design step_length step_mediumColour" style="padding: 0px 30px 0px 80px;">
                                Step 1
                            </div>
    
                            <div class="angle tri_medium_dark "></div>
    
                            <div class="step_design step_length step_darkColour ">
                                Step 2: Enter Top Up Amount
                            </div>
    
                            <div class="angle tri_dark_light"   ></div>
    
                            <div class="step_design step_length step_lightColour">                             
                                
                            </div>
    
                            <div class="angle  tri_light"></div>
                        </div>

                        <div class="topUpKiosk_bottom">
                            <div class="topUpKiosk_bottom">
                                <div class="topUp_pic topUp">
                                        <i class="far fa-money-bill-alt"></i>
                                </div>
                               
                                <form class="topUp_cage" id="topUp_send" method = "POST" action = "topUpCRUD.php">
                                    <div class="topUp_stack"> 
                                        <div class="topUp_stack_title">
                                            Card ID 
                                            <span>:</span>
                                        </div>
    
                                        <input type="text" name = "topupUid" value = "<?php echo $_SESSION['topUpUserID']; ?>" readonly>
                                    </div>
    
                                    <div class="topUp_stack"> 
                                        <div class="topUp_stack_title">
                                            Balance 
                                            <span>:</span>
                                        </div>
    
                                        <input class="topUp_input_number" type="number" value = "<?php echo $_SESSION['topupBal'];?>" readonly>
                                    </div>
    
                                    <div class="topUp_stack"> 
                                        <div class="topUp_stack_title">
                                            Amount
                                            <span>:</span>
                                        </div>
    
                                        <input class="topUp_input_number" type="text" pattern = "^\d*(\.\d{0,2})?$" name = "topupamount" type="text" required >
                                    </div>

                                    <div class = "topUp_buttonCage" >
                                        <button type="submit" name = "topupConfirm" >Confirm</button>
                                         <button id="button" type = "button" class="tablinks" onclick="openCity(event, 'Card');">Back</button>
                                    </div> 

                                </form>
                            </div>
                           

                        </div>
                        
                    </div>                 
            </div>
                  
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
                            Successfully Top Up !
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div> 

            <div id="toomuchModal" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            TOP UP not more than RM1000 !!
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
                            TOP UP not less than RM 10 !!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>

            <!--deactivatedcard-->
            <div id="deactivatedModal" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-exclamation"></i>
                            </div>
                                Card Deavtivated !!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>



    </div>

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/accessCardModal.js"></script>
    <script type="text/javascript" src="../linkFiles/transactionPriceColour.js"></script>
    <script>
    
        // function submitConfirm() {
        //         // document.chkOut.submit();
        //         document.forms['topUp_send'].submit();
        //     }
    </script>


</body>
</html>


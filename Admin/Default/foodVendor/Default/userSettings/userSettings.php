<?php
    include('FoodVendoruserSettingCRUD.php');

            //SECURE WEBPAGE WITH LOGIN ROLE TO AVOID UNAUTHORIZED ACCESS
            if(!isset($_SESSION['loginRole'])){

                header('location: ../../../Admin/Default/login.php');
        
            }
    

?>
<!DOCTYPE html>
<html lang="en">
        
<head>
        <link rel="stylesheet" media="screen" href="style.css" type="text/css" />
        <link rel="stylesheet" media="handheld" href="mobile.css" type="text/css" />

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<link rel="stylesheet" href="../linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../linkFiles/Modals_CSS/menu.css" type="text/css" />
<style>

.analysis_bottom {
    width: 100%;
    height: 100%;

    background-color: white; 

    display: flex;
    flex-direction: column;
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

.profile_title_cage {

    width: 80%;
    height: 40%;

    position: relative;

    display: flex;
    align-items: flex-end;

    font-size: 2.4vw;
    font-family:  'Heebo', Arial, sans-serif;
}

.profile_name {
    width: 90%;
    height: 50%;

    position: absolute;

    top: 10%;
    
    z-index: 1;

    background-color: transparent;

    display: flex; 
    justify-content: flex-end;
}

.profile_name_data {
    background-color: #427AA1;
    color: white;

    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.profile_role {
    width: 90%;
    height: 50%;
    background-color: transparent;

    display: flex;
    justify-content: flex-end;
}

.profile_role_data {
    background-color: #BBEDFF;
    color: #427AA1;

    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.angle {
    max-width: 0px;
    max-height: 0px;
    

    border-top: 8.4vh solid #427AA1;
    border-left: 45px solid #427AA1;
    border-right: 45px solid #427AA1;
    border-bottom: 8.3vh solid #427AA1;
    
}

.dark_angle {
    border-top-color:  #427AA1;
    border-left-color: #427AA1;
    border-right-color: transparent;
    border-bottom-color: transparent;
}

.light_angle {
    border-top-color:  #BBEDFF;
    border-left-color: #BBEDFF;
    border-right-color: transparent;
    border-bottom-color: transparent;
}


.profile_input_cage {
    width: 80%;
    height: 40%;

    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.profile_input_stack {
    display: flex;
    color: #427AA1;

    width: 75%;

    margin-bottom: 20px;

    font-size: 1.8vw;
    font-family:  'Heebo', Arial, sans-serif;
}

.profile_input_name {
    display: flex;
    justify-content: flex-end;

    min-width: 30%;
}

.profile_input_data {
    outline: none;
    border: none;

    min-width: 60%;
    margin-left: 5%;

    font-size: 1.6vw;
    font-family:  'Heebo', Arial, sans-serif;
   
}


.profile_input_stack button {
    outline: none;
    border: none;

    font-size: 1em;
    
    width: 50px;
}

.profile_button {
    outline: none;
    border: none;

    padding: 10px 45px;
    border-radius: 50px;

    color: #427AA1;
    background-color: #EBF2FA;

    font-size: 1.8vw;
    font-family:  'Heebo', Arial, sans-serif;
    background-color: #BBEDFF;
    /* align-self: flex-end; */

    /* margin-left: 15px; */

}

.button_group_outside {

    display:flex;
    align-self: flex-end;
    margin-right: 10%;
    justify-content: flex-end;


}

#profileConfirm {
    background-color: red;
    
}
</style>
<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />
<?php
    if(isset($_GET['updatesuccess'])){
            //sucessfully updated
        
        echo '<style>
        #Modal1 {
            display: none;
        }
        

        #ModalUpdated{
            display:flex;
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
            <a href="../homeFoodvendor.php?unset" class="btn activeTab"><i class="fas fa-home"></i>Home </a>
            <a href="../Analysis/analysisMain.php?unset" class="btn"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../order/order.php?unset" class="btn"><i class="fas fa-store"></i>Order </a>
            <a href="../Transaction/Transaction.php?unset" class="btn "><i class="fas fa-id-card"></i>Transaction</a>
            <a href="../employee/employee.php?unset" class="btn"><i class="fas fa-user"></i>Employee</a>
			<a href="../Menu/menu.php?unset" class="btn"><i class="fas fa-book-open"></i>Food Menu</a>
			
        </div>
        <!-- onclick="openCity(event, 'Cafeteria');" id="defaultOpen" -->
        <div class="bottom_right">
           <div class="analysis_cage">
                <div class="analysis_bottom">   
                    <div class="profile_title_cage">
                        <div class="profile_name">
                            <div class="profile_name_data"><?php echo $_SESSION['loginName'];  ?></div>
                            <div class="angle dark_angle"></div>
                        </div>

                        <div class="profile_role">
                            <div class="profile_role_data"><?php echo $_SESSION['loginRole'];  ?></div>
                            <div class="angle light_angle"></div>
                        </div>
                    </div>

                    <form class="profile_input_cage" action = "FoodVendoruserSettingCRUD.php" method = "POST">
                        <div class="profile_input_stack">
                            <div class="profile_input_name">Name :</div>
                            <input id = "profileNameInput" name = "editName" type = "text" class="profile_input_data" value="<?php echo $_SESSION['loginName'];?>" pattern="[a-zA-Z\s]+" title="user name should not include characters and numbers" readonly>
                            <button id ="profileEditName" type="button"><i class="fas fa-pen"></i></button>
                        </div>


                        <div class="profile_input_stack">
                            <div class="profile_input_name">Password :</div>
                            <input  name = "profilePwInput" type="password" class="profile_input_data" value="<?php echo $_SESSION['loginPw'];?>" readonly>
                            <button type="button" id="popUp1"><i class="fas fa-pen"></i></button>
                        </div>

                        <div class = "button_group_outside">
                            <button class="profile_button tab_colour" id = "profileConfirm" name ="profileConfirm" type = "submit" style= "display:none;">CONFIRM</button>
                            <button class="profile_button" id = "profileCancel" form = "tab_form" style= "display:none; margin-left: 15px; background-color: #BBEDFF;">CANCEL</button>
                            <button class="profile_button" id = "profileBack" form = "tab_form" onclick="window.history.back();">BACK</button>
                        </div>    
                    </form>

                    <!-- <button class="profile_button" onclick="window.history.back();">
                        BACK
                    </button> -->
                    
                </div>
           </div>

           <!-- The Modal 1-->
           <div id="Modal1" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage modal_resize_full">
                        <form class="content_innerCage" action = "FoodVendoruserSettingCRUD.php" method = "POST">
                            <div class="content_title">Change Password</div>

                            <div class="content_input_stack">
                                <div class="content_input_title">
                                    Previous password :
                                </div>

                                <input name = "previousPw" type="password" class="content_input" required>
                            </div>

                            <div class="content_input_stack">
                                <div class="content_input_title">
                                    New password :
                                </div>

                                <input name = "newPw" type="password" class="content_input" required>
                            </div>

                            <div class="content_input_stack">
                                <div class="content_input_title">
                                    Reconfirm new password :
                                </div>

                                <input name = "RetypenewPw" type="password" class="content_input" required>
                            </div>
                            
                            <div class="button_group">
                                <button name = "changePwConfirm" type="submit" class="close_style">Confirm</button>
                                <button type="button" onlick="goBack()" class="close">Cancel</button>
                            </div>
                            

                        </form>
                    </div>
                </div>
            </div>

            <!-- Updated Modal -->
            <div id="ModalUpdated" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Successfully Updated!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/userSettingsModal.js"></script>
    <script type="text/javascript" src="../linkFiles/userSetting.js"></script>
</body>
</html>
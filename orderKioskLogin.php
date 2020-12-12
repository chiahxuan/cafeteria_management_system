<?php
    include("orderKioskServer.php");//include connection to database
    // include("server.php");//include connection to database

    @$invalid = "";
    if (isset($_SESSION['kioskInvalidError'])) {
       //echo '<script type = "text/javascript"> alert("invalid username and password") </script>'; 
       @$invalid = $_SESSION['kioskInvalidError'];
       
       unset($_SESSION['kioskInvalidError']);
    }
?>
<!DOCTYPE html>
<html lang="en">
        
<head>
        <link rel="stylesheet" media="screen" href="style.css" type="text/css" />
        <link rel="stylesheet" media="handheld" href="mobile.css" type="text/css" />
        <link rel="stylesheet" href="Admin/linkFiles/Modals_CSS/popUpModals.css" type="text/css" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">



<style>
@import "//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css";


html {
    /*DEFAULT SETTINGS DO NOT TOUCH*/
        height: 100%;
    /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
    }
body {
    /*DEFAULT SETTINGS DO NOT TOUCH*/
    padding: 0;
    margin: 0;
    height: 100%;
    /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

    /*Set up background image for body*/
    background-image: url("Image/burger.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
    color: white;

    /*Set login_cage hoz and ver center*/
    display: flex;
    justify-content: center;
    align-items: center;
   /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

    
    
}

.login_cage {
   
    max-height: 600px;
    width: 350px;
    max-width: 350px;
    background-color: WHITE;

    display: flex;
    flex-direction: column;
    
   
}

.login_icon_cage {
    
    height: 300px;

        /*Set login_cage hoz and ver center*/
    display: flex;
    justify-content: center;
    align-items: center;
   /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

}


.login_icon_center {
    background-color: white;
    position: relative;
    width: 60%;

   border-radius: 50%;
}

.login_icon_center:before{
	content: "";
	display: block;
	padding-top: 100%; 	/* initial ratio of 1:1*/
}


.login_icon {
	position:  absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;

  /*Set up background image for login_icon*/
    background-image: url("Image/user2.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100%;
    color:white;
    /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

}

.login_input_cage {
    max-height: 100%;
    background-color: #EBF2FA;
    
}

.login_input_form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;


    max-height: 100%;
    background-color: white
}


input {
    text-indent: 20px;
    font-family: FontAwesome, Arial, Helvetica, sans-serif;
    padding: 10px;
    width: 80%;
    background-color:#EBEBEB;
    color:orangered;
}


button {
    padding: 8px;
    width: 85%;
    background-color:#D80027;
    color:white;


}



input, button {
    outline: none;
    margin: 10px;
    border-radius: 50px;
    border: none;
    font-size: 35px;
    
}
#ModalDeactivated {
            display: none;
        }

.errStatements {
    color: red;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;

}




/* For tablets: */
@media only screen and (max-width:800px) {
    /*Styles*/
    body {
        background-color: url("../Image/city2.jpg");
        padding: 0;
        margin: 0;
        font-size: 8vw;
        color: white;
    }
    /*^^^^^*/
}
/*^^^^^^^^^^^^^*/

/* Smartphones (portrait and landscape) ----------- */
@media only screen  and (max-width : 500px) {
    /* Styles */
    body {
        background-image: none;
        background-color: blue;
        font-size: 10vw;

        padding: 0;
        margin: 0;
    }
    /*^^^^^^^*/
}
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

</style>
<?php

if(isset($_GET['ModalDeactivated'])){
    #ModalDeactivated
    echo '<style>
        #ModalDeactivated {
            display: flex;
        }
        
        </style>';
}


?>
</head>

<body>
   
    <div class="login_cage">
        
        <div class="login_icon_cage">
            
            <div class="login_icon_center">
                
                <div class="login_icon"></div>

            </div>
        </div>
        
        <div class="login_input_cage">
             
            <form action="orderKioskServer.php" class="login_input_form" method='POST'>
                <input name = 'userid' type="text" class="login_input user" placeholder="&#61447; Account ID:" pattern ="[TP,VS,SF,sf,EM,HD,AD]{2}[0-9]{6}" title="id is case sensitive, be sure to include characters such as TP, VS, EM, AD, HD" required>
                <input name = 'password' type="password"class="login_input pass" placeholder="&#61475;  Password:" required>
                <button name = "login">Login</button>

                <div class = "errStatements"><?php echo $invalid;?></div>
            </form>
        </div>

        
            <div id="ModalDeactivated" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Card Deactivated !! Activate card at Admin office !!
                        </div>

                        <span class="close">Dismiss</span>

                    </div>
                </div>
            </div>


    </div>

</body>
</html>
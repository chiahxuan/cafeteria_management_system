<?php
    
    include('vendorcrud.php');

    if(isset($_GET['unset']))
    {
        
        unset($_SESSION['displayTransHis']);
        unset($_SESSION['displayProfile']);
        unset($_SESSION['displayModalUpdated']);
        unset($_SESSION['displayModalAdded']);
        unset($_SESSION['displayModalDeleted']);

        
    }

    //SECURE WEBPAGE WITH LOGIN ROLE TO AVOID UNAUTHORIZED ACCESS
    if(!isset($_SESSION['loginRole'])){

        header('location: ../login.php');

    }

    @$calTotalVendor = "SELECT COUNT(vendor_id) FROM vendor";
    @$calTotalVendor_run = mysqli_query($con, $calTotalVendor);
    @$calTotalVendor_run_rows = mysqli_fetch_assoc($calTotalVendor_run);
    
   
    
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

    width: 50%;
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
    background-color: #EBF2FA;
    color:#427AA1;

    

    font-size: 1.5em;
    word-wrap: break-word;
    
    font-family:  'Heebo', Arial, sans-serif;
}

.report_search {
    width: 30%;
    height: 100%;

    font-size: 30px;

    display: flex;
    justify-content: flex-end;
    align-items: center;

    padding-right: 25px;

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
    font-size: 35px;
    color: #427AA1;
    background-color: white;
}


.analysis_bottom {
    width: 100%;
    height: 100%;

    overflow: hidden;

    background-color: #BBEDFF; 

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
    

   display: flex;
   justify-content: flex-start;
   background-color: white;
}

.table_top_title {
    /* background-color: blueviolet; */

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

    padding-bottom: 5px;
}

.table_top_button button {
    width: 50px;
    height: 50px;

    margin: 5px;
    margin-top: 10px;

    font-size: 30px;

    outline: none;
    border: none;
    color: #427AA1;
    background-color: white;
}


.table_bottom_cage {
    width: 100%;
    height: 83%;

    background-color: white;

   
    display: flex; 
    flex-direction: column;
    align-items: center;
    
}

.vendor_button {

    padding:30px;
    display: flex;
    align-self: flex-end;
}

.vendor_button button {
    outline: none;
    border: none;
    border-radius: 50px;
    
    padding: 10px 30px;
    margin-right: 20px;
    
    background-color:#427AA1;
    color:white;

    /* width: fit-content; */
    
    text-align: center;
    align-self: flex-end;

    display: flex;

    font-size: 1.6vw;
    text-transform: uppercase;
    font-family:  'Heebo', Arial, sans-serif;
}

.profile_button{
    padding:30px;
    display: flex;
    align-self: flex-end;
}

.profile_button button{
    outline: none;
    border: none;
    border-radius: 50px;
    
    padding: 10px 30px;
    margin-right: 20px;
    
    background-color:#427AA1;
    color:white;

    /* width: fit-content; */
    
    text-align: center;
    align-self: flex-end;

    display: flex;

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

    text-indent: 20px;
    font-size: 1.5em;
    font-family: 'Heebo', Arial, sans-serif;
}


table tr td {
    background-color: #EBF2FA;
    color:#427AA1;
    
}

/* tr :hover{
    background-color: #427AA1;
    color:white;
    
} */


/*Vendor Profile tab*/
.vendor_profile_cage {


    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;

    
}


.vendor_content {

    width: 65%;
    height: 200px;

    display: flex;
    font-weight: bold;

}

.vendor_attribute {

    width: 35%;
    height: 100%;
    color:#427AA1;

    display: flex;
    flex-direction: column;
    
}

.vendor_attribute_block {
    width: 100%;
    height: 30%;

    text-align: right;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    
    font-size: 1.8vw;
    text-transform: uppercase;


    /* outline: none;
    border: none;

    width: 100%;
    height: calc(6vh - 2px);

    text-indent: 40px;
    color: #427AA1; */
    font-weight: bold;
    margin:10px;
    
}




.vendor_input {

    width: 70%;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.vendor_input input {

    outline: none;
    border: none;
    width: 100%;
    /* height: 30%; */
    height: calc(6vh - 2px);
    font-size: 1.8vw;
    text-indent: 40px;
    margin: 15px;
    color: #427AA1;
}


/*Transaction history tab*/
.trans_list {
    width: 100%;
    height: calc(100% - 110px);

    background-color: #EBF2FA;

    display: flex;
    flex-direction: column;
    align-items: center;

    /* overflow: hidden; */
}

.trans_title_cage {
    width: 60%;
    height: 115px;
    background-color: #427AA1;
    margin-bottom: auto;
    margin: 25px;
    display: flex;
    justify-content: space-between;
    padding: 50px;
    font-family: 'Heebo', Arial, sans-serif;
}

.trans_title_cage div h2 {
    padding: 0px;
    margin: 0px;
    line-height: 90%;
} */

.trans_title_cage div span {
    font-size: 0.9vw;
}

/* .trans_title_time span{
    font-size: 0.9vw;
}

.trans_title_time h2{
    padding: 0px;
    margin: 0px;
    line-height: 90%;
} */

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
    height: calc(100% - 115px);

    display: flex; 
    flex-direction: column;

    overflow:scroll;
    overflow-x: hidden;
    
  

    
}

.trans_detail {

    width: 100%;
    height: 70px;
    min-height: 70px;
    padding: 10px 0px;
    display: flex;
    justify-content: space-between;
    color: inherit;
    text-decoration: none;
    border-bottom: 3px solid #427AA1;
}

.trans_detail_food, .trans_detail_price, .trans_detail_quantity{
    width: 30%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;

    font-size: 1.6vw;
    font-family: 'Heebo', Arial, sans-serif;

}

.trans_detail_food {
    margin-left: 30px;
    color:#427AA1;

}

.trans_detail_food span {
    font-size: 1.2vw;

}

.trans_detail_quantity{
    color:#427AA1;

}

.trans_detail_price, .trans_detail_quantity {
    font-size: 2vw;

    display: flex;
    align-items: flex-end;
    margin-right: 30px;

    width: 20%;
}

table a {
    display: block;
    text-decoration: none;
    color : inherit;

}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

/* Buka DULU main table for tabcontent */
#foodVendor {
    display: flex;
}



</style>
<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />
<?php 

    //should change to profileDisplay
    if(isset($_SESSION['displayProfile']))
    {
        echo '<style>#foodVendor {
            display: none;
        }
        
        
        #Profile {
            display: flex;
        }
        
        .table_top_button button {
            background-color: #EBF2FA;
        
        }
        .table_bottom_cage {
            background-color: #EBF2FA;
        
        }
        .table_top_bar{
            background-color: #EBF2FA;

        }
        
        </style>';

    }

    if(isset($_POST['vendorSearch']))
    {
        echo '<style>#foodVendor {
            display: none;
        }
        
        
        #Profile {
            display: none;
        }
        
        #Transaction{
            display: flex;
        }

        </style>';

    }

    if(isset($_SESSION['displayTransHis']))
    {
        echo '<style>#foodVendor {
            display: none;
        }
        
        
        #Profile {
            display: none;
        }
        
        #Transaction{
            display: flex;
        }

        #transHistory{
            display: flex;
        }

        </style>';
        unset($_SESSION['displayTransHis']);


    }
        //sucessfully updated
        if(isset($_SESSION['displayModalUpdated']))
        {
            echo '<style>
            #foodVendor {
                display: none;
            }
            
            
            #Profile {
                display: flex;
            }
            
            #Transaction{
                display: none;
            }
    
            #transHistory{
                display: none;
            }
    
            #ModalUpdated{
                display:flex;
            }
            #ModalDeleted{
                display:none;
            } 
            .table_top_button button {
                background-color: #EBF2FA;
            
            }
            .table_bottom_cage {
                background-color: #EBF2FA;
            
            }

            .table_top_bar{
                background-color: #EBF2FA;

            }
    
            </style>';
            unset($_SESSION['displayModalUpdated']);

        }
    
    
        //sucessfully added
        if(isset($_SESSION['displayModalAdded']))
        {
            echo '<style>
            #foodVendor {
                display: flex;
            }
            
            
            #Profile {
                display: none;
            }
            
            #Transaction{
                display: none;
            }
    
            #transHistory{
                display: none;
            }
    
            #ModalAdded{
                display:flex;
            }
            #ModalDeleted{
                display:none;
            }
            </style>';
            unset($_SESSION['displayModalAdded']);
            
        }
        
        //sucessfully added
        if(isset($_SESSION['displayModalDeleted']))
        {
            echo '<style>
            #foodVendor {
                display: flex;
            }
            
            
            #Profile {
                display: none;
            }
            
            #Transaction{
                display: none;
            }
    
            #transHistory{
                display: none;
            }
    
            #ModalAdded{
                display:none;
            }
    
            #ModalDeleted{
                display:flex;
            }
            </style>';
            unset($_SESSION['displayModalDeleted']);
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

            <a href="../server.php?logout" class="notif_setting_stack">
                <h2>Log Out</h2>
            </a>
        </div>
    </div>
    <!--Menu Bar-->
    <div class="bottom">
        <div id="bottom_left">
            <a href="../homeAdmin.php?unset" class="btn unset"><i class="fas fa-home"></i>Home </a>
            <a href="../Analysis/analysisMain.php?unset" class="btn unset"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../foodVendor/foodVendorMain.php?unset" class="btn unset activeTab tablinks" onclick="openCity(event, 'foodVendor');"><i class="fas fa-store"></i>Food Vendors </a>
            <a href="../accessCard/accessCardMain.php?unset" class="btn unset"><i class="fas fa-id-card"></i>Access Cards</a>
            <a href="../systemUsers/systemUsers.php?unset" class="btn unset"><i class="fas fa-user"></i>System Users</a>
        </div>
        
        <div class="bottom_right">
           <div class="analysis_cage">
                

                <div class="analysis_bottom">
                  
                    <div id="foodVendor" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tab_colour">Total Vendors: <?php echo $calTotalVendor_run_rows['COUNT(vendor_id)']?></button>
                                
                            </div>
        
                            <form action="foodVendorMain.php" class="report_search" method="POST">
                                <input name = "searchinput" type="search" placeholder="Search"  pattern="[^&][a-zA-Z&0-9\s]+" title="should not include characters" required> 
                                <button name ="vsearch"><i class="fas fa-search"></i></button> 
                            </form>
                        </div>

                        <div class="table_top_bar">
                            <div class="table_top_button">
                                <button class="tablinks" onclick="openCity(event, 'addProfile');"><i class="fas fa-plus"></i></button>
                                <!-- <button><i class="fas fa-pen"></i></button>
                                <button><i class="fas fa-trash"></i></button> -->
                            </div>
                        </div>
                        
                        <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                            
                
                            <table>
                                <tr>
                                    <td>No.</td>
                                    <td>ID</td>
                                    <td>Name</td>
                                </tr>

                            <?php
                                if(isset($_POST['vsearch']))
                                {
                                    //search vendor details query
                                    $input = $_POST['searchinput'];//pass input
                                    $squery = "SELECT * FROM vendor WHERE vendor_id LIKE '%$input%' OR vendor_name LIKE '%$input%'"; 
                                    $squery_run = mysqli_query( $con, $squery);
                                    $row = mysqli_num_rows($squery_run);

                                    //echo '<script type = "text/javascript"> alert("'.$input.'"); </script>'; 

                                    if($row == 0)
                                    {
                                        echo "<td> No Data </td>";
                                        echo "<td> No Data </td>";
                                        echo "<td> No Data </td>";
                                    }
                                    else
                                    {
                                        $no1 = '0';
                                        while($getrow = mysqli_fetch_assoc($squery_run))
                                        {
                                            $no1++;
                                            echo '<tr name = "viewvendor" class="tablinks" onclick="openCity(event, \'Profile\');">';
                                            echo "<a href = 'test.php?id=".$getrow['vendor_id']."'>";
                                            echo "<td><a href = 'vendorcrud.php?id=".$getrow['vendor_id']."'>".$no1."</a></td>";
                                            echo "<td><a href = 'vendorcrud.php?id=".$getrow['vendor_id']."'>".$getrow['vendor_id']."</a></td>";
                                            echo "<td><a href = 'vendorcrud.php?id=".$getrow['vendor_id']."'>".$getrow['vendor_name']."</a></td>";
                                            echo '</a></tr>';
                                        }
                                    }
                                }
                                else
                                {
                                    $no1 ='0';
                                    //query to view vendor data in table
                                    $vquery = "SELECT * FROM vendor";
                                    $vquery_run = mysqli_query($con, $vquery);

                                    while($rows = mysqli_fetch_assoc($vquery_run))
                                    {
                               
                                        $no1++;                                       
                                        echo "<tr name = 'viewvendor' class='tablinks'>";
                                        echo "<td><a href = 'vendorcrud.php?id=".$rows['vendor_id']."'>".$no1."</a></td>";
                                        //echo '<td>'.$no1.'</td>';
                                        echo "<td><a href = 'vendorcrud.php?id=".$rows['vendor_id']."'>".$rows['vendor_id']."</a></td>";
                                        echo "<td><a href = 'vendorcrud.php?id=".$rows['vendor_id']."'>".$rows['vendor_name']."</a></td>";
                                        echo '</tr>';
                                       
                                    }
  
                                    
                                    
                                }

                            ?>    
                                


                              
                            </table>
                        </div>
                           

                    </div>
                    
                    <div id="Profile" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks tab_colour" onclick="openCity(event, 'Profile');">Profile</button>
                                <button class="tablinks" onclick="openCity(event, 'Transaction');" >Transaction History</button>
                            </div>
        
                            <form action="" class="report_search" method = "POST">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>


                        <form action = "vendorcrud.php" class="table_top_bar" method = "POST">
                            <div class="table_top_button">
                                <button id = "vedit" name = "vedit" type = "button"><i class="fas fa-pen"></i></button>
                                <button id = "deleteTrigger" type = "button"><i class="fas fa-trash"></i></button>
                            </div>
                        </form>
                        

                        
                        <div class="table_bottom_cage">
                            <div class="vendor_profile_cage">
                         

                                <div class="vendor_content">
                                    <div class="vendor_attribute">
                                        <div class="vendor_attribute_block">
                                           Vendor ID: 
                                        </div>

                                        <div class="vendor_attribute_block">
                                            Vendor Name:
                                        </div>

                                        <div class="vendor_attribute_block">
                                            Vendor Owner:
                                        </div>

                                    </div>

                                    <form action ="vendorcrud.php" class="vendor_input" method="POST"> 
                                        <input id = "profile_vid" name = "profile_vid" type="text" value="<?php $_SESSION['chkVendorId'] = $_SESSION['vendor_id']; echo $_SESSION['chkVendorId']; unset($_SESSION['displayProfile']); ?>" readonly>
                                        
                                        <input id = "profile_vname" name = "profile_vname" type="text" value="<?php echo $_SESSION['vendor_name']; ?>" maxlenght = "50" pattern="[^&][a-zA-Z&\s]+" title="Vendor name should not include characters and numbers, except & between words" readonly>

                                        <input id = "profile_vowner" name = "profile_vowner" type="text" value="<?php echo $_SESSION['employee_name']; ?>" pattern="[^&][a-zA-Z\s]+" title="Owner name should not include any character and number" readonly> 
                                        <div class="profile_button vendor_button" >
                                            <button id = "confirmEditBtn" name = "confirmEditBtn"  type="submit" class="" style= "display:none; ">Confirm</button>
                                            <button id = 'cancelBtn' type="button" class="tablinks" style= "display:none;" >Cancel</button>
                                            <button id="backBtn" type="button" class="tablinks" style= "visibility:visible;" >Back</button>
                                        </div>
                                    </form>
                                    
                                </div>
                                

                            </div>

                            
                        </div>
                        
                    </div>
                    
                    <div id="Transaction" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks" onclick="openCity(event, 'Profile');">Profile</button>
                                <button class="tablinks tab_colour" onclick="openCity(event, 'Transaction');" >Transaction History</button>
                            </div>
        
                            <form action="foodVendorMain.php" class="report_search" method = "POST">
                                <input name = "vendorSearchInput" type="search" placeholder="Search" pattern="[a-zA-Z0-9\s]+" title ="Search index should not include characters, try to insert Food Name, Transaction ID, Food ID or Order ID" required> 
                                <button name = "vendorSearch" type = "submit"><i class="fas fa-search"></i></button> 
                            </form>
                        </div>

                        <form class="trans_list" action="foodVendorMain.php" method="POST">
                            <div class="trans_title_cage"  >
                                <div class="trans_title_time">
                                    <?php
                                        //query to view vendor data in transaction page
                                        $vTransquery = "SELECT * FROM vendor WHERE vendor_id = '".$_SESSION['chkVendorId']."' ";
                                        $vTransquery_run = mysqli_query($con, $vTransquery);
                                        $vTransquery_run_rows = mysqli_fetch_assoc($vTransquery_run);
                                        $show_transData = $vTransquery_run_rows['vendor_balance'];
                                        $currentDate = date("d-m-Y");

                                        echo "<h2>".$_SESSION['chkVendorId']."</h2>";
                                        echo "<span>","Last Updated","</span>";
                                        echo '<span name ="storeLatestDate" style="font-size: 22px;">'.$currentDate.'</span>';
                                        echo "</div>";

                                        echo "<div class='trans_title_profit'>";
                                            echo "<span>Profit</span>";
                                            echo "<h2>".$show_transData."</h2>"  ;
                                        echo "</div>";
                                ?>
                            </div>


                            <div class="trans_detail_cage">
                                
                                    <?php
                                        if(isset($_POST['vendorSearch']))
                                        {
                                            $input = $_POST['vendorSearchInput'];
                                            // echo $_SESSION['chkVendorId'];

                                            $transSearch = "SELECT * FROM  viewvendortransaction WHERE vendorID = '".$_SESSION['chkVendorId']."' AND (transactionID LIKE '%$input%' OR orderID 
                                             LIKE '%$input%' OR FoodID  LIKE '%$input%' OR FoodName LIKE '%$input%' OR transactionDate LIKE '%$input%')
                                             ORDER BY transactionDate DESC";
                                            $transSearch_run = mysqli_query($con, $transSearch);
                                            $checkSearchResult = mysqli_num_rows($transSearch_run);
                                            
                                            if(mysqli_num_rows($transSearch_run) == 0)
                                            {
                                                echo '<div class="trans_detail">';
                                                echo '<div class="trans_detail_food">';
                                                echo "NO DATA";
                                                echo "<span>NO DATA</span>";
                                                echo '</div>';
                                                echo '<div class="trans_detail_price">';
                                                echo "NO DATA";
                                                echo '</div>';
                                                echo '<div class="trans_detail_price">';
                                                echo "NO DATA";
                                                echo '</div>';
    
                                                echo '</div>';
                                            }
                                            while($transSearch_run_row = mysqli_fetch_assoc($transSearch_run))
                                            {
                                               
                                                $orderID = $transSearch_run_row['orderID'];

                                                while($transView_run_row = mysqli_fetch_assoc($transView_run))
                                                {
                                                    
                                                    $orderID = $transView_run_row['orderID'];
    
                                                    if($transView_run_row['Title'] == 'REFUND'){
                                                        echo "<a class='trans_detail' href = 'vendorCRUD.php?orderid=".$orderID."'>";
                                                        echo '<div class="trans_detail_food">';
                                                        echo $transView_run_row['Title'];
                                                        echo "<span>".$transView_run_row['transDate']."</span>";
                                                        echo '</div>';
                                                        echo '<div class="trans_detail_quantity">';
                                                        echo $transView_run_row['Quantity'];
                                                        echo '</div>';
                                                        echo '<div class="trans_detail_price">';
                                                        echo "-RM ".$transView_run_row['TotalSub'];
                                                        echo '</div>';
            
                                                        echo '</a>';
                                                    }else{
                                                        echo "<a class='trans_detail' href = 'vendorCRUD.php?orderid=".$orderID."'>";
                                                        echo '<div class="trans_detail_food">';
                                                        echo $transView_run_row['Title'];
                                                        echo "<span>".$transView_run_row['transDate']."</span>";
                                                        echo '</div>';
                                                        echo '<div class="trans_detail_quantity">';
                                                        echo $transView_run_row['Quantity'];
                                                        echo '</div>';
                                                        echo '<div class="trans_detail_price">';
                                                        echo "RM ".$transView_run_row['TotalSub'];
                                                        echo '</div>';
            
                                                        echo '</a>';
                                                    }
    
                                                }
                                            }

                                            

                                        }else
                                        {

                                            $transView = "SELECT * FROM  viewvendortransaction WHERE vendorID = '".$_SESSION['chkVendorId']."' ORDER BY transDate DESC ";
                                            $transView_run = mysqli_query($con, $transView);
                                            
                                            
                                            while($transView_run_row = mysqli_fetch_assoc($transView_run))
                                            {
                                                
                                                $orderID = $transView_run_row['orderID'];

                                                if($transView_run_row['Title'] == 'REFUND'){
                                                    echo "<a class='trans_detail' href = 'vendorCRUD.php?orderid=".$orderID."'>";
                                                    echo '<div class="trans_detail_food">';
                                                    echo $transView_run_row['Title'];
                                                    echo "<span>".$transView_run_row['transDate']."</span>";
                                                    echo '</div>';
                                                    echo '<div class="trans_detail_quantity">';
                                                    echo $transView_run_row['Quantity'];
                                                    echo '</div>';
                                                    echo '<div class="trans_detail_price">';
                                                    echo "-RM ".$transView_run_row['TotalSub'];
                                                    echo '</div>';
        
                                                    echo '</a>';
                                                }else{
                                                    echo "<a class='trans_detail' href = 'vendorCRUD.php?orderid=".$orderID."'>";
                                                    echo '<div class="trans_detail_food">';
                                                    echo $transView_run_row['foodName'];
                                                    echo "<span>".$transView_run_row['transDate']."</span>";
                                                    echo '</div>';
                                                    echo '<div class="trans_detail_quantity">';
                                                    echo $transView_run_row['Quantity'];
                                                    echo '</div>';
                                                    echo '<div class="trans_detail_price">';
                                                    echo "RM ".$transView_run_row['TotalSub'];
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

                    <div id="addProfile" class="tabcontent" >
                            <div class="analysis_top">
                                <div class="report_type" >
                                    <button>Total Vendors: <?php echo $calTotalVendor_run_rows['COUNT(vendor_id)'];?></button>
                                </div>
            
                                <form action="" class="report_search">
                                    <input type="search" placeholder="Search"> 
                                    <button><i class="fas fa-search"></i></button> 
                                </form>
                            </div>
    
    
                            <div class="table_top_bar">
                                <div class="table_top_title">ADD PAGE</div>
                                <div class="table_top_button">
                                    <button><i class="fas fa-pen"></i></button>
                                    <button><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            
                            <div class="table_bottom_cage">
                                <div class="vendor_profile_cage">
                              
    
                                    <div class="vendor_content">
                                        <div class="vendor_attribute">
                                            <div class="vendor_attribute_block">
                                               Vendor ID: 
                                            </div>
    
                                            <div class="vendor_attribute_block">
                                                Vendor Name:
                                            </div>
 
                                        </div>
    
                                        <form action="vendorcrud.php" class="vendor_input" method="POST"> 
                                            <input name= "vid" type="text" placeholder="VENDOR ID" disabled>
    
                                            <input name ="vname" type="text" placeholder="VENDOR NAME" pattern="[^&][a-zA-Z&\s]+" title ="Name should not include characters and numbers" required>
                                            
                                            <div class="vendor_button">
                                                <button  id="popUp1" name = 'vadd' type="submit" class="">Confirm</button>
                                                <button type="button" class="tablinks" onclick="openCity(event, 'foodVendor');">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
    
                                </div>
                                
                                
                            </div>
                            
                    </div>

                    <!-- The Add Confirmation Modal-->
                    <div id="Modal1" class="modal">
                        <!-- Modal content -->
                        <div class="content_cage">
                            <div class="content_outerCage">
                                <div class="content_innerCage">
                                    <div class="content_infoTitle">
                                        ARE YOU SURE YOU WANT TO DELETE THE FOLLOWING USER?
                                    </div>
                                    <div class="content_info_bottomCage">
                                        <div class="content_detail_stack">
                                            <div class="content_name">Vendor ID</div>
                                            <span>:</span>
                                            <div class="content_detail"><?php echo $_SESSION['vendor_id'];?></div>
                                        </div>

                                        <div class="content_detail_stack">
                                            <div class="content_name">Vendor Name</div>
                                            <span>:</span>
                                            <div class="content_detail"><?php echo $_SESSION['vendor_name'];?></div>
                                        </div>

                                    </div>

                                </div>

                                <form class="button_group align_flexEnd" action="vendorCRUD.php" method = "POST">
                                    <button id = "vdelete"  name = "vdelete"  type="submit" class="close">Confirm</button>
                                    <button type="button" class="close">Cancel</button>
                                </form>
                                
                                
                            </div>
                        </div>
                    </div>

                               <!-- The Modal 1-->
           <div id="ModalAdded" class="modal">
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

            <div id="ModalDeleted" class="modal">
                <!-- Modal content -->
                <div class="content_cage">
                    <div class="content_outerCage">
                        <div class="content_innerCage">
                            <div class="content_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Successfully Deleted!
                        </div>

                        <span class="close">Dismiss</span>

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
                            <div>Transaction ID: <?php echo $_SESSION['transID']; unset($_SESSION['transID']);?></div>
                            <div>Amount: <?php echo $_SESSION['quantity']; unset($_SESSION['quantity']);?></div>
                            <div>Total: <?php echo $_SESSION['amount']; unset($_SESSION['amount']); ?></div>
                            <h3><?php echo $_SESSION['date']." at ".$_SESSION['time']; unset($_SESSION['date']); unset($_SESSION['time']);?></h3>
                        </div>

                        <form action = "accesscardCRUD.php" method = "POST">
                            <div class="content_refundBtn">
                                <!-- <button name = "refundBtn"  class = "actionBtn" >Refund</button> -->
                                <span class="close">Dismiss</span>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>

                </div>
                  
           </div>
           
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/headerModal.js"></script>
    <script type="text/javascript" src="../linkFiles/table.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/foodVendorModal.js"></script>
    <script type="text/javascript" src="../linkFiles/transactionPriceColour.js"></script>
    <!-- <script type="text/javascript" src="../linkFiles/Modals_JS/accessCardModal.js"></script> -->


</body>
</html>
	
<?php
    include('employeeCRUD.php');
    
    if(isset($_GET['unset']))
    {
        unset($_SESSION['showprofile']);

        unset($_SESSION['employeeID']);

        unset($_SESSION['employeeName']);

        unset($_SESSION['employeeRole']);

        unset($_SESSION['employeeBalance']);

        unset($_SESSION['employeeStatus']);

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

    background-color:#427AA1;
    color:white;
    
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

    background-color: white;
}

.report_search * {
    outline: none;
    border: none;
    background-color:white;
    color:#427AA1;
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

   display: flex;
   justify-content: flex-start;
}

.table_top_button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    
    margin-left: auto; 
    margin-right: 45px;
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
    height: 83%;

    background-color: white;

    display: flex; 
    flex-direction: column;
    align-items: center;
}

.vendor_button {
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

    color: #427AA1;
    background-color: #BBEDFF;
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
    background-color: #EBF2FA;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; 
    max-width: 500px;
   
    color:#427AA1;
    text-decoration:none;

}

table a{
    color:inherit;
    display: block;
    text-decoration:none;
}


/*Vendor Profile tab*/
.vendor_profile_cage {
    background-color: #EBF2FA;

    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;

    overflow: hidden;
}

.vendor_content {
    width: 65%;
    height: fit-content;

    display: flex;
}

.vendor_attribute {
    width: 35%;
    height: 100%;

    font-family:  'Heebo', Arial, sans-serif;
    color: #427AA1;

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
    padding:10px; 
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
    height: calc(6vh - 2px);

    font-size: 1.8vw;
    text-indent: 40px;
    color: #427AA1;
    font-weight: bold;
    margin:10px;
}

/* Open cafeteriaUser tab by default */
#Employee {
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
<link rel="stylesheet" href="../linkFiles/Modals_CSS/popUpModals.css" type="text/css" />

<?php 
    if(isset($_SESSION['showprofile'])){
        
        echo '<style>      
        
        #Profile{
            display: flex;
        }

        #Employee{
            display: none;
        }


        </style>';
        unset($_SESSION['showprofile']);
    

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
        <div id="bottom_left">
            <a href="../homeFoodvendor.php?unset" class="btn"><i class="fas fa-home"></i>Home </a>
            <a href="../Analysis/analysisMain.php?unset" class="btn"><i class="fas fa-chart-area  "></i>Analysis </a>
            <a href="../order/order.php?unset" class="btn"><i class="fas fa-store"></i>Order </a>
            <a href="../Transaction/Transaction.php?unset" class="btn"><i class="fas fa-id-card"></i>Transaction</a>
            <a href="../employee/employee.php?unset" class="btn activeTab"><i class="fas fa-user"></i>Employee</a>
			<a href="../Menu/menu.php?unset" class="btn"><i class="fas fa-book-open"></i>Food Menu</a>
        </div>
        <!-- onclick="openCity(event, 'Cafeteria');" id="defaultOpen" -->
		<div class="bottom_right">
           <div class="analysis_cage">
                

                <div class="analysis_bottom">
						
					<!-- Employee table -->
                    <div id="Employee" class="tabcontent">
                            <div class="analysis_top">
                                <div class="report_type" >
                                    <button class="tablinks">Employee Profile</button>

                                </div>
            
                                <form action="employee.php" method ="POST" class="report_search">
                                    <input name ="vendorSearchInput" type="search" placeholder="Search" pattern="[a-zA-Z0-9\s]+" title ="Search index should not include characters, try to insert Food Name, Transaction ID, Food ID or Order ID" required>
                                    <button name = "vendorSearch" type = "submit"><i class="fas fa-search"></i></button> 
                                </form>
                            </div>
    
                            <div class="table_top_bar">
                            </div>
                            
                            <div class="table_bottom_cage" style=" overflow: scroll; overflow-x: auto;">
                                
    
                                <table>
                                    <tr>
                                        <td>No.</td>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Role</td>
                                    </tr>
  
                                    <?php 
                                    
                                    
                                        if(isset($_POST['vendorSearch']))
                                        {

                                            $input = $_POST['vendorSearchInput'];
                                            
                                            $selectEmployee = "SELECT * FROM employee  WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."'
                                            AND( `employee_id` LIKE '%$input%' OR `employee_name` LIKE '%$input%' OR `employee_role` LIKE '%$input%'  )";
                                            $selectEmployee_run = mysqli_query($con, $selectEmployee);
                                            
                                            
                                            if(mysqli_num_rows($selectEmployee_run) == 0)
                                            {
                                                echo "<td> No Data </td>";
                                                echo "<td> No Data </td>";
                                                echo "<td> No Data </td>";
                                                echo "<td> No Data </td>";
                                            }else{
                                                $no = '0';
                                                while($selectEmployee_run_rows = mysqli_fetch_assoc($selectEmployee_run))
                                                {
                                                
                                                    $no++;
                
                                                    echo "<tr class='tablinks' onclick='openCity(event, 'Profile');'>";
                                                    echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$no."</a></td>";
                                                    echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$selectEmployee_run_rows['employee_id']."</a></td>";
                                                    echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$selectEmployee_run_rows['employee_name']."</a></td>";
                                                    echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$selectEmployee_run_rows['employee_role']."</a></td>";
                                                    echo "</tr>";
                
                
                                                    
                                                }
                                            }
                                            

                                        }else{
                                            $selectEmployee = "SELECT * FROM `employee` WHERE vendor_id = '".$_SESSION['loginRelatedVendor']."'  ";
                                            $selectEmployee_run = mysqli_query($con, $selectEmployee);
                                            
                                            $no = '0';
                                            while($selectEmployee_run_rows = mysqli_fetch_assoc($selectEmployee_run)){
                                                $no++;
        
                                                echo "<tr class='tablinks' onclick='openCity(event, 'Profile');'>";
                                                echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$no."</a></td>";
                                                echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$selectEmployee_run_rows['employee_id']."</a></td>";
                                                echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$selectEmployee_run_rows['employee_name']."</a></td>";
                                                echo "<td><a href = 'employeeCRUD.php?id=".$selectEmployee_run_rows['employee_id']."'>".$selectEmployee_run_rows['employee_role']."</a></td>";
                                                echo "</tr>";
        
        
                                            }
                                        }

                                    ?>
 
                                </table>
                            </div>  
                        </div>			                   
				
					<!-- Profile section -->
                    <div id="Profile" class="tabcontent">
                        <div class="analysis_top">
                            <div class="report_type" >
                                <button class="tablinks" onclick="openCity(event, 'Profile');">Employee Profile</button>
                                
                            </div>
        
                            <form action="" class="report_search">
                                <input type="search" placeholder="Search"> 
                                <button><i class="fas fa-search"></i></button> 
                            </form>
                        </div>


                        <div class="table_top_bar">
                           
                        </div>
                        
                        <div class="table_bottom_cage">
                            <div class="vendor_profile_cage">

                                <div class="vendor_content">
                                    <div class="vendor_attribute">
                                        <div class="vendor_attribute_block">
                                           Employee ID: 
                                        </div>

                                        <div class="vendor_attribute_block">
                                            Employee Name:
                                        </div>

                                        <div class="vendor_attribute_block">
                                             Role:
                                        </div>

                                        <div class="vendor_attribute_block">
                                             Balance:
                                        </div>

                                        <div class="vendor_attribute_block">
                                             Status:
                                        </div>


                                    </div>

                                    <form class="vendor_input"> 
                                        <input type="text" placeholder="<?php echo $_SESSION['employeeID']; ?>" readonly>

                                        <input type="text" placeholder="<?php echo $_SESSION['employeeName']; ?>" readonly>

                                        <input type="text" placeholder="<?php echo  $_SESSION['employeeRole']; ?>" readonly>

                                        <input type="text" placeholder="<?php echo $_SESSION['employeeBalance']; ?>" readonly>

                                        <input type="text" placeholder="<?php echo $_SESSION['employeeStatus'];?>" readonly>
                                         
                                        <div class="vendor_button">
                                            <button type="button" class="tablinks" onclick="openCity(event, 'Employee');">Dismiss</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            
                        </div>
                        
                    </div>
				</div>

			</div>
         </div>
           <!-- The Add Confirmation Modal-->


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../linkFiles/Modals_JS/employeeModal.js"></script>
    <script type="text/javascript" src="../linkFiles/transactionPriceColour.js"></script>
</body>
</html>
<?php
    include('server.php');

        //SECURE WEBPAGE WITH LOGIN ROLE TO AVOID UNAUTHORIZED ACCESSX
        if(!isset($_SESSION['loginRole'])){

            header('location: login.php');
    
        }

        @$calVendor = "SELECT COUNT(vendor_id) FROM `vendor` ";
        @$calVendor_run = mysqli_query($con, $calVendor);
        @$calVendor_run_rows = mysqli_fetch_assoc($calVendor_run);
    

        //CALCULATE TOTAL STUDENT 
        @$calTotalUsers = "SELECT COUNT(`user_id`) FROM `user` WHERE user_role = 'student'";
        @$calTotalUsers_run = mysqli_query($con, $calTotalUsers);
        @$calTotalUsers_run_rows = mysqli_fetch_assoc($calTotalUsers_run);

        //CALCULATE TOTAL HELP DESK 
        @$calTotalHD = "SELECT COUNT(`user_id`) FROM `user` WHERE user_role = 'help desk'";
        @$calTotalHD_run = mysqli_query($con, $calTotalHD);
        @$calTotalHD_run_rows = mysqli_fetch_assoc($calTotalHD_run);

         //CALCULATE TOTAL ADMIN
         @$calTotalAD = "SELECT COUNT(`user_id`) FROM `user` WHERE user_role = 'admin'";
         @$calTotalAD_run = mysqli_query($con, $calTotalAD);
         @$calTotalAD_run_rows = mysqli_fetch_assoc($calTotalAD_run);

        //CALCULATE TOTAL STAFF
        @$calTotalSF = "SELECT COUNT(`user_id`) FROM `user` WHERE user_role = 'staff'";
        @$calTotalSF_run = mysqli_query($con, $calTotalSF);
        @$calTotalSF_run_rows = mysqli_fetch_assoc($calTotalSF_run);

        //CALCULATE TOTAL VISITOR
        @$calTotalVS = "SELECT COUNT(`user_id`) FROM `user` WHERE user_role = 'visitor'";
        @$calTotalVS_run = mysqli_query($con, $calTotalVS);
        @$calTotalVS_run_rows = mysqli_fetch_assoc($calTotalVS_run);

        //CALCULATE TOTAL KITCHEN OWNER
        @$calTotalEMKO = "SELECT COUNT(`employee_id`) FROM `employee` WHERE employee_role = 'kitchen owner'";
        @$calTotalEMKO_run = mysqli_query($con, $calTotalEMKO);
        @$calTotalEMKO_run_rows = mysqli_fetch_assoc($calTotalEMKO_run);

        //CALCULATE TOTAL KITCHEN EMPLOYEE
        @$calTotalEMKE = "SELECT COUNT(`employee_id`) FROM `employee` WHERE employee_role = 'kitchen employee'";
        @$calTotalEMKE_run = mysqli_query($con, $calTotalEMKE);
        @$calTotalEMKE_run_rows = mysqli_fetch_assoc($calTotalEMKE_run);

        //**  BAR CHARTS FOR VENDOR REPORT  **//
        //SHOWS SALES OF EACH CATEGORY OF VENDOR
        @$arrVendorID = array();
        @$month = date('m', time());
        @$arrColor = array('#EA4A10', 'yellow', 'green', '#F4826E', '#ACBEA3', '#581535', '#ffc305', 'c70039' );
        //BAR CHARTS FOR VENDOR REPORT 
        //SHOWS SALES OF EACH CATEGORY OF VENDOR
        @$getGraphVid= "SELECT * FROM vendorgraphcategory group by vendorID ";
        @$getGraphVid_run = mysqli_query($con, $getGraphVid);
        @$arrayVendorID = array();
        while(@$getGraphVid_run_rows = mysqli_fetch_assoc($getGraphVid_run))
        {
            @$arrayVendorID[] = $getGraphVid_run_rows['vendorID'];
        } 

        @$middleTopCategory = "";
        for($i = 0; $i < count($arrayVendorID); $i++){
            
            @$arrayCategory = array();
            @$getCategory = "SELECT SUM(`totalAmount`) as `topFood`, foodCategory, vendorName FROM admingraphtotalsales WHERE vendorID = '".$arrayVendorID[$i]."' GROUP BY foodCategory ORDER BY `totalAmount` DESC limit 1";
            @$getCategory_run = mysqli_query($con, $getCategory);
            while(@$getFood_run_rows = mysqli_fetch_assoc($getCategory_run)){
                // $arrayCategory[] = $getFood_run_rows['foodCategory'];

                if(@$i == 0){
                    @$firstTopCategory = '[\''.$getFood_run_rows['vendorName'].'\n '.$getFood_run_rows['foodCategory'].'\', '.$getFood_run_rows['topFood'].', \'color: '.$arrColor[$i].'\'], ';
                }else if ($i == count($arrayVendorID)-1  ){
                    @$lastTopCategory = '[\''.$getFood_run_rows['vendorName'].'\n '.$getFood_run_rows['foodCategory'].'\', '.$getFood_run_rows['topFood'].', \''.$arrColor[$i].'\'] ';
                }else{
                    @$middleTopCategory .= '[\''.$getFood_run_rows['vendorName'].'\n '.$getFood_run_rows['foodCategory'].'\', '.$getFood_run_rows['topFood'].', \''.$arrColor[$i].'\'], ';
                }
                
            }

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
<link rel="stylesheet" href="../Default/linkFiles/Modals_CSS/header.css" type="text/css" />
<link rel="stylesheet" href="../Default/linkFiles/Modals_CSS/menu.css" type="text/css" />
<style>

.bottom_right {
    flex-direction: column;
    overflow: scroll;
    align-items: flex-start;
    justify-content: flex-start;
}

.stats_group {
    width: 100%;
    min-height: 20%;
    background-color: #EBEBEB;
    display: flex;
    justify-content: center;
    align-items: center;

}

.stats {
    width: 100%;
    height: 100%;
    text-align: center;
    display: flex;
}

.stat {
    width:50%;
    height: 100%;
    
    font-size: 20px;
    font-family:  'Lato', Arial, sans-serif;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.stat span {
    height:40px;
    margin-bottom: 10px;
}

.stat_circle {
    padding: 0px;
    margin: 0px auto;

    width: 80px;
    height: 80px;
    border-radius: 100%;

    background-color: white;

    font-size: 42px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.complain {
    width: 100%;
    height: 75%;

    color: rgb(14, 14, 14);

    display: flex;
    justify-content: center;
    align-items: center;

    background-color:red;

}

.complain_cage {
    width: 80%; 
    height: 95%;
    background-color: #EBEBEB;  
}

.complain_title {
    width: 100%;
    height: 20%;

    color: rgb(250, 99, 4);
    background-color: white;

    font-size: 32px;
    font-family:  'Heebo', Arial, sans-serif;
    text-align: center;

    display: flex;
    justify-content: center;
    align-items: center;
}

.complain_content {
    width: 100%;
    height: 80%;

    background-color: white;
    
    overflow: scroll;
    overflow-x: hidden;
}

.complain_card {
    width: 90%;
    height: 25%;
    background-color : #EBEBEB;

    margin: 0 auto;
    
    margin-bottom: 15px; 

    color: rgb(102, 102, 102);

    border-radius: 25px;

    font-size: 20px;
    font-weight: bold;
    font-family:  'Lato', Arial, sans-serif;
   
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

   text-align: center;
}

.complain_id {
    
    align-self: flex-end;
    margin-right: 50px; 
    text-align: right;
    color: red;
        
}

.graph_group {
    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;
}

.graph {
    width: 50%;
    height: 80%;

    display: flex;
    justify-content: center;
    align-items: center;
}

.red {
    
}

/*DO NOT REMOVE*/
/*Google charts flickering bug solution*/
svg > g > g:last-child { pointer-events: none }
/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/



</style>
</head>

<body>
    <!--Title Bar-->
    <div class="top">
        <div class="top_left">
            APU Cafeteria System
            <i class="fas fa-utensils"></i>
        </div>

        <form class="top_right">
            <button type="button" id="user"> <div class="user_cover"><i class="fas fa-user-circle"></i></div></button>
        </form>


        <div class="notif_setting_cage">
            <a href="./userSettings/userSettings.php" class="notif_setting_stack">
                <h2>View Profile</h2>
            </a>


            <a href="server.php?logout" class="notif_setting_stack">
                <h2>Log Out</h2>
            </a>
        </div>
    </div>
    <!--Menu Bar-->
    <div class="bottom">

    <?php

        //FILTER PAGES TO BE ACCESSED BY ADMIN AND HELP DESK
        if(@$_SESSION['loginRole'] == "admin"){
            echo ' <div id="bottom_left">';
                echo '<a href="homeAdmin.php?unset" class="btn unset activeTab"><i class="fas fa-home"></i>Home </a>';
                echo '<a href="./Analysis/analysisMain.php?unset" class="btn unset"><i class="fas fa-chart-area  "></i>Analysis </a>';
                echo '<a href="./foodVendor/foodVendorMain.php?unset" class="btn unset"><i class="fas fa-store"></i>Food Vendors </a>';
                echo '<a href="./accessCard/accessCardMain.php?unset" class="btn unset"><i class="fas fa-id-card"></i>Access Cards</a>';
                echo '<a href="./systemUsers/systemUsers.php?unset" class="btn unset"><i class="fas fa-user"></i>System Users</a>';
            echo '</div>';

        }else if (@$_SESSION['loginRole'] == "help desk"){
            echo ' <div id="bottom_left">';
                echo '<a href="./accessCard/accessCardMain.php?unset" class="btn unset"><i class="fas fa-id-card"></i>Access Cards</a>';
                echo '<a href="./systemUsers/systemUsers.php?unset" class="btn unset"><i class="fas fa-user"></i>System Users</a>';
            echo '</div>';
        }
    
    ?>


        <div class="bottom_right">
            <div class="stats_group">
                <div class="stats">
                    <div class="stat left">
                        <span>Total Cafeteria User</span>

                        <div class="stat_circle"><?php echo @$calTotalUsers_run_rows['COUNT(`user_id`)'];?></div>
                    </div>

                    <div class="stat mid">
                        <span>Number of Vendors</span>

                        <div class="stat_circle"><?php echo @$calVendor_run_rows['COUNT(vendor_id)'];?></div>
                    </div>

                    <div class="stat right">
                        <span>Total Help Desk</span>

                        <div class="stat_circle"><?php echo @$calTotalHD_run_rows['COUNT(`user_id`)'];?></div>
                    </div>
                </div>

            

            </div>

            <div class="graph_group">
                <div class="graph red">
                        <div id="piechart" style="width:90%; height:90%;"></div>
                </div>

                <div class="graph">
                    <div id="barchart_values" style="width: 90%; height: 90%;"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/mainJS.js"></script>
    <script type="text/javascript" src="../Default/linkFiles/headerModal.js"></script>
    
        <script>
            
            // Load google charts
            //Pie Chart
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(homePieChart);

            

            // Draw the chart and set the chart values
            function homePieChart() {
            var data = google.visualization.arrayToDataTable([
            ['User Type', 'Hours per Day'],
            ['Admin', <?php echo @$calTotalAD_run_rows['COUNT(`user_id`)'];?>],
            ['Student', <?php echo @$calTotalUsers_run_rows['COUNT(`user_id`)']; ;?>],
            ['Kithcen Owner', <?php echo @$calTotalEMKO_run_rows['COUNT(`employee_id`)'];?>],
            ['Kithcen Employee', <?php echo @$calTotalEMKE_run_rows['COUNT(`employee_id`)'] ;?>],
            ['Help Desk', <?php echo @$calTotalHD_run_rows['COUNT(`user_id`)'];?>],
            ['Visitor', <?php echo @$calTotalVS_run_rows['COUNT(`user_id`)'] ;?>],
            ['Staff', <?php echo @$calTotalSF_run_rows['COUNT(`user_id`)'] ;?>]
            ]);
            
            // Optional; add a title and set the width and height of the chart
            var options = {'title':'NUMBER OF USER TYPES',  'fontSize':18 };

                
            
            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
            }




            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(homeBarChart);
            function homeBarChart() {
            var data = google.visualization.arrayToDataTable([
            ["Vendor", "Top Sales", { role: "style" }],
            <?php echo @$firstTopCategory.$middleTopCategory.$lastTopCategory;?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            var options = {
                title: "TOP CATEGORY SALES OF VENDORS",
                fontSize:18,
                bar: {groupWidth: "75%"},
                legend: { position: "none" },
                bars: 'vertical'
            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(view, options);


            //Auto resize charts
            $(window).resize(function(){
                homePieChart();
                homeBarChart();
                });
            }

            
        </script>
</body>
</html>
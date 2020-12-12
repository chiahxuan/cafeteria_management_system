<?php

    include('../../../Admin/Default/server.php');
    

    if(isset($_POST['vendorReportBtn']))
    {
        
        //NAVAGATE TO REPORT PAGE WHEN SELECTED
        @$_SESSION['VendorReportExist'] = "SET";
        //PASS VENDOR REPORT SELECTED MONTH 
        @$_SESSION['vendorReportMonth'] = $_POST['vendorReportMonth'];
        header('location: analysisMain.php');

    
    }


?>
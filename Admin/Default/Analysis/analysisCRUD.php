<?php 
    include('../server.php');

    if(isset($_POST['CafmonthBtn']))
    {
        unset($_SESSION['VendorReportExist']);
        @$_SESSION['monthValue'] = $_POST['month'];
        @$_SESSION['checkCafReport'] = $_POST['month'];

        header('location: analysisMain.php');
    }


    if(isset($_POST['vendorReportBtn']))
    {
        unset($_SESSION['checkCafReport']);
        @$_SESSION['VendorReportExist'] = $_POST['vendorReportMonth'];

        @$_SESSION['vendorReportMonth'] = $_POST['vendorReportMonth'];
        @$_SESSION['VendorOption'] = $_POST['VendorOption'];
      
        header('location: analysisMain.php');

    }
?>
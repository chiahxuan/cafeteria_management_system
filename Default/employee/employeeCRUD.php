<?php
    include('../../../Admin/Default/server.php');


    if(isset($_GET['id']))
    {
        // $_SESSION['loginRelatedVendor'] = $_GET['id'];
        $id = $_GET['id'];

            //employee table query
            @$eshow = "SELECT * from `employee` where `employee_id` = '$id' ";
            @$eshow_run = mysqli_query($con, $eshow);
            @$eshow_rows = mysqli_fetch_assoc($eshow_run);
            //pass variable to session
            @$_SESSION['employeeID'] =  $eshow_rows['employee_id'];
            @$_SESSION['employeeName'] =  $eshow_rows['employee_name'];
            @$_SESSION['employeeRole'] = $eshow_rows['employee_role'];
            @$_SESSION['employeeBalance'] = $eshow_rows['employee_balance'];
            @$_SESSION['employeeStatus'] = $eshow_rows['employee_status'];
           
            // echo $_SESSION['employeeName'];
            // echo $_SESSION['employeeRole'];
            // echo $_SESSION['employeeBalance'];
            // echo $_SESSION['employeeStatus'];

            $_SESSION['showprofile'] = 'SET';
            header("location: employee.php");
    }
    




?>
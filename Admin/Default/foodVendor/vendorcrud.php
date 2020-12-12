<?php
    //connection to database
    //start session 
    //connection to server to get loginID
    include('../server.php');

    if(isset($_GET['orderid']))
    {

        @$orderid = $_GET['orderid'];

        @$selectOrder = "SELECT * FROM viewvendortransaction WHERE orderID = '$orderid'  ";
        @$selectOrder_run = mysqli_query($con, $selectOrder);

        if(mysqli_num_rows($selectOrder_run) < 1)
        {
            //  ERROR REDIRECT
            header("location: foodVendorMain.php");
        }else
        {
            //  SUCESS, FETCH ARRAY
            @$selectOrder_run_rows = mysqli_fetch_assoc($selectOrder_run);

            @$_SESSION['foodName'] = $selectOrder_run_rows['foodName'];
            @$_SESSION['transID'] = $selectOrder_run_rows['transID'];
            @$_SESSION['quantity'] = $selectOrder_run_rows['Quantity'];
            @$_SESSION['amount'] = $selectOrder_run_rows['TotalSub'];
            @$_SESSION['date'] = $selectOrder_run_rows['transDate'];
            @$_SESSION['time'] = $selectOrder_run_rows['transTime'];
          
            @$_SESSION['displayTransHis'] = "SET";


            header("location: foodVendorMain.php?displayTransHis=".$_SESSION['displayTransHis']);

        }

    }

    //get data (id)into profilePage
    if(isset($_GET['id'])){

        @$_SESSION['vendor_id'] = $_GET['id'];
        //vendor query
        @$vshow = "SELECT * from vendor where vendor_id = '".$_SESSION['vendor_id']."' ";
        @$vshow_run = mysqli_query($con, $vshow);
        @$vshow_rows = mysqli_fetch_assoc($vshow_run);
        //employee table query
        @$eshow = "SELECT * from employee where vendor_id = '".$_SESSION['vendor_id']."' AND employee_role = 'kitchen owner' ";
        @$eshow_run = mysqli_query($con, $eshow);
        @$eshow_rows = mysqli_fetch_assoc($eshow_run);
        //pass variable to session
        @$_SESSION['vendor_name'] =  $vshow_rows['vendor_name'];
        @$_SESSION['employee_name'] = $eshow_rows['employee_name'];

        $_SESSION['displayProfile'] = 'set';
       
        header("location: foodVendorMain.php?id =".$_SESSION['vendor_id']);

    }
    
    //EDIT VENDOR 
    if(isset($_POST['confirmEditBtn']))
    {
        @$vendor_id = $_SESSION['chkVendorId'];
        @$vendor_name = $_POST['profile_vname'];
        @$vendor_owner = $_POST['profile_vowner'];
        
        @$update_vquery = "UPDATE vendor SET    vendor_name = '$vendor_name' 
                                            WHERE   vendor_id = '$vendor_id'";        
        @$update_vquery_run = mysqli_query($con, $update_vquery);

        @$update_equery = "UPDATE employee SET employee_name = '$vendor_owner' 
                                                WHERE   vendor_id = '$vendor_id' AND employee_role = 'kitchen owner'   ";
        @$update_equery_run = mysqli_query($con, $update_equery);

        //check if the data affected
        if(mysqli_affected_rows($con) <= 0)
        {
            echo "<script> window.location.assign('foodVendorMain.php'); </script>";
        }else
        {

            @$_SESSION['displayModalUpdated'] = 'set';

            echo "<script> window.location.assign('foodVendorMain.php'); </script>";
        }
    }
    
    //DELETE VENDOR
    if(isset($_POST['vdelete']))
    {
        
        @$employee_delete = "DELETE FROM employee WHERE vendor_id = '".$_SESSION['chkVendorId']."'";
        @$employee_delete_run = mysqli_query($con, $employee_delete);
        @$vendor_delete = "DELETE FROM vendor WHERE vendor_id = '".$_SESSION['chkVendorId']."'";
        @$vendor_delete_run = mysqli_query($con, $vendor_delete);
        

        if(mysqli_affected_rows($con) <= 0)
        {
            echo "<script> window.location.assign('foodVendorMain.php'); </script>";
        }else
        {

            $_SESSION['displayModalDeleted'] = 'set';
            echo "<script> window.location.assign('foodVendorMain.php'); </script>";
        }
    }
    
    //ADD VENDOR
    if(isset($_POST['vadd']))
    {
        //generate random vendor_id
        @$num = rand(000000, 999999);
        @$vendorid = 'VD'.$num;
        //run query to generate unique vendor_id
        @$query = "SELECT * FROM vendor WHERE vendor_id = '".$vendorid."'";
        @$query_run = mysqli_query($con, $query);
        
       if(mysqli_num_rows($query_run) > 0)
        {
            //loop to repeat the random number generation  
            do{
                @$num = rand(000000, 999999);
                @$vendorid = 'VD'.$num;
                //run query to generate unique vendor_id
                @$query = "SELECT * FROM vendor where vendor_id = '".$vendorid."'";
                @$query_run = mysqli_query($con, $query);
            }while(mysqli_num_rows($query_run) > 0 );
            //pass value from textbox to variable using POST
            @$vendorname = $_POST['vname'];
            //query to insert vendor details, vendor_balance = 0.00 by default
            @$vadd = "INSERT INTO vendor(vendor_id, vendor_name, vendor_balance) VALUES ('$vendorid', '$vendorname', '0.00')";
            @$vadd_run = mysqli_query($con, $vadd);
            //display vendor_id and inserted name
            @$_SESSION['displayModalAdded'] = 'set';
            echo "<script> window.location.assign('foodVendorMain.php'); </script>";
        }else
        {
            @$vendorname = $_POST['vname'];
            //query to insert vendor details, vendor_balance = 0.00 by default
            @$vadd = "INSERT INTO vendor(vendor_id, vendor_name, vendor_balance) VALUES ('$vendorid', '$vendorname', '0.00')";
            @$vadd_run = mysqli_query($con, $vadd);
            //display vendor_id and inserted name
            @$_SESSION['displayModalAdded'] = 'set';

            echo "<script> window.location.assign('foodVendorMain.php'); </script>";

        }  

    }


    




?>


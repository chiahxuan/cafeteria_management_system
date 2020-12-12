<?php
    include('../server.php');


    //NAVIGATED FROM TRANS DETAIL TO GET INFORMATION FOR TRANSHIS POP UP 
    if(isset($_GET['orderid']))
    {

        $orderid = $_GET['orderid'];


        @$getpendinginfo = "SELECT * FROM pendingrequest WHERE orderID = '$orderid'  ";
        @$getpendinginfo_run = mysqli_query($con, $getpendinginfo);
        echo mysqli_affected_rows($con);

        if(@mysqli_affected_rows($con) < 1)
        {
            //  ERROR REDIRECT
            header("location: accessCardMain.php?displayTransHis=".$_SESSION['displayTransHis']);
        }else
        {
             //SUCESS, FETCH ARRAY
            $getpendinginfo_run_rows = mysqli_fetch_assoc($getpendinginfo_run);

            @$_SESSION['pendingfoodName'] = $getpendinginfo_run_rows['foodName'];
            @$_SESSION['pendingtransID'] = $getpendinginfo_run_rows['trans_id'];
            @$_SESSION['pendingquantity'] = $getpendinginfo_run_rows['quantity'];
            @$_SESSION['pendingtotalamount'] = $getpendinginfo_run_rows['totalRefundPrice'];
            @$_SESSION['pendingdate'] = $getpendinginfo_run_rows['transDate'];
            @$_SESSION['pendingtime'] = $getpendinginfo_run_rows['transTime'];
            @$_SESSION['orderid'] = $getpendinginfo_run_rows['orderID'];
            @$_SESSION['vendorid'] = $getpendinginfo_run_rows['vendorID'];
            @$_SESSION['pendinguserid'] = $getpendinginfo_run_rows['userID'];
            @$_SESSION['pendingemployeeid'] = $getpendinginfo_run_rows['employeeID'];

          
            $_SESSION['displayTransHis'] = "SET";

            header("location: accessCardMain.php?s=".$_SESSION['displayTransHis']);

        }
    }


    if(isset($_POST['btnConfirm']))
    {
        //select user query
        @$ushow = "SELECT * from `user` where `user_id` = '".$_POST['userID']."' ";
        @$ushow_run = mysqli_query($con, $ushow);
        @$ushow_rows = mysqli_fetch_assoc($ushow_run);

            if(@mysqli_num_rows($ushow_run) > 0)
            {
                //pass variable to session
                @$_SESSION['userName'] =  $ushow_rows['user_name'];
                @$_SESSION['userRole'] = $ushow_rows['user_role'];
                @$_SESSION['userBalance'] = $ushow_rows['card_amount'];
                @$_SESSION['userStatus'] = $ushow_rows['card_status'];
                @$_SESSION['referRole'] = $ushow_rows['user_role'];
                @$_SESSION['accessUserID'] = $_POST['userID'];

            }else{

                //employee table query
                @$eshow = "SELECT * from employee where `employee_id` = '".$_SESSION['accessUserID']."' ";
                @$eshow_run = mysqli_query($con, $eshow);
                @$eshow_rows = mysqli_fetch_assoc($eshow_run);

                if(@mysqli_num_rows($eshow_rows) > 0){
                    //pass variable to session
                    @$_SESSION['employeName'] =  $eshow_rows['employee_name'];
                    @$_SESSION['employeeRole'] = $eshow_rows['employee_role'];
                    @$_SESSION['employeeBalance'] = $eshow_rows['employee_balance'];
                    @$_SESSION['employeeStatus'] = $eshow_rows['employee_status'];
                    @$_SESSION['accessUserID'] = $_POST['userID'];

                    @$_SESSION['referRole'] = $eshow_rows['employee_role'];
                }else{
                    //invalid
                    echo "<script> window.location.assign('accessCardMain.php?invalidid'); </script>";

                }

            }
            //header("location: accessCardMain.php");
            echo "<script> window.location.assign('accessCardMain.php'); </script>";


        
    }

    //TOP UP PROCESS
    if(isset($_POST['topupConfirmBtn']))
    {
        //echo "top up here";
        @$id = $_SESSION['accessUserID'];
        @$topupAmount = $_POST['amount'];
        @$current_date = date("Y-m-d");
        @$current_time = date("h:i:s");
        @$checkStatusBoolean = false;

        if(isset($_SESSION['referRole'])){

            @$checkStatus = "SELECT * from `user` WHERE `user_id` = '".$_SESSION['accessUserID']."' ";
            @$checkStatus_run = mysqli_query($con, $checkStatus);
            @$checkStatus_run_rows = mysqli_fetch_assoc($checkStatus_run);

            if($checkStatus_run_rows['card_status'] == 'ACTIVATED' ){
                @$checkStatusBoolean = true;
            }else{
                @$checkStatusBoolean = false;
            }

        }else{
            @$checkStatus = "SELECT * from `employee` WHERE `employee_id` = '".$_SESSION['accessUserID']."' ";
            @$checkStatus_run = mysqli_query($con, $checkStatus);
            @$checkStatus_run_rows = mysqli_fetch_assoc($checkStatus_run);

            if($checkStatus_run_rows['employee_status'] == 'ACTIVATED' ){
                @$checkStatusBoolean = true;
            }else{
                @$checkStatusBoolean = false;
            }
        }

        if($checkStatusBoolean == false){
            echo "<script> window.location.assign('accessCardMain.php?deactivatedcard'); </script>";

        }else if ($checkStatusBoolean == true){
            
            if($topupAmount < 10){
                //ERROR NOT ENOUGH TOP UP AMOUNT 
                echo "<script> window.location.assign('accessCardMain.php?notenoughamount'); </script>";

            }else if($topupAmount > 1000){
                echo "<script> window.location.assign('accessCardMain.php?toomuch'); </script>";
                
            }else{
                //CREATE TOP UP TRANSACTION 
                @$num = rand(100000, 999999);
                @$trans_id = 'TR'.$num;

                @$checkTransID = "SELECT * FROM `transaction` WHERE `trans_id` = '$trans_id' ";
                @$checkTransID_run = mysqli_query($con, $checkTransID);

                //CHECK TRANSACTION UNIQUE NUMBER
                if(@mysqli_num_rows($checkTransID_run) > 0)
                {
                    // echo '<script type = "text/javascript"> alert("not unique trans id"); </script>';  
                    do{

                        //CREATE TOP UP TRANSACTION 
                        @$num = rand(100000, 999999);
                        @$trans_id = 'TR'.$num;
                        
                        @$checkTransID = "SELECT * FROM `transaction` WHERE `trans_id` = '$trans_id' ";
                        @$checkTransID_run = mysqli_query($checkTransID);
                    }while(mysqli_num_rows($checkTransID_run) > 0);
                }else{
                    
                    // echo '<script type = "text/javascript"> alert("unique and valid name"); </script>'; 

                    //CHECK ROLE TO UPDATE DATE
                    if(@$_SESSION['referRole'] == 'kitchen employee' OR $_SESSION['referRole'] == 'kitchen owner')
                    {
                        
                        @$topUpTrans ="INSERT INTO `transaction`(`trans_id`, `trans_date`, `trans_time`, `trans_title`, `trans_amount`, `employee_id`) 
                        VALUES ('$trans_id', '$current_date', '$current_time', 'TOP UP', '$topupAmount', '$id' ) ";
                        @$topUpTrans_run = mysqli_query($con, $topUpTrans);
            
                        @$selectEmployee = "SELECT * FROM `employee` WHERE employee_id = '$id' " ;
                        @$selectEmployee_run = mysqli_query($con, $selectEmployee);
                        @$getEmployeeinfo = mysqli_fetch_assoc($selectEmployee_run);
                        //CALCULATE TOP UP AMOUNT
                        @$total = $topupAmount + $getEmployeeinfo['employee_balance'];
            
                        @$eTopup = "UPDATE employee  SET employee_balance = '$total'
                                                    WHERE employee_id = '$id'" ;
                        @$eTopup_run = mysqli_query($con, $eTopup);
            
                        @$_SESSION['employeeBalance'] = $total;
            
                    }else
                    {
            
                        @$topUpTrans ="INSERT INTO `transaction`(`trans_id`, `trans_date`, `trans_time`, `trans_title`, `trans_amount`, `user_id`) 
                        VALUES ('$trans_id', '$current_date', '$current_time', 'TOP UP', '$topupAmount', '$id' ) ";
                    
                        @$topUpTrans_run = mysqli_query($con, $topUpTrans);
            
                        
                        @$selectUser = "SELECT * FROM `user` WHERE `user_id` = '$id' " ;
                        @$selectUser_run = mysqli_query($con, $selectUser);
                        @$getUserinfo = mysqli_fetch_assoc($selectUser_run);
                        @$total = $topupAmount + $getUserinfo['card_amount'];
            
                        //UPDATE BALANCE
                        @$uTopup = "UPDATE `user`  SET card_amount = '$total' WHERE `user_id` = '$id'" ;
                        @$uTopup_run = mysqli_query($con, $uTopup);
            
                        @$_SESSION['userBalance'] = $total;
                    }



                    //GENERATE NUMBER FOR ORDER ID
                    @$num1 = rand(100000, 999999);
                    @$order_id = 'OR'.$num1;
            
                    @$checkOrderID = "SELECT * FROM `order` WHERE `order_id` = '$order_id' ";
                    @$checkOrderID_run = mysqli_query($con, $checkOrderID);
            
                    //CHECK ORDER UNIQUE NUMBER
                    if(@mysqli_num_rows($checkOrderID_run) > 0)
                    {
                        // echo '<script type = "text/javascript"> alert("not unique order id"); </script>';  
                        do{
            
                            //CREATE TOP UP TRANSACTION 
                            @$num1 = rand(100000, 999999);
                            @$order_id = 'OR'.$num1;
                            
                            @$checkOrderID = "SELECT * FROM `order` WHERE `order_id` = '$order_id' ";
                            @$checkOrderID_run = mysqli_query($con, $checkOrderID);
                        }while(@mysqli_num_rows($checkOrderID_run) > 0);
                    }else{
                        // echo '<script type = "text/javascript"> alert("unique order id"); </script>';  
                        
                        
                        @$orderTrans ="INSERT INTO `order`(`order_id`, `quantity`, `trans_id`,  `order_type`) 
                        VALUES ('$order_id', '1','$trans_id', 'TOP UP' ) ";
                    
                        @$orderTrans_run = mysqli_query($con, $orderTrans);
                        
                    }

            
                    @$_SESSION['checkTopUP'] = 'set';
                    echo "<script> window.location.assign('accessCardMain.php'); </script>";
            
                }

            }


        }


    

    }

    //CHANGE STATUS
    if(isset($_POST['changeStatusBtn']))
    {
        //echo "top up here";
        @$id = $_SESSION['accessUserID'];

        if(@$_SESSION['referRole'] == 'kitchen employee' OR $_SESSION['referRole'] == 'kitchen owner')
        {
            
            @$selectEmployee = "SELECT * FROM `employee` WHERE employee_id = '$id' " ;
            @$selectEmployee_run = mysqli_query($con, $selectEmployee);
            @$getEmployeeinfo = mysqli_fetch_assoc($selectEmployee_run);
            //echo $getEmployeeinfo['employee_balance']." top up amount";
            @$status = $getEmployeeinfo['employee_status'];
            // echo '<script> alert("'.$status.'");</script>';

            if(@$status == "ACTIVATED" )
            {   
                //DEAVTIVATE 
                @$newstatus = "DEACTIVATED";
                @$eChangeStatus = "UPDATE `employee` SET `employee_status` = '$newstatus'
                WHERE employee_id = '$id'" ;
                @$eTopup_run = mysqli_query($con, $eChangeStatus);
                //echo mysqli_affected_rows($con);


            }else if (@$status == "DEACTIVATED")
            {
                //ACTIVATE
                @$newstatus = "ACTIVATED";
                @$eChangeStatus = "UPDATE `employee`  SET `employee_status` = '$newstatus'
                WHERE employee_id = '$id'" ;
                @$eTopup_run = mysqli_query($con, $eChangeStatus);

                //echo mysqli_affected_rows($con);

            }
            
            // echo $newstatus;
            $_SESSION['employeeStatus'] = $newstatus;

        }else
        {
            @$selectUser = "SELECT * FROM `user` WHERE `user_id` = '$id' " ;
            @$selectUser_run = mysqli_query($con, $selectUser);
            @$getUserinfo = mysqli_fetch_assoc($selectUser_run);
            //echo $getEmployeeinfo['employee_balance']." top up amount";
            @$status = $getUserinfo['card_status'];
            // echo '<script> alert("'.$status.'");</script>';

            if(@$status == "ACTIVATED" )
            {   
                //DEAVTIVATE 

                @$newstatus = "DEACTIVATED";
                @$uChangeStatus = "UPDATE `user` SET `card_status` = '$newstatus'
                WHERE `user_id` = '$id'" ;
                @$eTopup_run = mysqli_query($con, $uChangeStatus);
                //echo mysqli_affected_rows($con);


            }else if ($status == "DEACTIVATED")
            {
                //ACTIVATE
                @$newstatus = "ACTIVATED";
                @$uChangeStatus = "UPDATE `user` SET `card_status` = '$newstatus'
                                    WHERE `user_id` = '$id'" ;
                @$eTopup_run = mysqli_query($con, $uChangeStatus);

                //echo mysqli_affected_rows($con);

            }
            
            // echo $newstatus;
            @$_SESSION['userStatus'] = $newstatus;
        }

        echo "<script> window.location.assign('accessCardMain.php'); </script>";
        

    }

    //REFUND PROCESS
    if(isset($_POST['refundBtn']))
    {
        unset($_SESSION['check']);


        @$transid = $_SESSION['pendingtransID'];
        @$orderid = $_SESSION['orderid'];
        @$refundAmount = $_SESSION['pendingtotalamount'];

        //UPDATE TRANSACTION PENDING TO REFUND 
        @$updateordertype = "UPDATE `order` SET `order_type` = 'REFUND' 
        WHERE `order_id` =  '$orderid' ";
        @$updateordertype_run = mysqli_query($con, $updateordertype);

        if(@mysqli_affected_rows($con) <1)
        {
            //ERROR CANNOT UPDATE
            // echo '<script> alert("cannot update order");</script>';
            echo "<script> window.location.assign('accessCardMain.php'); </script>";

        }else{
            //UPDATE ORDER PENDING TO REFUND 
            @$updatetranstitle= "UPDATE `transaction` SET `trans_title` = 'REFUND' 
                                WHERE `trans_id` =  '$transid' ";
            @$updatetranstitle_run = mysqli_query($con, $updatetranstitle);
            if(@mysqli_affected_rows($con) <1)
            {
                //ERROR CANNOT UPDATE TRANSACTION
                // echo '<script> alert("cannot update transaction");</script>';
                echo "<script> window.location.assign('accessCardMain.php'); </script>";

            }else{
                //UPDATE ORDER PENDING TO REFUND 

                @$getVendorProfit = "SELECT * FROM vendor WHERE vendor_id = '".$_SESSION['vendorid']."'    ";
                @$getVendorProfit_run = mysqli_query($con, $getVendorProfit);
                @$getVendorProfit_run_rows = mysqli_fetch_assoc($getVendorProfit_run);

                //CALCULATE VENDOR BALANCE AFTER REFUND
                @$vendorBalance  = $getVendorProfit_run_rows['vendor_balance'];
                @$totalProfit = $vendorBalance - $refundAmount;

                //UPDATE VENDOR BALACNE 
                @$updateVendorBalance = "UPDATE `vendor` SET `vendor_balance` = '$totalProfit' 
                WHERE `vendor_id` =  '".$_SESSION['vendorid']."'    ";
                @$updateVendorBalance_run = mysqli_query($con, $updateVendorBalance);

                if(@mysqli_affected_rows($con) <1)
                {
                    //ERROR CANNOT UPDATE TRANSACTION
                    echo "<script> window.location.assign('accessCardMain.php'); </script>";

                }else{
                    //UPDATE USER BALANCE BALANCE + REFUND.PRICE
                    @$getUserBalance = "SELECT * FROM `user` WHERE `user_id` = '".$_SESSION['pendinguserid']."'    ";
                    @$getUserBalance_run = mysqli_query($con, $getUserBalance);

                    if(@mysqli_affected_rows($con) <1)
                    {
                        //ERROR CANNOT UPDATE TRANSACTION
                        //GET BALNACE FROM EMPLOYEE
                        @$getUserBalance = "SELECT * FROM `employee` WHERE `employee_id` = '".$_SESSION['pendingemployeeid']."'    ";
                        @$getUserBalance_run = mysqli_query($con, $getUserBalance);

                        if(@mysqli_affected_rows($con) <1)
                        {
                            //ERROR CANNOT GET EMPLOYEE
                            // echo '<script> alert("cannot get employee info! ");</script>';
                            echo "<script> window.location.assign('accessCardMain.php'); </script>";

                        }else{
                            @$getUserBalance_run_rows = mysqli_fetch_assoc($getUserBalance_run);
    
                            //CALCULATE VENDOR BALANCE AFTER REFUND
                            @$userBalance  = $getUserBalance_run_rows['employee_balance'];
                            @$newBalance = $userBalance + $refundAmount;
            
                            //UPDATE VENDOR BALACNE 
                            @$updateUserBalance = "UPDATE `employee` SET `employee_balance` = '$newBalance' 
                            WHERE `employee_id` =  '".$_SESSION['pendingemployeeid']."'    ";
                            @$updateUserBalance_run = mysqli_query($con, $updateUserBalance);
                            @$_SESSION['doneRefund'] = 'set';
                            // echo '<script> alert("Refund Completed (employee)");</script>';
                            echo "<script> window.location.assign('accessCardMain.php'); </script>";

                        }

                    }else{
                        @$getUserBalance_run_rows = mysqli_fetch_assoc($getUserBalance_run);
    
                        //CALCULATE VENDOR BALANCE AFTER REFUND
                        @$userBalance  = $getUserBalance_run_rows['card_amount'];
                        @$newBalance = $userBalance + $refundAmount;
               
        
                        //UPDATE VENDOR BALACNE 
                        @$updateUserBalance = "UPDATE `user` SET `card_amount` = '$newBalance' 
                        WHERE `user_id` ='".$_SESSION['pendinguserid']."'    ";
                        @$updateUserBalance_run = mysqli_query($con, $updateUserBalance);
                     
                        @$_SESSION['doneRefund'] = 'set';

                        // echo '<script> alert("Refund Completed (user)");</script>';
                        echo "<script> window.location.assign('accessCardMain.php'); </script>";

                    }
                }
            }

        }


       

    }




?>
<?php
    $con = mysqli_connect("localhost", "root", "root", "cafeteria") or die("Unable to connect");
    //start session 
    session_start();

if(isset($_POST['btnConfirm'])){
    
        //select user query
        @$ushow = "SELECT * from `user` where `user_id` = '".$_POST['userID']."' ";
        @$ushow_run = mysqli_query($con, $ushow);
        @$ushow_rows = mysqli_fetch_assoc($ushow_run);

            if(@mysqli_num_rows($ushow_run) > 0)
            {
                //pass variable to session
                $_SESSION['topupName'] =  $ushow_rows['user_name'];
                $_SESSION['topupRole'] = $ushow_rows['user_role'];
                $_SESSION['topupBal'] = $ushow_rows['card_amount'];
                $_SESSION['topupStatus'] = $ushow_rows['card_status'];
                $_SESSION['topupRole'] = $ushow_rows['user_role'];
                $_SESSION['topUpUserID'] = $_POST['userID'];

                header('Location: TopUpKioskMain.php?displayActivity');

            }else{

                //employee table query
                @$eshow = "SELECT * from employee where `employee_id` = '".$_POST['userID']."' ";
                @$eshow_run = mysqli_query($con, $eshow);
                @$eshow_rows = mysqli_fetch_assoc($eshow_run);
            
                if(@mysqli_num_rows($eshow_rows) > 0){
                    //pass variable to session
                    $_SESSION['topupName'] =  $eshow_rows['employee_name'];
                    $_SESSION['topupRole'] = $eshow_rows['employee_role'];
                    $_SESSION['topupBal'] = $eshow_rows['employee_balance'];
                    $_SESSION['topupStatus'] = $eshow_rows['employee_status'];
                    $_SESSION['topUpUserID'] = $_POST['userID'];
                    header('Location: TopUpKioskMain.php?displayActivity');


                }else{
                    header('Location: TopUpKioskMain.php?invalidid');

                }

            }
          
        // echo 

}

if(isset($_POST['topupamount'])){

    $id = $_POST['topupUid'];
    $topupAmount = $_POST['topupamount'];
    $current_date = date("Y-m-d");
    $current_time = date("h:i:s");

    @$checkStatusBoolean = false;

    if($_SESSION['topupRole'] != 'kitchen employee' OR $_SESSION['topupRole'] != 'kitchen owner'  ){

        @$checkStatus = "SELECT * from `user` WHERE `user_id` = '".$_SESSION['topUpUserID']."' ";
        @$checkStatus_run = mysqli_query($con, $checkStatus);
        @$checkStatus_run_rows = mysqli_fetch_assoc($checkStatus_run);

        if($checkStatus_run_rows['card_status'] == 'ACTIVATED' ){
            @$checkStatusBoolean = true;
        }else{
            @$checkStatusBoolean = false;
        }

    }else{
        @$checkStatus = "SELECT * from `employee` WHERE `employee_id` = '".$_SESSION['topUpUserID']."' ";
        @$checkStatus_run = mysqli_query($con, $checkStatus);
        @$checkStatus_run_rows = mysqli_fetch_assoc($checkStatus_run);

        if($checkStatus_run_rows['employee_status'] == 'ACTIVATED' ){
            @$checkStatusBoolean = true;
        }else{
            @$checkStatusBoolean = false;
        }
    }

    if($checkStatusBoolean == false){
        echo "<script> window.location.assign('TopUpKioskMain.php?deactivatedcard'); </script>";

    }else if ($checkStatusBoolean == true){
        //continue update
        if($topupAmount < 10){
            //ERROR NOT ENOUGH TOP UP AMOUNT 
            header('Location: TopUpKioskMain.php?notenoughamount');


        }else if($topupAmount > 1000){
            header('Location: TopUpKioskMain.php?toomuch');

            
        }else{
            //CREATE TOP UP TRANSACTION 
            $num = rand(100000, 999999);
            $trans_id = 'TR'.$num;
            $uniqueTransID = false;

            $checkTransID = "SELECT * FROM `transaction` WHERE `trans_id` = '$trans_id' ";
            $checkTransID_run = mysqli_query($con, $checkTransID);

            //CHECK TRANSACTION UNIQUE NUMBER
            if(mysqli_num_rows($checkTransID_run) > 0)
            {
                $uniqueTransID = false;

                do{

                    //CREATE TOP UP TRANSACTION 
                    $num = rand(100000, 999999);
                    $trans_id = 'TR'.$num;
                    
                    $checkTransID = "SELECT * FROM `transaction` WHERE `trans_id` = '$trans_id' ";
                    $checkTransID_run = mysqli_query($checkTransID);
                }while(mysqli_num_rows($checkTransID_run) > 0);
                $uniqueTransID = true;

            }else{
                
                $uniqueTransID = true;
            }   
            
            //STRAT TOP UP 
            if($uniqueTransID == true){
                //CHECK ROLE TO UPDATE DATE
                if($_SESSION['topupRole'] == 'kitchen employee' OR $_SESSION['topupRole'] == 'kitchen owner')
                {
                    
                    $topUpTrans ="INSERT INTO `transaction`(`trans_id`, `trans_date`, `trans_time`, `trans_title`, `trans_amount`, `employee_id`) 
                    VALUES ('$trans_id', '$current_date', '$current_time', 'TOP UP', '$topupAmount', '$id' ) ";
                    $topUpTrans_run = mysqli_query($con, $topUpTrans);

                    echo mysqli_affected_rows($con);
                    $selectEmployee = "SELECT * FROM `employee` WHERE employee_id = '$id' " ;
                    $selectEmployee_run = mysqli_query($con, $selectEmployee);
                    $getEmployeeinfo = mysqli_fetch_assoc($selectEmployee_run);
                    //CALCULATE TOP UP AMOUNT
                    $total = $topupAmount + $getEmployeeinfo['employee_balance'];

                    $eTopup = "UPDATE employee  SET employee_balance = '$total'
                                                WHERE employee_id = '$id'" ;
                    $eTopup_run = mysqli_query($con, $eTopup);

                    $_SESSION['employeeBalance'] = $total;

                }else
                {

                    $topUpTrans ="INSERT INTO `transaction`(`trans_id`, `trans_date`, `trans_time`, `trans_title`, `trans_amount`, `user_id`) 
                    VALUES ('$trans_id', '$current_date', '$current_time', 'TOP UP', '$topupAmount', '$id' ) ";
                
                    $topUpTrans_run = mysqli_query($con, $topUpTrans);

                    echo mysqli_affected_rows($con);
                    
                    $selectUser = "SELECT * FROM `user` WHERE `user_id` = '$id' " ;
                    $selectUser_run = mysqli_query($con, $selectUser);
                    $getUserinfo = mysqli_fetch_assoc($selectUser_run);
                    $total = $topupAmount + $getUserinfo['card_amount'];

                    //UPDATE BALANCE
                    $uTopup = "UPDATE `user`  SET card_amount = '$total' WHERE `user_id` = '$id'" ;
                    $uTopup_run = mysqli_query($con, $uTopup);

                    $_SESSION['userBalance'] = $total;
                }

                    //GENERATE NUMBER FOR ORDER ID
                $num1 = rand(100000, 999999);
                $order_id = 'OR'.$num1;
                $uniqueOrderID = false;

                $checkOrderID = "SELECT * FROM `order` WHERE `order_id` = '$order_id' ";
                $checkOrderID_run = mysqli_query($con, $checkOrderID);

                //CHECK ORDER UNIQUE NUMBER
                if(mysqli_num_rows($checkOrderID_run) > 0)
                {
                    $uniqueOrderID = false;
                    do{
        
                        //CREATE TOP UP TRANSACTION 
                        $num1 = rand(100000, 999999);
                        $order_id = 'OR'.$num1;
                        
                        $checkOrderID = "SELECT * FROM `order` WHERE `order_id` = '$order_id' ";
                        $checkOrderID_run = mysqli_query($con, $checkOrderID);
                    }while(mysqli_num_rows($checkOrderID_run) > 0);
                    $uniqueOrderID = true;

                }else{
                    $uniqueOrderID = true;         
        
                }

                if($uniqueOrderID == true){
                                
                    
                    $orderTrans ="INSERT INTO `order`(`order_id`, `quantity`, `trans_id`,  `order_type`, `order_status`) 
                    VALUES ('$order_id', '1','$trans_id', 'TOP UP', 'COMPLETED' ) ";
                    $orderTrans_run = mysqli_query($con, $orderTrans);
                    if( mysqli_affected_rows($con) >0){
                        header('Location: TopUpKioskMain.php?topupsuccess');
                    }else{
                        header('Location: TopUpKioskMain.php?displayActivity');

                    }
                    
                }




            }
            
        }
    }



       

    


}


?>
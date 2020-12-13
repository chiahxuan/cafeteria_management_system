<?php
    include('../../../Admin/Default/server.php');

    if(isset($_GET['orderid']))
    {

        // echo $_GET['orderid'];
        @$orderid = $_GET['orderid'];
        @$_SESSION['orderid'] = $orderid;
        // echo "hello;";

        @$selectOrder = "SELECT * FROM viewtransaction WHERE orderID = '$orderid' ";
        @$selectOrder_run = mysqli_query($con, $selectOrder);
        echo mysqli_affected_rows($con);

        if(mysqli_affected_rows($con) < 1)
        {
            //  ERROR REDIRECT
            header("location: Transaction.php");

        }else
        {
            //SUCESS, FETCH ARRAY
            $selectOrder_run_rows = mysqli_fetch_assoc($selectOrder_run);

            @$_SESSION['foodName'] = $selectOrder_run_rows['foodName'];
            @$_SESSION['transID'] = $selectOrder_run_rows['transactionID'];
            @$_SESSION['quantity'] = $selectOrder_run_rows['orderQuantity'];
            @$_SESSION['amount'] = $selectOrder_run_rows['totalAmount'];
            @$_SESSION['date'] = $selectOrder_run_rows['transactionDate'];
            @$_SESSION['time'] = $selectOrder_run_rows['transactionTime'];
            @$_SESSION['orderStatus'] = $selectOrder_run_rows['orderStatus'];
          
            @$_SESSION['displayTransHistory'] = "SET";
            // echo $_SESSION['foodName'];
            // echo $_SESSION['transID'];
            // echo $_SESSION['quantity'];
            // echo $_SESSION['amount'] ;
            // echo $_SESSION['date'] ;
            // echo $_SESSION['time'] ;

            header("location: Transaction.php");

        }

    }

    if(isset($_POST['refundBtn'])){

        //SELECT ORDER ID 
        @$selectOrder = "SELECT * FROM `viewtransaction` WHERE `orderID` = '".$_SESSION['orderid']."'  ";
        @$selectOrder_run = mysqli_query($con, $selectOrder);
        @$selectOrder_run_rows = mysqli_fetch_assoc($selectOrder_run);

        @$refundUserID = $selectOrder_run_rows['userID'];
        @$refundAmount = $selectOrder_run_rows['totalAmount'];
 

        //GENERATE NEW TRANS ID 
       @$num = rand(100001, 999999);
        @$transid = 'TR'.$num;
        @$today = date("Y-m-d");
        @$now = date("h:m:s");


        //CHECK IF TRANSACTION ID UNIQUE
        @$hdquery = "SELECT * FROM `transaction` WHERE `trans_id` = '".$transid."'   ";
        @$hdquery_run = mysqli_query($con, $hdquery);

        if(mysqli_affected_rows($con) < 0){
            //NOT UNIQUE ID
            echo '<script type = "text/javascript"> alert("not unique id"); </script>';  

            do{

                $num = rand(100001, 999999);
                $transid = 'TR'.$num;

                @$hdquery = "SELECT * FROM `transaction` WHERE `trans_id` = '".$transid."'   ";
                @$hdquery_run = mysqli_query($con, $hdquery);

            }while(mysqli_num_rows($hdquery_run) > 0);

            //UNIQUE ID

            //refund normal user
            @$checkUser = "SELECT * FROM `user` WHERE `user_id` = '$refundUserID' ";
            @$checkUser_run = mysqli_query($con, $checkUser);

            if(mysqli_affected_rows($con) < 1){
                //employee refund 
                @$checkEm = "SELECT * FROM `employee` WHERE `employee_id` = '$refundUserID' ";
                @2$checkEm_run = mysqli_query($con, $checkEm);

                if(mysqli_affected_rows($con) < 1){
                    //error
                    echo '<script type = "text/javascript"> alert("cannot select employee"); </script>';  

                    echo "<script> window.location.assign('Transaction.php'); </script>";

                }else{
                    //sucess detect employee and continue
                    //it is employee to refund 
                    @$refundAdd = "INSERT INTO `transaction`(`trans_id`, `trans_date`, trans_time, trans_title, trans_amount,`employee_id`) 
                    VALUES ('".$transid."' , '$today', '$now', 'PENDING', '$refundAmount', '$refundUserID' )";
                    @$refundAdd_run = mysqli_query($con, $refundAdd);

                    if(mysqli_affected_rows($con) < 1){
                        //error cannot insert 
                        echo '<script type = "text/javascript"> alert("cannot insert transaction for employee"); </script>';  

                        echo "<script> window.location.assign('Transaction.php'); </script>";

                    }else{
                        //insert success continue with update
                        //insert success continue with update
                        @$UserEditQUery = "UPDATE `order` SET `order_type` = 'PENDING',
                                            `trans_id` = '$transid'
                                        WHERE `order_id` = '".$_SESSION['orderid']."'  "; 
                        @$UserEditQUery_run = mysqli_query($con, $UserEditQUery);

                        if(mysqli_affected_rows($con) < 1){
                        //error cannot insert 
                         echo '<script type = "text/javascript"> alert("canont update order for employee"); </script>';  

                        echo "<script> window.location.assign('Transaction.php'); </script>";

                        }else{
                        //SUCCESS REFUND FOR VENDOR PART, NAV BACK TO TRANS
                        echo '<script type = "text/javascript"> alert("insert success where new trans ID is: " + "'.$transid.'"  ); </script>';

                        echo "<script> window.location.assign('Transaction.php?successRefund'); </script>";
                        }
                    }
   
                }

            }else{
                //it is user to refund 
                @$refundAdd = "INSERT INTO `transaction`(`trans_id`, `trans_date`, trans_time, trans_title, trans_amount, `user_id`) 
                VALUES ('".$transid."' , '$today', '$now', 'PENDING', '$refundAmount', '$refundUserID' )";
                @$refundAdd_run = mysqli_query($con, $refundAdd);

                if(mysqli_affected_rows($con) < 1){
                    //error cannot insert 
                    echo '<script type = "text/javascript"> alert("cannot insert transaction for user"); </script>';  

                    echo "<script> window.location.assign('Transaction.php'); </script>";

                }else{
                    //insert success continue with update
                    @$UserEditQUery = "UPDATE `order` SET `order_type` = 'PENDING',
                                                        `trans_id` = '$transid'
                                                    WHERE `order_id` = '".$_SESSION['orderid']."'  "; 
                    @$UserEditQUery_run = mysqli_query($con, $UserEditQUery);

                    if(mysqli_affected_rows($con) < 1){
                        //error cannot insert 
                        echo '<script type = "text/javascript"> alert("canont update order for employee"); </script>';  

                        echo "<script> window.location.assign('Transaction.php'); </script>";

                    }else{
                        //SUCCESS REFUND FOR VENDOR PART, NAV BACK TO TRANS
                        echo '<script type = "text/javascript"> alert("insert success where new trans ID is: " + "'.$transid.'"  ); </script>';

                        echo "<script> window.location.assign('Transaction.php?successRefund'); </script>";
                        
    
                    }                   

                }
            }    

        }else{
            //UNIQUE ID

            //refund normal user
            @$checkUser = "SELECT * FROM `user` WHERE `user_id` = '$refundUserID' ";
            @$checkUser_run = mysqli_query($con, $checkUser);

            if(mysqli_affected_rows($con) < 1){
                //employee refund 
                @$checkEm = "SELECT * FROM `employee` WHERE `employee_id` = '$refundUserID' ";
                @$checkEm_run = mysqli_query($con, $checkEm);

                if(mysqli_affected_rows($con) < 1){
                    //error
                    echo "<script> window.location.assign('Transaction.php'); </script>";

                }else{
                    //sucess detect employee and continue
                    //it is employee to refund 
                    @$refundAdd = "INSERT INTO `transaction`(`trans_id`, `trans_date`, trans_time, trans_title, trans_amount, `employee_id`) 
                    VALUES ('".$transid."' , '$today', '$now', 'PENDING', '$refundAmount', '$refundUserID' )";
                    @$refundAdd_run = mysqli_query($con, $refundAdd);

                    if(mysqli_affected_rows($con) < 1){
                        //error cannot insert 
                        echo "<script> window.location.assign('Transaction.php'); </script>";

                    }else{

                        //insert success continue with update
                        @$UserEditQUery = "UPDATE `order` SET `order_type` = 'PENDING',
                                            `trans_id` = '$transid'
                                        WHERE `order_id` = '".$_SESSION['orderid']."'  "; 
                        @$UserEditQUery_run = mysqli_query($con, $UserEditQUery);

                        if(mysqli_affected_rows($con) < 1){
                        //error cannot insert 
                        echo "<script> window.location.assign('Transaction.php'); </script>";

                        }else{
                        //SUCCESS REFUND FOR VENDOR PART, NAV BACK TO TRANS
                        echo "<script> window.location.assign('Transaction.php?successRefund'); </script>";


                        }

                        
                    }
    
                }

            }else{

                //it is user to refund 
                @$refundAdd = "INSERT INTO `transaction`(`trans_id`, `trans_date`, trans_time, trans_title, trans_amount, `user_id`) 
                VALUES ('".$transid."' , '$today', '$now', 'PENDING', '$refundAmount', '$refundUserID' )";
                @$refundAdd_run = mysqli_query($con, $refundAdd);

                if(mysqli_affected_rows($con) < 1){
                    //error cannot insert 
                    echo '<script type = "text/javascript"> alert("canont insert trans for user"); </script>';  

                    echo "<script> window.location.assign('Transaction.php'); </script>";

                }else{
                    //insert success continue with update
     
                    @$UserEditQUery = "UPDATE `order` SET `order_type` = 'PENDING',
                                                        `trans_id` = '$transid'
                                                    WHERE `order_id` = '".$_SESSION['orderid']."'  "; 
                    @$UserEditQUery_run = mysqli_query($con, $UserEditQUery);

                    if(mysqli_affected_rows($con) < 1){
                        //error cannot insert 
                        echo '<script type = "text/javascript"> alert("canont update order for user"); </script>';  

                        echo "<script> window.location.assign('Transaction.php'); </script>";

                    }else{
                        //SUCCESS REFUND FOR VENDOR PART, NAV BACK TO TRANS
                        echo '<script type = "text/javascript"> alert("user refund success"); </script>';  

                        echo "<script> window.location.assign('Transaction.php?successRefund'); </script>";
                        
    
                    }                   

                }
            }         

        }

    }

    if(isset($_POST['resetOrder'])){
        
      
        @$updateStatus = "UPDATE `order` SET order_status = 'INCOMPLETE' WHERE `order_id` = '".$_SESSION['orderid']."' ";
        @$updateStatus_run = mysqli_query($con, $updateStatus);

        if(mysqli_affected_rows($con)){


            header('location: Transaction.php?orderreset');

        }else{
            //error
            echo '<script>alert ("CANNOT UPDATE");</script>';
            @$_SESSION['cannotUpdate'] = 'SET';
            header('location: Transaction.php?cannotUpdate');
        }



    }


?>
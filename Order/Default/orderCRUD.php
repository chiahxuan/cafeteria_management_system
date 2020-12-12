<?php
include('../../Admin/Default/server.php');

    
    if(isset($_GET['deletecart'])){


        if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
    
            @$deleteCart = "DELETE FROM cartlist WHERE `food_id` = '".$_GET['deletecart']."' AND employee_id =  '".$_SESSION['kioskLoginID']."'  ";
            @$deleteCart_run = mysqli_query($con, $deleteCart);
            header('Location: order.php');
    
        }else{
    
            @$deleteCart = "DELETE FROM cartlist WHERE `food_id` = '".$_GET['deletecart']."' AND `user_id` =  '".$_SESSION['kioskLoginID']."'  ";
            @$deleteCart_run = mysqli_query($con, $deleteCart);
            header('Location: order.php');
    
        }
 

    }

    if(isset($_POST['popUp_successDelete'])){


        if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
 
            @$deleteCart = "DELETE FROM cartlist WHERE  employee_id =  '".$_SESSION['kioskLoginID']."'  ";
            @$deleteCart_run = mysqli_query($con, $deleteCart);
    
            header('Location: home.php?deleteOrder');

        }else{
    
            @$deleteCart = "DELETE FROM cartlist WHERE  `user_id` =  '".$_SESSION['kioskLoginID']."'  ";
            @$deleteCart_run = mysqli_query($con, $deleteCart);
    
            header('Location: home.php?deleteOrder');
            
        }
    }


    //PURCHASE
    if(isset($_POST['purchaseQuantity'])){

        //DECLARE VARIABLES 
        @$checkTransID = false;
        @$checkOrderID = false;
        @$transactionSuccess = false;
        @$purchaseID = $_POST['purchaseID'];
        @$purchasePrice = $_POST['purchasePrice'];
        @$purchaseQuantity = $_POST['purchaseQuantity'];
        @$oldBalance =0;

        @$current_date = date("Y-m-d");
        @$current_time = date("h:i:s");

        //CREATE, GENERATE AND CHECK UNIQUE TRANSACTION ID
        @$num = rand(100001, 999999);
        @$trans_id = 'TR'.$num;

        if($_SESSION['kioskLoginRole'] == 'kitchen employee' OR $_SESSION['kioskLoginRole'] == 'kitchen owner'){
            @$getBalance = "SELECT * FROM employee WHERE employee_id = '".$_SESSION['kioskLoginID']."'  ";
            @$getBalance_run = mysqli_query($con, $getBalance);
            @$getBalance_run_rows = mysqli_fetch_assoc($getBalance_run);
            @$oldBalance = $getBalance_run_rows['employee_balance'];
    
        }else{
            @$getBalance = "SELECT * FROM `user` WHERE user_id = '".$_SESSION['kioskLoginID']."'  ";
            @$getBalance_run = mysqli_query($con, $getBalance);
            @$getBalance_run_rows = mysqli_fetch_assoc($getBalance_run);
            @$oldBalance = $getBalance_run_rows['card_amount'];
        }
        @$newBalance = $oldBalance - $_POST['totalAmount'];


        //COMFIRM VALID CREDIT FOT TRANSACTION 
        if($newBalance >= 0){
            //transaction success, start to insert
            @$checkTransID = "SELECT * FROM `transaction` WHERE `trans_id` = '$trans_id' ";
            @$checkTransID_run = mysqli_query($con, $checkTransID);

            //CHECK TRANSACTION UNIQUE NUMBER
            if(mysqli_num_rows($checkTransID_run) > 0)
            {
                // echo '<script type = "text/javascript"> alert("not unique trans id"); </script>';  
                $checkTransID = false;
                do{

                    //CREATE NEW TRANS ID 
                    $num = rand(100000, 999999);
                    $trans_id = 'TR'.$num;
                    
                    @$checkTransID = "SELECT * FROM `transaction` WHERE `trans_id` = '$trans_id' ";
                    @$checkTransID_run = mysqli_query($checkTransID);
                }while(mysqli_num_rows($checkTransID_run) > 0);
                $checkTransID = true;

            }else{
                
                // echo '<script type = "text/javascript"> alert("unique and valid name"); </script>'; 
                $checkTransID = true;

            }

            //SUCCESS CREATED UNIQUE TRANS_ID AND ORDER_ID
            if($checkTransID = true){
                //DECLARE TRANS ID FOR RECIEPT
                @$_SESSION['purchaseTransaction'] = $trans_id;
                @$_SESSION['totalAmount'] = $_POST['totalAmount'];

                //CONTINUE TRANSACTION INSERTION 
                if($_SESSION['kioskLoginRole'] == 'kitchen employee' OR $_SESSION['kioskLoginRole'] == 'kitchen owner'){

                    
                    @$purcahseTrans ="INSERT INTO `transaction`(`trans_id`, `trans_date`, `trans_time`, `trans_title`, `trans_amount`, `employee_id`) 
                    VALUES ('$trans_id', '$current_date', '$current_time', 'PURCHASE', '".$_POST['totalAmount']."', '".$_SESSION['kioskLoginID']."' ) ";
                }else{
                    $purcahseTrans ="INSERT INTO `transaction`(`trans_id`, `trans_date`, `trans_time`, `trans_title`, `trans_amount`, `user_id`) 
                    VALUES ('$trans_id', '$current_date', '$current_time', 'PURCHASE', '".$_POST['totalAmount']."', '".$_SESSION['kioskLoginID']."' ) ";
                }
                $purcahseTrans_run = mysqli_query($con, $purcahseTrans);
                
                if(mysqli_affected_rows($con)> 0){
                    //INSERT TRANSCTION SUCCESS 
                    //GENERATE 
                    for($i = 0; $i < count($_POST['purchaseQuantity']); $i++   ){

                        //CREATE, GENERATE AND CHECK UNIQUE ORDER ID
                        $no = rand(100001, 999999);
                        $order_id = 'OR'.$no;
            
                        @$checkOrID = "SELECT * FROM `order_id` WHERE `order_id` = '$order_id' ";
                        @$checkOrID_run = mysqli_query($con, $checkOrID);
            
                        //CHECK TRANSACTION UNIQUE NUMBER
                        if(mysqli_affected_rows($con) > 0)
                        {
                            // echo '<script type = "text/javascript"> alert("not unique order id"); </script>';  
                            $checkOrderID = false;
                            do{
            
                                //CREATE NEW ORDER ID
                                $no = rand(100001, 999999);
                                $order_id = 'OR'.$no;
                                
                                @$checkOrID = "SELECT * FROM `order_id` WHERE `order_id` = '$order_id' ";
                                @$checkOrID_run = mysqli_query($con, $checkOrID);
                            }while(mysqli_affected_rows($con) > 0);
                            $checkOrderID = true;
            
                        }else{
                            // echo '<script type = "text/javascript"> alert("unique and valid id"); </script>'; 
                            $checkOrderID = true;
            
                        }

                        if($checkOrderID = true){//unique order ID
                            //INSERT ORDER QUERY 
                            @$addOrder ="INSERT INTO `order`(`order_id`, `quantity`, `trans_id`, `food_id`, `order_type`, `order_status`) 
                            VALUES ('$order_id', '".$_POST['purchaseQuantity'][$i]."','$trans_id', '".$_POST['purchaseID'][$i]."', 'PURCHASE', 'INCOMPLETE') ";
                            @$addOrder_run = mysqli_query($con, $addOrder);
                            @$transactionSuccess = true;
                        

                        }else{
                            //cannot generate unique order id
                            @$transactionSuccess = false;
                            echo '<script>alert("cannot insert order or transaction!");</script>';
                        }
                    }


                    if($transactionSuccess == true) {
                        //CLEAR CARTLIST
                        @$UpdateBalanceBool = false;
                        @$clearCart = "DELETE FROM `cartlist` WHERE `user_id` = '".$_SESSION['kioskLoginID']."'  ";
                        @$clearCart_run = mysqli_query($con, $clearCart);
                    
                        //UPDATE USER'S BALANCE
                        if($_SESSION['kioskLoginRole'] == 'kitchen employee' OR $_SESSION['kioskLoginRole'] == 'kitchen owner'){
                            @$updateBalance = "UPDATE employee SET employee_balance = '$newBalance' WHERE employee_id = '".$_SESSION['kioskLoginID']."'  ";
                            @$updateBalance_run = mysqli_query($con, $updateBalance);
                            if(mysqli_affected_rows($con)>0){
                                @$UpdateBalanceBool = true;
                            }else{
                                @$UpdateBalanceBool = false;
                            }
                        }else{
                            $updateBalance = "UPDATE `user` SET `card_amount` = '$newBalance' WHERE `user_id` = '".$_SESSION['kioskLoginID']."'  ";
                            $updateBalance_run = mysqli_query($con, $updateBalance);
                            if(mysqli_affected_rows($con)>0){
                                @$UpdateBalanceBool = true;
                            }else{
                                @$UpdateBalanceBool = false;
                            }
                        }

                        if($UpdateBalanceBool == true){
                            header('Location: home.php?ordersuccess');

                        }else{
                            header('Location: order.php');

                        }

   



                    }else{
                        echo '<script>alert("success false!");</script>';

                        header('Location: order.php');

                    }
                
                }
            }

        }else{
            //error 
            echo '<script>alert("not enough credit!");</script>';
            header('Location: order.php?notEnoughCredit');


        }
///////////////       



        
    }


    
    // echo $_POST['purchaseID'];
?>
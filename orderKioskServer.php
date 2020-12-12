<?php
    //connection to database
    $con = mysqli_connect("localhost", "root", "root", "cafeteria") or die("Unable to connect");
    //start session 
    session_start();

    //login
    if(isset($_POST['login']))
    {
        
        @$userid = $_POST['userid'];//get value from textbox userid
        @$_SESSION['kioskLoginID'] = $userid;
        @$password = mysqli_real_escape_string($con, $_POST['password']);//get password from database
        @$xpassword = md5($password);//convert password into real pw which is 123 by default
        
        @$userLogin = "SELECT * FROM `user` WHERE `user_id` = '$userid' AND `user_password` = '$xpassword' ";
        @$userLogin_run = mysqli_query($con, $userLogin);
        //check user table 
        if(mysqli_affected_rows($con) <= 0)
        {
            //user not success check employee
            @$emLogin = "SELECT * FROM `employee` WHERE `employee_id` = '$userid' AND `employee_password` = '$xpassword' ";
            @$emLogin_run = mysqli_query($con, $emLogin);

            if (mysqli_affected_rows($con) > 0)
            {
                //employee success
                @$emLogin_run_rows = mysqli_fetch_array($emLogin_run);

                if($emLogin_run_rows['employee_status'] == 'ACTIVATED'){
                    $_SESSION['kioskLoginRole'] = $emLogin_run_rows['employee_role'];
                    // $_SESSION['kioskLoginName'] = $emLogin_run_rows['employee_name'];
                    // $_SESSION['kioskLoginRelated'] = $emLogin_run_rows['vendor_id'];
              
                    // $_SESSION['loginPw'] =$xpassword ;
                    // echo '<script type = "text/javascript"> alert("login success") </script>';  
                    header("Location: Order/Default/home.php");  
                }else{
                    $_SESSION['kioskInvalidError'] = "Card Deactivate";
                    echo "<script>window.location.href='orderKioskLogin.php'</script>";
                    
                }



            }else{

                $emLogin_run_rows = mysqli_fetch_array($emLogin_run);
                //invalid username and password
                @$_SESSION['kioskInvalidError'] = "";
                @$_SESSION['kioskInvalidError'] = "Invalid username or password";

                // echo '<script type = "text/javascript"> alert("login success") </script>';  
                header("Location:orderKioskLogin.php"); 
            }


        }else 
        {

            $userLogin_run_rows = mysqli_fetch_array($userLogin_run);

            if($userLogin_run_rows['card_status'] == 'ACTIVATED'){
               @$_SESSION['kioskLoginRole'] = $userLogin_run_rows['user_role'];
                // $_SESSION['loginRole'] = $userLogin_run_rows['user_role'];
                // $_SESSION['loginName'] = $userLogin_run_rows['user_name'];
                // $_SESSION['loginPw'] =$xpassword ;
                header("Location: Order/Default/home.php");  
            }else{
                $_SESSION['kioskInvalidError'] = "Card Deactivate";
                echo "<script>window.location.href='orderKioskLogin.php'</script>";
            }



        }


    }

    //logout
    if(isset($_GET['logout']))
    {
        // echo '<script type = "text/javascript"> alert("logout") </script>';  
        
            session_destroy();

            unset($_SESSION['kioskLoginID']);
            unset($_SESSION['kioskLoginRole']);
            echo '<script type = "text/javascript"> alert("logout success") </script>';  
            echo "<script>window.location.href='orderKioskLogin.php'</script>";
        
    }

?>
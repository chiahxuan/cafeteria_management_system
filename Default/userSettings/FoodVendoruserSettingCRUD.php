<?php
    include('../../../Admin/Default/server.php');
    
    unset($_SESSION['updatedName']);

    if(isset($_POST['profileConfirm'])){
        echo $_POST['editName'];
        $name = $_POST['editName'];
        echo $_SESSION['loginID']; 
        echo $_SESSION['loginRole'];
        echo $_SESSION['loginName'];

        if($_SESSION['loginRole'] == 'kitchen employee' OR $_SESSION['loginRole'] == 'kitchen owner')
        {
            $updateName = "UPDATE `employee` SET `employee_name` = '$name' WHERE `employee_id` = '".$_SESSION['loginID']."' "; 
            $updateName_run = mysqli_query($con, $updateName);

            $_SESSION['loginName'] = $name;
        
        }else{
            $updateName = "UPDATE `user` SET `user_name` = '$name' WHERE `user_id` = '".$_SESSION['loginID']."' "; 
            $updateName_run = mysqli_query($con, $updateName);

            $_SESSION['loginName'] = $name;
        }

        
        if(mysqli_affected_rows($con) <= 0)
        {
            // die("<script>alert('cannot update data!');</script>");
            echo "<script> alert('nothing changed!'); </script>";

            echo "<script> window.location.assign('userSettings.php'); </script>";
        }else{
            echo "<script> alert('Name successfully updated!'); </script>";
            $_SESSION['loginName'] = $name;
            echo $_SESSION['loginName'] ;
            echo "<script> window.location.assign('userSettings.php?updatesuccess'); </script>";
        }


    }


    if(isset($_POST['changePwConfirm']))
    {
        // echo $_POST['previousPw'];
        echo $_POST['newPw']."<br>";
        // echo $_POST['RetypenewPw'];

        $oldpw = md5($_POST['previousPw']);
        $newpw = md5($_POST['newPw']);
        // echo $oldpw;
        echo $oldpw."<BR>";

        $id =  $_SESSION['loginRole'];

        //CHECK NEW PASSWORD ADN RETYPE NEW PASSWORD
        if($_POST['newPw'] !=  $_POST['RetypenewPw'])
        {
            echo '<script>alert("error new password does not match")</script>';

            echo "<script> window.location.assign('userSettings.php'); </script>";

        }else
        {
            //CHECK ROLE TO CHECK PREVIOUS PASSWORD FROM QUERY
            if($_SESSION['loginRole'] == 'kitchen employee' OR $_SESSION['loginRole'] == 'kitchen owner')
            {
                $checkpw ="SELECT employee_password from `employee` WHERE `employee_id` = '".$_SESSION['loginID']."' ";
                $checkpw_run = mysqli_query($con, $checkpw);
                $checkpw_run_row = mysqli_fetch_assoc($checkpw_run);


                // echo $checkpw_run_row['employee_password'];
                $dataPassword = $checkpw_run_row['employee_password'];
                echo $dataPassword;

    
            
            }else
            {
                $checkpw ="SELECT user_password from `user` WHERE `user_id` = '".$_SESSION['loginID']."' ";
                $checkpw_run = mysqli_query($con, $checkpw);
                $checkpw_run_row = mysqli_fetch_assoc($checkpw_run);

                // echo $checkpw_run_row['user_password'];

                $dataPassword = $checkpw_run_row['user_password'];
                
                             
            }
        }

        //CHECK PASSWORD MATCH WITH QUERY 
        if($oldpw != $dataPassword)
        {
            echo '<script>alert("previous password doesnt match")</script>';

            // echo "<script> window.location.assign('userSettings.php'); </script>";

        }else
        {
            //MATCH
            $updatePw = "UPDATE `user` SET `user_password` = '$newpw' WHERE `user_id` = '".$_SESSION['loginID']."' "; 
            $updatePw_run = mysqli_query($con, $updatePw);  
            echo mysqli_affected_rows($con);

            if (mysqli_affected_rows($con) > 0)
            {
                //SUCCESS
                //echo '<script>alert("update password success")</script>';
                echo "<script> window.location.assign('userSettings.php'); </script>";


            }else
            {
                // echo '<script>alert("cannot update user, update emplyee")</script>';

                $updatePw = "UPDATE `employee` SET `employee_password` = '$newpw' WHERE `employee_id` = '".$_SESSION['loginID']."' "; 
                $updatePw_run = mysqli_query($con, $updatePw);  
                echo mysqli_affected_rows($con);

                
                if (mysqli_affected_rows($con) > 0)
                {
                    //SUCCESS
                    // echo '<script>alert("update password success")</script>';
                    echo "<script> window.location.assign('userSettings.php?updatesuccess'); </script>";


                }else{
                    //error
                    echo '<script>alert("error")</script>';

                    echo "<script> window.location.assign('userSettings.php'); </script>";

                }
                
                // echo "<script> window.location.assign('userSettings.php'); </script>";

            }
        }     
            
           

    }




?>
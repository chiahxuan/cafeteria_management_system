<?php

include('../../Admin/Default/server.php');


    if(isset($_GET['addcart'])){

        if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
            $insertOrder = "INSERT INTO cartlist(food_id, `employee_id` ) VALUES ('".$_GET['addcart']."', '".$_SESSION['kioskLoginID']."') ";
            $insertOrder_run = mysqli_query($con, $insertOrder);
    
            
            $checkCategory = "SELECT * FROM vendorfood WHERE foodID = '".$_GET['addcart']."' ";
            $checkCategory_run = mysqli_query($con, $checkCategory);
            $checkCategory_run_rows = mysqli_fetch_assoc($checkCategory_run);
    
            $category = $checkCategory_run_rows['foodCategory'];
    
            header('Location: home.php?displayFoods='.$category);
        }else{
            $insertOrder = "INSERT INTO cartlist(food_id, `user_id` ) VALUES ('".$_GET['addcart']."', '".$_SESSION['kioskLoginID']."') ";
            $insertOrder_run = mysqli_query($con, $insertOrder);
    
            
            $checkCategory = "SELECT * FROM vendorfood WHERE foodID = '".$_GET['addcart']."' ";
            $checkCategory_run = mysqli_query($con, $checkCategory);
            $checkCategory_run_rows = mysqli_fetch_assoc($checkCategory_run);
    
            $category = $checkCategory_run_rows['foodCategory'];
    
            header('Location: home.php?displayFoods='.$category);
        }



    }

    if(isset($_GET['deletecart'])){


        if($_SESSION['kioskLoginRole'] == 'kitchen onwer' OR $_SESSION['kioskLoginRole'] == 'kitchen employee'){//employee table
            $checkCategory = "SELECT * FROM vendorfood WHERE foodID = '".$_GET['deletecart']."'  ";
            $checkCategory_run = mysqli_query($con, $checkCategory);
            $checkCategory_run_rows = mysqli_fetch_assoc($checkCategory_run);
    
            $category = $checkCategory_run_rows['foodCategory'];
    
            $deleteCart = "DELETE FROM cartlist WHERE `food_id` = '".$_GET['deletecart']."' AND employee_id =  '".$_SESSION['kioskLoginID']."'  ";
            $deleteCart_run = mysqli_query($con, $deleteCart);
    
            header('Location: home.php?displayFoods='.$category);
        }else{
            $checkCategory = "SELECT * FROM vendorfood WHERE foodID = '".$_GET['deletecart']."' ";
            $checkCategory_run = mysqli_query($con, $checkCategory);
            $checkCategory_run_rows = mysqli_fetch_assoc($checkCategory_run);
    
            $category = $checkCategory_run_rows['foodCategory'];
    
            $deleteCart = "DELETE FROM cartlist WHERE `food_id` = '".$_GET['deletecart']."' AND `user_id` =  '".$_SESSION['kioskLoginID']."'  ";
            $deleteCart_run = mysqli_query($con, $deleteCart);
    
            header('Location: home.php?displayFoods='.$category);
        }

    }

?>
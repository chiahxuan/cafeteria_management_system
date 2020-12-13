<?php
    include('../../../Admin/Default/server.php');

// phpinfo();
    
    if(isset($_GET['foodid'])){

        @$selectFood = "SELECT * FROM food WHERE food_id = '".$_GET['foodid']."'  ";
        @$selectFood_run = mysqli_query($con, $selectFood);
        @$selectFood_run_rows = mysqli_fetch_assoc($selectFood_run);

         //pass variable to session
        @$_SESSION['foodID'] =  $selectFood_run_rows['food_id'];
        @$_SESSION['foodName'] =  $selectFood_run_rows['food_name'];
        @$_SESSION['foodPrice'] = $selectFood_run_rows['food_price'];
        @$_SESSION['foodCategory'] = $selectFood_run_rows['food_category'];
        @$_SESSION['foodPic'] = $selectFood_run_rows['food_pic'];


        @$_SESSION['showFoodDetails'] = 'SET';
         header("location: menu.php");

         header("Content-type: image/jpeg");
         echo $selectFood_run_rows['food_pic'];



    }

    if(isset($_POST['foodConfirmEdit'])){
        
 
        
        $menuImage = $_FILES['foodPhotoinput'];
        print_r ($menuImage);


        @$imgName = $_FILES['foodPhotoinput']['name'];
        @$imgTmpName = $_FILES['foodPhotoinput']['tmp_name'];
        @$imgSize = $_FILES['foodPhotoinput']['size'];
        @$imgError = $_FILES['foodPhotoinput']['error'];
        @$imgType = $_FILES['foodPhotoinput']['type'];

        @$fileExt = explode('.', $imgName);
        @$fileActualExt = strtolower(end($fileExt));

        @$allowed = array('jpg', 'jpeg', 'png', 'pdf');

      
       @$imageData = addslashes(file_get_contents($_FILES['foodPhotoinput']['tmp_name']));



        //REMOVE CHARCTERS FROM STRING FOOD PRICE FOR UPDATE 
        @$foodPrice = preg_replace("/[^0-9,.]/", "", $_POST['foodPriceinput']);

        @$updateFood = "UPDATE `food` SET `food_name` = '".$_POST['foodNameinput']."', `food_price` = '$foodPrice', `food_category` = '".$_POST['foodCategoryinput']."', food_pic = '$imageData'
        WHERE `food_id` = '".$_POST['foodIDinput']."' ";
        @$updateFood_run = mysqli_query($con, $updateFood);

            echo mysqli_affected_rows($con);

        if(mysqli_affected_rows($con) < 1){
            //ERROR BOX 
            header('location: menu.php');
        }else{

            //SUCCESS
          
            header('location: menu.php?foodUpdateSuccess');
        }
    }

    if(isset($_POST['confirmDelete'])){
        
        
        @$deleteFood = "DELETE FROM food WHERE food_id = '".$_SESSION['foodID']."'  ";
        @$deleteFood_run = mysqli_query($con, $deleteFood);
        
        if(mysqli_affected_rows($con) <= 0)
        {
            echo "<script>alert('cannot update data!');</script>";
            echo "<script> window.location.assign('menu.php'); </script>";
        }else
        {

            $_SESSION['displayModalDeleted'] = 'set';
            echo "<script> window.location.assign('menu.php'); </script>";
        }

    }

    if(isset($_POST['foodConfirmAdd'])){


        $sdsd = $_FILES['AddfoodPhotoinput'];
        echo $_FILES['AddfoodPhotoinput']['name'];
        echo $_FILES['AddfoodPhotoinput']['tmp_name'];
        echo $_FILES['AddfoodPhotoinput']['size'];


        print_r($sdsd);
        echo $_FILES['AddfoodPhotoinput']['tmp_name'];
        @$imageData = addslashes(file_get_contents($_FILES['AddfoodPhotoinput']['tmp_name']));

        @$num = rand(100000, 999999);
        @$foodid = 'FD'.$num;

        @$checkfoodID = "SELECT * FROM food WHERE food_id  = '$foodid' ";
        @$checkfoodID_run = mysqli_query($con, $checkfoodID);

        if(mysqli_affected_rows($con) > 0 ){
            //NO UNIQUE ID 
            echo '<script type = "text/javascript"> alert("not unique id"); </script>';  
            do{

                $num = rand(100000, 999999);
                $foodid = 'FD'.$num;

                @$checkfoodID = "SELECT * FROM food WHERE food_id  = '$foodid' ";
                @$checkfoodID_run = mysqli_query($con, $checkfoodID);

            }while(mysqli_num_rows($checkfoodID_run) > 0);

                @$foodadd = "INSERT INTO food(`food_id`, `food_name`, food_price, food_category, food_pic, vendor_id) 
                            VALUES ('".$foodid."' , '".$_POST['menuNewName']."', '".$_POST['menuNewPrice']."', '".$_POST['menuNewCategory']."', '', '".$_SESSION['loginRelatedVendor']."' )";
                @$foodadd_run = mysqli_query($con, $foodadd);

                //SELECT USER INFO INTO SESSION
                @$getFoodInfo = "SELECT * FROM `food` WHERE `food_id` = '".$foodid."'   ";
                @$getFoodInfo_run = mysqli_query($con, $getFoodInfo);
                @$getFoodInfo_run_row = mysqli_fetch_assoc($getFoodInfo_run);
                
              

                @$_SESSION['foodID'] = $foodid;
                @$_SESSION['foodName'] =  $getFoodInfo_run_row['food_name'];
                @$_SESSION['foodPrice'] = $getFoodInfo_run_row['food_price'];
                @$_SESSION['foodCategory'] = $getFoodInfo_run_row['food_category'];
                @$_SESSION['foodPic'] = $getFoodInfo_run_row['food_pic'];

                //REDIRECT TO PROFILE WITH SUCESS MODAL
                @$_SESSION['ModalAdded'] = 'set';
                echo '<script type = "text/javascript"> alert("insert success where ID is: " + "'.$foodid.'" ); </script>';
                echo "<script> window.location.assign('menu.php'); </script>";
        }else if(mysqli_affected_rows($con) == -1){
            //INVALID QUERY
            echo '<script type = "text/javascript"> alert("error query "); </script>';  

        }else{
                @$foodadd = "INSERT INTO food(`food_id`, `food_name`, food_price, food_category, food_pic, vendor_id) 
                                 VALUES ('".$foodid."' , '".$_POST['menuNewName']."', '".$_POST['menuNewPrice']."', '".$_POST['menuNewCategory']."', '$imageData', '".$_SESSION['loginRelatedVendor']."' )";
                @$foodadd_run = mysqli_query($con, $foodadd);

                //SELECT USER INFO INTO SESSION
                @$getFoodInfo = "SELECT * FROM `food` WHERE `food_id` = '".$foodid."'   ";
                @$getFoodInfo_run = mysqli_query($con, $getFoodInfo);
                @$getFoodInfo_run_row = mysqli_fetch_assoc($getFoodInfo_run);
                
              

                @$_SESSION['foodID'] = $foodid;
                @$_SESSION['foodName'] =  $getFoodInfo_run_row['food_name'];
                @$_SESSION['foodPrice'] = $getFoodInfo_run_row['food_price'];
                @$_SESSION['foodCategory'] = $getFoodInfo_run_row['food_category'];
                @$_SESSION['foodPic'] = $getFoodInfo_run_row['food_pic'];

                //REDIRECT TO PROFILE WITH SUCESS MODAL
                @$_SESSION['ModalAdded'] = 'set';


                echo '<script type = "text/javascript"> alert("insert success where ID is: " + "'.$foodid.'" ); </script>';
                echo "<script> window.location.assign('menu.php?ModalAdded'); </script>";
        }
         
    }


    if(isset($_POST['categoryConfirmEdit'])){


        // echo $_POST['Categoryinput'];
        // echo $_SESSION['tempCat'];
        @$updateCategory = "UPDATE food SET food_category = '".$_POST['Categoryinput']."'
                WHERE food_category = '".$_SESSION['tempCat']."'    ";      
        @$updateCategory_run = mysqli_query($con, $updateCategory);

        

        if(mysqli_affected_rows($con) < 1){
           
            header('location: menu.php');
        }else{
            @$_SESSION['tempCat'] = $_POST['Categoryinput'];
            @$_SESSION['foodConfirmAdd'] = 'set';
            header('location: menu.php');
        }

       

    }

    if(isset($_POST['cfmDeleteModal'])){

        @$deleteCategory = "DELETE FROM food WHERE food_category = '".$_SESSION['tempCat']."'   ";
        @$deleteCategory_run = mysqli_query($con, $deleteCategory);

        if(mysqli_affected_rows($con) < 1){
           
            header('location: menu.php');
        }else{
            $_SESSION['displayModalDeleted'] = 'set';
            header('location: menu.php');
        }

    }

?>
<?php
    include('../../../Admin/Default/server.php');

    if(isset($_GET['orderID']))
    {
        echo $_GET['orderID'];
        $updateStatus = "UPDATE `order` SET order_status = 'COMPLETED' WHERE `order_id` = '".$_GET['orderID']."' ";
        $updateStatus_run = mysqli_query($con, $updateStatus);

        if(mysqli_affected_rows($con)){

            $_SESSION['orderCompleted'] = 'SET';
            header('location: order.php');

        }else{
            //error
            echo '<script>alert ("CANNOT UPDATE");</script>';
            $_SESSION['cannotUpdate'] = 'SET';
            header('location: order.php');
        }
    }

?>
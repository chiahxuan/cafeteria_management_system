<?php
    include('../../../Admin/Default/server.php');

    @$updateCategory = "UPDATE food SET food_category = 'success'
    WHERE food_category = 'TESTCAT' ";

    @$deleteCategory = "DELETE FROM food WHERE food_category = 'success'   ";
    

    

?>
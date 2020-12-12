<?PHP

/////////////////////
create view vendorfood as
SELECT vendor.vendor_id as vendorID, vendor.vendor_name as vendorName, food.food_id as foodID, food.food_name as foodName, food.food_category as foodCategory, food.food_price as foodPrice, food.food_pic as foodPic vendor.vendor_pic as vendorPic
FROM `vendor` 
JOIN food ON food.vendor_id = vendor.vendor_id
/////////////////////



//SELECT VENDOR
vendor_id, vendor_name, COUNT(food_id) as totalFoods, vendor_pic
$selectVendor = " ";


//SLEECT FOOD CATEGORY --> select every food category as array, loop food id based on category array --> 
food_category, COUNT(food_id) as totalFoods, caterogy_pic

$selectCategory = "SELECT food_category WHERE "

//SELECT food_id into array, loop food array and display FOOD_NAME, FOOD_PRICE


?>
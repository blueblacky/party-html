<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['food_name'] != '' ) {
    
	$food_id = $_POST['food_id'];
	$category_id = $_POST['category_id'];
    $food_name = $_POST['food_name'];
		
    $con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
    $result = mysql_query("UPDATE food_master SET `category_id` = '".$category_id."', `food_name` = '".$food_name."' WHERE food_id = '".$food_id."'");

    // check if row inserted or not
    if ($result != '') {
         $data = array(
		"success"     => '1',
		"message"     => 'Update Success'
		);
		echo json_encode($data);
    } else {
        $data = array(
		"success"     => '0',
		"message"     => 'Update Failed'
		);
		echo json_encode($data);
    }
} else {
    $data = array(
		"success"     => '0',
		"message"     => 'Required'
		);
		echo json_encode($data);
}
?>

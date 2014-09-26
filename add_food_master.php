<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['food_name'] != '' ) {
    
	$category_id = $_POST['category_id'];
	$food_name = $_POST['food_name'];
	
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
	$check=mysql_query("SELECT * FROM food_master WHERE food_name = '".$food_name."'");
	
	if(mysql_num_rows($check) > 0){
		$data = array(
		"success"     => '0',
		"message"     => 'Already Exits'
		);
		echo json_encode($data);
	}else{
	$result = "INSERT INTO food_master(`category_id`, `food_name`,`status`) VALUES('".$category_id."', '".$food_name."', 'Yes')";

    // check if row inserted or not
   if (!mysql_query($result)){
       $data = array(
		"success"     => '0',
		"message"     => 'Error'
		);
		echo json_encode($data);
    } else {
         $data = array(
		"success"     => '1',
		"message"     => 'Insert Success'
		);
		echo json_encode($data);
    }
}} else {
     $data = array(
		"success"     => '0',
		"message"     => 'Required'
		);
		echo json_encode($data);
}
?>
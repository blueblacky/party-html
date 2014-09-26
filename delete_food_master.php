<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['food_id'] != '') {
	
	$food_id=$_POST['food_id'];
	
    $con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
    $result = mysql_query("DELETE FROM food_master WHERE food_id = ".$food_id."");
    
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
       $data = array(
		"success"     => '1',
		"message"     => 'Delete Success'
		);
		echo json_encode($data);
    } else {
        $data = array(
		"success"     => '0',
		"message"     => 'No Product Found'
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
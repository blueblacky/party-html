<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['c_id'] != '') {
	
	$category_id=$_POST['c_id'];
    
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
    $result = mysql_query("DELETE FROM food_category WHERE category_id = ".$category_id."");
    
    if (mysql_affected_rows() > 0) {
       /* $response["success"] = 1;
        $response["message"] = "Category Delete Successfully.";
        echo json_encode($response);*/
		 $data = array(
		"success"     => '1',
		"message"     => 'Delete Success'
		);
		echo json_encode($data);
    } else {
        /*$response["success"] = 0;
        $response["message"] = "No product found";
        echo json_encode($response);*/
		 $data = array(
		"success"     => '0',
		"message"     => 'No Product Found'
		);
		echo json_encode($data);
    }
} else {
    /*$response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    echo json_encode($response);*/
	 $data = array(
		"success"     => '0',
		"message"     => 'Required'
		);
		echo json_encode($data);
}
?>
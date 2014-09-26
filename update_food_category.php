<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['c_id'] != '' ) {
    
	$category_id = $_POST['c_id'];
    $category_name = $_POST['cname'];
	
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
    $result = mysql_query("UPDATE food_category SET `category_name` = '".$category_name."' WHERE category_id = '".$category_id."'");

    if ($result != '') {
       /* $response["success"] = 1;
        $response["message"] = "Category Successfully Updated.";
        
        echo json_encode($response);*/
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

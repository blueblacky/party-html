<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['utensils_id'] != '') {
	
	$utensils_id=$_POST['utensils_id'];
    
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
    $result = mysql_query("DELETE FROM accessories_master WHERE utensils_id = ".$utensils_id."");
    
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
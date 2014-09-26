<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['party_id'] != '') {
	
	$party_id = $_POST['party_id'];
    
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
    $result = mysql_query("DELETE FROM party_booking WHERE party_id = ".$party_id."");
    
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
	$result1 = mysql_query("DELETE FROM party_food WHERE party_id = ".$party_id."");
	$result2 = mysql_query("DELETE FROM party_utensils WHERE party_id = ".$party_id."");
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
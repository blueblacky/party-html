<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['u_id'] != '') {
	
	$u_id=$_POST['u_id'];
    $con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
    $result = mysql_query("DELETE FROM user WHERE u_id = ".$u_id."");
    
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
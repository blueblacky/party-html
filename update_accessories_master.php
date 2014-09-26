<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['utensils_id'] != '' ) {
    
	$utensils_id = $_POST['utensils_id'];
	$utensils_name = $_POST['utensils_name'];

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

    $result = mysql_query("UPDATE accessories_master SET `utensils_name` = '".$utensils_name."' WHERE utensils_id = '".$utensils_id."'");

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

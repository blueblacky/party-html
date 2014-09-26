<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['utensils_name'] != '' ) {
    
	$utensils_name = $_POST['utensils_name']; 
	
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
	$check=mysql_query("SELECT * FROM accessories_master WHERE utensils_name = '".$utensils_name."'");
	
	if(mysql_num_rows($check) > 0){
		 $data = array(
		"success"     => '0',
		"message"     => 'Already Exits'
		);
		echo json_encode($data);
	}else{
	$result = "INSERT INTO accessories_master(`utensils_name`,`status`) VALUES('".$utensils_name."', 'Yes')";

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
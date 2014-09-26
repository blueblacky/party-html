<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['first_name'] && $_POST['last_name'] && $_POST['u_name'] && $_POST['pwd'] != '' ) {
    
    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$u_name = $_POST['u_name'];
	$pwd = $_POST['pwd'];
	
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
	$check=mysql_query("SELECT * FROM user WHERE first_name = '".$first_name."'");
	
	if(mysql_num_rows($check) > 0){
		 $data = array(
		"success"     => '0',
		"message"     => 'Already Exits'
		);
		echo json_encode($data);
	}else{
	$result = "INSERT INTO user(`first_name`, `last_name`, `u_name`, `pwd` ,`status`) VALUES('".$first_name."', '".$last_name."', '".$u_name."' ,'".$pwd."', 'Yes')";

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
} }else {
     $data = array(
		"success"     => '0',
		"message"     => 'Required'
		);
		echo json_encode($data);
}
?>
<?php    
header('Access-Control-Allow-Origin: *');
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}
	
   $result = mysql_query("SELECT * FROM user WHERE u_name = '".$uname."' AND pwd= '".$pass."'");

	if(mysql_num_rows($result)>0){

		 $data = array(
		 "name"        => $uname,
		"success"     => '1',
		"message"     => 'Login Success'
		);
		echo json_encode($data);
    } else {
		 $data = array(
		"success"     => '0',
		"message"     => 'Login Failed'
		);
		echo json_encode($data);
    }
?>

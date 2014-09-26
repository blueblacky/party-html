<?php
header('Access-Control-Allow-Origin: *'); 
$uname = $_POST['uname'];
$pass = $_POST['pass'];
if($uname == 'admin' && $pass == 'admin'){
	 $data = array(
		"success"     => '1',
		"message"     => 'Login Success',
		"uname"       => $uname
	 );
	echo json_encode($data);
}else{
	 $data = array(
		"success"     => '0',
		"message"     => 'Login Failed'
	 );
	echo json_encode($data);
}
?>
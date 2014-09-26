<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['first_name'] && $_POST['last_name'] && $_POST['u_name'] && $_POST['pwd'] != '' ) {
    
	$u_id = $_POST['u_id'];
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
	
    $result = mysql_query("UPDATE user SET `first_name` = '".$first_name."', `last_name` = '".$last_name."', `u_name` = '".$u_name."', `pwd` = '".$pwd."' WHERE u_id = '".$u_id."'");

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

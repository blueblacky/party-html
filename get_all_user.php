<?php
header('Access-Control-Allow-Origin: *');

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

$result = mysql_query("SELECT *FROM user ORDER BY first_name") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    $response["u_id"] = array();
	$response["first_name"] = array();
	$response["last_name"] = array();
	$response["u_name"] = array();
	$response["pwd"] = array();
    
    while ($row = mysql_fetch_array($result)) {        
		array_push($response["u_id"], $row["u_id"]);
        array_push($response["first_name"], $row["first_name"]);
		array_push($response["last_name"], $row["last_name"]);
		array_push($response["u_name"], $row["u_name"]);
		array_push($response["pwd"], $row["pwd"]);
    }
  echo json_encode($response);
} else {
    $data = array(
		"success"     => '0',
		"message"     => 'No Product'
		);
		echo json_encode($data);
}
?>

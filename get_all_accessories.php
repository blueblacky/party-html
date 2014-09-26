<?php
header('Access-Control-Allow-Origin: *');

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

$result = mysql_query("SELECT *FROM accessories_master ORDER BY utensils_name") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    $response["accessories_id"] = array();
	$response["accessories_name"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        array_push($response["accessories_id"], $row["utensils_id"]);
		 array_push($response["accessories_name"],$row["utensils_name"]);
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

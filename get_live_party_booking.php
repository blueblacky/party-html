<?php
header('Access-Control-Allow-Origin: *');

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

$date = date("Y/m/d");
$result = mysql_query("SELECT *FROM party_booking WHERE party_date >= '$date' ORDER BY party_date") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["party_id"] = array();
	 $response["party_date"] = array();
	  $response["customer_name"] = array();
	   $response["venue"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        array_push($response["party_id"], $row['party_id']);
		array_push($response["party_date"], $row['party_date']);
		array_push($response["customer_name"], $row['customer_name']);
		array_push($response["venue"], $row['venue']);
		
    }
  echo json_encode($response);
  //echo require_once __DIR__ .;
} else {
    $data = array(
		"success"     => '0',
		"message"     => 'No Product'
		);
		echo json_encode($data);
}
?>

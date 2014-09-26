<?php
header('Access-Control-Allow-Origin: *');

if ($_POST['from_date'] && $_POST['to_date'] != '' ) {
    
	$from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
	
	$f_date=date("Y-m-d", strtotime($from_date));
	$t_date=date("Y-m-d", strtotime($to_date));
		

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

$result = mysql_query("SELECT *FROM party_booking WHERE party_date between '$f_date' and '$t_date' ORDER BY party_date") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    $response["party_id"] = array();
	$response["party_date"] = array();
	$response["customer_name"] = array();
	$response["venue"] = array();
    
    while ($row = mysql_fetch_array($result)) {

        array_push($response["party_id"], $row["party_id"]);
		array_push($response["party_date"], $row["party_date"]);
		array_push($response["customer_name"], $row["customer_name"]);
		array_push($response["venue"], $row["venue"]);
    }   
 echo json_encode($response);
}
 else {
    $data = array(
		"success"     => '0',
		"message"     => 'No Product'
		);
		echo json_encode($data);
}
}
else
{
 $data = array(
		"success"     => '0',
		"message"     => 'Required'
		);
		echo json_encode($data);
}
?>

<?php
header('Access-Control-Allow-Origin: *');

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

$result = mysql_query("SELECT *FROM food_master INNER JOIN food_category ON food_master.category_id = food_category.category_id ORDER BY food_category.category_name,food_master.food_name") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
    $response["food_id"] = array();
	$response["food_name"] = array();
	$response["category_id"] = array();
	$response["category_name"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        array_push($response["food_id"], $row["food_id"]);
		array_push($response["food_name"], $row["food_name"]);
		array_push($response["category_id"], $row["category_id"]);
		array_push($response["category_name"], $row["category_name"]);
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

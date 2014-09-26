<?php
header('Access-Control-Allow-Origin: *');

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

$result = mysql_query("SELECT *FROM food_category ORDER BY category_name") or die(mysql_error());

if (mysql_num_rows($result) > 0) {
   $response["category_id"] = array();
   $response["category_name"] = array();
    
    while ($row = mysql_fetch_array($result)) {
       //$category = array();
		//$category["category_id"]=$row["category_id"];
        //$category["category_name"] = $row["category_name"];
	
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

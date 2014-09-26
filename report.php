<?php
header('Access-Control-Allow-Origin: *');
$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

if ($_POST['party_id'] != '' ) {
    
    $party_id = $_POST['party_id'];
	
	$result = mysql_query("SELECT * FROM party_booking WHERE party_id = $party_id") or die(mysql_error());
	
	if (mysql_num_rows($result) > 0){
	
	$row = mysql_fetch_array($result);
	$p_date=$row["party_date"];
	$p_date_now=date("d M Y", strtotime($p_date));
	/*$report = array();
			$report["party_id"] = $row["party_id"];
			$report["customer_name"] = $row["customer_name"];
			$report["address"] = $row["address"];
			$report["email"] = $row["email"];
			$report["contact_no"] = $row["contact_no"];
			$report["party_date"] = $row["party_date"];
			$report["party_time"] = $row["party_time"];
			$report["pax"] = $row["pax"];
			$report["venue"] = $row["venue"];
			$report["start"] = $row["start"];
			$report["special_notes"] = $row["special_notes"];
			$report["venue_and_guest_details"] = $row["venue_and_guest_details"];
			$report["van_and_team"] = $row["van_and_team"];
			$report["booked_date"] = $row["booked_date"];
			$report["booked_by"] = $row["booked_by"];*/
			$response["party_id"] = array();
			$response["customer_name"] = array();
			$response["address"] = array();
			$response["email"] = array();
			$response["contact_no"] = array();
			 
			$response["party_date"] = array();
			$response["party_time"] = array();
			$response["pax"] = array();
			$response["venue"] = array();
			$response["start"] = array();
			$response["special_notes"] = array();
			$response["venue_and_guest_details"] = array();
			$response["van_and_team"] = array();
			$response["booked_date"] = array();
			$response["booked_by"] = array();
			$response["food"] = array();
			$response["uten"] = array();
			
			array_push($response["party_id"], $row["party_id"]);
			array_push($response["customer_name"], $row["customer_name"]);
			array_push($response["address"], $row["address"]);
			array_push($response["email"], $row["email"]);
			array_push($response["contact_no"], $row["contact_no"]);
			array_push($response["party_date"], $p_date_now);
			array_push($response["party_time"], $row["party_time"]);
			array_push($response["pax"], $row["pax"]);
			array_push($response["venue"], $row["venue"]);
			array_push($response["start"], $row["start"]);
			array_push($response["special_notes"], $row["special_notes"]);
			array_push($response["venue_and_guest_details"], $row["venue_and_guest_details"]);
			array_push($response["van_and_team"], $row["van_and_team"]);
			array_push($response["booked_date"], $row["booked_date"]);
			array_push($response["booked_by"], $row["booked_by"]);

			$query_1 = mysql_query("SELECT food_master.food_name food_name FROM party_food INNER JOIN food_master ON food_master.food_id=party_food.food_id WHERE party_food.party_id = $party_id");
			
			$f1 = '';
			$f2 = '';
			while($row=mysql_fetch_array($query_1)){
				$f2 = $row['food_name'];
				$f1  = $f1."<br/>".$f2;	 
			}
			$food_list = ltrim($f1, ",");
			array_push($response["food"], $food_list);
			//$report["party_food_list"] = $food_list;
			
			$query_2 = mysql_query("SELECT accessories_master.utensils_name utensils_name FROM party_utensils INNER JOIN accessories_master ON accessories_master.utensils_id=party_utensils.utensils_id WHERE party_utensils.party_id = $party_id");
			
			$f3 = '';
			$f4 = '';
			while($row=mysql_fetch_array($query_2)){
				$f4 = $row['utensils_name'];
				$f3  = $f3."<br/>".$f4;	 
			}
			$utenslis_list = ltrim($f3, ",");
			array_push($response["uten"], $utenslis_list);
			//$report["party_utensils_list"] = $utenslis_list;

		/*$response["report"] = array();
		
		array_push($response["report"], $report);
		
		$response["success"] = 1;
        $response["message"] = "Success";*/
		
		echo json_encode($response);
	}else{
		$response["success"] = 0;
        $response["message"] = "No Record Found.";
        
        // echoing JSON response
        echo json_encode($response);
	}
	}
?>
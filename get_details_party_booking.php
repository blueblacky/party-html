<?php
header('Access-Control-Allow-Origin: *');

	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

if (isset($_POST["party_id"])) {
    $party_id = $_POST['party_id'];

   $query = mysql_query("SELECT * FROM party_booking WHERE party_id = $party_id");
        if (mysql_num_rows($query) > 0) {			

			$result = mysql_fetch_array($query);
			
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
			
			array_push($response["party_id"], $result["party_id"]);
			array_push($response["customer_name"], $result["customer_name"]);
			array_push($response["address"], $result["address"]);
			array_push($response["email"], $result["email"]);
			array_push($response["contact_no"], $result["contact_no"]);
			array_push($response["party_date"], $result["party_date"]);
			array_push($response["party_time"], $result["party_time"]);
			array_push($response["pax"], $result["pax"]);
			array_push($response["venue"], $result["venue"]);
			array_push($response["start"], $result["start"]);
			array_push($response["special_notes"], $result["special_notes"]);
			array_push($response["venue_and_guest_details"], $result["venue_and_guest_details"]);
			array_push($response["van_and_team"], $result["van_and_team"]);
			array_push($response["booked_date"], $result["booked_date"]);
			array_push($response["booked_by"], $result["booked_by"]);
            /*$party_booking = array();
            $party_booking["party_id"] = $result["party_id"];
			$party_booking["customer_name"] = $result["customer_name"];
			$party_booking["address"] = $result["address"];
			$party_booking["email"] = $result["email"];
			$party_booking["contact_no"] = $result["contact_no"];
			$party_booking["party_date"] = $result["party_date"];
			$party_booking["party_time"] = $result["party_time"];
			$party_booking["pax"] = $result["pax"];
			$party_booking["venue"] = $result["venue"];
			$party_booking["start"] = $result["start"];
			$party_booking["special_notes"] = $result["special_notes"];
			$party_booking["venue_and_guest_details"] = $result["venue_and_guest_details"];
			$party_booking["van_and_team"] = $result["van_and_team"];
			$party_booking["booked_date"] = $result["booked_date"];
			$party_booking["booked_by"] = $result["booked_by"];*/
				
				
			$query_1 = mysql_query("SELECT * FROM party_food WHERE party_id = $party_id");
			
			$f1 = '';
			$f2 = '';
			while($row=mysql_fetch_array($query_1)){
				$f2 = $row['food_id'];
				$f1  = $f1.",".$f2;	 
			}
			$food_list = ltrim($f1, ",");
			array_push($response["food"], $food_list);
			//$party_booking["party_food_list"] = $food_list;
			
			$query_2 = mysql_query("SELECT * FROM party_utensils WHERE party_id = $party_id");
			
			$f3 = '';
			$f4 = '';
			while($row=mysql_fetch_array($query_2)){
				$f4 = $row['utensils_id'];
				$f3  = $f3.",".$f4;	 
			}
			$utenslis_list = ltrim($f3, ",");
			array_push($response["uten"], $utenslis_list);
			//$party_booking["party_utensils_list"] = $utenslis_list;
            // success
            /*$response["success"] = 1;
  
            // user node
            $response["party_booking"] = array();

            array_push($response["party_booking"], $party_booking);

            // echoing JSON response*/
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    /*} else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }*/
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['customer_name'] && $_POST['party_date'] != '' ) {
    
			$party_id = $_POST["party_id"];
			$customer_name = $_POST["customer_name"];
			$address = $_POST["address"];
			$email = $_POST["email"];
			$contact_no = $_POST["contact_no"];
			$date = $_POST["party_date"];
			$party_time = $_POST["party_time"];
			$pax = $_POST["pax"];
			$venue = $_POST["venue"];
			$start = $_POST["start"];
			$special_notes = $_POST["special_notes"];
			$venue_and_guest_details = $_POST["venue_and_guest_details"];
			$van_and_team = $_POST["van_and_team"];
			//$book_date = $_POST["booked_date"];
			//$booked_by = $_POST["booked_by"];
			$uten = $_POST['party_utensils_list'];
			$food = $_POST['party_food_list'];
			$party_date = date("Y-m-d", strtotime($date));
			//$booked_date = date("Y-m-d", strtotime($book_date));
			$utensils_list = rtrim($uten, ",");
			$food_list = rtrim($food, ",");

			
	//require_once __DIR__ . '/phpToPDF.php';		

	include('phpToPDF.php');
	
	$con=mysql_connect("localhost","root","");
	mysql_select_db("partybooking");
	if (mysql_error())
	{
	echo "Failed to connect to MySQL: " . mysql_error();
	}

    $result = mysql_query("UPDATE party_booking SET `customer_name` = '".$customer_name."', `address` = '".$address."',`email` = '".$email."', `contact_no` = '".$contact_no."', `party_date` = '".$party_date."', `party_time` = '".$party_time."', `pax` = '".$pax."', `venue` = '".$venue."', `start` = '".$start."', `special_notes` = '".$special_notes."', `venue_and_guest_details` = '".$venue_and_guest_details."', `van_and_team` = '".$van_and_team."' WHERE party_id = '".$party_id."'");

    // check if row inserted or not
    if ($result != '') {
        // successfully updated
	  $utensils_lists = explode(',',$utensils_list);
	  $food_lists = explode(',',$food_list);
	  /*print_r($utensils_lists);
	  echo count($utensils_lists);*/
	  $del_uten = mysql_query("DELETE FROM party_utensils WHERE party_id = ".$party_id."");
	  for($i=0;$i<count($utensils_lists);$i++){
		$up_utensils = mysql_query("INSERT INTO party_utensils(`party_id`, `utensils_id`,`status`) VALUES('".$party_id."', '".$utensils_lists[$i]."','Yes')");
	  }
	  $del_food = mysql_query("DELETE FROM party_food WHERE party_id = ".$party_id."");
	  for($k=0;$k<count($food_lists);$k++){
		 $up_food = mysql_query("INSERT INTO party_food(`party_id`, `food_id`,`status`) VALUES('".$party_id."', '".$food_lists[$k]."','Yes')");
	  }
	  
	  $result = mysql_query("SELECT * FROM party_booking WHERE party_id = '".$party_id."'") or die(mysql_error());
	
	
    // check if row inserted or not
		if (mysql_num_rows($result) > 0){
        // successfully inserted into database
		//while($row = mysql_fetch_array($result)){
		
		$row = mysql_fetch_array($result);
		
	  $html1 = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<title>HTML Invoice Template</title>
		<style type="text/css">
		<!--
		body {
		  font-family:Tahoma;
		}

		img {
		  border:0;
		}

		#page {
		  width:800px;
		  margin:0 auto;
		  padding:15px;

		}

		#logo {
		  float:left;
		  margin:0;
		}

		#address {
		  height:181px;
		  margin-left:50px; 
		}

		table {
		  width:100%;
		}
		th{
		text-align:left;
		}
		td {
		padding:5px;
		}

		tr.odd {
		  background:#e1ffe1;
		}
		#item{
		  height:510px;
		  width:450px;
		  border:2px;
		  float:left;
		  border-style: solid;
		  border-width: 1px;
		}
		#office_use{
		  height:150px;
		  width:300px;
		  margin-left:25px;
		  border:2px;
		  float:left;
		  border-style: solid;
		  border-width: 1px;
		}
		#special_notes{
		  height:120px;
		  width:300px;
		  margin-left:25px;
		  border:2px;
		  float:left;
		  border-style: solid;
			border-width: 1px;
		}
		#utensils{
		  height:120px;
		  width:300px;
		  margin-left:25px;
		  border:2px;
		  float:left;
		  border-style: solid;
			border-width: 1px;
		}
		#venus_guest{
		  height:120px;
		  width:800px;
		  border:2px;
		  float:left;
		  border-style: solid;
		  border-width: 1px;
		}
		#van_team{
		  height:120px;
		  width:300px;
		  margin-left:25px;
		  border:2px;
		  float:left;
		  border-style: solid;
		  border-width: 1px;
		}
		-->
		</style>
		</head>
		<body>
		<div id="page">
		  <div id="logo">
			<a href="#"><img src="http://www.ereporting.in/test/logo.png" height="181px" width="180px"></a>
		  </div><!--end logo-->
		  <br><br>
		  <div id="address" style="float:left;">

			<br />
			Bill No  '.$row['party_id'].'<br />
			Created on '.date("Y/m/d").'<br />
			</p>
		  </div><!--end address-->
		  <div id="address" style="float:left;">
		  <p>
			  <strong>Customer Details</strong><br />
			  Name: '.$row['customer_name'].'<br />
			  Email: '.$row['email'].'<br />
			  Contact No: '.$row['contact_no'].'<br />
			  Address: '.$row['address'].'<br />
		  </div>

		  <div id="content">
			<table>
			  <tr>
			  <td><strong>Date</strong></td>
			  <td><strong>Time</strong></td>
			  <td><strong>Place</strong></td>
			  <td><strong>Pax</strong></td>
			  <td><strong>Start</strong></td>
			  </tr>
			  <tr class="odd">
			  <td>'.$row['party_date'].'</td>
			  <td>'.$row['party_time'].'</td>
			  <td>'.$row['venue'].'</td>
			  <td>'.$row['pax'].'</td>
			  <td>'.$row['start'].'</td>
			  </tr>
			</table>
			<br><br>';
			$get_food = mysql_query("SELECT food_master.food_name cus_food_name FROM party_food INNER JOIN food_master ON food_master.food_id = party_food.food_id WHERE party_food.party_id = $party_id") or die(mysql_error());
			
			$f1 = '';
			$f2 = '';
			while($row1 = mysql_fetch_array($get_food)){
				$f2 = $row1['cus_food_name'];
				$f1  = $f1."<br />".$f2;	 
			}
			$html2 ='
			<div id="item">
			<br><br><br>
			<table>
			<tr>
			<td>'.$f1.'</td>
			</tr>
			</table>
			</div>
			<p style="text-align:center;">Utensils</p>
			<div id="utensils">';
			$get_utensils = mysql_query("SELECT accessories_master.utensils_name cus_utensils_name FROM party_utensils INNER JOIN accessories_master ON accessories_master.utensils_id = party_utensils.utensils_id WHERE party_utensils.party_id = $party_id") or die(mysql_error());
			
			$f3 = '';
			$f4 = '';
			while($row2 = mysql_fetch_array($get_utensils)){
				$f4 = $row2['cus_utensils_name'];
				$f3  = $f3."<br />".$f4;	 
			}
			$html3 = 
			'<table><tr><td>
			'.$f3.'
			</td></tr></table>
			</div>
			<br />
			<p style="text-align:center;">Special Notes</p>
			<div id="special_notes">
			<table><tr><td>
			'.$row['special_notes'].'
			</td></tr></table>
			</div>
			<br />
			<p style="text-align:center;">Van And Team</p>
			<div id="special_notes">
			<table><tr><td>
			'.$row['van_and_team'].'
			</td></tr></table>
			</div>
			<p style="text-align:left;text-indent:350px;">Venus And Guest Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
			<div id="venus_guest">
			<table><tr><td>
			'.$row['venue_and_guest_details'].'
			</td></tr></table>
			</div>
			<p style="margin-left:50px;">
			
			  <center><small><br /><br />Unit 10,Russel & Gill Industrial Estate,Wharf Street(Pleck Road) Opp.Manor Hospital, Walsall Ws2 9ES,UK
			  <br />www.chefvijay.co.uk
			  &copy; Your Company All Rights Reserved
			  </small></center>
			</p>
		  </div><!--end content-->
		</div><!--end page-->
		</body>

		</html>';
		 $html = $html1."".$html2."".$html3;
		phptopdf_html($html,'pdf/', ''.$row['party_id'].'.pdf');
		}
	  
	  
        $data = array(
		"success"     => '1',
		"message"     => 'Insert Success'
		);
		echo json_encode($data);
    } else {
       $data = array(
		"success"     => '0',
		"message"     => 'Error'
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

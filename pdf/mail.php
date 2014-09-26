<?php
header('Access-Control-Allow-Origin: *');
if ($_POST['email'] && $_POST['party_id'] != '' ) {
    
			$party_id = $_POST["party_id"];
			$email = $_POST["email"];

        $htmlbody = " Your Mail Contant Here.... You can use html tags here...";



		$to = $email;  //Recipient Email Address

		$subject = "Test email with attachment"; //Email Subject

		$headers = "From: vigneshteamwork@gmail.com\r\nReply-To: name@domain.com";

		$random_hash = md5(date('r', time()));

		$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";

		//$attachment = chunk_split(base64_encode(file_get_contents('demo.jpg'))); // Set your file path here
		$attachment = chunk_split(base64_encode(file_get_contents(''.$party_id.'.pdf'))); // Set your file path here

		//define the body of the message.

		$message = "--PHP-mixed-$random_hash\r\n"."Content-Type: multipart/alternative; boundary=\"PHP-alt-$random_hash\"\r\n\r\n";
		$message .= "--PHP-alt-$random_hash\r\n"."Content-Type: text/plain; charset=\"iso-8859-1\"\r\n"."Content-Transfer-Encoding: 7bit\r\n\r\n";

		//Insert the html message.
		$message .= $htmlbody;
		$message .="\r\n\r\n--PHP-alt-$random_hash--\r\n\r\n";

		//include attachment
		//$message .= "--PHP-mixed-$random_hash\r\n"."Content-Type: application/zip; name=\"demo.jpg\"\r\n"."Content-Transfer-Encoding: base64\r\n"."Content-Disposition: attachment\r\n\r\n";
		$message .= "--PHP-mixed-$random_hash\r\n"."Content-Type: application/zip; name=\"".$party_id.".pdf\"\r\n"."Content-Transfer-Encoding: base64\r\n"."Content-Disposition: attachment\r\n\r\n";
		$message .= $attachment;
		$message .= "/r/n--PHP-mixed-$random_hash--";

		//send the email
		$mail = mail( $to, $subject , $message, $headers );

		//echo $mail ? "Mail sent" : "Mail failed";
		$data = array(
		"success"     => '1',
		"message"     => 'Mail Send Successfully'
		);
		echo json_encode($data);
		}else{
		$data = array(
		"success"     => '0',
		"message"     => 'Mail Sending Fail'
		);
		echo json_encode($data);
		}
?>
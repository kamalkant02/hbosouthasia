<?php

/* Subscribe now api for third party and return success message in json format */
include '../config.php';
include './app_functions.php';
$response = array();
$name = ucfirst($_REQUEST['name']);
$contact = $_REQUEST['contact'];
$email = $_REQUEST['email'];
$address = ucfirst($_REQUEST['address']);
$city = ucfirst($_REQUEST['city']);
$cable = ucfirst($_REQUEST['cable']);
$customer = $_REQUEST['customer'];
$comments = ucfirst($_REQUEST['comments']);


if (!empty($name) && !empty($email)) {

    //$to = 'feedback@hbosouthasia.com,mamta.garg@omlogic.com,kshitij.aggarwal@omlogic.com ';
    $to = 'kamalkant.prasad@omlogic.com';

    $subject = 'Subscription Request From ' . $name; // accessing subject part of email
    $message = '<table align="left" width="560" border="0" cellspacing="0" cellpadding="4" style="font-size:12px; font-family: Arial;">
		   <tr>
			<td width="30%">Name:</td>
			<td width="70%">' . $name . '</td>
		  </tr>
		  <tr>
			<td>Contact Number:</td>
			<td>' . $contact . '</td>
		  </tr>                  
                   <tr>
			<td>Email ID:</td>
			<td>' . $email . '</td>
		   </tr>
		  <tr>
			<td>Address:</td>
			<td>' . $address . '</td>
		  </tr>
		  
		  <tr>
			<td>City:</td>
			<td>' . $city . '</td>
		  </tr>
		  <tr>
			<td>DTH Platform/Cable Operator:</td>
			<td>' . $cable . '</td>
		  </tr>
		  <tr>
			<td>Customer ID:</td>
			<td>' . $customer . '</td>
		  </tr>
		  <tr>
			<td>Query:</td>
			<td>' . $comments . '</td>
		  </tr>
                   <tr>
			<td>Date:</td>
			<td>' . date('D-m-Y') . '</td>
		  </tr>
	</table>';

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'From:' . $name . '<' . $email . '>' . "\r\n";
    if (mail($to, $subject, $message, $headers)) {

        $response["success"] = "Thank you for your time. We will contact you soon.";
    } else {

        $response["success"] = "Your message could not be sent. Please try again.";
    }
    echo json_encode($response);
} else {
    echo "HBO India API";
}
?>
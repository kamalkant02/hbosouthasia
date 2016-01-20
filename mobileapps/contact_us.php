<?php

/* Contact us api for third party and return success message in json format */
include '../config.php';
$response = array();
$name = ucfirst($_REQUEST['name']);
$email = $_REQUEST['email'];
$city = ucfirst($_REQUEST['city']);
$comments = ucfirst($_REQUEST['comments']);

if (!empty($name) && !empty($email)) {


    $headers = "From: " . $name . "<" . $email . ">";
    $headers = $headers . "\r\n";
    $headers = $headers . 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $to = "kamalkant.prasad@omlogic.com,vijay.kumar@omlogic.com";

    $subject = "User Contact Details From HBO South Asia";

    $body = ' 
		 <table width="80%" border="0" align="center" cellpadding="2" cellspacing="2" >

		  <tr valign="top" class="text">
          <td valign="middle">Name:</td>
          <td>' . $name . '</td>
          </tr>

		  <tr valign="top" class="text">
          <td valign="middle">E-mail:</td>
          <td>' . $email . '</td>
          </tr>

		   <tr valign="top" class="text">
          <td valign="middle">City:</td>
          <td>' . $city . '</td>
          </tr>

		  <tr valign="top" class="text">
          <td valign="middle">Comments:</td>
          <td>' . nl2br($comments) . '</td>
          </tr>
          </tr>

		  <tr valign="top" class="text">
          <td valign="middle">Date:</td>
          <td>' . date('M d, Y h:i:s') . '</td>
          </tr>
  </table>';

    //echo $body;
    if (mail($to, $subject, $body, $headers)) {
        $response["success"] = "Thank you for your time. We will contact you soon.";
    } else {
        $response["success"] = "Your information has not been submit. Plz try again!";
    }

    echo json_encode($response);
} else {
    echo "HBO Defined API";
}
?>
<?php

$to1 = $InsertData['txtEmail1'];
//$to='vijaywithlogic@gmail.com'; 
//$subject='Please confirm your registration'; // accessing subject part of email
$subject1 = 'Your subscription to 3 days movie schedule'; // accessing subject part of email
$emailcontent = '<html>
<head>
  <title>Your subscription to 3 days movie schedule</title>
</head>
<body align="left">
    <p>Hello ' . ucwords($InsertData['txtName1']) . ',<br /><br />

	You recently requested an email subscription from the IP Address ' . $InsertData['userIPAddress'] . ' on ' . DateFormat($InsertData['addDate']) . ' to receive 3 days HBO movies calendar. We can\'t wait to send the updates you want via email, so please click the following link to activate your subscription immediately:<br /><br />

	<a href="http://hbosouthasia.com/verification.php?email=' . $InsertData['txtEmail1'] . '&vcode=' . md5($InsertData['VerificationCode']) . '">http://hbosouthasia.com/verification.php?email=' . $InsertData['txtEmail1'] . '&vcode=' . md5($InsertData['VerificationCode']) . '</a><br /><br />

	(If the link above does not appear clickable or does not open a browser window when you click it, copy it and paste it into your web browser\'s Location bar.)<br /><br />

	As soon as your subscription is active, we will send an email every 3rd day in a month containing the list of movies coming in the next 3 days.<br /><br />

If you did not request this subscription, or no longer wish to activate it, take no action. Simply delete this message and that will be the end of it.<br /><br /><br />

Thank You,<br /><br />HBO South Asia
	</p>
</center>
</body>
</html>
';

$headers1 = "From:HBO South Asia<hbosa@hboasia.com>\nMIME-Version: 1.0\nContent-type:text/html;charset=iso-8859-1\nReturn-Path:hbosa@hboasia.com\nReturn-Receipt-To:hbosa@hboasia.com";
//echo $message1;
// Mail it

//echo $emailcontent;

mail($to1, $subject1, $emailcontent, $headers1);
?>

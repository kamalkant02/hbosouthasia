<?php
$row_sql = mysql_fetch_array($res_ins);
$to=$row_sql['userEmail'];
//$to='vijaywithlogic@gmail.com'; 

$subject='Thank you for confirming your details'; // accessing subject part of email
$message = '<html>
<head>
  <title>Your subscription to 3 days movie schedule</title>
</head>
<body align="left">
   <p>Hello '.ucwords($row_sql['userName']).',<br /><br />
	
	We will send an email every 3rd day in a month containing the list of movies coming in the next 3 days.<br /><br /><br /><br />
	
	
	
	
Thank You,<br /><br />HBO South Asia
</p>
</center>
</body>
</html>
';


// Additional headers
//$headers .= 'To: '.$to.'' . "\r\n";
$headers ="From:HBO South Asia<hbosa@hboasia.com>\nMIME-Version: 1.0\nContent-type:text/html;charset=iso-8859-1\nReturn-Path:hbosa@hboasia.com\nReturn-Receipt-To:hbosa@hboasia.com";
//echo $message;
// Mail it
mail($to, $subject, $message, $headers);
$to1 = 'manjeet.kumar@omlogic.com,priyanka.gupta@omlogic.com,vijay.kumar@omlogic.com';
$subject1 = 'Newsletter Mailing List';
$message1 = 'Hi,<br/><br/>Please add below entry in newsletter list<br/><br/>Email:- '.$to.'<br/><br/>Country:- '.$row_sql['country'].'<br/><br/><br/><br/>Thank You,<br /><br />HBO South Asia';

mail($to1, $subject1, $message1, $headers);
?>
<?php
include("../config.php");
include("../dbconfig.php");

//print_r($_REQUEST);
if(!empty($_POST['id']))
{
$sql_checkin = "SELECT * FROM fb_users WHERE fbuserid='" . $_POST['id'] . "'";
	$res_checkin = mysql_query($sql_checkin);
	//echo date('Y-m-d H:i:s');
	$sql_checkin2 = "SELECT * FROM user_login WHERE fb_id='" . $_POST['id'] . "' and last_visit >= '".date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . "- 30 seconds"))."'";
	$res_checkin2 = mysql_query($sql_checkin2);
	
	//insert into last visit
	if(mysql_num_rows($res_checkin2)==0)
	{
	$sql_last_visit = "INSERT INTO user_login(fb_id,user_agent,ip_address,last_visit) VALUES('" . $_POST['id'] . "','" . $_SERVER['HTTP_USER_AGENT'] . "','" . $_SERVER['REMOTE_ADDR'] . "','" . date('Y-m-d H:i:s') . "')";
		mysql_query($sql_last_visit);
	}
		
	if (mysql_num_rows($res_checkin) > 0) {
	//update users table
		$sql = "UPDATE fb_users 
	set name = '" . $_POST['name'] . "',first_name='" . $_POST['first_name'] . "',last_name='" . $_POST['last_name'] . "',
	gender = '" . $_POST['gender'] . "',email='" . $_POST['email'] . "',link='" . $_POST['linkurl'] . "',username='" . $_POST['username'] . "',
	updatedate = '" . date('Y-m-d H:i:s') . "' where fbuserid='" . $_POST['id'] . "'";
		mysql_query($sql);
		} else
		{	
		$sql1 = "INSERT INTO fb_users (`fbuserid`,  `name`, `first_name`, `last_name`, `gender`, `email`, `link`, `username`, `useripaddress`, `adddate`)
				 VALUES ('" . $_POST['id'] . "', '" . $_POST['name'] . "', '" . $_POST['first_name'] . "', '" . $_POST['last_name'] . "', '" . $_POST['gender'] . "', '" . $_POST['email'] . "', '" . $_POST['linkurl'] . "', '" . $_POST['username'] . "', '".$_SERVER['REMOTE_ADDR']."', '" . date('Y-m-d H:i:s') . "')";
		mysql_query($sql1);
		
		
		$headers ="From:HBO South Asia<hbosa@hboasia.com>\nMIME-Version: 1.0\nContent-type:text/html;charset=iso-8859-1\nReturn-Path:hbosa@hboasia.com\nReturn-Receipt-To:hbosa@hboasia.com";
		//echo $message;
		// Mail it
		$to1 = 'bhawna.pathak@omlogic.com,priyanka.gupta@omlogic.com,vijay.kumar@omlogic.com';
		$subject1 = 'Newsletter Mailing List';
		$message1 = 'Hi,<br/><br/>Please add below entry in newsletter list<br/><br/>Email:- '.$_POST['email'].'<br/><br/>Country:- '.$_SESSION[TerritoryName].'<br/><br/><br/><br/>Thank You,<br /><br />HBO South Asia';
		
		mail($to1, $subject1, $message1, $headers);
		}
		echo '<span style="float:left;">Welcome '.$_POST['name'].'&nbsp;&nbsp;</span><img src="https://graph.facebook.com/'.$_POST['id'].'/picture" width="25px" height="25px" align="right">';
		
}
?>

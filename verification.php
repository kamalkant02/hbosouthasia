<?php
include("config.php");
?>
<?php include("mainheader.php");?>
<body>
<div id="wrapper">
<?php include_once("header.php");?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$InsertData['email'] = DoSecure($_GET['email']);
		$InsertData['verificationcode'] = DoSecure($_GET['vcode']);

///////////////////////////////////////////Server side validation /////////////////////////////////////
		$error_msg = '';
		if ($InsertData['email'] == '') {
			$error_msg.="Email missing.<br>";
		}
		if ($InsertData['verificationcode'] == '') {
			$error_msg.="Verification code missing.<br>";
		}

		if ($error_msg == '') {
			$ins_sql = "Select * from f_newsletter where userEmail='" . $InsertData['email'] . "' and md5(VerificationCode)='" . $InsertData['verificationcode'] . "' and isDeleted=0 and Verified=0";
//echo $ins_sql;
			$res_ins = mysql_query($ins_sql);
			if (mysql_num_rows($res_ins) == 1) {
				$VerificationCheck = 1;
				$upd_sql = "Update f_newsletter set Verified=1, VerificationFromIP='" . $_SERVER["REMOTE_ADDR"] . "', VerifiedOnDate='" . DateFormatDB(date("Y-m-d H:i:s")) . "' where userEmail='" . $InsertData['email'] . "' and md5(VerificationCode)='" . $InsertData['verificationcode'] . "'";
				$res_sql = mysql_query($upd_sql);
				if (mysql_affected_rows()) {
					include("verificationsuccessemail.php");
				}
			} else {
				$VerificationCheck = 3;
			}
		} else {
			$VerificationCheck = 2;
		}
}
$message = '';
switch ($VerificationCheck) {
	case 1: $message .="<span class='successmsg'>Thank you for your confirmation.</span>";
		break;
	case 2: $message .="<span class='errormsg'>" . $error_msg . "</span>";
		break;
	case 3: $message .="<span class='errormsg'>Something went wrong.</span>";
		break;
}
?>
<div id="block_schedule_header" class="clearfix movie_title">
  <div class="container clearfix font_content font_block_header shows_font special_font title_block">
	<div class="page_title">Verification</div>
	<div class="glow glow_position"></div>
  </div>
</div>
  
<div class="block_container" style="min-height: 200px;">
<div class="container clearfix section group">
<div class="font_content font_block_header shows_font special_font channel_section_header bottom_spacing">
<?php if($message != ''){  
echo $message;
} ?>
</div>

</div>
</div>
<?php include("footerlink.php");?>  
<?php include("copyright.php");?> 
</div>
<?php include("footeranalytics.php"); ?>
</body>
</html>

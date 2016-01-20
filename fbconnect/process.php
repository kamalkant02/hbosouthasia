 <?php 
 error_reporting(0);
 include('../config.php');
 
       $app_id = "290373271008258";
       $app_secret = "ea5d42ddedf7f5cb6b4695108842770e";
       $post_login_url = "http://apps.facebook.com/hbosouthasiaconnect/process.php";
       
       $code = $_REQUEST["code"];
//print_r($_REQUEST);
        //Obtain the access_token with publish_stream permission 
       if(empty($code))
         {
           $dialog_url= "http://www.facebook.com/dialog/oauth?"
           . "client_id=" . $app_id 
           . "&redirect_uri=" . urlencode($post_login_url)
           . "&scope=email,read_stream,publish_stream";
           echo("<script>top.location.href='" . $dialog_url . 
           "'</script>");
       } 
       else {
         $token_url= "https://graph.facebook.com/oauth/"
         . "access_token?"
         . "client_id=" .  $app_id 
         . "&redirect_uri=" . urlencode( $post_login_url)
         . "&client_secret=" . $app_secret
         . "&code=" . $code;
         $response = file_get_contents($token_url);
         $params = null;
         parse_str($response, $params);
         $access_token = $params['access_token'];
		 
		 $access_token2 = file_get_contents($token_url);

		$graph_url2 = "https://graph.facebook.com/me?" . $access_token2;
	
		$user = json_decode(file_get_contents($graph_url2));
		//print_r($user);


		
	if($access_token2)
		{
		$sql_checkin = "select * from fb_users where fbuserid='".$user->id ."'";
		$res_checkin = mysql_query($sql_checkin);
		if(mysql_num_rows($res_checkin) > 0)
		{
		$sql = "UPDATE fb_users 
			set
			isdelete = 1,
			updatedate = '" . DateFormatDB(date('Y-m-d H:i:s')) . "'
			where fbuserid='".$user->id."' and isdelete=0";
		 mysql_query($sql);
		}
		
		$sql = "INSERT INTO fb_users (`fbuserid`,  `name`, `first_name`, `last_name`, `gender`, `email`, `link`, `username`, `useripaddress`, `adddate`)
		 VALUES ('" . $user->id . "', '" . $user->name . "', '" . $user->first_name . "', '" . $user->last_name . "', '" . $user->gender . "', '" . $user->email . "', '" . $user->link . "', '" . $user->username . "', '".$_SERVER['REMOTE_ADDR']."', '" . DateFormatDB(date('Y-m-d H:i:s')) . "')";
		 mysql_query($sql);

		//header("location:../logedin.php");
		session_start();
		$_SESSION['fbusername'] = $user->name;
		$_SESSION['fbuserid'] = $user->id;
		}

	
	   ?>
<script>top.location.href='../logedin.php'</script>

		<?php
		}
		 ?>

<!-- initializing FB SDK starts -->
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId : '290373271008258',
status : true, // check login status
cookie : true, // enable cookies to allow the server to access the session
xfbml : true // parse XFBML
});
</script>
<!-- initializing FB SDK ends -->
<?php 
error_reporting(0);
	include('../../dbconfig.php');
	
     
	 if($_REQUEST["post_id"])
	 {
	 $user = explode('_',$_REQUEST["post_id"]);
	 $sql = "INSERT INTO `response_feed` (`postid`, `fbuserid`, `adddate`) VALUES ('".$_REQUEST["post_id"]."', '".$user[0]."','".date('Y-m-d H:i:s')."');";
	 $res = mysql_query($sql);
	 }
?>
<script>
window.close();
</script>
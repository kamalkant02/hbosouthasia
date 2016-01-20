<?php
include('config.php');
$redirecturl = $_SERVER['HTTP_REFERER'];
$sql = "select * from a_territories where TerritoryID=".$_GET['id']." and Status=1";
$res = mysql_query($sql);
if(mysql_num_rows($res) > 0)
{
$row = mysql_fetch_array($res);
$raw_cookie_data = $row['IniSet'];
$enc_cookie_data = base64_encode($raw_cookie_data);
setcookie($cookie_name, $enc_cookie_data, time() + $cookie_time);
header("location:".$redirecturl);
}

?>
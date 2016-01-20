<?php
include("../config.php");
//print_r($_REQUEST);
if($_REQUEST['insert'] == 1)
{
$sql1 = "insert into c_likes (MovieID,UserIPAddress,AddDate) value('".$_REQUEST['movie_id']."','".$_SERVER['REMOTE_ADDR']."','".DateFormatDB(date('Y-m-d H:i:s'))."')";
$res1 = mysql_query($sql1);
}
$sql_like_count = "select * from c_likes where MovieID IN (SELECT MovieID FROM b_movies WHERE Title = (SELECT Title FROM b_movies WHERE MovieID=".$_REQUEST['movie_id']."))";
$res_like_count = mysql_query($sql_like_count);
if(mysql_num_rows($res_like_count) > 0)
{
echo mysql_num_rows($res_like_count);
}
else
{
echo 'No';
}

?>

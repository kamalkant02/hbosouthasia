<?php
include("config.php");
error_reporting(0);
$fromdate = date('Y-m-d');
$todate = date('Y-m-d',strtotime(date('Y-m-d') ."+ 2 day"));

$sql1 = "select * from b_movies WHERE DATE(AiringDateTime) BETWEEN '".$fromdate."' AND '".$todate."' AND Status=1 ORDER BY AiringDateTime ASC" ; 
$res1 = mysql_query($sql1);
if(mysql_num_rows($res1) > 0)
{
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>
';?>
<?php 
echo '<rss version="2.0"  xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
<channel>
	<title>HBO South Asia</title>
	<link>http://www.hbosouthasia.com/</link>
	<description>HBO South Asia</description>
	<copyright>http://www.hbosouthasia.com All Rights Reserved</copyright>
	';
	
while($row = mysql_fetch_array($res1))
{
echo '	<item>
		<MovieTitle>'.$row['Title'].'</MovieTitle>
		<AiringDateTime>'.$row['AiringDateTime'].'</AiringDateTime>
		<Starring>'.$row['Starring'].'</Starring>
		<DirectedBy>'.$row['DirectedBy'].'</DirectedBy>
		<MovieDescription><![CDATA[ '.$row['Synopsis'].']]></MovieDescription>
		<MovieImage>http://www.hbosouthasia.com/'.$row['FilePath'].'</MovieImage>
		<BlockBuster>'.$row['BlockBuster'].'</BlockBuster>		        
		<IsHighlight>'.$row['IsHighlight'].'</IsHighlight>
		<MovieLink>http://www.hbosouthasia.com/moviepreview.php?id='.$row['MovieID'].'</MovieLink>
		</item>
';
}
             
   echo '</channel>';
	echo '</rss>';
}
?>
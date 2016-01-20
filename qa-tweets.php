<?php
include("config.php");
$datestring = date("jS F Y",strtotime($_GET['weekdate']));

?>
<html><head>
    <title>HBO South Asia Tweet - <?php echo $datestring;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="robots" content="noindex,nofollow">
</head>

<body>
    
    

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<table width="580" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr valign="top">
    <td><p>
                       <span style="float:left;"><a href="<?php echo $_SERVER['PHP_SELF']?>?weekdate=<?php echo date("Y-m-d",strtotime($_GET['weekdate'] ."- 1 day")) ?>"><<-Previous</a></span>
					    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HBO South Asia Tweet – <?php echo $datestring;?></strong>
						<span style="float:right;"><a href="<?php echo $_SERVER['PHP_SELF']?>?weekdate=<?php echo date("Y-m-d",strtotime($_GET['weekdate'] ."+ 1 day")) ?>">Next->></a></span>
                <font face="Arial, Helvetica, sans-serif" size="2"><br>
      </font>
       </p>
<?php
$sql_didyouknow = "SELECT * FROM `d_didyouknow` WHERE DATE(ShowDate)='".$_GET['weekdate']."' AND `Status`=1 LIMIT 0,1";
$res_didyouknow = mysql_query($sql_didyouknow);
if(mysql_num_rows($res_didyouknow) > 0)
{
$row_didyouknow = mysql_fetch_array($res_didyouknow);
echo $row_didyouknow['StoryLine'];

if(strlen($row_didyouknow['StoryLine']) > 119)
{
$storyline = substr($row_didyouknow['StoryLine'],0,115)."...";
}
else
{
$storyline = $row_didyouknow['StoryLine'];
}

?>
<div align="right"><a href="https://twitter.com/intent/tweet?original_referer=http://www.hbosouthasia.com&text=<?php echo $storyline; ?>&url=http://www.hbosouthasia.com" target="_blank" alt="Share on Twitter" title="Share on Twitter" ><img src="../images/tweet.png"/></a></div>
<?php } ?>
</td></tr>
  <tr><td>&nbsp;</td></tr>
  </tbody></table>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</body>
</html>
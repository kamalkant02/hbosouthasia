<?php
include("config.php");
$searchtext = DoSecure(addslashes($_REQUEST['search_name']));
?>
<?php include("mainheader.php");?>
<body>
<div id="wrapper">
<?php include_once("header.php");?>
    <div id="block_schedule_header" class="clearfix movie_title">
      <div class="container clearfix font_content font_block_header shows_font special_font title_block">
        <h2 class="movie_title">Search Results for "<?php echo $_REQUEST['search_name']; ?>"</h2>
        <div class="glow glow_position"></div>
      </div>
  </div>
  
  <div class="block_container" style="min-height: 200px;">
<?php
$split_stemmed = split(" ",$searchtext);
	
    $sql_search = "SELECT DISTINCT * FROM (((SELECT DISTINCT *
					FROM b_movies
					WHERE (Title LIKE '%$searchtext%')
					and Status=1 )) 
					UNION ";         
	$sql_search .= "(SELECT DISTINCT * FROM b_movies WHERE (";
	             
	while(list($key,$val)=each($split_stemmed)){
              if($val<>" " and strlen($val) > 0){
              $sql_search .= "(Title LIKE '%$val%') OR";
              }
	}
              $sql_search=substr($sql_search,0,(strLen($sql_search)-3));//this will eat the last OR
              $sql_search .= ") and Status=1)) as tab ORDER BY AiringDateTime DESC";
			  
			  
//echo $sql_search;
$res_search = mysql_query($sql_search);
$rowPerpage = 10;
$linkPerpage = 8; //ceil($totalrow/$rowPerpage);
if(mysql_num_rows($res_search) > 0)
{
	require('include/ps_pagination.php');
	$pager = new PS_Pagination($link, $sql_search, $rowPerpage, $linkPerpage, 'search_name='.$_GET['search_name'].'');
	$paginationlist = $pager->paginate();
	
	while($row_search = mysql_fetch_array($paginationlist))
	{
	?>
  <div class="container clearfix section group">
				<div class="font_content font_block_header shows_font special_font channel_section_header bottom_spacing"></div>
			</div>
	<div class="container clearfix section group">
		<div class="span_15_of_15 clearfix" style="padding-bottom: 20px;">
			<div class="span_4_of_15 special_font" style="float:left;"><a class="shows_font special_font" href="<?php echo getmoviename($row_search['Title'],$row_search['MovieID'])?>" title="<?php echo $row_search['Title']; ?>"><img src="http://www.hbosouthasia.com/<?php echo $row_search['FilePathBig']; ?>" alt="<?php echo $row_search['Title']; ?>" border="0" height="170" width="225" style="border:2px solid;"></a></div>
			<div class="span_11_of_15 font_content special_font" style="float:left;">
				<a class="shows_font special_font" href="<?php echo getmoviename($row_search['Title'],$row_search['MovieID'])?>" title="<?php echo $row_search['Title']; ?>"><?php echo $row_search['Title']; ?></a>
				<br><?php echo DateFormat($row_search['AiringDateTime']); ?><br><br><?php echo $row_search['Synopsis']; ?>		
				</div>
			</div>
		</div>
<?php } } ?>
	</div>
<?php include("footerlink.php");?>  
<?php include("copyright.php");?> 
</div>
<?php include("footeranalytics.php"); ?>
</body>
</html>
